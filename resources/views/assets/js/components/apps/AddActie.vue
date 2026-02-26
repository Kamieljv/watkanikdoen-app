<template>
  <div>
    <div v-if="!sent">
      <StepProgress v-model="activeIndex" :steps="stepTitles" />
      <Form>
        <Transition name="slide" mode="out-in" appear>
          <div
            v-if="activeStep.key === 'start'"
            :key="0"
            class="p-8 bg-white rounded-md shadow-md min-h-[400px]"
          >
            <h2 class="mb-3">Een actie toevoegen</h2>
            <p>
              Super dat je een actie wilt toevoegen! Op deze manier werk je met
              ons mee om de website volledig te maken. Om een actie toe te
              voegen vragen we je om in te loggen of een account aan te maken.
              Dit is nodig om je op de hoogte te houden van de status van de
              aangemelde actie. <br /><br />
              We plaatsen alleen acties die voldoen aan onze voorwaarden. Bekijk
              hiervoor de pagina
              <a href="/welke-acties-plaatsen-we">Welke acties plaatsen we?</a>.
              <br /><br />
              Heb je vragen? Neem een kijkje op de
              <a href="/hoe-werkt-het">Hoe werkt het?</a>-pagina of neem
              <a href="/contact">contact</a> met ons op. <br /><br />
              Klik op 'Volgende' om door te gaan.
            </p>
          </div>
          <div
            v-else-if="activeStep.key === 'organizer'"
            :key="1"
            class="p-8 bg-white rounded-md shadow-md min-h-[400px]"
          >
            <h2 class="mb-3">Kies organisator(en)</h2>
            <OrganizerForm v-model="selectedOrganizers" :routes="routes" />
          </div>
          <div
            v-else-if="activeStep.key === 'actie'"
            :key="2"
            class="p-8 bg-white rounded-md shadow-md min-h-[400px]"
          >
            <h2 class="mb-3">Actiedetails beschrijven</h2>
            <ActieForm
              ref="actieFormRef"
              v-model="report"
              :default-center="defaultCenter"
              :zoom="zoom"
            >
            </ActieForm>
            {{  }}
          </div>
          <div
            v-else-if="activeStep.key === 'user'"
            :key="3"
            class="p-8 bg-white rounded-md shadow-md min-h-100"
          >
            <h2 class="mb-3">Wie ben jij?</h2>
            <div class="col-span-2">
              We willen je graag op de hoogte houden van de status van je
              aanmeldingen en je hier eventueel vragen over stellen. Daarom
              vragen we je om in te loggen óf een account te maken.
            </div>
            <LoginOrRegister
              :routes="routes"
              :min-password-length="minPasswordLength"
              :redirect="false"
              :h-captcha-key="hCaptchaKey"
              :user-id="currentUserId"
              @done="authDone"
            />
          </div>
          <div
            v-else-if="activeStep.key === 'confirm'"
            :key="4"
            class="flex flex-col justify-between p-8 bg-white rounded-md shadow-md min-h-[400px]"
          >
            <div>
              <h2 class="mb-3">Bevestig en verzend je actie</h2>
              <p>
                Ben je helemaal klaar? Klik dan op 'Verzenden'. <br /><br />
                We gaan zo snel mogelijk aan de slag om je inzending te toetsen
                aan onze
                <a href="/welke-acties-plaatsen-we"
                  >voorwaarden voor plaatsing</a
                >
              </p>
            </div>
            <div>
              <p class="text-sm leading-5 text-gray-500">
                Bij het verzenden van dit formulier ga je akkoord met onze
                <a href="/algemene-voorwaarden-en-privacyverklaring"
                  >Voorwaarden en Privacyverklaring</a
                >.
              </p>
              <div
                v-if="currentErrors && currentErrors.length > 0"
                class="mt-2 p-3 text-sm rounded-md failure"
              >
                <p v-for="(error, index) in currentErrors" :key="index">
                  {{ error }}
                </p>
              </div>
            </div>
          </div>
        </Transition>
        <div
          class="flex mt-5"
          :class="{
            'justify-end': activeIndex === 0,
            'justify-between': activeIndex > 0,
          }"
        >
          <button
            v-if="activeIndex > 0"
            type="button"
            class="secondary"
            @click.prevent="activeIndex--"
          >
            {{ __("general.previous") }}
          </button>
          <button
            v-if="!isLastStep"
            class="primary"
            :disabled="nextDisabled"
            @click.prevent="handleNext"
          >
            {{ __("general.next") }}
          </button>
          <button v-else class="primary" @click.prevent="submit">
            <span v-if="!isLoading">{{ __("general.send_form") }}</span>
            <div v-else class="custom-loader"></div>
          </button>
        </div>
      </Form>
    </div>
    <div v-else>
      <div
        class="flex justify-center items-center max-w-6xl mx-auto my-6 bg-white rounded-md shadow-md min-h-[400px]"
      >
        <SuccessGIF
          src="/images/protest_signs.gif"
          title="Gelukt! Bedankt voor je bijdrage!"
          message="We zullen je aanmelding zo snel mogelijk beoordelen."
        />
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { computed, inject, onMounted, Ref, ref } from "vue";
import { Form } from "vee-validate";
import axios from "axios";
import OrganizerForm from "../forms/OrganizerForm.vue";
import type { Organizer, Report } from "../../models";
const __: (key: string) => string = inject("translate");

