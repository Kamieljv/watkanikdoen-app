import { TRichSelect, TCard } from "vue-tailwind/dist/components";
const VueTailwindSettings = {
  "t-rich-select": {
      component: TRichSelect
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