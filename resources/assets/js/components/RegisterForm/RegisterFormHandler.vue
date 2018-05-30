<template>
    <span>
        <register-company :info="steps" v-show="steps.currentStep == 1"></register-company>
        <choose-plan :info="steps" v-show="steps.currentStep == 2"></choose-plan>
        <payment :info="steps" v-show="steps.currentStep == 3"></payment>
        <finish-registration :info="steps" v-show="steps.currentStep == 4"></finish-registration>
    </span>
</template>

<script>
    export default {
        data(){
           return {
               steps:{
                   currentStep:1,
               }
           }
        }
    }
</script>