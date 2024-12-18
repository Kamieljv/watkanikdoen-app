<template>
	<div class="Collapsible bg-gray-200 rounded-md">
		<button @click.prevent="handleClick" type="button" :class="{
			Collapsible__trigger: true,
			'Collapsible__trigger--open': !transitioning && open,
			'Collapsible__trigger--closed': !transitioning && !open,
			'Collapsible__trigger--transitioning': transitioning,
		}">
			<slot name="trigger">
				<div class="customTrigger flex items-center justify-between p-4">
					<div class="flex items-center space-x-3 text-gray-800">
						<slot name="icon"></slot>
						<h3 class="text-sm" style="line-height: 1.5rem" :style="labelStyle">{{ triggerLabel }}</h3>
						<div v-if="notificationCount" id="notification-count"
							class="flex items-center justify-center w-5 h-5 text-sm font-extrabold text-white bg-gray-500 rounded-full">
							{{ notificationCount }}
						</div>
					</div>
					<ChevronDownIcon class="flippable" />
				</div>
			</slot>
		</button>

		<div :class="{
				Collapsible__content: true,
				'Collapsible__content--open': !transitioning && open,
				'Collapsible__content--closed': !transitioning && !open,
				'Collapsible__content--transitioning': transitioning,
			}" 
			:style="{
				height,
				transitionProperty: 'height',
				transitionDuration,
				transitionTimingFunction,
				transitionDelay,
			}" @transitionend="handleEnd">
			<div class="Collapsible__contentInner p-4 bg-gray-50 border border-t-0 rounded-md border-gray-300"
				ref="innerRef">
				<slot></slot>
			</div>
		</div>
	</div>
</template>

<script setup lang="ts">

import { nextTick, onUpdated, ref, watch } from 'vue';
import ChevronDownIcon from '&/heroicon-s-chevron-down.svg';

const props = defineProps({
	triggerLabel: {
		type: String,
		default: 'Open me',
	},
	labelStyle: {
		type: String,
		default: ''
	},
	notificationCount: {
		type: Number,
		default: null,
	},
	transitionDuration: {
		type: String,
		default: '400ms',
	},
	transitionTimingFunction: {
		type: String,
		default: 'ease',
	},
	transitionDelay: {
		type: String,
		default: '0s',
	},
	isOpen: {
		default: true,
		type: Boolean,
	},
	onCollapse: {
		default: () => { },
		type: Function,
	}
})

const open = ref(props.isOpen)
const height = ref(props.isOpen ? 'auto' : '0px')
const closeOnNextTick = ref(false)
const transitioning = ref(false)
const innerRef = ref(null)

watch(open, (newVal, oldVal) => {
	transitioning.value = true;
	height.value = innerRef.value.scrollHeight + 'px';
	if (oldVal === true) {
		closeOnNextTick.value = true;
	}
})

watch(() => props.isOpen, (newVal) => {
	open.value = newVal
})

const handleClick = () => {
	props.onCollapse(!props.isOpen)
	open.value = !open.value
}


const handleEnd = () => {
	if (height.value !== '0px') {
		height.value = 'auto';
	}
	transitioning.value = false;
}
	
onUpdated(() => {
	nextTick(() => {
		window.setTimeout(() => {
			if (closeOnNextTick.value) {
				height.value = '0px';
				closeOnNextTick.value = false;
			}
		});
	});
})
</script>

<style scoped lang="scss">
.Collapsible__content:not(.Collapsible__content--open) {
	overflow: hidden;
}

.Collapsible__trigger {
	appearance: none;
	border: 0;
	background: transparent;
	border-radius: 0;
	font-family: inherit;
	font-size: inherit;
	font-style: inherit;
	text-align: inherit;
	color: inherit;
	padding: 0;
	margin: 0;
	display: block;
	width: 100%;
	cursor: pointer;
}


.Collapsible__trigger.Collapsible__trigger--open svg.flippable {
	transform: rotate(0.5turn);
}

.customTrigger {
	display: grid;
	grid-template-columns: auto 20px;
	align-items: center;
}

.customTrigger svg {
	display: block;
	width: 100%;
	height: auto;
}
</style>
