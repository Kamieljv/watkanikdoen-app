<template>
    <div                                        >
        <div class="col-span-2">
            We willen je graag op de hoogte houden van de status van je aanmeldingen 
            en je hier eventueel vragen over stellen. 
            Daarom vragen we je om in te loggen óf een account te maken.
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 max-w-4xl mx-auto flex-col my-6 md:divide-x">
            <div class="col-span-1 space-y-3">
                <Login
                    :routes="routes"
                    :min-password-length="minPasswordLength"
                    :async="true"
                />
            </div>
            <div class="col-span-1 space-y-3">
                <Register
                    :routes="routes"
                    :min-password-length="minPasswordLength"
                    :h-captcha-key="hCaptchaKey"
                    :async="true"
                />
            </div>
        </div>
    </div>
</template>

<script>

import { caseHelper } from '../../mixins/caseHelper';

export default {
	name: "AddActie",
    components: {
        //
    },
    mixins: [
        caseHelper,
    ],
    props: {
        routes: {
            type: Object,
            required: true,
        },
        minPasswordLength: {
            type: Number,
            default: 10,
        },
        hCaptchaKey: {
            type: String,
            required: true,
        },
        minPasswordLength: {
            type: Number,
            default: 10,
        },
    }
}
</script>