<template>
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
						<div class="flex border-0" style="justify-content: space-between;">
							<h2>Bezoekersstatistieken</h2>
							<a :href="umamiUrl" class="btn btn-info">Meer statistieken</a>
						</div>
						<p>Laatste {{days}} dagen vergeleken met de {{days}} dagen daarvoor</p>
						<div v-if="isError.visit" class="error-message">
							<p>Er is iets misgegaan bij het laden van de statistieken.</p>
						</div>
						<div v-else class="flex border-0">
							<div v-for="stat in Object.keys(visitStats)" :key="stat" class="stat-container">
								<p>{{names[stat]}}</p>
								<div v-if="!isLoading.visit" class="flex border-0">
									<h2 class="stat-number">{{visitStats[stat].value}}</h2>
									<span
										class="change"
										:class="{
											positive: visitStats[stat].change > 0 || visitStats[stat].change[0] !== '-',
											negative: visitStats[stat].change < 0 || visitStats[stat].change[0] === '-',
											bounce: stat === 'bouncerate',
										}"
									>
										{{visitStats[stat].change}}
									</span>
								</div>
								<div v-else class="custom-loader"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
						<h2>Platformstatistieken</h2>
						<div v-if="isError.platform" class="error-message">
							<p>Er is iets misgegaan bij het laden van de statistieken.</p>
						</div>
						<div v-else class="flex border-0">
							<div v-for="stat in Object.keys(platformStats)" :key="stat" class="stat-container">
								<p>{{stat}}</p>
								<div v-if="!isLoading.platform" class="flex border-0">
									<h2 class="stat-number">{{platformStats[stat]}}</h2>
								</div>
								<div v-else class="custom-loader"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</template>

<script>
import moment from "moment"

export default {
	name: "StatsDashboard",
	props: {
		platformStatsRoute: {
			type: String,
			required: true,
		},
		days: {
			type: Number,
			default: 7,
		},
		umamiUsername: {
			type: String,
			required: true,
		},
		umamiPassword: {
			type: String,
			required: true,
		},
		umamiUrl: {
			type: String,
			required: true,
		},
		umamiWebsiteId: {
			type: String,
			required: true,
		},
	},
	data() {
		return {
			visitStats: {},
			platformStats: {},
			isLoading: {
				visit: true,
				platform: true,
			},
			isError: {
				visit: false,
				platform: false,
			},
			names: {
				'pageviews': 'pageviews',
				'visitors': 'visitors',
				'bouncerate': 'bounce rate',
				'avgtime': 'average visit',
			}
		}
	},
	mounted() {
		this.visitStats = ["pageviews", "visitors", "bouncerate", "avgtime"]
			.reduce((acc,curr)=> (acc[curr]={value: "N/A", change: "N/A"},acc),{})
		this.platformStats = ["acties", "users", "organizers"]
			.reduce((acc,curr)=> (acc[curr]="N/A",acc),{})
		this.getPlatformStats()
		this.getVisitStats(this.days, 0)
	},
	methods: {
		getVisitStats(startDaysAgo, endDaysAgo) {
			this.$http.post(`${this.umamiUrl}/api/auth/login`, {
				"username": this.umamiUsername,
				"password": this.umamiPassword,
			}).then((response) => {
				this.$http.get(`${this.umamiUrl}/api/websites/${this.umamiWebsiteId}/stats`, {
					headers: {
						"Authorization": `Bearer ${response.data.token}`
					},
					params: {
						startAt: moment().subtract(startDaysAgo, "days").unix()*1000,
						endAt: moment().subtract(endDaysAgo, "days").unix()*1000
					}
				}).then((response) => {
					this.processData(response.data);
					this.isLoading.visit = false
				}).catch((error) => {
					console.log(error)
					this.isLoading.visit = false
					this.isError.visit = true
				})
			})
		},
		getPlatformStats() {
			this.$http.get(this.platformStatsRoute)
				.then((response) => {
					this.platformStats = response.data
					this.isLoading.platform = false
				}).catch((error) => {
					console.log(error)
					this.isLoading.platform = false
					this.isError.platform = true
				})
		},
		processData(data) {
			console.log(data);
			const { bounces, pageviews, totaltime, visitors, visits } = data || {};
			const num = Math.min(data && visitors.value, data && bounces.value);
			const diffs = data && {
				pageviews: pageviews.value - pageviews.change,
				visitors: visitors.value - visitors.change,
				visits: visits.value - visits.change,
				bounces: bounces.value - bounces.change,
				totaltime: totaltime.value - totaltime.change,
			};
			var computedStats = {
				bouncerate: {
					value: Number(visitors.value ? (num / visitors.value) * 100 : 0).toFixed(0) + '%',
					change: Number(visitors.value && visitors.change
						? (num / visitors.value) * 100 -
							(Math.min(diffs.visitors, diffs.bounces) / diffs.visitors) * 100 || 0
						: 0).toFixed(0) + '%',
				},
				avgtime: {
					value: this.formatShortTime(Math.abs(totaltime.value && pageviews.value
						? totaltime.value / (pageviews.value - bounces.value)
						: 0)),
					change: this.formatShortTime(Math.abs(totaltime.value && pageviews.value
						? (diffs.totaltime / (diffs.pageviews - diffs.bounces) -
							totaltime.value / (pageviews.value - bounces.value)) *
							-1 || 0
						: 0)),
				},
			}
			this.visitStats = Object.fromEntries(
				Object.entries({ ...data, ...computedStats }).filter((key) =>
					Object.keys(this.visitStats).includes(key[0])
				)
			);
		},
		formatShortTime(secs, space = ' ') {
			const time = moment.utc(secs * 1000)
			const minutes = time.minutes()
			const seconds = time.seconds()

			let t = '';

			if (minutes > 0) t += `${minutes}m${space}`;
			if (seconds > 0) t += `${seconds}s${space}`;

			if (!t) {
				return `0s`;
			}

			return t;
		}
	}
}
</script>

<style lang="scss" scoped>
	.error-message {
		color: red;
	}
    .stat-number {
		color: black;
		font-weight: 900;
	}
	.stat-container {
		margin-right: 0.75rem;
		min-width: 120px;
	}
	span.change {
		font-weight: 600;
		&.positive {
			color: green;
			&.bounce {
				color: red;
			}
			&::before {
				content: '+';
				margin-left: 5px;
				margin-right: -3px;
			}
		}
		&.negative {
			margin-left: 5px;
			color: red;
			&.bounce {
				color: green;
			}
		}
	}
</style>

