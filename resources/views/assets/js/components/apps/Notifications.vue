<template>
	<div class="flex flex-col justify-start flex-1 mb-5 overflow-hidden bg-white border shadow-md rounded-lg border-gray-150">
		<div class="flex flex-wrap items-center justify-between p-5 bg-white border-b border-gray-150 sm:flex-no-wrap">
			<div class="relative flex-1">
				<h3 class="flex items-center text-lg font-medium leading-6 text-gray-900 space-x-3">
					<span>{{ __("notifications.notifications") }}</span>
					<div v-if="unreadNotifications > 0" id="notification-count" class="flex items-center justify-center w-5 h-5 text-sm font-extrabold text-red-100 bg-red-500 rounded-full">
						{{ unreadNotifications }}
					</div>
				</h3>
				<p class="text-sm leading-5 text-gray-500 mt-2">
					{{ __("dashboard.notifications_description") }}
				</p>
			</div>
		</div>

		<div v-if="noNotifications" id="notifications-none" class="flex items-center justify-center h-24 w-full text-gray-600 font-medium">
			<InboxIcon class="w-5 h-5 mr-3" />
			{{ __("dashboard.no_notifications") }}
		</div>

		<div id="notification-ul" class="relative max-h-[400px] overflow-y-scroll">
			<div
				v-for="(n, i) in notificationsProcessed"
				:key="n.id"
			 	:id="'notification-li-' + i"
				class="flex flex-col border-b border-gray-200 w-full"
				:class="{'bg-blue-50': n.unread, 'hover:bg-gray-100': !n.unread}"
			>
				<div class="flex items-start p-5">
					<div class="flex-shrink-0 pt-1">
						<div class="flex items-center justify-center text-xl w-10 h-10 rounded-full text-gray-400" :class="{'text-white bg-[color:var(--wkid-blue)]': n.unread, 'bg-gray-100': !n.unread}">
							<BellIcon style="stroke: currentColor; height: 26px;" />
						</div>
					</div>
					<div class="flex flex-col items-start flex-1 w-0 ml-3">
						<a :href="n.data.link">
							<div class="text-sm leading-5 text-gray-600" :class="{'text-gray-700': n.unread}">
								<span class="text-[15px] font-medium" :class="{'font-black': n.unread}">{{ n.data.title }}</span><br/>
								<span :class="{'font-bold': n.unread}">{{ n.data.body }}</span>
							</div>
						</a>
						<div class="flex space-x-3 w-full items-center justify-left mt-2 text-xs font-medium leading-5 text-gray-500">
							<span class="notification-datetime text-xs">{{ formatDistanceToNow(parseISO(n.created_at), {locale: nl}) }} {{ __('general.ago') }}</span>
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

<script setup lang="ts">
import axios from 'axios';
import { parseISO, formatDistanceToNow } from 'date-fns';
import { nl } from 'date-fns/locale';
import { computed, ref } from 'vue';
import InboxIcon from '&/antdesign-inbox-o.svg';
import BellIcon from '&/bell.svg';
import _ from 'lodash';
const __ = str => _.get(window.i18n, str)

const props = defineProps({
	notifications: {
		type: Array,
		required: true,
	},
	readRoute: {
		type: String,
		required: true,
	}
})

const notif = ref(props.notifications)

const noNotifications = computed(() => notif.value.length === 0)

const notificationsProcessed = computed(() => {
	return notif.value.map((n: object) => {
		n.unread = n.read_at === null
		return n
	})
})

const unreadNotifications = computed(() => {
	return notificationsProcessed.value.filter((n) => n.unread === true).length
})

const markAsRead = (e) => {
	axios.post(props.readRoute + "/" + e.target.dataset.id).then((response) => {
		if (response.data.type == "success") {
			notif.value[e.target.dataset.listid].read_at = new Date()
		}
	})
}

</script>
<style lang="scss" scoped>
	#notification-ul {
		/* Hide scrollbar for IE, Edge and Firefox */
		-ms-overflow-style: none;  /* IE and Edge */
		scrollbar-width: none;  /* Firefox */
		
		/* Hide scrollbar for Chrome, Safari and Opera */
		&::-webkit-scrollbar {
			display: none;
		}
	}
</style>