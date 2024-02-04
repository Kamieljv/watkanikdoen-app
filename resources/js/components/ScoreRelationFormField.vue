<template>
	<div>
		<tr v-for="e in entitiesWithValues" :key="e.id">
			<td><label :for="e.name">{{e.name}}</label></td>
			<td style="padding-left: 10px">
				<input type="number" class="score-input" :id="e.id" :name="'dim_' + e.name" min="0" max="10" :value="e.value" step="1" @change="handleChange" />
				<button v-if="e.value !== null" :data-id="e.id" class="btn delete-btn" @click="handleDelete">
					<span class="icon voyager-trash"></span>
				</button>
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
			}
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
					'answer_id': this.currentId,
					'dimension_id': parseInt(e.target.id),
					'score': parseInt(this.entitiesWithValues.find((c) => c.id == e.target.id).value)
				})
			},
			handleDelete(e) {
				e.preventDefault();
				this.$http.post(this.scoreDeleteRoute, {
					'answer_id': this.currentId,
					'dimension_id': parseInt(e.target.dataset.id),
				})
				this.$set(this.entitiesWithValues.find((c) => c.id == e.target.dataset.id), 'value', null);

			}
		}
	}
</script>

<style lang="scss">
	.score-input {
		width: 70px;
	}

	.delete-btn {
		background: #ff4545;
  		color: white;
		&:hover {
			background: #a81f1f;
			color: white;
		}
	}

</style>

