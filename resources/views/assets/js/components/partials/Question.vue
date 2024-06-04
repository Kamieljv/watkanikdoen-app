<template>
    <div class="p-8">
        <h4 class="mb-5 text-[var(--wkid-pink)] text-2xl font-thin">ActieWijzer</h4>
        <h1 class="mb-1">{{question.question}}</h1>
        <h3 class="font-normal text-gray-500">{{ question.description }}</h3>
        <t-radio-group 
            v-model="data" 
            class="mt-8 text-lg"
            :options="answers"
            text-attribute="answer"
            value-attribute="id"
        >
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
    mounted() {
        if (this.value) {
            this.data = this.value;
        }
    },
    watch: {
      data: function () {
        this.$emit('input', this.data);
      }
    },
}
</script>