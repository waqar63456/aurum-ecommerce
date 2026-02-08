<template>
  <div class="reset-password-form">
    <form @submit.prevent="resetPassword">
      <h2>Reset Password</h2>

      <!-- Email Input -->
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>

      <!-- Password Input -->
      <div>
        <label for="password">New Password:</label>
        <input type="password" v-model="password" required />
      </div>

      <!-- Confirm Password Input -->
      <div>
        <label for="password_confirmation">Confirm Password:</label>
        <input type="password" v-model="password_confirmation" required />
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" :disabled="loading">Reset Password</button>
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
      password: '',
      password_confirmation: '',
      loading: false,
      error: null,
      successMessage: null,
    };
  },
  methods: {
    async resetPassword() {
      this.loading = true;
      this.error = null;
      this.successMessage = null;

      try {
        const response = await axios.post('http://127.0.0.1:8000/api/reset-password', {
          email: this.email,
          password: this.password,
          password_confirmation: this.password_confirmation,
        });

        // Handle successful password reset
        this.successMessage = alert("✅Password reset successfully!Now Login with New Password.");
        this.$router.push('/user_profile'); // Redirect to login page
      } catch (error) {
        // Handle error response
        this.error = alert("❌Error resetting password. Please try again.");
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
/* Styling for the reset password form */
.reset-password-form {
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
</style>
