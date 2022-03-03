<template>
	<div class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border shadow-md rounded-lg border-gray-150">
		<div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
			<div class="relative flex-1">
				<h3 class="flex items-center text-lg font-medium leading-6 text-gray-900 space-x-3">
					<span>{{ __("notifications.notifications") }}</span>
					<div v-if="unreadNotifications > 0" id="notification-count" class="flex items-center justify-center w-7 h-7 text-base font-extrabold text-red-100 bg-red-500 rounded-full">
						{{ unreadNotifications }}
					</div>
				</h3>
				<p class="text-sm leading-5 text-gray-500 mt-2">
					{{ __("dashboard.notifications_description") }}
				</p>
			</div>
		</div>

		<div v-if="noNotifications" id="notifications-none" class="flex items-center justify-center h-24 w-full text-gray-600 font-medium">
			<svg-vue icon="antdesign-inbox-o" class="w-5 h-5 mr-3" />
			{{ __("dashboard.no_notifications") }}
		</div>

		<div class="relative max-h-[400px] overflow-y-scroll">
			<div
				v-for="(n, i) in notificationsProcessed"
				:key="n.id"
			 	:id="'notification-li-' + i"
				class="flex flex-col border-b border-gray-200"
				:class="{'bg-blue-50': n.unread, 'hover:bg-gray-100': !n.unread}"
			>
				<div class="flex items-start p-5">
					<div class="flex-shrink-0 pt-1">
						<div class="flex items-center justify-center text-xl w-10 h-10 rounded-full text-gray-400" :class="{'text-white bg-[color:var(--wkid-blue)]': n.unread, 'bg-gray-100': !n.unread}">
							<svg-vue :icon="n.data.icon" style="stroke: currentColor; height: 26px;" />
						</div>
					</div>
					<div class="flex flex-col items-start flex-1 w-0 ml-3">
						<a :href="n.data.link">
							<div class="text-sm leading-5 text-gray-600" :class="{'text-gray-700': n.unread}">
								<span class="text-[15px] font-medium" :class="{'font-black': n.unread}">{{ n.data.title }}</span><br/>
								<span :class="{'font-bold': n.unread}">{{ n.data.body }}</span>
							</div>
						</a>
						<div class="flex space-x-3 w-full items-center justify-left mt-2 text-sm font-medium leading-5 text-gray-500">
							<span class="notification-datetime">{{ moment(n.created_at).fromNow() }}</span>
							<span v-if="n.unread">•</span>
							<span v-if="n.unread" @click="markAsRead" :data-id="n.id" :data-listid="i" class="flex justify-start text-xs text-gray-500 cursor-pointer hover:text-gray-700 mark-as-read hover:underline">
								<svg class="absolute w-4 h-4 mt-1 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
								<svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
								{{ __("general.mark_as_read") }}
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	name: "Notifications",
	props: {
		notifications: {
			type: Array,
			required: true,
		},
		readRoute: {
			type: String,
			required: true,
		}
	},
	data() {
		return {
			notif: this.notifications
		}
	},
	computed: {
		noNotifications() {
			return this.notif.length === 0
		},
		notificationsProcessed() {
			return this.notif.map((n) => {
				n.unread = n.read_at === null
				return n
			})
		},
		unreadNotifications() {
			return this.notificationsProcessed.filter((n) => n.unread === true).length
		}
	},
	mounted() {
	},
	methods: {
		markAsRead(e) {
			this.$http.post(this.readRoute + "/" + e.target.dataset.id).then((response) => {
				if (response.data.type == "success") {
					Vue.set(this.notif[e.target.dataset.listid], "read_at", new Date())
				}
			})
		}
	},
}
</script>