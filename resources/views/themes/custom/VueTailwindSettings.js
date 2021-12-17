import { TInput, TButton, TRichSelect, TPagination, TTag, TCard } from "vue-tailwind/dist/components";
const VueTailwindSettings = {
  "t-input": {
    component: TInput,
  },
  "t-button": {
    component: TButton,
  },
  "t-rich-select": {
    component: TRichSelect,
  },
  "t-pagination": {
    component: TPagination,
  },
  "t-tag": {
    component: TTag,
  },
  "t-card": {
    component: TCard,
    props: {
        variants: {
            skeleton: {
                body: 'p-3',
                wrapper: 'rounded-lg shadow-md animate-pulse',
                header: 'bg-gray-200 h-48 p-3',
                footer: 'p-3',
            }
        }
    }
  },
};
export default VueTailwindSettings;