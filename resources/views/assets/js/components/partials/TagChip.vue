<template>
  <div
    class="flex items-center gap-1 text-sm lowercase bg-gray-400/10 px-2.5 py-0.5 rounded-full"
  >
    #{{ props.tag }}
  </div>
</template>
<script setup lang="ts">
const props = defineProps({
  tag: {
    type: String,
    required: true,
  },
});
</script>
