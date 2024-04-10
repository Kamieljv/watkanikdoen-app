<template>
	<div class="wrapper">
		<tr v-for="e in entitiesWithValues" :key="e.id">
			<td class="name-cell"><span :for="e.name" :title="e.description">{{e.name}}</span></td>
			<td class="input-cell" :id="'row_' + e.id">
				<input type="number" class="score-input" :id="e.id" :name="'dim_' + e.name" :min="minScore" :max="maxScore" :value="e.value" step="1" @change="handleChange" />
			</td>
			<td class="delete-cell">
				<button v-if="e.value !== null" :data-id="e.id" class="btn delete-btn" @click.prevent="handleDelete(e.id)">
					<span class="icon voyager-trash"></span>
				</button>
			</td>
			<td class="error-cell">
				<span class="error"></span>
			</td>
		</tr>
	</div>
</template>

<script>
	export default {
		name: "ScoreRelationFormField",
		props: {
			entities: {
				type: Array,
				required: true,
			},
			entityClass: {
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
			currentScores: {
				type: Array,
				required: true,
			},
			currentId: {
				type: Number,
				required: true,
			},
			minScore: {
				type: Number,
				required: true,
			},
			maxScore: {
				type: Number,
				required: true,
			},
		},
		data() {
			return {
				entitiesWithValues: []
			}
		},
		mounted() {
			this.entitiesWithValues = this.entities.map((e) => {
				var current = this.currentScores.find((c) => c.id === e.id);
				e.value = current ? current.pivot.score : null;
				return e
			});
		},
		methods: {
			handleChange(e) {
				this.$set(this.entitiesWithValues.find((c) => c.id == e.target.id), 'value', e.target.value);
				this.$http.post(this.scoreRoute, {
					'entity_class': this.entityClass,
					'entity_id': this.currentId,
					'dimension_id': parseInt(e.target.id),
					'score': parseInt(this.entitiesWithValues.find((c) => c.id == e.target.id).value)
				}).then((response) => {
					// reset the inner html of the element with row_id
					document.getElementById('row_' + e.target.id).querySelector('.error').innerHTML = '';	
					// remove the invalid class from the input element in the element with row_id
					document.getElementById('row_' + e.target.id).querySelector('input').classList.remove('invalid');
				}).catch((error) => {
					// set the inner html of the element with row_id to the error message
					document.getElementById('row_' + e.target.id).querySelector('.error').innerHTML = error.response.data.message;
					// toggle the invalid class on the input element in the element with row_id
					document.getElementById('row_' + e.target.id).querySelector('input').classList.add('invalid');
				})
			},
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
	td {
		vertical-align: middle;
		padding-right: 10px;
		height: 50px;
	}

	td.name-cell span {
		font-weight: bold;
	}

	.score-input {
		width: 70px;
		font-size: large;
		font-weight: bold;
	}

	.delete-btn {
		background: #ff4545;
  		color: white;
		&:hover {
			background: #a81f1f;
			color: white;
		}
	}

	.invalid {
		border: 1px solid red;
	}

	.error {
		color: red;
	}

	.wrapper {
		background-color: #ebebeb;
		padding: 10px;
		border-radius: 5px;
		border: 1px solid #e4eaec;
	}

</style>

