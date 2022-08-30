<template>
  <div class="Collapsible bg-gray-100 rounded-md">
    <button
      @click.prevent="handleClick"
      type="button"
      :class="{
        Collapsible__trigger: true,
        'Collapsible__trigger--open': !transitioning && open,
        'Collapsible__trigger--closed': !transitioning && !open,
        'Collapsible__trigger--transitioning': transitioning,
      }"
    >
      <slot name="trigger">
        <div class="customTrigger flex items-center justify-between p-4">
            <h3 class="text-sm text-gray-800">{{ triggerLabel }}</h3>
            <svg-vue icon="heroicon-s-chevron-down" />
        </div>
      </slot>
    </button>

    <div
      :class="{
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
      }"
      @transitionend="handleEnd"
    >
      <div class="Collapsible__contentInner p-4 bg-gray-50 border-t border-gray-200" ref="inner">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Collapsible',
  data() {
    return {
      open: this.isOpen,
      height: this.isOpen ? 'auto' : '0px',
      closeOnNextTick: false,
      transitioning: false,
    };
  },
  props: {
    triggerLabel: {
      type: String,
      default: 'Open me',
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
      default: () => {},
      type: Function,
    },
  },
  methods: {
    handleClick() {
      this.onCollapse(!this.isOpen);
      this.open = !this.open;
    },
    handleEnd() {
      if (this.height !== '0px') {
        this.height = 'auto';
      }
      this.transitioning = false;
    },
  },
  watch: {
    open(newVal, oldVal) {
      this.transitioning = true;
      this.height = this.$refs.inner.scrollHeight + 'px';

      if (oldVal === true) {
        this.closeOnNextTick = true;
      }
    },
    isOpen(newVal) {
      this.open = newVal;
    },
  },
  updated() {
    this.$nextTick(() => {
      window.setTimeout(() => {
        if (this.closeOnNextTick) {
          this.height = '0px';
          this.closeOnNextTick = false;
        }
      });
    });
  },
};
</script>

<style scoped lang="scss">
.Collapsible__content {
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


.Collapsible__trigger.Collapsible__trigger--open svg {
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
