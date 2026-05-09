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
import { useToast } from 'vue-toastification';

export default {
  data() {
    return {
      email: '',
      password: '',
      loading: false,
      error: null,
      redirectPath: null
    };
  },
  mounted() {
    // Get redirect path from query params
    this.redirectPath = this.$route.query.redirect || '/';
  },
  methods: {
    async login() {
      this.loading = true;
      this.error = null;
      const toast = useToast();

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
            id: response.data.user.id,
            name: response.data.user.name,
            email: response.data.user.email,
            profile_image: response.data.user.profile_image,
          };
          localStorage.setItem('user', JSON.stringify(userData));

          // Check if there's a buyNow product in sessionStorage
          const buyNowProduct = sessionStorage.getItem('buyNowProduct');
          
          if (buyNowProduct) {
            // Clear the buyNow product
            sessionStorage.removeItem('buyNowProduct');
            
            // Parse and add to cart
            const product = JSON.parse(buyNowProduct);
            let cart = localStorage.getItem('cart');
            cart = cart ? JSON.parse(cart) : [];
            
            cart.push({
              id: product.id,
              name: product.name,
              price: product.price,
              quantity: product.quantity,
              size: product.size,
              colors: product.colors,
              image: product.image
            });
            
            localStorage.setItem('cart', JSON.stringify(cart));
            
            // Redirect to checkout
            toast.success('✅ Login successful! Redirecting to checkout...');
            setTimeout(() => {
              this.$router.push('/checkout');
            }, 1000);
          } else {
            // Normal login, redirect to home or previous page
            toast.success('✅ Login successful!');
            this.$router.push(this.redirectPath);
          }
        } else {
          toast.error('🚨 Invalid credentials');
        }
      } catch (error) {
        toast.error('Login failed. Invalid credentials.');
        this.error = 'Login failed. Please check your credentials.';
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
</style>