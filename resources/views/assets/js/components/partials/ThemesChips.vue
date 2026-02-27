<template>
  <ul
    v-if="props.themes.length <= props.maxVisible"
    :class="`flex flex-wrap justify-${props.justify}`"
  >
    <li
      v-for="theme in props.themes"
      :key="theme.id"
      class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
      :style="{ backgroundColor: theme.color }"
    >
      <span class="text-white" rel="theme">
        {{ theme.name }}
      </span>
    </li>
  </ul>
  <ul v-else :class="`flex flex-wrap justify-${props.justify}`">
    <li
      v-for="theme in props.themes.slice(0, props.maxVisible)"
      :key="theme.id"
      class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
      :style="{ backgroundColor: theme.color }"
    >
      <span class="text-white" rel="theme">
        {{ theme.name }}
      </span>
    </li>
    <li
      class="relative self-start inline-block px-2 py-1 mr-1 mb-1 text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
    >
      <span class="text-gray-800" rel="theme">
        +{{ props.themes.length - props.maxVisible
        }}{{ props.showPlusLabel ? " thema's" : "" }}
      </span>
    </li>
  </ul>
</template>

<script setup lang="ts">
import { Theme } from "../../models";

const props = defineProps({
  themes: {
    type: Array<Theme>,
    default: () => [],
  },
  maxVisible: {
    type: Number,
    default: 2,
  },
  showPlusLabel: {
    type: Boolean,
    default: true,
  },
  justify: {
    type: String,
    default: "start",
  },
});
</script>
