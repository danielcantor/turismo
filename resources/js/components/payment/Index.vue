<template>
    <div>
        <h1>Payment Status: {{ paymentStatus }}</h1>
        <div v-if="paymentStatus === 'pending'">
            <p>Your payment is currently pending. Please wait a few moments and refresh the page to check the status again.</p>
        </div>
        <div v-else-if="paymentStatus === 'failure'">
            <p>Sorry, your payment was not successful. Please try again or contact customer support for assistance.</p>
        </div>
        <div v-else-if="paymentStatus === 'success'">
            <p>Thank you for your payment! Your transaction was successful.</p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            paymentStatus: 'pending' // Set the initial payment status to 'pending'
        }
    },
    // You can update the payment status based on the response from the payment API
    methods: {
        updatePaymentStatus(response) {
            if (response.status === 'success') {
                this.paymentStatus = 'success';
            } else {
                this.paymentStatus = 'failure';
            }
        }
    }
}
</script>
