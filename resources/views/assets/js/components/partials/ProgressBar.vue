<template>
  <div
    role="progressbar"
    class="progressbar"
    :style="barStyle"
    :aria-valuemin="min"
    :aria-valuenow="value"
    :aria-valuemax="max"
  >
    <div class="progressbar progressbar-value" :style="progressStyle"></div>
  </div>
</template>

<script>
export default {
  name: "ProgressBar",
  props: {
    value: {
      type: Number,
      default: 0,
    },
    color: {
      type: String,
      default: "#607c8a",
    },
    backgroundColor: {
      type: String,
      default: "#ededed",
    },
    min: {
      type: Number,
      default: 0,
    },
    max: {
      type: Number,
      default: 100,
    },
  },
  computed: {
    progressStyle() {
      return {
        backgroundColor: this.color,
        width: ((this.value - this.min) / (this.max - this.min)) * 100 + "%",
        display: "block",
      };
    },
    barStyle() {
      return {
        backgroundColor: this.backgroundColor,
      };
    },
  },
};
</script>

<style scoped>
.progressbar {
  position: relative;
  overflow: hidden;
  height: 1rem;
  border: 0 none;
  background: #dee2e6;
  border-radius: 3px;
}

.progressbar .progressbar-label {
  color: #495057;
  line-height: 1.5rem;
  text-align: center;
  height: 100%;
  width: 100%;
  position: absolute;
  font-weight: bold;
}

.progressbar .progressbar-value {
  height: 100%;
  width: 0%;
  position: absolute;
  display: none;
  border: 0 none;
  transition: width 1s ease-in-out;
}
</style>
