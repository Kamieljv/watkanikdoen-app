<template>
    <div class="relative">
        <div class="h-full">
			<!-- The search input -->
            <t-input
                @input="onChange"
                v-model="search"
                @keydown.down="onArrowDown"
                @keydown.up="onArrowUp"
                @keydown.enter="onEnter"
                :placeholder="placeholder"
                :disabled="hasValue"
                :class="{'pr-8': hasValue}"
            />
			<!-- The form input -->
			<input type="hidden" :value="formValue" :name="formInputName" />
            <div
                v-if="hasValue"
                class="absolute right-0 inset-y-0 flex items-center pr-3 ml-3 cursor-pointer"
                @click="resetResult"
            >
                <svg class="fill-current h-4 w-4 text-gray-400" viewBox="0 0 20 20">
                    <path fill="currentColor" d="M11.469,10l7.08-7.08c0.406-0.406,0.406-1.064,0-1.469c-0.406-0.406-1.063-0.406-1.469,0L10,8.53l-7.081-7.08
                    c-0.406-0.406-1.064-0.406-1.469,0c-0.406,0.406-0.406,1.063,0,1.469L8.531,10L1.45,17.081c-0.406,0.406-0.406,1.064,0,1.469
                    c0.203,0.203,0.469,0.304,0.735,0.304c0.266,0,0.531-0.101,0.735-0.304L10,11.469l7.08,7.081c0.203,0.203,0.469,0.304,0.735,0.304
                    c0.267,0,0.532-0.101,0.735-0.304c0.406-0.406,0.406-1.064,0-1.469L11.469,10z"></path>
                </svg>
            </div>
        </div>

        <ul
        id="autocomplete-results"
        v-show="isOpen"
        class="absolute bg-white w-full z-[99] rounded-lg overflow-hidden mt-1"
        v-bind:class="{'flex align-center justify-center': isLoading}"
        >
            <li
                class="loading w-full flex align-center justify-center"
                v-if="isLoading"
            >
                <div class="dot-flashing my-3"/>
            </li>
            <li
                v-else
                v-for="(result, i) in results"
                :key="i"
                @click="setResult(result)"
                class="autocomplete-result px-3 py-1 cursor-pointer"
                :class="{ 'is-active': i === arrowCounter }"
                v-html="result[visibleAttribute]"
            >
            </li>
        </ul>
    </div>
</template>

<script>
export default {
	name: "FormAutocomplete",
	props: {
		items: {
			type: Array,
			required: false,
			default: () => [],
		},
		isAsync: {
			type: Boolean,
			required: false,
			default: false,
		},
		minQueryLength: {
			type: Number,
			default: 3,
		},
		visibleAttribute: {
			type: String,
			default: "name"
		},
		formAttribute: {
			type: String,
			default: "id"
		},
		formInputName: {
			type: String,
			default: ""
		},
		placeholder: {
			type: String,
			required: false,
			default: '',
		}
	},
	data() {
		return {
			isOpen: false,
			results: [],
			search: "",
			isLoading: false,
			hasValue: false,
			arrowCounter: 0,
			preventOpen: false,
			formValue: null,
		}
	},
	watch: {
		items: function (value, oldValue) {
			if (value !== oldValue) {
				this.results = value
				this.isLoading = false
				this.isOpen = true
			}
		},
	},
	mounted() {
		document.addEventListener("click", this.handleClickOutside)
	},
	destroyed() {
		document.removeEventListener("click", this.handleClickOutside)
	},
	methods: {
		setResult(result) {
			this.preventOpen = true
			this.search = result[this.visibleAttribute].replace(/(<([^>]+)>)/gi, "")
			if (!this.isAsync) {
				this.formValue = result[this.formAttribute]
			}
			this.isOpen = false
			this.hasValue = true
			this.$emit("input", result)
		},
		resetResult() {
			this.search = ""
			this.isOpen = false
			this.hasValue = false
			this.formValue = null
			this.$emit("input", "")
		},
		filterResults() {
			this.results = this.items.filter((item) => {
				return item[this.visibleAttribute].toLowerCase().indexOf(this.search.toLowerCase()) > -1
			})
		},
		onChange: _.debounce(function() {
			if (this.search.length >= this.minQueryLength) {
				if (!this.preventOpen) this.$emit("change", this.search)
				if (this.isAsync) {
					this.isLoading = true
					this.isOpen = !this.preventOpen
				} else {
					this.filterResults()
					this.isOpen = !this.preventOpen
				}
			} else {
				this.isOpen = false
			}
			this.preventOpen = false
		}, 500),
		handleClickOutside(event) {
			if (!this.$el.contains(event.target)) {
				this.isOpen = false
				this.arrowCounter = 0
			}
		},
		onArrowDown() {
			if (this.arrowCounter < this.results.length) {
				this.arrowCounter = this.arrowCounter + 1
			}
		},
		onArrowUp() {
			if (this.arrowCounter > 0) {
				this.arrowCounter = this.arrowCounter - 1
			}
		},
		onEnter() {
			this.search = this.results[this.arrowCounter][this.visibleAttribute].replace(/(<([^>]+)>)/gi, "")
			this.isOpen = false
			this.arrowCounter = 0
		},
	}
}
</script>

<style>
    .autocomplete-result.is-active,
    .autocomplete-result:hover {
        background-color: var(--wkid-blue);
        color: white;
    }

    /**
    * ==============================================
    * Dot Flashing
    * ==============================================
    */
    .dot-flashing::before, .dot-flashing::after, .dot-flashing {
        width: 10px;
        height: 10px;
        border-radius: 5px;
        background-color: #6c6c6c;
        color: #6c6c6c;
        animation: dotFlashing 1s infinite alternate;
        content: '';
        display: inline-block;
        position: absolute;
        top: 0;
    }
    .dot-flashing {
        position: relative;
        animation: dotFlashing 1s infinite linear alternate;
        animation-delay: .5s;
    } 
    .dot-flashing::before {
        left: -15px;
        animation-delay: 0s;
    }
    .dot-flashing::after {
        left: 15px;
        animation-delay: 1s;
    }

    @keyframes dotFlashing {
        0% {
            background-color: #757575;
        }
        50%,
        100% {
            background-color: #ddd;
        }
    }
</style>