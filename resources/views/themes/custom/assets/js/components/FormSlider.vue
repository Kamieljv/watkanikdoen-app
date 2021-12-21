<template>
    <div class="slider-input-wrapper flex flex-row items-center justify-between">
        <div class="slider-wrapper flex shrink items-center">
            <input
                type="range"
                ref="range"
                class="range-slider"
                @input="$emit('input', $event.target.value)"
                :max="max"
                :min="min"
                v-model="value"
                :style="{
                    '--range-width': rangeWidth,
                    '--progress-color': progressColor,
                    '--track-color': trackColor,
                    '--track-height': trackHeight,
                    '--thumb-border-radius': squaredThumb ? '0' : '50%',
                    '--thumb-color': thumbColor,
                    '--thumb-size': thumbSize,
                }"
            />
        </div>
        <div class="value-wrapper shrink-0 ml-3">
            {{ value + ' ' + unit }}
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            unit: {
                type: String
            },
            rangeWidth: {
                type: String,
                required: false,
                default: "100%",
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
                default: "11px",
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
                value: this.min,
            }
        }, 
        computed: {
            updateWebkitProgress() {
                const progress = (this.value / this.max) * 100 + "%";
                return this.$refs.range.style.setProperty("--webkit-progress", progress);
            },
        },
        mounted() {
            this.updateWebkitProgress;
        },
        watch: {
            value: function() {
                this.updateWebkitProgress;
            },
        },
};
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
  top: 13px;
  left: 0;
  width: var(--webkit-progress);
  height: var(--track-height);
  background-color: var(--progress-color);
  cursor: pointer;
}
.range-slider::-webkit-slider-thumb {
  position: relative;
  -webkit-appearance: none;
  box-sizing: content-box;
  border: 1px solid var(--thumb-border-color);
  height: var(--thumb-size);
  width: var(--thumb-size);
  border-radius: var(--thumb-border-radius);
  background-color: var(--thumb-color);
  cursor: pointer;
  margin: calc((var(--thumb-size) / 2) - var(--thumb-size)) 0 0 0;
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