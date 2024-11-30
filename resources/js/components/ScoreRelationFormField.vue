<template>
	<div class="wrapper">
		<tr v-for="d in dimensionsWithValues" :key="d.id">
			<td class="name-cell"><span :for="d.name" :title="d.description">{{d.name}}</span></td>
			<td class="input-cell" :id="'row_' + d.id">
				<input 
					:id="currentId + '_dim_' + d.id"
					type="number" 
					class="score-input" 
					:name="'dim_' + d.name" 
					:min="minScore" 
					:max="maxScore" 
					:value="d.value" 
					step="1"
					:data-dim-id="d.id"
					@change="handleChange"
				/>
			</td>
			<td class="delete-cell">
				<button v-if="d.value !== null" :data-id="d.id" class="btn delete-btn" @click.prevent="handleDelete(d.id, $event)">
					<span class="icon voyager-trash"></span>
				</button>
			</td>
			<td class="error-cell">
				<span class="error"></span>
			</td>
		</tr>
	</div>
</template>

<script setup lang="ts">

import axios from 'axios';
import { onMounted, ref } from 'vue';

const props = defineProps({
	dimensions: {
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
})

const dimensionsWithValues = ref([]);

onMounted(() => {
	// deep copy props.dimensions
	var dims = JSON.parse(JSON.stringify(props.dimensions));
	// add the current score to the dimension
	dimensionsWithValues.value = dims.map((e) => {
		var current = props.currentScores.find((c) => c.id === e.id);
		e.value = current ? current.pivot.score : null;
		return e
	});
});

const handleChange = (e) => {
	dimensionsWithValues.value.find((c) => c.id == e.target.dataset.dimId).value = e.target.value;
	axios.post(props.scoreRoute, {
		'entity_class': props.entityClass,
		'entity_id': props.currentId,
		'dimension_id': parseInt(e.target.dataset.dimId),
		'score': parseInt(dimensionsWithValues.value.find((c) => c.id == e.target.dataset.dimId).value)
	}).then((response) => {
		if (response.data.status === "success") {
			// reset the inner html of the error element in the row
			e.target.closest('tr').querySelector('.error').innerHTML = '';	
			// remove the invalid class from the input element in the row
			e.target.closest('tr').querySelector('input').classList.remove('invalid');
		} else {
			throw new Error(response.message);
		}
	}).catch((error) => {
		// set the inner html of the error element in the row
		e.target.closest('tr').querySelector('.error').innerHTML = error.response.data.message;
		// toggle the invalid class on the input element in the row
		e.target.closest('tr').querySelector('input').classList.add('invalid');
	});
}


const handleDelete = (dimension_id, e) => {
	var tr = e.target.closest('tr');
	axios.post(props.scoreDeleteRoute, {
		'entity_class': props.entityClass,
		'entity_id': props.currentId,
		'dimension_id': parseInt(dimension_id),
	}).then((response) => {
		// reset the inner html of the error element in the row
		tr.querySelector('.error').innerHTML = '';
		// remove the invalid class from the input element in row
		tr.querySelector('input').classList.remove('invalid');
	});
	dimensionsWithValues.value.find((c) => c.id == dimension_id).value = null;
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

