<template>
    <div class="p-8">
        <p class="mb-5 text-[var(--wkid-pink)] text-lg md:text-2xl font-thin">ActieWijzer</p>
        <h1 class="mb-2">{{question.question}}</h1>
        <p class="text-gray-500 text-lg md:text-2xl">{{ question.description }}</p>

        <div class="my-5">
            <div
                v-for="t in themes"
                :key="t.id"
                class="relative self-start inline-block px-3 py-2 mr-1 mb-2 border-gray-100 bg-gray-100 cursor-pointer text-xs font-medium leading-5 uppercase rounded-full"
                :class="{'border-2 border-white': selected.includes(t.id), 'border-2': !selected.includes(t.id)}"
                :style="{backgroundColor: selected.includes(t.id) ? t.color : null}"
                :data-id="t.id"
                @click="select(t.id)"
            >
                <span class="text-sm" :class="{'text-white': selected.includes(t.id)}" rel="theme">
                    {{ t.name }}
                </span>
            </div>
        </div>
        
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
        themes: {
            type: Array,
            required: true,
        },
        value: {
            type: Array,
            default: null
        }
    },
    data: () => ({
        selected: [],
    }),
    methods: {
        select(id) {
            if (this.selected.includes(id)) {
                const index = this.selected.indexOf(id);
                this.selected.splice(index, 1);
            } else {
                this.selected.push(id)
            }
        },
    },
    mounted() {
        if (this.value) {
            this.selected = this.value;
        }
    },
    watch: {
        selected: function () {
            this.$emit('input', this.selected);
        },
    },
}
</script>