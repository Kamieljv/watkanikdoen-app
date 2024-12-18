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
									<h2 v-if="stat==='avgtime'" class="stat-number">{{formatShortTime(visitStats[stat].value)}}</h2>
									<h2 v-else class="stat-number">{{visitStats[stat].value}}</h2>
									<span
										class="change"
										:class="{
											positive: visitStats[stat].change > 0,
											negative: visitStats[stat].change < 0,
											bounce: stat === 'bouncerate',
										}"
									>
										<span v-if="stat === 'avgtime'">
											{{formatShortTime(visitStats[stat].change)}}
										</span>
										<span v-else>{{visitStats[stat].change}}</span>
										<span v-if="stat === 'bouncerate'">%</span>
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

<script setup lang="ts">

import { onMounted, ref } from "vue"
import axios from 'axios'
import { getTime, intervalToDuration, subDays } from "date-fns";

const props = defineProps({
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
})

const visitStats = ref({})
const platformStats = ref({})
const isLoading = ref({
	visit: true,
	platform: true,
})
const isError = ref({
	visit: false,
	platform: false,
})
const names = ref({
	'pageviews': 'pageviews',
	'visitors': 'visitors',
	'bouncerate': 'bounce rate',
	'avgtime': 'average visit',
})

const getVisitStats = (startDaysAgo, endDaysAgo) => {
	axios.post(`${props.umamiUrl}/api/auth/login`, {
		"username": props.umamiUsername,
		"password": props.umamiPassword,
	}).then((response) => {
		axios.get(`${props.umamiUrl}/api/websites/${props.umamiWebsiteId}/stats`, {
			headers: {
				"Authorization": `Bearer ${response.data.token}`
			},
			params: {
				startAt: getTime(subDays(new Date(), startDaysAgo)),
				endAt: getTime(subDays(new Date(), endDaysAgo))
			}
		}).then((response) => {
			processData(response.data);
			isLoading.value.visit = false
		}).catch((error) => {
			console.log(error)
			isLoading.value.visit = false
			isError.value.visit = true
		})
	})
}

const getPlatformStats = () => {
	axios.get(props.platformStatsRoute)
		.then((response) => {
			platformStats.value = response.data
			isLoading.value.platform = false
		}).catch((error) => {
			console.log(error)
			isLoading.value.platform = false
			isError.value.platform = true
		})
}

const processData = (data) => {
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
				: 0).toFixed(0),
		},
		avgtime: {
			value: Math.abs(totaltime.value && pageviews.value
				? totaltime.value / (pageviews.value - bounces.value)
				: 0),
			change: totaltime.value && pageviews.value
				? (diffs.totaltime / (diffs.pageviews - diffs.bounces) -
					totaltime.value / (pageviews.value - bounces.value)) *
					-1 || 0
				: 0,
		},
	}
	visitStats.value = Object.fromEntries(
		Object.entries({ ...data, ...computedStats }).filter((key) =>
			Object.keys(visitStats.value).includes(key[0])
		)
	);
}

const formatShortTime = (secs, space = ' ') => {
	const prefix = secs < 0 ? '-' : '';
	const {minutes, seconds} = intervalToDuration({ start: 0, end: Math.round(secs) * 1000 });

	let t = '';

	if (minutes > 0) t += `${minutes}m${space}`;
	if (seconds > 0) t += `${seconds}s${space}`;

	if (!t) {
		return `0s`;
	}

	return prefix + t;
}

onMounted(() => {
	visitStats.value = ["pageviews", "visitors", "bouncerate", "avgtime"]
		.reduce((acc,curr)=> (acc[curr]={value: "N/A", change: "N/A"},acc),{})
	platformStats.value = ["acties", "users", "organizers"]
		.reduce((acc,curr)=> (acc[curr]="N/A",acc),{})
	getPlatformStats()
	getVisitStats(props.days, 0)
})

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

