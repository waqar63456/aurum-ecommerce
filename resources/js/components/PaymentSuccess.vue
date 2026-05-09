<template>
  <div class="container mt-5">
    <div class="card">
      <div class="card-header bg-success text-white">
        <h3>Payment Successful!</h3>
      </div>
      <div class="card-body">
        <h5>Thank you for your purchase!</h5>
        <p>Your payment has been processed successfully.</p>
        <p>Order ID: {{ orderId }}</p>
        <p>Amount: ${{ amount }}</p>
        <button class="btn btn-primary" @click="continueShopping">Continue Shopping</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      orderId: this.$route.query.order_id || 'N/A',
      amount: this.$route.query.amount || '0.00'
    }
  },
  methods: {
    continueShopping() {
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>
.card {
  max-width: 500px;
  margin: 50px auto;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0,0,0,0.1);
}
.card-header {
  border-radius: 10px 10px 0 0;
  padding: 20px;
}
.btn-primary {
  background-color: #7fad39;
  border-color: #7fad39;
}
.btn-primary:hover {
  background-color: #6c9e2e;
  border-color: #6c9e2e;
}
</style>