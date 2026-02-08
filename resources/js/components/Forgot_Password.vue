<template>
    <div class="forgot-password-form">
      <form @submit.prevent="requestOTP">
        <h2>Forgot Password</h2>
  
        <!-- Email Input -->
         <div class="text"><strong>Please Enter the Email for OTP </strong></div>
        <div>
          <label for="email"></label>
          <input type="email" name="email" v-model="email" placeholder="Enter Email" required />
        </div>
  
        <!-- Submit Button -->
        <div>
          <button type="submit" :disabled="loading">Request OTP</button>
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
        loading: false,
        error: null,
        successMessage: null,
      };
    },
    methods: {
      async requestOTP() {
        this.loading = true;
        this.error = null;
        this.successMessage = null;
  
        try {
          const response = await axios.post('http://127.0.0.1:8000/api/forgot-password', {
            email: this.email,
          });
  
          // Handle successful response
          this.successMessage = alert("✅OTP sent successfully to your email!");
          this.$router.push('/reset_verify_otp'); 
        } catch (error) {
          // Handle error response
          this.error = alert("❌Error sending OTP. Please check the email address.");
        } finally {
          this.loading = false;
        }
      },
    },
  };
  </script>
  
  <style scoped>
  /* Styling for the forgot password form */
  .forgot-password-form {
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
  .text {
    justify-content: center;
    color: #764a71;
    text-align: center;
    margin: 25px;
   
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
  </style>
  