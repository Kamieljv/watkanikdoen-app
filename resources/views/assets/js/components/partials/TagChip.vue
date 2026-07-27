<template>
  <div
    class="flex items-center gap-1 text-sm lowercase bg-gray-50 px-2.5 py-0.5 rounded-full"
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
