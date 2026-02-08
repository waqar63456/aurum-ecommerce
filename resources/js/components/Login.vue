<template>
  <div class="login-form">
    <form @submit.prevent="login">
      <h2>Login</h2>

      <!-- Email Input -->
      <div>
        <label for="email">Email:</label>
        <input type="email" v-model="email" required />
      </div>

      <!-- Password Input -->
      <div>
        <label for="password">Password:</label>
        <input type="password" v-model="password" required />
      </div>

      <!-- Submit Button -->
      <div>
        <button type="submit" :disabled="loading">Login</button>
      </div>

      <!-- Forgot Password Link -->
      <div class="forgot-password-link">
        <router-link to="/forgot-password">Forgot Password?</router-link>
      </div>

      <!-- Error Message Display -->
      <p v-if="error" class="error-message">{{ error }}</p>
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import { useToast } from 'vue-toastification'; // Import useToast

export default {
  data() {
    return {
      email: '',
      password: '',
      loading: false,
      error: null,
    };
  },
  methods: {
    async login() {
      this.loading = true;
      this.error = null;
      const toast = useToast(); // Initialize toast

      try {
        // Send the login request to the backend
        const response = await axios.post('http://127.0.0.1:8000/api/customer/login', {
          email: this.email,
          password: this.password,
        });

        // Check if the login was successful
        if (response.data.user) {
          // Store user data in localStorage
          const userData = {
            name: response.data.user.name,
            email: response.data.user.email,
            profile_image: response.data.user.profile_image, // Assuming the image URL is returned
            other_details: response.data.user.other_details, // Add other user details if necessary
          };
          localStorage.setItem('user', JSON.stringify(userData));

          // Redirect to the home page
          this.$router.push('/');

          // Show success toast
          toast.success('✅ Login successful!');
        } else {
          // Show error toast for invalid credentials
          toast.error('🚨️Invalid credentials');
        }
      } catch (error) {
        // Show error toast for login failure
        toast.error(' Login failed. Invalid credentials.');
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
/* Styling for the login form */
.login-form {
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

.forgot-password-link {
  text-align: center;
  margin-top: 10px;
}

.forgot-password-link a {
  color: #764a71;
  text-decoration: none;
  font-weight: bold;
}

.forgot-password-link a:hover {
  text-decoration: underline;
}

.error-message {
  color: red;
  text-align: center;
}

/* Transition for the entering state */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter,
.fade-leave-to {
  opacity: 0;
}

.fade-leave-active {
  opacity: 1;
}

.custom-toast-white {
  background-color: #ffffff !important;
  color: #191818 !important;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1) !important;
  border: 1px solid #ddd !important;
}
</style>
