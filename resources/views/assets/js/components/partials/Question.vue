<template>
    <div class="p-8">
        <h4 class="mb-5 text-[var(--wkid-pink)] text-lg md:text-2xl font-thin">ActieWijzer</h4>
        <h1 class="mb-2">{{question.question}}</h1>
        <h3 class="font-normal text-gray-500 text-lg md:text-2xl">{{ question.description }}</h3>
        <div class="flex flex-col flex-wrap gap-1 mt-5">
            <div v-for="answer in answers" class="flex items-center gap-2">
                <RadioButton v-model="data" :inputId="'answer' + answer.id" name="dynamic" :value="answer.id" />
                <label :for="'answer' + answer.id" class="cursor-pointer">{{ answer.answer }}</label>
            </div>
        </div>
    </div>
</template>
<script setup lang="ts">
import RadioButton from 'primevue/radiobutton';
import { ref, watch, computed } from 'vue';
const emit = defineEmits(['update:modelValue'])

const props = defineProps({
    question: {
        type: Object,
        required: true,
    },
    value: {
        type: Number,
        default: null
    }
})

const data = ref(props.value);

const answers = computed(() => {
    return props.question.answers
})

watch(data, (data) => {
    emit('update:modelValue', data);
})

</script>