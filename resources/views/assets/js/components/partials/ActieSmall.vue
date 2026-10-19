<template>
  <article
    class="flex flex-col overflow-hidden rounded-lg actie relative"
    :class="
      flat
        ? 'min-h-[150px]'
        : 'h-[150px] shadow-lg transition-all ease-out hover:translate-y-[-0.250rem] hover:shadow-[0_0_20px_rgba(0,0,0,0.30)]'
    "
    typeof="Article"
  >
    <a
      :href="actie.link"
      :target="targetBlank ? '_blank' : ''"
      :class="[
        flat ? 'flex flex-1' : 'h-full',
        { 'opacity-70 grayscale': isAfgelopen && !flat },
      ]"
      :title="isAfgelopen ? 'Deze actie is afgelopen' : actie.title"
    >
      <meta property="name" :content="actie.title" />
      <meta property="author" typeof="Person" content="admin" />
      <meta
        property="dateModified"
        :content="new Date(actie.updated_at).toISOString()"
      />
      <meta
        class="uk-margin-remove-adjacent"
        property="datePublished"
        :content="new Date(actie.created_at).toISOString()"
      />
      <div class="flex" :class="flat ? 'flex-1' : 'h-full'">
        <div class="w-1/3 h-full relative">
          <img
            v-if="actie.image_url"
            class="object-cover h-full w-full absolute inset-0"
            :src="actie.image_url"
            alt=""
          />
          <div
            v-else
            class="h-full bg-gray-300 text-gray-400 flex items-center justify-center"
          >
            <LogoIcon style="fill: currentColor; height: 80px" />
          </div>
        </div>
        <div class="flex flex-col w-2/3 justify-between flex-1 bg-white">
          <div
            class="title-body-container p-3 overflow-hidden flex flex-col justify-between"
            :class="flat ? 'gap-2' : 'h-full'"
          >
            <div>
              <h3
                class="line-clamp-2 uppercase text-xl font-semibold leading-5 text-gray-900"
              >
                {{ actie.title }}
              </h3>
              <span class="text-sm font-bold text-[color:var(--wkid-pink)]">{{
                actie.start_date.toUpperCase()
              }}</span>
              <div class="mb-2">
                <p class="text-sm leading-4 text-gray-900 line-clamp-2">
                  {{ __("acties.by") }}
                  <a
                    :href="actie.organizers[0].link"
                    class="font-medium hover:underline"
                    style="color: inherit"
                  >
                    {{ actie.organizers[0].name }}</a
                  >
                  <span v-if="actie.organizers.length > 1"
                    >&nbsp;{{ __("general.and") }}&nbsp;<span
                      class="font-medium"
                      >{{ actie.organizers.length - 1 }}&nbsp;{{
                        actie.organizers.length - 1 > 1
                          ? __("general.others")
                          : __("general.other")
                      }}</span
                    ></span
                  >
                </p>
              </div>
            </div>
            <div>
              <ThemesChips
                :themes="actie.themes"
                :max-visible="1"
                :show-plus-label="false"
                :compact="true"
              ></ThemesChips>
            </div>
          </div>
        </div>
      </div>
    </a>
  </article>
</template>

<script setup lang="ts">
import { computed, inject } from "vue";
import LogoIcon from "&/logo-icon.svg";
import { useTranslate } from "@composables";
const __ = useTranslate();

const props = defineProps({
  actie: {
    type: Object,
    required: true,
  },
  targetBlank: {
    type: Boolean,
    default: false,
  },
  flat: {
    type: Boolean,
    default: false,
  },
});

const isAfgelopen = computed(() => {
  return (
    new Date(props.actie.end_date + " " + props.actie.end_time) < new Date()
  );
});
</script>
