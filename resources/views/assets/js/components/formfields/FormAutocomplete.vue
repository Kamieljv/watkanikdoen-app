<template>
  <div ref="fieldRef" class="relative">
    <div class="h-full">
      <!-- The search input -->
      <InputText
        v-model="search"
        :placeholder="placeholder"
        :disabled="hasValue"
        class="h-full"
        :class="{ 'pr-8': hasValue }"
        @input="onChange"
        @keydown.down="onArrowDown"
        @keydown.up="onArrowUp"
        @keydown.enter="onEnter"
      />
      <!-- The form input -->
      <input type="hidden" :value="formValue" :name="formInputName" />
      <div
        v-if="hasValue"
        class="absolute right-0 inset-y-0 flex items-center pr-3 ml-3 cursor-pointer"
        @click="resetResult"
      >
        <svg class="fill-current h-4 w-4 text-gray-400" viewBox="0 0 20 20">
          <path
            fill="currentColor"
            d="M11.469,10l7.08-7.08c0.406-0.406,0.406-1.064,0-1.469c-0.406-0.406-1.063-0.406-1.469,0L10,8.53l-7.081-7.08
                    c-0.406-0.406-1.064-0.406-1.469,0c-0.406,0.406-0.406,1.063,0,1.469L8.531,10L1.45,17.081c-0.406,0.406-0.406,1.064,0,1.469
                    c0.203,0.203,0.469,0.304,0.735,0.304c0.266,0,0.531-0.101,0.735-0.304L10,11.469l7.08,7.081c0.203,0.203,0.469,0.304,0.735,0.304
                    c0.267,0,0.532-0.101,0.735-0.304c0.406-0.406,0.406-1.064,0-1.469L11.469,10z"
          ></path>
        </svg>
      </div>
    </div>

    <ul
      v-show="isOpen"
      id="autocomplete-results"
      class="absolute bg-white w-full z-[1001] rounded-lg overflow-hidden mt-1"
      :class="{ 'flex align-center justify-center': isLoading }"
    >
      <li
        v-if="isLoading"
        class="loading w-full flex align-center justify-center"
      >
        <div class="dot-flashing my-3" />
      </li>
      <li
        v-for="(result, i) in results"
        v-else
        :key="i"
        v-sanitize.inline="result[visibleAttribute]"
        class="autocomplete-result px-3 py-1 cursor-pointer"
        :class="{ 'is-active': i === arrowCounter }"
        @click="setResult(result)"
      ></li>
    </ul>
  </div>
</template>

<script setup lang="ts">
import { onBeforeUnmount, onMounted, ref, watch } from "vue";
import debounce from "lodash/debounce";
const emit = defineEmits(["input", "change"]);

const props = defineProps({
  items: {
    type: Array,
    required: false,
    default: () => [],
  },
  isAsync: {
    type: Boolean,
    required: false,
    default: false,
  },
  minQueryLength: {
    type: Number,
    default: 3,
  },
  visibleAttribute: {
    type: String,
    default: "name",
  },
  formAttribute: {
    type: String,
    default: "id",
  },
  formInputName: {
    type: String,
    default: "",
  },
  placeholder: {
    type: String,
    required: false,
    default: "",
  },
});

const isOpen = ref(false);
const results = ref([]);
const search = ref("");
const isLoading = ref(false);
const hasValue = ref(false);
const arrowCounter = ref(0);
const preventOpen = ref(false);
const formValue = ref(null);
const fieldRef = ref(null);

watch(
  () => props.items,
  (value, oldValue) => {
    if (value !== oldValue) {
      results.value = value;
      isLoading.value = false;
      isOpen.value = true;
    }
  },
);

const setResult = (result) => {
  preventOpen.value = true;
  search.value = result[props.visibleAttribute].replace(/(<([^>]+)>)/gi, "");
  if (!props.isAsync) {
    formValue.value = result[props.formAttribute];
  }
  isOpen.value = false;
  hasValue.value = true;
  emit("input", result);
};

const resetResult = () => {
  search.value = "";
  isOpen.value = false;
  hasValue.value = false;
  formValue.value = null;
  emit("input", "");
};

const filterResults = () => {
  results.value = props.items.filter((item) => {
    return (
      item[props.visibleAttribute]
        .toLowerCase()
        .indexOf(search.value.toLowerCase()) > -1
    );
  });
};

const onChange = debounce(() => {
  if (search.value.length >= props.minQueryLength) {
    if (!preventOpen.value) emit("change", search.value);
    if (props.isAsync) {
      isLoading.value = true;
      isOpen.value = !preventOpen.value;
    } else {
      filterResults();
      isOpen.value = !preventOpen.value;
    }
  } else {
    isOpen.value = false;
  }
  preventOpen.value = false;
}, 500);

const handleClickOutside = (event) => {
  if (!fieldRef.value.contains(event.target)) {
    isOpen.value = false;
    arrowCounter.value = 0;
  }
};

const onArrowDown = () => {
  if (arrowCounter.value < results.value.length) {
    arrowCounter.value = arrowCounter.value + 1;
  }
};

const onArrowUp = () => {
  if (arrowCounter.value > 0) {
    arrowCounter.value = arrowCounter.value - 1;
  }
};

const onEnter = () => {
  search.value = results.value[arrowCounter.value][
    props.visibleAttribute
  ].replace(/(<([^>]+)>)/gi, "");
  isOpen.value = false;
  arrowCounter.value = 0;
};

onMounted(() => {
  document.addEventListener("click", handleClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", handleClickOutside);
});

defineExpose({
  resetResult,
});
</script>
<style lang="scss" scoped>
@use "../../../sass/app.scss";
</style>
<style>
.autocomplete-result.is-active,
.autocomplete-result:hover {
  background-color: var(--color-blue-500);
  color: white;
}

/**
    * ==============================================
    * Dot Flashing
    * ==============================================
    */
.dot-flashing::before,
.dot-flashing::after,
.dot-flashing {
  width: 10px;
  height: 10px;
  border-radius: 5px;
  background-color: #6c6c6c;
  color: #6c6c6c;
  animation: dotFlashing 1s infinite alternate;
  content: "";
  display: inline-block;
  position: absolute;
  top: 0;
}
.dot-flashing {
  position: relative;
  animation: dotFlashing 1s infinite linear alternate;
  animation-delay: 0.5s;
}
.dot-flashing::before {
  left: -15px;
  animation-delay: 0s;
}
.dot-flashing::after {
  left: 15px;
  animation-delay: 1s;
}

@keyframes dotFlashing {
  0% {
    background-color: #757575;
  }
  50%,
  100% {
    background-color: #ddd;
  }
}
</style>