const props = defineProps({
  routes: {
    type: Object,
    required: true,
  },
  defaultCenter: {
    type: Array as () => number[],
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
    default: () => ({}),
  },
  minPasswordLength: {
    type: Number,
    default: 10,
  },
});

const activeIndex = ref(0);
const steps = ref([
  {
    key: "start",
    title: "Start",
  },
  {
    key: "organizer",
    title: "Organisator kiezen/toevoegen",
  },
  {
    key: "actie",
    title: "Actie beschrijven",
  },
  {
    key: "user",
    title: "Wie ben jij?",
  },
  {
    key: "confirm",
    title: "Bevestigen",
  },
]);

const report: Ref<Report | null> = ref({} as Report);
const selectedOrganizers: Ref<Organizer[]> = ref([]);
const currentUserId: Ref<number | null> = ref(null);
const sent: Ref<boolean> = ref(false);
const currentErrors: Ref<string[]> = ref([]);
const isLoading: Ref<boolean> = ref(false);
const actieFormRef = ref(null);

const stepTitles = computed(() => steps.value.map((s) => s.title));
const activeStep = computed(() => steps.value[activeIndex.value]);
const isLastStep = computed(() => activeIndex.value === steps.value.length - 1);
const nextDisabled = computed(() => {
  if (
    (activeStep.value.key === "organizer" &&
      selectedOrganizers.value.length == 0) ||
    (activeStep.value.key === "user" && !currentUserId.value)
  ) {
    return true;
  }
  return false;
});
onMounted(() => {
  currentUserId.value = props.user ? props.user.id : null;
  if (currentUserId.value) {
    steps.value = steps.value.filter((s) => s.key !== "user");
  }
});

const submit = async () => {
  isLoading.value = true;
  // build organizers data object
  const organizers = selectedOrganizers.value.map((org) => {
    return "id" in org ? { id: org.id } : org;
  });
  // remove report properties with null value
  Object.keys(report.value).forEach((k) => {
    if (report.value[k] === null) {
      delete report.value[k];
    }
  });
  axios
    .post(props.routes["report_create"], {
      userId: currentUserId.value,
      organizers: organizers,
      report: report.value,
    })
    .then((response) => {
      if (response.data.status === "success") {
        sent.value = true;
      } else {
        currentErrors.value = [response.data.message];
      }
      isLoading.value = false;
    })
    .catch(() => {
      isLoading.value = false;
    });
};

const handleNext = () => {
  // validate first if active step is actie
  if (activeStep.value.key === "actie") {
    actieFormRef.value.isValid().then((valid) => {
      if (valid) nextStep();
    });
  } else {
    nextStep();
  }
};

const nextStep = () => {
  window.scrollTo(0, 0);
  activeIndex.value++;
};

const authDone = (userId) => {
  currentUserId.value = userId;
  activeIndex.value++;
};
</script>
<style scoped>
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
