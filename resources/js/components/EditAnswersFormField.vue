<template>
	<div class="wrapper">
		<div v-for="a in answersToEdit" :key="a.id">
			<label>Antwoord</label>
			<input type="text" v-model="a.answer" />
			{{ a.dimensions }}
			<ScoreRelationFormField
				:key="a.id"
				:entities="dimensions"
				:entityClass="'App\\Models\\Answer'"
				:scoreRoute="scoreRoute"
				:scoreDeleteRoute="scoreDeleteRoute"
				:currentScores="a.dimensions"
				:currentId="a.id"
				:minScore="0"
				:maxScore="10"
				@input="handleChange"
			></ScoreRelationFormField>
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
			handleChange(e) {
				console.log(e);
			},
			// handleChange(e) {
			// 	this.$set(this.entitiesWithValues.find((c) => c.id == e.target.id), 'value', e.target.value);
			// 	this.$http.post(this.scoreRoute, {
			// 		'entity_class': this.entityClass,
			// 		'entity_id': this.currentId,
			// 		'dimension_id': parseInt(e.target.id),
			// 		'score': parseInt(this.entitiesWithValues.find((c) => c.id == e.target.id).value)
			// 	}).then((response) => {
			// 		// reset the inner html of the element with row_id
			// 		document.getElementById('row_' + e.target.id).querySelector('.error').innerHTML = '';	
			// 		// remove the invalid class from the input element in the element with row_id
			// 		document.getElementById('row_' + e.target.id).querySelector('input').classList.remove('invalid');
			// 	}).catch((error) => {
			// 		// set the inner html of the element with row_id to the error message
			// 		document.getElementById('row_' + e.target.id).querySelector('.error').innerHTML = error.response.data.message;
			// 		// toggle the invalid class on the input element in the element with row_id
			// 		document.getElementById('row_' + e.target.id).querySelector('input').classList.add('invalid');
			// 	})
			// },
			handleDelete(dimension_id) {
				this.$http.post(this.scoreDeleteRoute, {
					'entity_class': this.entityClass,
					'entity_id': this.currentId,
					'dimension_id': parseInt(dimension_id),
				}).then((response) => {
					// reset the inner html of the element with row_id
					document.getElementById('row_' + dimension_id).querySelector('.error').innerHTML = '';	
					// remove the invalid class from the input element in the element with row_id
					document.getElementById('row_' + dimension_id).querySelector('input').classList.remove('invalid');
				});
				this.$set(this.entitiesWithValues.find((c) => c.id == dimension_id), 'value', null);
			}
		}
	}
</script>

<style lang="scss" scoped>
	.wrapper {
		background-color: #ebebeb;
		padding: 10px;
		border-radius: 5px;
		border: 1px solid #e4eaec;
	}

</style>

