<template>
    <div>
        <div class="w-full h-20 mt-8 sm:mb-4">
            <ul class="progressbar flex justify-between">
                <li 
                    :class="{'active': (i-1) <= current, 'cursor-pointer': ((i - current) === 0 || (i-1) < current)}" 
                    v-for="i in steps.length" 
                    :key="i" 
                    :style="{width: widthPerc}"
                    @click="setCurrentStep(i)"
                >
                    <p class="text-sm hidden sm:block">{{ steps[i-1] }}</p>
                </li>
            </ul>
        </div>
    </div>
</template>
<script setup lang="ts">

import { ref, computed, watch } from 'vue';
const emit = defineEmits(['update:modelValue'])

const props = defineProps({
    modelValue: {
        type: Number,
        required: true,
    },
    steps: {
        type: Array,
        required: true,
    },
})

const current = ref(props.modelValue)

const widthPerc = computed(() => {
    return 100 / props.steps.length + '%'
})

watch(() => props.modelValue, (value) => {
    current.value = value
})

const setCurrentStep = (i: number) => {
    if ((i - current.value) === 0 || (i-1) < current.value) {
        current.value = i-1
        emit('update:modelValue', current.value)
    }
}

</script>

<style scoped lang="scss">
    .progressbar{
        counter-reset: step;
        & li {
            position: relative;
            text-align: center;
            // Step nodes
            &:before {
                content:counter(step);
                counter-increment: step;
                width: 30px;
                height: 30px;
                border: 2px solid #bebebe;
                display: block;
                margin: 0 auto 10px auto;
                border-radius: 50%;
                line-height: 27px;
                background: white;
                color: #bebebe;
                text-align: center;
                font-weight: bold;
                transition: all 0.25s ease-in-out;
            }
            // Lines between step nodes
            &:after {
                content: '';
                position: absolute;
                width:100%;
                height: 3px;
                background: #979797;
                top: 15px;
                left: -50%;
                z-index: -1;
                transition: all 0.25s ease-in-out;
            }
            &.active {
                &:before {
                    border-color: var(--wkid-blue);
                    background: var(--wkid-blue);
                    color: white;
                }
                &:after {
                    background: var(--wkid-blue);
                }
            }
        }
    }
    .progressbar li:first-child:after{
        content: none;
    }
</style>