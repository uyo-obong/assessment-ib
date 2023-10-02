<script setup>
import HeroDisplay from "@/components/HeroDisplay.vue";
import InfoDisplay from "@/components/InfoDisplay.vue";

import {ref, reactive} from "vue";
import axios from "axios";
import {useRouter} from "vue-router";

// Handle model binding
let validateCard = reactive({
    card_name: "",
    card_number: "",
    card_expiry_month: "",
    card_expiry_year: "",
    card_cvv: "",
});

//Handle error log
const validationError = ref({
    card_name: null,
    card_number: null,
    card_expiry_month: null,
    card_expiry_year: null,
    card_cvv: null,
});

const validationSuccess = ref({
    success: null,
});

const router = useRouter();
const handleValidation = () => {
    axios.post("http://127.0.0.1:8000/api/card/validation", validateCard).then((res) => {

        validationSuccess.value.success = res.data.message

        // Reset validationError values to null
        for (const key in validationError.value) {
            validationError.value[key] = null;
        }

        router.push("/");
    }).catch((err) => {

        // Reset validationSuccess to null
        validationSuccess.value.success = null

        const errorMessages = err.response.data.message;
        for (const key in errorMessages) {
            if (key in validationError.value) {
                validationError.value[key] = errorMessages[key][0];
            }
        }
    });
};
</script>

<template>
    <HeroDisplay/>

    <div class="row align-items-md-stretch">
        <InfoDisplay/>

        <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
                <form class="row" @submit.prevent="handleValidation">
                    <div class="col-md-12 mb-3">
                        <input type="text" class="form-control"
                               :class="{ 'is-valid': validationSuccess.success, 'is-invalid': validationError.card_name }"
                               id="validationServer01"
                                placeholder="Enter Card Name" v-model="validateCard.card_name">
                        <div class="invalid-feedback" v-if="validationError.card_name"> {{
                            validationError.card_name
                            }}
                        </div>
                    </div>

                    <div class="col-md-12 mb-3">
                        <input type="text" class="form-control"
                               :class="{ 'is-valid': validationSuccess.success, 'is-invalid': validationError.card_number }"
                               id="validationServer06"
                                placeholder="Enter Card Number" v-model="validateCard.card_number">
                        <div class="invalid-feedback" v-if="validationError.card_number"> {{
                            validationError.card_number
                            }}
                        </div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <input type="text" class="form-control"
                               :class="{ 'is-valid': validationSuccess.success, 'is-invalid': validationError.card_expiry_month }"
                               id="validationServer03"
                               placeholder="Expiry Month" v-model="validateCard.card_expiry_month">
                        <div class="invalid-feedback" v-if="validationError.card_expiry_month"> {{
                            validationError.card_expiry_month
                            }}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <input type="text" class="form-control"
                               :class="{ 'is-valid': validationSuccess.success, 'is-invalid': validationError.card_expiry_year }"
                               id="validationServer03"
                               placeholder="Expiry Year" v-model="validateCard.card_expiry_year">
                    </div>

                    <div class="col-md-4">
                        <input type="text" class="form-control"
                               :class="{ 'is-valid': validationSuccess.success, 'is-invalid': validationError.card_cvv }"
                               id="validationServer03"
                               placeholder="Card CVV" v-model="validateCard.card_cvv">
                        <div class="invalid-feedback" v-if="validationError.card_cvv"> {{
                            validationError.card_cvv
                            }}
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary">Submit form</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
