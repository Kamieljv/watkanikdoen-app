<template>
    <div>
        <div class="flex w-full justify-center items-center" style="color:var(--wkid-message-success)">
            <svg-vue icon="clarity-check-circle-line" class="shrink-0" style="stroke: currentColor; height: 150px;"></svg-vue>
        </div>
        <p class="text-center">{{message}}</p>
    </div>
</template>
<script>
export default {
    name: "SuccessBlock",
    props: {
        message: {
            type: String,
            required: true,
        },
    },
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