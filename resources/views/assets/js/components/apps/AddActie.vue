<template>
    <div>
        <div v-if="!sent">
            <step-progress
                :steps="stepTitles"
                :currentStep="activeIndex"
                v-model="activeIndex"
            >
            </step-progress>
            <ValidationObserver>
                <transition name="slide" mode="out-in" appear>
                    <div v-if="activeStep.key === 'start'" class="p-8 bg-white rounded-md shadow-md min-h-[400px]" :key="0">
                        <h2>Een actie toevoegen</h2>
                        <p>Super dat je een actie wilt toevoegen! Op deze manier werk je met ons mee om de
                            website volledig te maken.
                            Om een actie toe te voegen vragen we je om in te loggen of een account aan te maken.
                            Dit is nodig om je op de hoogte te houden van de status van de aangemelde actie.
                            <br/><br/>
                            We plaatsen alleen acties die voldoen aan onze voorwaarden. Bekijk hiervoor de pagina <a href="/welke-acties-plaatsen-we">Welke acties plaatsen we?</a>.
                            <br/><br/>
                            Heb je vragen? Neem een kijkje op de <a href="/hoe-werkt-het">Hoe werkt het?</a>-pagina of neem <a href="/contact">contact</a> met ons op.
                            <br/><br/>
                            Klik op 'Volgende' om door te gaan.
                        </p>
                    </div>
                    <div v-else-if="activeStep.key === 'organizer'" class="p-8 bg-white rounded-md shadow-md min-h-[400px]" :key="1">
                        <h2>Kies organisator(en)</h2>
                        <organizer-form
                            v-model="selectedOrganizers"
                            :selected-organizers="selectedOrganizers"
                            :routes="routes"
                        />
                    </div>
                    <div v-else-if="activeStep.key === 'actie'" class="p-8 bg-white rounded-md shadow-md min-h-[400px]" :key="2">
                        <h2>Actiedetails beschrijven</h2>
                        <Actie-Form
                            ref="actieForm"
                            v-model="report"
                            :report="report"
                            :default-center="('location' in report) ? [report.location] : defaultCenter"
                            :zoom="zoom"
                        ></Actie-Form>
                    </div>
                    <div v-else-if="activeStep.key === 'user' && currentUser !== {}" class="p-8 bg-white rounded-md shadow-md min-h-[400px]" :key="3">
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
                    <div v-if="activeStep.key === 'confirm'" class="flex flex-col justify-between p-8 bg-white rounded-md shadow-md min-h-[400px]" :key="4">
                        <div>
                            <h2>Bevestig en verzend je actie</h2>
                            <p>Ben je helemaal klaar? Klik dan op 'Verzenden'.
                                <br/><br/>
                                We gaan zo snel mogelijk aan de slag om je inzending te toetsen aan onze <a href="/welke-acties-plaatsen-we">voorwaarden voor plaatsing</a></p>
                        </div>
                        <div>
                            <p class="text-sm leading-5 text-gray-500">Bij het verzenden van dit formulier ga je akkoord met onze <a href="/algemene-voorwaarden-en-privacyverklaring">Voorwaarden en Privacyverklaring</a>.</p>
                            <div v-if="currentErrors && Object.keys(currentErrors).length > 0" class="mt-2 p-3 text-sm rounded-md failure">
                                <p
                                    v-for="error in Object.keys(currentErrors)"
                                    :key="error"
                                >
                                    {{ currentErrors[error][0] }}
                                </p>
                            </div>
                        </div>
                    </div>
                </transition>
                <div class="flex mt-5" :class="{'justify-end': activeIndex === 0, 'justify-between': activeIndex > 0}">
                    <button v-if="activeIndex > 0" type="button" @click.prevent="activeIndex--"
                        class="secondary">
                        {{ __('general.previous') }}
                    </button>
                    <button v-if="!isLastStep" class="primary"  @click.prevent="handleNext" :disabled="nextDisabled">
                        {{ __('general.next') }}
                    </button>
                    <button v-else class="primary"  @click.prevent="submit">
                        <span v-if="!isLoading">{{ __('general.send_form') }}</span>
                        <div v-else class="custom-loader"></div>
                    </button>
                </div>
            </ValidationObserver>
        </div>
        <div v-else>
            <div class="flex justify-center items-center max-w-6xl mx-auto my-6 bg-white rounded-md shadow-md min-h-[400px]">
                <SuccessGIF src="/images/protest_signs.gif" title="Gelukt! Bedankt voor je bijdrage!" message="We zullen je aanmelding zo snel mogelijk beoordelen."/>
            </div>
        </div>
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
        activeIndex: 0,
        steps: [
            {
                key: 'start',
                title: 'Start'
            },
            {
                key: 'organizer',
                title: 'Organisator kiezen/toevoegen'
            },
            {
                key: 'actie',
                title: 'Actie beschrijven'
            },
            {
                key: 'user',
                title: 'Wie ben jij?'
            },
            {
                key: 'confirm',
                title: 'Bevestigen'
            }
        ],
        report: {},
        selectedOrganizers: [],
        currentUser: {},
        sent: false,
        currentErrors: [],
        isLoading: false,
    }),
    computed: {
        stepTitles() {
            return this.steps.map(s => s.title)
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
    mounted() {
        this.currentUser = this.user
        if (Object.keys(this.currentUser).length > 0) {
            this.steps = this.steps.filter((s) => s.key !== 'user')
        }
    },
    methods: {
        submit() {
            this.isLoading = true;
            // build organizers data object
            var organizers = this.selectedOrganizers.map((org) => {
                return ('id' in org)? {id: org.id} : org
            })
            // remove report properties with null value
            Object.keys(this.report).forEach(k => {
                if (this.report[k] === null) {
                    delete this.report[k];
                }
            });
            this.$http.post(this.routes['report_create'], {
                userId: this.currentUser.id,
                organizers: organizers,
                report: this.report,
            }).then((response) => {
                if (response.data.status === 'success') {
                    this.sent = true
                } else {
                    this.currentErrors = {error: [response.data.message]}
                }
                this.isLoading = false;
            }).catch((error) => {
                this.currentErrors = error.response.data.errors;
                this.isLoading = false;
            })
        },
        handleNext() {
            window.scrollTo(0,0);

            if (this.activeStep.key === 'actie') {
                this.$refs.actieForm.$refs.actieValidator.validate().then((result) => {
                    if (result) { 
                        this.activeIndex++ 
                    }
                    else if( this.activeIndex > 1){
                        var i = 0
                        for(var key in this.$refs.actieForm.$refs.actieValidator.fields){
                            var el = document.querySelector( '[name=' + key + ']')
                            if(el && ++i == 1)
                                el.scrollIntoView()
                        }
                    }
                });
                this.currentErrors = [];
            } else {
                this.activeIndex++
            }
        },
        authDone(user) {
            this.currentUser = user
            this.activeIndex++
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
    .failure {
        color: var(--wkid-message-error-dark);
        background: var(--wkid-message-error-light);
    }
</style>