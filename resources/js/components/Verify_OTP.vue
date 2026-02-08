<template>
    <div class="verify-otp-form">
      <form @submit.prevent="verifyOTP">
        <h2>Verify OTP</h2>
  <div class="text"><strong>Enter Email and OTP for Verification</strong></div>
        <!-- Email Input -->
        <div>
          <label for="email"></label>
          <input type="email" v-model="email" placeholder="Enter Email" required />
        </div>
  
        <!-- OTP Input -->
        <div>
          <label for="otp"></label>
          <input type="text" v-model="otp" placeholder="Enter OTP" required />
        </div>
  
        <!-- Submit Button -->
        <div>
          <button type="submit" :disabled="loading">Verify OTP</button>
        </div>
  
        <!-- Error Message Display -->
        <p v-if="error" class="error-message">{{ error }}</p>
        <!-- Success Message Display -->
        <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        email: '',
        otp: '',
        loading: false,
        error: null,
        successMessage: null,
      };
    },
    methods: {
      async verifyOTP() {
        this.loading = true;
        this.error = null;
        this.successMessage = null;
  
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/verify-otp', {
            email: this.email,
            otp: this.otp,
          });
  
          // Handle successful OTP verification
          this.successMessage = alert("✅OTP verified successfully! Proceed to reset your password.");
          this.$router.push('/reset_new_password'); // Redirect to reset password page
        } catch (error) {
          // Handle error response
          this.error = alert("❌Invalid OTP or email.");
        } finally {
          this.loading = false;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Styling for the verify OTP form */
  .verify-otp-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  
  h2 {
    text-align: center;
    margin-bottom: 20px;
  }
  
  label {
    display: block;
    margin-bottom: 5px;
  }
  
  input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
  }
  
  button {
    width: 100%;
    padding: 10px;
    background-color: #764a71;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }
  
  button:disabled {
    background-color: #ccc;
  }
  
  .error-message {
    color: red;
    text-align: center;
  }
  
  .success-message {
    color: green;
    text-align: center;
  }
  .text{
    justify-content: center;
    color: #764a71;
    text-align: center;
    margin: 25px;
  }
  </style>
  