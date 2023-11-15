<template>
    <div>
        <div v-if="!sent">
            <step-progress
                :steps="steps"
                :currentStep="activeIndex"
                v-model="activeIndex"
            >
            </step-progress>
            <ValidationObserver>
                <Transition name="slide" mode="out-in" appear>
                    <question :question="questions[activeIndex]" :key="activeIndex" @input="handleInput" class="p-8 bg-white rounded-md shadow-md min-h-[300px]">
                    </question>
                </Transition>
                <div class="flex mt-5" :class="{'justify-end': activeIndex === 0, 'justify-between': activeIndex > 0}">
                    <button v-if="activeIndex > 0" type="button" @click.prevent="activeIndex--"
                        class="secondary">
                        {{ __('general.previous') }}
                    </button>
                    <button v-if="!isLastStep" class="primary" @click.prevent="activeIndex++" :disabled="nextDisabled">
                        {{ __('general.next') }}
                    </button>
                    <button v-else class="primary"  @click.prevent="submit">
                        {{ __('general.send_form') }}
                    </button>
                </div>
            </ValidationObserver>
        </div>
        <div v-else>
            <div class="flex justify-center items-center max-w-4xl mx-auto my-6 bg-white rounded-md shadow-md min-h-[300px]">
                <SuccessGIF src="/images/protest_signs.gif" title="Gelukt! Bedankt voor je bijdrage!" message="We zullen je aanmelding zo snel mogelijk beoordelen."/>
            </div>
        </div>
    </div>
</template>

<script>

import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "ActieWijzer",
    mixins: [
        caseHelper,
    ],
    props: {
        questions: {
            type: Array,
            required: true,
        },
    },
    data: () => ({
        activeIndex: 0,
        sent: false,
        currentErrors: [],
    }),
    computed: {
        steps() {
            return this.questions.map(q => q.subject)
        },
        activeStep() {
            return this.steps[this.activeIndex]
        },
        isLastStep() {
            return this.activeIndex === this.steps.length - 1;
        },
        nextDisabled() {
            if ((this.activeStep.key === 'organizer' && this.selectedOrganizers.length == 0) ||
                (this.activeStep.key === 'user' && Object.keys(this.currentUser).length === 0)
                ) 
            {
                return true
            }
            return false
        }
    },
    methods: {
        handleInput(i) {
            console.log(i)
        }
    }
};
</script>
<style scoped>
    h2 {
        @apply mb-3;
    }
    
    .slide-enter-active {
        transition: all 0.25s ease-in-out;
    }
    .slide-leave-active {
        transition: all 0.25s ease-in-out;
    }

    .slide-enter-from {
        opacity: 0;
    }

    .slide-leave-to {
        opacity: 0;
    }
    .failure {
        color: var(--wkid-message-error-dark);
        background: var(--wkid-message-error-light);
    }
</style>