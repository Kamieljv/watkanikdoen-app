<template>
	<div class="wrapper">
		<div v-if="answersToEdit.length > 0">
			<div v-for="a in answersToEdit" :key="a.id">
				<label>Antwoord</label>
				<input type="text" v-model="a.answer" />
				{{ a.dimensions }}
				<ScoreRelationFormField
					:key="a.id"
					:dimensions="dimensions"
					:entityClass="'App\\Models\\Answer'"
					:scoreRoute="scoreRoute"
					:scoreDeleteRoute="scoreDeleteRoute"
					:currentScores="a.dimensions"
					:currentId="a.id"
					:minScore="0"
					:maxScore="10"
				></ScoreRelationFormField>
			</div>
		</div>
		<div v-else>
			Er zijn geen antwoorden om te bewerken.
		</div>
	</div>
</template>

<script>
	import ScoreRelationFormField from './ScoreRelationFormField.vue';

	export default {
		name: "EditAnswersFormField",
		props: {
			answers: {
				type: Array,
				required: true,
			},
			editRoute: {
				type: String,
				required: true,
			},
			deleteRoute: {
				type: String,
				required: true,
			},
			scoreRoute: {
				type: String,
				required: true,
			},
			scoreDeleteRoute: {
				type: String,
				required: true,
			},
			dimensions: {
				type: Array,
				required: true,
			},
		},
		data() {
			return {
				answersToEdit: this.answers,
			}
		},
		mounted() {
			//
		},
		methods: {
			//
		}
	}
</script>

