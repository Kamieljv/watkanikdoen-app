<template>
    <div>
        <!-- Externe link form -->
        <form @submit.prevent="addUrl">
            <FormField
                v-model="url"
                name="link"
                label="Externe link"
                type="url"
                rules="url"
            >
                <button class="primary plus-btn" @click="addUrl" title="Nog een link toevoegen">
                    <svg-vue icon="antdesign-plus-o" class="w-6 h-6 text-white" />
                </button>
            </FormField>
        </form>
        <!-- Display added links -->
        <div>
            <div v-for="url in urls" :key="url" class="flex items-center space-x-1"> 
                <a :href="url" class="text-blue-900 hover:underline" target="_blank">{{ url }}</a>
                <span class="text-red-500 cursor-pointer" @click="removeUrl(url)">
                    <svg-vue icon="antdesign-close" class="w-4 h-4" />
                </span>
            </div>
            <ValidatedFormField
                id="urls"
                v-bind="urls"
                name="urls"
                type="hidden"
                :rules="{ required: true }"
            >
                <input v-bind="urls" type="hidden" name="urls" />
            </ValidatedFormField>
        </div>
    </div>
</template>

<script>
import { validate } from 'vee-validate';

export default {
    props: {
        urls: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            url: '',
        };
    },
    methods: {
        addUrl() {
            if (typeof this.urls.find((o) => { return o.name == this.url }) == 'undefined'
                && typeof this.url !== 'undefined'
                && this.url.length > 0) {

                validate(this.url, 'url')
                    .then((result) => {
                        if (result.valid) {
                            if (/^https?:\/\//.test(this.url) == false) {
                                this.url = 'https://' + this.url;
                            }
                            this.urls.push(this.url);
                            this.url = '';
                            this.$emit('change', this.urls);
                        }
                    })
            }
        },
        removeUrl(url) {
            this.urls = this.urls.filter(item => item !== url);
        }
    }
};
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