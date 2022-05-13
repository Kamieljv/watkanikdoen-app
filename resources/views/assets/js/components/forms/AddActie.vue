<template>
    <div>
        <step-progress
            :steps="steps"
            :currentStep="activeIndex"
        >
        </step-progress>

        <ValidationObserver v-slot="{ passes }">
            <form @submit.prevent="passes(nextStep)" class="form">
                <transition name="slide" mode="out-in" appear>
                    <div v-if="activeIndex === 0" class="p-6 bg-white rounded-md shadow-md min-h-[300px]" :key="0">
                        <h2>Start: Een actie toevoegen</h2>
                        <p>Super dat je een actie wilt toevoegen! Op deze manier werk je met ons mee om de
                            website volledig te maken.
                            Om een actie toe te voegen vragen we je om in te loggen of een account aan te maken.
                            Dit is nodig om je op de hoogte te houden van de status van de aangemelde actie.
                        </p>
                    </div>
                    <div v-else-if="activeIndex === 1" class="p-6 bg-white rounded-md shadow-md min-h-[300px]" :key="1">
                        <h2>Organisator kiezen/toevoegen</h2>
                        <p>Hier kun je een organisator kiezen/toevoegen.
                        </p>
                    </div>
                    <div v-else-if="activeIndex === 2" class="p-6 bg-white rounded-md shadow-md min-h-[300px]" :key="2">
                        <h2>Actiedetails beschrijven</h2>
                        <p>Hier komt het actieformulier</p>
                    </div>
                    <div v-else-if="activeIndex === 3" class="p-6 bg-white rounded-md shadow-md min-h-[300px]" :key="3">
                        <h2>Account registreren</h2>
                        <p>Super dat je een actie wilt toevoegen! Op deze manier werk je met ons mee om de
                            website volledig te maken.
                            Om een actie toe te voegen vragen we je om in te loggen of een account aan te maken.
                            Dit is nodig om je op de hoogte te houden van de status van de aangemelde actie.
                        </p>
                    </div>
                    <div v-else class="p-6 bg-white rounded-md shadow-md min-h-[300px]" :key="4">
                        <h2>Klaar!</h2>
                        <p>Dankjewel!
                        </p>
                    </div>
                </transition>
                <div class="flex mt-5" :class="{'justify-end': activeIndex === 0, 'justify-between': activeIndex > 0}">
                    <button v-if="activeIndex > 0" type="button" @click="activeIndex--"
                        class="flex items-center justify-center px-4 py-2 text-base font-medium leading-6 text-blue-500 transition duration-150 ease-in-out border rounded-md border-1 border-blue-500 hover:bg-blue-500/25">
                        {{ __('general.previous') }}
                    </button>
                    <button class="flex items-center justify-center px-4 py-3 text-base font-medium leading-6 text-white transition duration-150 ease-in-out border border-transparent rounded-md bg-blue-600 hover:bg-blue-500">
                        {{ isLastStep ? __('general.send_form') : __('general.next') }}
                    </button>
                </div>
            </form>
        </ValidationObserver>
    </div>
</template>

<script>

import { ValidationProvider } from 'vee-validate';
import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "AddActie",
    components: {
        ValidationProvider
    },
    mixins: [
        caseHelper,
    ],
    props: {
        routes: {
            type: Object,
            required: true,
        },
    },
    data: () => ({
        activeIndex: 0,
        steps: [
            'Start',
            'Organisator kiezen/toevoegen',
            'Actie beschrijven',
            'Account registreren',
            'Klaar!'
        ],
    }),
    computed: {
        isLastStep() {
            return this.activeIndex === this.steps.length - 1;
        }
    },
    methods: {
        submit() {
            console.log("Submitting to server!");
            // You could also validate manually like this.
            // this.$refs.registerForm.validate(); // this is 'async' use `await` or `then`.
        },
        nextStep() {
            if (this.isLastStep) {
                return this.submit();
            }
            this.activeIndex++;
        }
    }
};
</script>
<style scoped>
    h2 {
        @apply mb-3;
    }
    .slide-enter-active,
    .slide-leave-active {
        transition: all 0.25s ease-in-out;
    }

    .slide-enter-from {
        opacity: 0;
    }

    .slide-leave-to {
        opacity: 0;
    }
</style>