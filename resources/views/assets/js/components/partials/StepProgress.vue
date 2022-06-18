<template>
    <div>
        <div class="w-full h-20 mt-8 sm:mb-4">
            <ul class="progressbar flex justify-between">
                <li 
                    :class="{'active': (i-1) <= current, 'cursor-pointer': ((i - current) === 0 || (i-1) < current)}" 
                    v-for="i in steps.length" 
                    :key="i" 
                    :style="{width: widthPerc}"
                    @click="setCurrentStep(i)"
                >
                    <p class="text-sm hidden sm:block">{{ steps[i-1].title }}</p>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        steps: {
            type: Array,
            required: true,
        },
        currentStep: {
            type: Number,
            required: true,
        },
    },
    data () {
        return {
            current: this.currentStep
        }
    },
    computed: {
        widthPerc: function() {
            return 100 / this.steps.length + '%'
        }
    },
    watch: {
        currentStep() {
            this.current = this.currentStep
        }
    },
    methods: {
        setCurrentStep: function(i) {
            if ((i - this.current) === 0 || (i-1) < this.current) {
                this.current = i-1
                this.$emit('input', this.current)
            }
        }
    }
}
</script>

<style scoped lang="scss">
    .progressbar{
        counter-reset: step;
        & li {
            position: relative;
            text-align: center;
            // Step nodes
            &:before {
                content:counter(step);
                counter-increment: step;
                width: 30px;
                height: 30px;
                border: 2px solid #bebebe;
                display: block;
                margin: 0 auto 10px auto;
                border-radius: 50%;
                line-height: 27px;
                background: white;
                color: #bebebe;
                text-align: center;
                font-weight: bold;
                transition: all 0.25s ease-in-out;
            }
            // Lines between step nodes
            &:after {
                content: '';
                position: absolute;
                width:100%;
                height: 3px;
                background: #979797;
                top: 15px;
                left: -50%;
                z-index: -1;
                transition: all 0.25s ease-in-out;
            }
            &.active {
                &:before {
                    border-color: var(--wkid-blue);
                    background: var(--wkid-blue);
                    color: white;
                }
                &:after {
                    background: var(--wkid-blue);
                }
            }
        }
    }
    .progressbar li:first-child:after{
        content: none;
    }
</style>