<template>
    <div>
        <FormField
            ref="fieldRef"
            v-model="url"
            name="link"
            type="url"
            validateOn="blur"
            @blur="console.log(url)"
        >
            <template v-slot:label>
                <label for="link" class="block text-sm font-medium leading-5 text-gray-700">
                    Externe link
                    <span v-if="required" class="text-red-500">*</span>
                </label>
            </template>
            <template v-slot:button-right>
                <button class="primary plus-btn" @click="addUrl" :disabled="!url" title="Nog een link toevoegen">
                    <PlusIcon class="w-6 h-6 text-white" />
                </button>
            </template>
        </FormField>
        <span v-if="error" role="alert">{{ error }}</span>
        <!-- Hidden formfield to contain the urls -->
        <FormField
            id="urls"
            v-model="urls"
            name="urls"
            type="hidden"
            :rules="{required: required}"
        />
        <!-- Display added links -->
        <div class="mt-5">
            <div v-for="u in urls" class="flex items-center space-x-1"> 
                <a :href="u" class="text-blue-900 hover:underline" target="_blank">{{ u }}</a>
                <span class="text-red-500 cursor-pointer" @click="removeUrl(u)">
                    <CloseIcon class="w-4 h-4" />
                </span>
            </div>
        </div>
    </div>
</template>

<script setup lang="ts">

import { ref, watch } from 'vue';
import PlusIcon from '&/antdesign-plus-o.svg'
import CloseIcon from '&/antdesign-close.svg'
const emit = defineEmits(['update:modelValue'])

const value = defineModel<Array<string>>()

const props = defineProps({
    required: {
        type: Boolean,
        default: false,
    }
})

const url = ref('');
const urls = ref<Array<string> | undefined>(value.value);
const error = ref(null);
const fieldRef = ref(null);

watch(
    value,
    (newVal) => {
        urls.value = newVal ?? []
    },
    { immediate: true }
)

const addUrl = (e) => {
    e.preventDefault();

    if (!url.value) return;
    // add http(s) prefix if necessary
    if (/^https?:\/\//.test(url.value) == false) {
        url.value = 'https://' + url.value;
    }

    // re-set the value with the https:// prefix
    fieldRef.value.fieldRef.value = url.value
    // validate the field
    const pattern = new RegExp(
		'^(https?:\\/\\/)?' + // protocol
		  '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
		  '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR IP (v4) address
		  '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
		  '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
		  '(\\#[-a-z\\d_]*)?$', // fragment locator
		'i'
	);
	if (!pattern.test(url.value)) {
        error.value = 'Dit is geen geldige URL';
        return;
    }

    // return if url already exists in urls
    if (urls.value.includes(url.value)) {
        error.value = 'Deze URL is al toegevoegd';
        return;
    }

    error.value = null;

    urls.value.push(url.value);
    url.value = null;

    emit('update:modelValue', urls.value);
    
}

const removeUrl = (url) => {
    urls.value = urls.value.filter(item => item !== url);
    emit('update:modelValue', urls.value);
}

</script>
<style lang="scss" scoped>
    button.plus-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-left: 5px;
        padding: 10px;
    }    
</style>