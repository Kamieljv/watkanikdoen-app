<template>
    <div class="p-8">
        <h1 class="mb-3">{{question.question}}</h1>
        
        <t-radio-group 
            v-model="data" 
            :options="answers"
            text-attribute="answer"
            value-attribute="id"
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
        value: {
            type: Number,
            default: null
        }
    },
    data: () => ({
        data: null
    }),
    
    computed: {
        answers() {
            return this.question.answers
        },
    },
    methods: {
        updateInput() {
            this.$emit('input', this.data);
        },
    },
    watch: {
      value: {
        immediate: true,
        handler: function(newVal) {
          this.data = newVal;
        },
      },
    },
}
</script>