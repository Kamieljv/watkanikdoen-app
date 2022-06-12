<template>
    <div>
        <step-progress
            :steps="steps"
            :currentStep="activeIndex"
            v-model="activeIndex"
        >
        </step-progress>
        {{selectedOrganizers}}
        {{report}}
        {{currentUser}}

        <ValidationObserver>
            <transition name="slide" mode="out-in" appear>
                <div v-if="activeIndex === 0" class="p-8 bg-white rounded-md shadow-md min-h-[300px]" :key="0">
                    <h2>Start: Een actie toevoegen</h2>
                    <p>Super dat je een actie wilt toevoegen! Op deze manier werk je met ons mee om de
                        website volledig te maken.
                        Om een actie toe te voegen vragen we je om in te loggen of een account aan te maken.
                        Dit is nodig om je op de hoogte te houden van de status van de aangemelde actie.
                    </p>
                </div>
                <div v-else-if="activeIndex === 1" class="p-8 bg-white rounded-md shadow-md min-h-[300px]" :key="1">
                    <h2>Kies organisator(en)</h2>
                    <organizer-form
                        v-model="selectedOrganizers"
                        :selected-organizers="selectedOrganizers"
                        :routes="routes"
                    />
                </div>
                <div v-else-if="activeIndex === 2" class="p-8 bg-white rounded-md shadow-md min-h-[300px]" :key="2">
                    <h2>Actiedetails beschrijven</h2>
                    <Actie-Form
                        ref="actieForm"
                        v-model="report"
                        :report="report"
                        :default-center="defaultCenter"
                        :zoom="zoom"
                    ></Actie-Form>
                </div>
                <div v-else-if="activeIndex === 3" class="p-8 bg-white rounded-md shadow-md min-h-[300px]" :key="3">
                    <h2>Wie ben jij?</h2>
                    <LoginOrRegister
                        :routes="routes"
                        :min-password-length="minPasswordLength"
                        :async="true"
                        :h-captcha-key="hCaptchaKey"
                        :user="currentUser"
                        @done="authDone"
                    />
                </div>
                <div v-else class="p-8 bg-white rounded-md shadow-md min-h-[300px]" :key="4">
                    <h2>Klaar!</h2>
                    <p>Dankjewel!
                    </p>
                </div>
            </transition>
            <div class="flex mt-5" :class="{'justify-end': activeIndex === 0, 'justify-between': activeIndex > 0}">
                <button v-if="activeIndex > 0" type="button" @click.prevent="activeIndex--"
                    class="secondary">
                    {{ __('general.previous') }}
                </button>
                <button class="primary"  @click.prevent="handleNext" :disabled="nextDisabled">
                    {{ isLastStep ? __('general.send_form') : __('general.next') }}
                </button>
            </div>
        </ValidationObserver>
    </div>
</template>

<script>

import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "AddActie",
    mixins: [
        caseHelper,
    ],
    props: {
        routes: {
            type: Object,
            required: true,
        },
        defaultCenter: {
			type: Array,
			required: true,
		},
		zoom: {
			type: Number,
			required: true,
		},
        hCaptchaKey: {
            type: String,
            required: true,
        },
        user: {
            type: Object,
        },
        minPasswordLength: {
            type: Number,
            default: 10,
        },
    },
    data: () => ({
        activeIndex: 2,
        steps: [
            'Start',
            'Organisator kiezen/toevoegen',
            'Actie beschrijven',
            'Wie ben jij?',
            'Klaar!'
        ],
        report: {},
        selectedOrganizers: [],
        currentUser: {},
    }),
    computed: {
        isLastStep() {
            return this.activeIndex === this.steps.length - 1;
        },
        nextDisabled() {
            if ((this.activeIndex === 1 && this.selectedOrganizers.length == 0) ||
                (this.activeIndex === 3 && Object.keys(this.currentUser).length === 0)
                ) 
            {
                return true
            }
            return false
        }
    },
    mounted() {
        this.currentUser = this.user
    },
    methods: {
        submit() {
            console.log("Submitting to server!");
            // You could also validate manually like this.
            // this.$refs.registerForm.validate(); // this is 'async' use `await` or `then`.
        },
        handleNext() {
            if (this.activeIndex === 1 && this.selectedOrganizers.length == 0) {
                this.error = 'Set an organizer first'
            } else if (this.activeIndex === 2) {
                this.$refs.actieForm.$refs.actieValidator.validate().then((result) => {
                    if (result) { 
                        this.activeIndex++ 
                    }
                })
            } else {
                this.activeIndex++
            }
        },
        authDone(user) {
            this.currentUser = user
            this.activeIndex++
        }
    },
    // watch: {
    //     report: {
    //         handler: function (value) {
    //             console.log(value)
    //         },
    //         deep: true
    //     }
    // }
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