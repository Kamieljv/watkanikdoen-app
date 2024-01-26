<template>
    <div class="p-8">
        <h1 class="mb-3">{{question.question}}</h1>
        <div
            v-for="t in themesSelected"
            :key="t.id"
            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 cursor-pointer text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
            :style="{backgroundColor: selected.includes(t.id) ? t.color : 'gray'}"
            :data-id="t.id"
            @click="select(t.id)"
        >
            <span class="text-white" rel="theme">
                {{ t.name }}
            </span>
        </div>
        <FormField
            v-model="query"
            :value="query"
            name="query"
            type="text"
            placeholder="Zoeken..."
            @input="processQuery"
            :clearable="true"
            autofocus
            classes="block w-full sm:w-1/2 md:w-1/3 h-full px-3 py-2 mb-5 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500"
        />
        <div
            v-for="t in themesFiltered"
            :key="t.id"
            class="relative self-start inline-block px-2 py-1 mr-1 mb-1 cursor-pointer text-xs font-medium leading-5 text-white uppercase bg-gray-100 rounded"
            :style="{backgroundColor: selected.includes(t.id) ? t.color : 'gray'}"
            :data-id="t.id"
            @click="select(t.id)"
        >
            <span class="text-white" rel="theme">
                {{ t.name }}
            </span>
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
        query: '',
    }),
    computed: {
        themesSelected: function() {
            return this.themes.filter((t) => this.selected.includes(t.id))
        },
        themesFiltered: function() {
            return this.themes.filter((t) => !this.selected.includes(t.id) && t.name.toLowerCase().indexOf(this.query) >= 0)
        }
    },
    methods: {
        select(id) {
            if (this.selected.includes(id)) {
                const index = this.selected.indexOf(id);
                this.selected.splice(index, 1);
            } else {
                this.selected.push(id)
            }
        },
        processQuery: _.debounce(function(input) {
			this.query = input
		}, 500),
    },
    watch: {
        selected: function () {
            this.$emit('input', this.selected);
        },
    },
}
</script>