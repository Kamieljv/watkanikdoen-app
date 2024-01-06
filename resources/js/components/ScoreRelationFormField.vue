<template>
	<div>
		<div v-for="e in entitiesWithValues" :key="e.id">
			<label :for="e.name">{{e.name}}</label>
			<input type="number" :id="e.id" :name="'dim_' + e.name" min="0" max="10" :value="e.value" step="1" @change="handleChange" />
			<button :data-id="e.id" @click="handleSubmit">OK</button>
		</div>
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
			},
			handleSubmit(e) {
				e.preventDefault();
				this.$http.post(this.scoreRoute, {
					'answer_id': this.currentId,
					'dimension_id': parseInt(e.target.dataset.id),
					'score': parseInt(this.entitiesWithValues.find((c) => c.id == e.target.dataset.id).value)
				})
			}
		}
	}
</script>

