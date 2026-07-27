<template>
  <a :href="clickable ? props.organizer.link : undefined"
    ><div
      class="flex items-center gap-1 p-1 rounded-sm"
      :class="{ 'hover:bg-gray-400/30 hover:pointer': clickable }"
    >
      <img class="h-5 w-5 rounded-full" :src="props.organizer.image_url" />
      {{ props.organizer.name }}
    </div>
  </a>
</template>
<script setup lang="ts">
import { type Organizer } from "../../models";

const props = defineProps({
  organizer: {
    type: Object as () => Organizer,
    required: true,
  },
  clickable: {
    type: Boolean,
    default: true,
  },
});
</script>
