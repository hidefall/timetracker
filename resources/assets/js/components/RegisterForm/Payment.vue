<template>
    <span>
        <h2>Payment</h2>
        <form action="#" @submit.prevent="createToken" method="post" id="payment-form">
          <div class="form-row">
            <label for="card-element">
              Credit or debit card
            </label>
            <div id="card-element">
              <!-- A Stripe Element will be inserted here. -->
            </div>

              <!-- Used to display Element errors. -->
            <div id="card-errors" role="alert"></div>
          </div>

          <button v-if="!isLoading" class="btn btn-success btn-block">Submit Payment</button>
          <button v-else class="btn btn-default btn-block"><i class="fa fa-spinner fa-pulse"></i></button>
        </form>
    </span>
</template>

<script>
    import axios from 'axios'
    import swal from 'sweetalert2'
    export default {
        props:['info'],
        data(){
            return {
                isLoading:false,
                stripe: Stripe('pk_test_Y76tdFx8EtjbaE4sStat4AMY'),
                elements: {},
                style: {
                    base: {
                        color: '#32325d',
                        lineHeight: '18px',
                        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                        fontSmoothing: 'antialiased',
                        fontSize: '16px',
                        '::placeholder': {
                            color: '#aab7c4'
                        }
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                },
                card:{},
                form:{}
            }
        },
        methods:{
            createToken(event){
                this.stripe.createToken(this.card).then((result) => {
                    if (result.error) {
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // console.log(result.token)
                        this.stripeTokenHandler(result.token);
                    }
                });
            },
            stripeTokenHandler(token) {
                this.isLoading = true
                axios.post('/napi/subscribe',{
                    'token': token.id,
                    'user': this.info.company.user[0].id,
                    'plan': this.info.plan
                }).then((response)=>{
                    this.isLoading = false
                    if(response.data.id){
                        swal('Success','Thanks for your payment','success').then(()=>{
                            this.info.currentStep += 1;
                        })
                    }
                }).catch((errors)=>{
                    console.log(errors.response.data)
                })
            }
        },
        mounted(){
            this.elements = this.stripe.elements()
            this.card = this.elements.create('card', {style: this.style})
            this.card.mount('#card-element');

            this.card.addEventListener('change', (event) => {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            this.form = document.getElementById('payment-form')
        }
    }
</script>

<style scoped>
    .StripeElement {
        background-color: white;
        height: 40px;
        padding: 10px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
</style>















