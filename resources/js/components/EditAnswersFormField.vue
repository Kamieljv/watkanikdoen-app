<template>
	<div>
		<div v-if="answersToEdit.length > 0">
			<div v-for="a in answersToEdit" :key="a.id" style="margin-bottom: 10px">
				<div class="wrapper">
					<input 
					type="text" 
					class="name-input" 
					v-model="a.answer" 
					:disabled="!a.editable" 
					:class="{editable: a.editable}" 
					:data-answer-id="a.id" />
					<button 
						v-if="!a.editable" 
						class="edit-btn" 
						@click.prevent="handleEdit($event, a.id)"
					>
						Bewerken
					</button>
					<button 
						v-else
						class="edit-btn" 
						@click.prevent="handleSave($event, a.id)"
					>
						Opslaan
					</button>
					<div class="error"></div>
				</div>
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
					v-model="a.dimensions"
				></ScoreRelationFormField>
			</div>
		</div>
		<div v-else>
			Er zijn geen antwoorden om te bewerken.
		</div>
	</div>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import ScoreRelationFormField from './ScoreRelationFormField.vue';
import axios from 'axios';

const props = defineProps({
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
	editAnswerRoute: {
		type: String,
		required: true,
	},
	dimensions: {
		type: Array,
		required: true,
	},
});

const answersToEdit = ref(props.answers.map(a => {
	a.editable = false;
	return a;
}));

const handleEdit = (e, id) => {
	answersToEdit.value.find((a) => a.id == id).editable = true;
}

const handleSave = (e, id) => {
	var val = e.target.closest('div').querySelector('input').value;
	answersToEdit.value.find((a) => a.id == id).answer = val;
	axios.post(props.editAnswerRoute, {
		'id': id,	
		'answer': val,
	}).then((response) => {
		answersToEdit.value.find((a) => a.id == id).editable = false;
		
		if (response.data.status === "success") {
			// reset the inner html of the error element in the row
			e.target.closest('div').querySelector('.error').innerHTML = '';	
		} else {
			throw new Error(response.message);
		}
	}).catch((error) => {
		// set the inner html of the error element in the row
		e.target.closest('div').querySelector('.error').innerHTML = error.response.data.message;
	});
}
</script>

<style lang="scss" scoped>
	.wrapper {
		background-color: #ebebeb;
		padding: 10px;
		border-radius: 5px;
		border: 1px solid #e4eaec;
	}
	input.name-input {
		font-weight: bold;
	}
	input:not(.editable) {
		background: transparent;
		border: none;
		border-bottom: 1px solid gray;
	}
	.error {
		color: red;
	}
</style>
	