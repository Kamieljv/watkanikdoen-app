<template>
  <div class="Collapsible">
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
        <div class="customTrigger">
            <slot name="left-icon"></slot>
            <h3 class="mt-8 mb-3 text-sm text-gray-900">{{ triggerLabel }}</h3>
            <svg
                aria-hidden="true"
                focusable="false"
                data-prefix="fas"
                data-icon="chevron-down"
                class="svg-inline--fa fa-chevron-down fa-w-14"
                role="img"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 448 512"
            >
                <path
                fill="currentColor"
                d="M207.029 381.476L12.686 187.132c-9.373-9.373-9.373-24.569 0-33.941l22.667-22.667c9.357-9.357 24.522-9.375 33.901-.04L224 284.505l154.745-154.021c9.379-9.335 24.544-9.317 33.901.04l22.667 22.667c9.373 9.373 9.373 24.569 0 33.941L240.971 381.476c-9.373 9.372-24.569 9.372-33.942 0z"
                />
            </svg>
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
      <div class="Collapsible__contentInner" ref="inner">
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

<style scoped>
.Collapsible__content {
  overflow: hidden;
}

.Collapsible__contentInner {
  height: auto;
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
