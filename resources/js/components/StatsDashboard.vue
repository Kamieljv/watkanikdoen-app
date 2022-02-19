<template>
    <div class="page-content browse container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
						<div class="flex border-0" style="justify-content: space-between;">
							<h2>Bezoekersstatistieken</h2>
							<a :href="statsUrl" class="btn btn-info">Meer statistieken</a>
						</div>
						<p>Laatste {{days}} dagen vergeleken met de {{days}} dagen daarvoor</p>
						<div v-if="isError.visit" class="error-message">
							<p>Er is iets misgegaan bij het laden van de statistieken.</p>
						</div>
						<div v-else class="flex border-0">
							<div v-for="stat in Object.keys(visitStats)" :key="stat" class="stat-container">
								<p>{{stat}}</p>
								<div v-if="!isLoading.visit" class="flex border-0">
									<h2 class="stat-number">{{visitStats[stat].value}}{{stat == 'totaltime' ? 's' : ''}}</h2>
									<span
										class="change"
										:class="{positive: visitStats[stat].change > 0, negative: visitStats[stat].change < 0}"
									>
										{{visitStats[stat].change}}{{stat == 'totaltime' ? 's' : ''}}
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
	import moment from 'moment'

	export default {
		name: "StatsDashboard",
		props: {
			umamiToken: {
				type: String,
				required: true,
			},
			statsUrl: {
				type: String,
				required: true,
			},
			platformStatsRoute: {
				type: String,
				required: true,
			},
			days: {
				type: Number,
				default: 7,
			}
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
			}
		},
		mounted() {
			this.visitStats = ['pageviews', 'uniques', 'bounces', 'totaltime']
								.reduce((acc,curr)=> (acc[curr]={value: 'N/A', change: 'N/A'},acc),{})
			this.platformStats = ['acties', 'users', 'organizers']
								.reduce((acc,curr)=> (acc[curr]='N/A',acc),{})
			this.getPlatformStats()
			this.getVisitStats(2, this.days, 0)
		},
		methods: {
			getVisitStats(websiteId, startDaysAgo, endDaysAgo) {
				this.$http.get(`https://analytics.watkanikdoen.nl/api/website/${websiteId}/stats`, {
					withCredentials: true,
					headers: {
						'Authorization': `Bearer ${this.umamiToken}`
					},
					params: {
						start_at: moment().subtract(startDaysAgo, 'days').unix()*1000,
						end_at: moment().subtract(endDaysAgo, 'days').unix()*1000
					}
				}).then((response) => {
					this.visitStats = response.data
					console.log(this.visitStats)
					this.isLoading.visit = false
				}).catch((error) => {
					console.log(error)
					this.isLoading.visit = false
					this.isError.visit = true
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
			&::before {
				content: '+';
				margin-left: 5px;
				margin-right: -3px;
			}
		}
		&.negative {
			margin-left: 5px;
			color: red;
		}
	}
</style>

