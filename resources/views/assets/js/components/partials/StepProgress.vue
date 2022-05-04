<template>
    <div>
        <div class="w-full h-20 mt-8">
            <ul class="progressbar flex justify-between">
                <li class="" :class="[i <= currentStep + 1 ? 'active' : '', widthClass]" v-for="i in steps.length" :key="i">
                    {{ steps[i-1] }}
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
        }
    },
    computed: {
        widthClass: function() {
            return 'w-1/' + this.steps.length
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