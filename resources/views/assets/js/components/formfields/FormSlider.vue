<template>
    <div 
        class="slider-input-wrapper flex items-center justify-between"
        :title="disabled? 'Selecteer eerst een plaatsnaam.' : ''"
    >
        <div class="slider-wrapper w-full flex flex-col shrink items-center">
            <div class="w-full text-left text-sm text-gray-500">
                {{ 'Afstand (tot ' + (disabled? '...' : value) + ' ' + unit + ')'}}
            </div>
            <input
                type="range"
                ref="range"
                class="range-slider"
                @input="inputCaptured"
                :max="max"
                :min="min"
                step="10"
                v-model="value"
                :style="{
                    '--range-width': rangeWidth,
                    '--progress-color': disabled? 'gray' : progressColor,
                    '--track-color': trackColor,
                    '--track-height': trackHeight,
                    '--thumb-border-radius': squaredThumb ? '0' : '50%',
                    '--thumb-color': disabled? 'gray' : thumbColor,
                    '--thumb-size': thumbSize,
					'--webkit-thumb-offset': thumbOffset,
                }"
                :disabled="disabled"
            />
        </div>
    </div>
</template>

<script>
export default {
	name: "FormSlider",
	props: {
		currentValue: {
			type: Number,
			required: false,
		},
		unit: {
			type: String
		},
		rangeWidth: {
			type: String,
			required: false,
			default: "100%",
		},
		delay: {
			type: Number, 
			required: false,
			default: 500,
		},
		disabled: {
			type: Boolean,
			default: false,
		},
		progressColor: {
			type: String,
			required: false,
			default: "#000c",
		},
		trackColor: {
			type: String,
			required: false,
			default: "#0003",
		},
		squaredThumb: {
			type: Boolean,
			required: false,
			default: false,
		},
		thumbColor: {
			type: String,
			required: false,
			default: "blue",
		},
		thumbSize: {
			type: String,
			required: false,
			default: "14px",
		},
		trackHeight: {
			type: String,
			default: "5px",
		},
		max: {
			type: Number,
			required: false,
			default: 100,
		},
		min: {
			type: Number,
			required: false,
			default: 10,
		},
	},
	data() {
		return {
			value: this.currentValue,
		}
	}, 
	computed: {
		updateWebkitProgress() {
			const progress = ((this.value - this.min) / (this.max - this.min)) * 100 + "%"
			return this.$refs.range.style.setProperty("--webkit-progress", progress)
		},
		inputCaptured() {
			return _.debounce(this.processInput, this.delay)
		},
		thumbOffset() {
			var size = Number(this.thumbSize.split("px")[0])
			return (Math.max((size/2 - 1) * 0.5, 0) - size * 0.5) + "px"
		}
	},
	mounted() {
		this.updateWebkitProgress
	},
	watch: {
		value: function() {
			this.updateWebkitProgress
		},
	},
	methods: {
		processInput(event) {
			this.$emit("input", Number(event.target.value))
		},
	},
}
</script>

<style scoped>
.range-slider {
  position: relative;
  -webkit-appearance: none;
  background: none;
  margin: 0;
  padding: 5px 0;
  height: 19px;
  width: var(--range-width);
}
.range-slider:focus-visible {
  outline: 2px solid var(--progress-color);
}
.range-slider::-webkit-slider-runnable-track {
  width: 100%;
  height: var(--track-height);
  cursor: pointer;
  background: var(--track-color);
}
.range-slider::before {
  position: absolute;
  content: "";
  top: 7px;
  left: 0;
  width: var(--webkit-progress);
  height: var(--track-height);
  background-color: var(--progress-color);
  cursor: pointer;
  border-radius: 3px;
}
.range-slider::-webkit-slider-thumb {
  position: relative;
  -webkit-appearance: none;
  box-sizing: content-box;
  border: 1px solid var(--thumb-border-color);
  height: var(--thumb-size);
  width: var(--thumb-size);
  border-radius: 50%;
  background-color: var(--thumb-color);
  cursor: pointer;
  margin-top: var(--webkit-thumb-offset);
}
.range-slider:active::-webkit-slider-thumb {
  transform: scale(1.2);
  background: var(--thumb-color);
}
.range-slider::-moz-range-track {
  width: 100%;
  height: var(--track-height);
  cursor: pointer;
  background: var(--track-color);
}
.range-slider::-moz-range-progress {
  height: var(--track-height);
  background-color: var(--progress-color);
}
.range-slider::-moz-focus-outer {
  border: 0;
}
.range-slider::-moz-range-thumb {
  box-sizing: content-box;
  border: 1px solid var(--thumb-border-color);
  height: var(--thumb-size);
  width: var(--thumb-size);
  border-radius: var(--thumb-border-radius);
  background-color: var(--thumb-color);
  cursor: pointer;
}
.range-slider:active::-moz-range-thumb {
  transform: scale(1.2);
  background: var(--thumb-color);
}
</style>