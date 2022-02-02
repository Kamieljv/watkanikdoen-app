import { TRichSelect, TCard, TInput, TModal, TToggle } from "vue-tailwind/dist/components"
const VueTailwindSettings = {
	"t-rich-select": {
		component: TRichSelect,
		props: {
			fixedClasses: {
				wrapper: "relative",
				buttonWrapper: "inline-block relative w-full h-full",
				selectButton: "w-full h-full flex text-left justify-between items-center cursor-pointer",
				selectButtonLabel: "block truncate",
				selectButtonTagWrapper: "flex overflow-hidden",
				selectButtonTag: "",
				selectButtonTagText: "px-3",
				selectButtonTagDeleteButton: "-ml-1.5 h-full hover:bg-[color:var(--wkid-blue-dark)] hover:shadow-sm inline-flex items-center px-2 transition",
				selectButtonTagDeleteButtonIcon: "w-3 h-3",
				selectButtonPlaceholder: "block truncate",
				selectButtonIcon: "fill-current flex-shrink-0 ml-1 h-4 w-4",
				selectButtonClearButton: "flex flex-shrink-0 items-center justify-center absolute right-0 top-0 m-2 h-6 w-6",
				selectButtonClearIcon: "fill-current h-3 w-3",
				dropdown: "absolute w-full z-10",
				dropdownFeedback: "",
				loadingMoreResults: "",
				optionsList: "overflow-auto",
				searchWrapper: "inline-block w-full",
				searchBox: "inline-block w-full",
				optgroup: "",
				option: "cursor-pointer",
				disabledOption: "opacity-50 cursor-not-allowed",
				highlightedOption: "cursor-pointer",
				selectedOption: "cursor-pointer",
				selectedHighlightedOption: "cursor-pointer",
				optionContent: "",
				optionLabel: "truncate block",
				selectedIcon: "fill-current h-4 w-4",
				enterClass: "",
				enterActiveClass: "",
				enterToClass: "",
				leaveClass: "",
				leaveActiveClass: "",
				leaveToClass: "",
			},
			classes: {
				wrapper: "",
				buttonWrapper: "",
				selectButton: "px-3 py-2 text-black transition duration-100 ease-in-out bg-white border border-gray-300 rounded shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed",
				selectButtonLabel: "",
				selectButtonTagWrapper: "-mx-2 -my-2.5 py-2 pr-8",
				selectButtonTag: "bg-[color:var(--wkid-blue)] mr-1 block shrink-0 disabled:cursor-not-allowed disabled:opacity-50 duration-100 ease-in-out focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded shadow-sm text-sm text-white transition white-space-no m-0.5 max-w-full overflow-hidden h-8 flex items-center",
				selectButtonTagText: "px-2",
				selectButtonTagDeleteButton: "-ml-1.5 h-full hover:bg-[color:var(--wkid-blue-dark)] hover:shadow-sm inline-flex items-center px-2 transition",
				selectButtonTagDeleteButtonIcon: "",
				selectButtonPlaceholder: "text-gray-500",
				selectButtonIcon: "text-gray-600",
				selectButtonClearButton: "hover:bg-blue-100 text-gray-600 rounded transition duration-100 ease-in-out",
				selectButtonClearIcon: "",
				dropdown: "-mt-1 bg-white border-b border-gray-300 border-l border-r rounded-b shadow-sm",
				dropdownFeedback: "pb-2 px-3 text-gray-400 text-sm",
				loadingMoreResults: "pb-2 px-3 text-gray-400 text-sm",
				optionsList: "",
				searchWrapper: "p-2 placeholder-gray-400",
				searchBox: "px-3 py-2 bg-gray-50 text-sm rounded border focus:outline-none focus:shadow-outline border-gray-300",
				optgroup: "text-gray-400 uppercase text-xs py-1 px-2 font-semibold",
				option: "",
				disabledOption: "",
				highlightedOption: "bg-blue-100",
				selectedOption: "font-semibold bg-[color:var(--wkid-blue)] font-semibold text-white",
				selectedHighlightedOption: "font-semibold bg-[color:var(--wkid-blue-dark)] font-semibold text-white",
				optionContent: "flex justify-between items-center px-3 py-2",
				optionLabel: "",
				selectedIcon: "",
				enterClass: "opacity-0",
				enterActiveClass: "transition ease-out duration-100",
				enterToClass: "opacity-100",
				leaveClass: "opacity-100",
				leaveActiveClass: "transition ease-in duration-75",
				leaveToClass: "opacity-0",
			},
		}
	},
	"t-card": {
		component: TCard,
		props: {
			variants: {
				skeleton: {
					body: "p-3",
					wrapper: "rounded-lg shadow-md animate-pulse",
					header: "bg-gray-200 h-48 p-3",
					footer: "p-3",
				}
			}
		}
	},
	"t-input": {
		component: TInput,
		props: {
			fixedClasses: "block w-full h-full px-3 py-2 transition duration-100 ease-in-out border rounded shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50 disabled:opacity-50 disabled:cursor-not-allowed",
			classes: "text-black placeholder-gray-400 bg-white border-gray-300 focus:border-blue-500 ",
			variants: {
				danger: "border-red-300 bg-red-50 placeholder-red-200 text-red-900",
				success: "border-green-300 bg-green-50 placeholder-gray-400 text-green-900"
			}
		}
	},
	't-modal': {
		component: TModal,
		props: {
		  	fixedClasses: {
				overlay: 'z-[1001] overflow-auto scrolling-touch left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black/50',
				wrapper: 'relative mx-auto mt-20 max-w-lg px-3 py-12',
				modal: 'overflow-visible relative rounded-lg overflow-hidden',
				body: 'p-3',
				header: 'border-b rounded-t',
				footer: ' p-3 rounded-b',
				close: 'flex items-center justify-center rounded-full absolute right-0 top-0 -m-3 h-8 w-8 transition duration-100 ease-in-out focus:ring-2 focus:ring-blue-500 focus:outline-none focus:ring-opacity-50'
		  	},
		  	classes: {
				overlay: '',
				wrapper: '',
				modal: 'bg-white shadow',
				body: '',
				header: 'border-gray-100 p-5',
				footer: 'bg-gray-100',
				close: 'bg-gray-100 text-gray-600 hover:bg-gray-200',
				closeIcon: 'fill-current h-4 w-4',
				overlayEnterClass: 'opacity-0',
				overlayEnterActiveClass: 'transition ease-out duration-100',
				overlayEnterToClass: 'opacity-100',
				overlayLeaveClass: 'opacity-100',
				overlayLeaveActiveClass: 'transition ease-in duration-75',
				overlayLeaveToClass: 'opacity-0',
				enterClass: '',
				enterActiveClass: '',
				enterToClass: '',
				leaveClass: '',
				leaveActiveClass: '',
				leaveToClass: ''
			},
			variants: {
				danger: {
					overlay: '',
					header: 'bg-[color:var(--wkid-red)] text-white p-3',
					body: 'text-gray-900',
					close: 'bg-red-50 text-red-700 hover:bg-red-200 border-red-100 border',
					modal: 'bg-white shadow-lg',
					footer: 'bg-red-50'
				}
			}
		}
	},
	"t-toggle": {
		component: TToggle,
	}
}
export default VueTailwindSettings