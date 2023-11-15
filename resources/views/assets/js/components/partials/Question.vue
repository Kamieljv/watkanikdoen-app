<template>
    <div class="p-8">
        <h1 class="mb-3">{{question.question}}</h1>
        
        <t-radio-group 
            v-model="value" 
            :options="answers"
            @change="updateInput">
        </t-radio-group>
    </div>
</template>
<script>
export default {
    name: "Question",
    props: {
        question: {
            type: Object,
            required: true,
        },
    },
    data: () => ({
        value: null
    }),
    computed: {
        answers() {
            return this.question.answers.map(a => a.answer)
        },
    },
    methods: {
        updateInput() {
            this.$emit('input', this.value);
        },
    }
}
</script>