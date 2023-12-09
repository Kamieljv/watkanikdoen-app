<template>
	<div>
		<div v-for="e in entitiesWithValues" :key="e.id">
			<label :for="e.name">{{e.name}}</label>
			<input type="range" :id="e.name" :name="e.name" min="0" max="10" :value="e.value" step="1" @change="handleChange" />
		</div>
		{{entitiesWithValues}}
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
			}
		},
		data() {
			return {
				//
			}
		},
		computed: {
			entitiesWithValues: function() {
				return this.entities.map((e) => {
					var current = this.currentScores.find((c) => c.id === e.id);
					e.value = current ? current.pivot.score : null;
					return e
				});
			}
		},
		mounted() {
		},
		watch: {
			//
		},
		methods: {
			handleChange(e) {
				console.log(e);
			}
		}
	}
</script>

