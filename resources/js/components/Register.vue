<template>
  <!-- slider Area Start-->
  <div class="slider-area">
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/category.jpg">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="hero-cap text-center">
              <h2>Register</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- slider Area End-->

  <!-- Register Form Area Start -->
  <section class="login_part section_padding">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 col-md-6">
          <div class="login_part_text text-center">
            <div class="login_part_text_iner">
              <h2>Welcome to our Shop!</h2>
              <p>Join us and enjoy a personalized shopping experience with the latest products and offers!</p>
              <a href="/login" class="btn_3">Already have an account? Log in</a>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="login_part_form">
            <div class="login_part_form_iner">
              <h3 class="text-center">Register Yourself</h3>
              <form class="row contact_form" @submit.prevent="register" novalidate="novalidate">
                <div class="col-md-12 form-group p_star">
                  <input type="text" class="form-control" v-model="name" placeholder="Name" />
                  <small v-if="errors.name" class="text-danger">{{ errors.name }}</small>
                </div>

                <div class="col-md-12 form-group p_star">
                  <input type="email" class="form-control" v-model="email" placeholder="Email" />
                  <small v-if="errors.email" class="text-danger">{{ errors.email }}</small>
                </div>

                <div class="col-md-12 form-group p_star">
                  <input type="password" class="form-control" v-model="password" placeholder="Password" />
                  <small v-if="errors.password" class="text-danger">{{ errors.password }}</small>
                </div>

                <div class="col-md-12 form-group p_star">
                  <input type="password" class="form-control" v-model="password_confirmation" placeholder="Confirm Password" />
                  <small v-if="errors.password_confirmation" class="text-danger">{{ errors.password_confirmation }}</small>
                </div>

                <div class="col-md-12 form-group p_star">
                  <input type="file" class="form-control" @change="onFileChange" accept="image/*" />
                  <small v-if="errors.profile_image" class="text-danger">{{ errors.profile_image }}</small>
                </div>

                <div class="col-md-12 form-group">
                  <button type="submit" class="btn_3" :disabled="loading">
                    <span v-if="loading">Registering...</span>
                    <span v-else>Register</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Register Form Area End -->
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
      profile_image: null,
      loading: false,
      errors: {},
    };
  },
  methods: {
    onFileChange(event) {
      this.profile_image = event.target.files[0];
    },
    async register() {
      this.loading = true;
      this.errors = {}; // Clear previous errors

      try {
        let formData = new FormData();
        formData.append('name', this.name);
        formData.append('email', this.email);
        formData.append('password', this.password);
        formData.append('password_confirmation', this.password_confirmation);
        if (this.profile_image) {
          formData.append('profile_image', this.profile_image);
        }

        const response = await axios.post('http://127.0.0.1:8000/api/customer/register', formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
          },
        });

        // Save user data to localStorage
        const userData = {
          name: this.name,
          email: this.email,
          profile_image: response.data.customer.profile_image,
        };
        localStorage.setItem('user', JSON.stringify(userData));

        alert('✅ Registration successful! Check your email for the OTP.');
        this.$router.push('/otp_form');
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors; // Assign errors if validation fails
        } else {
          alert('❌ Registration failed. Please try again later.');
        }
      } finally {
        this.loading = false;
      }
    },
  },
};
</script>

<style scoped>
/* Style similar to login form */
.slider-area {
  background: url('assets/img/hero/category.jpg') no-repeat center center;
  background-size: cover;
  height: 500px;
}
.section_padding {
  padding: 60px 0;
}
.login_part_form {
  background-color: #f7f7f7;
  padding: 40px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.btn_3 {
  background-color: #61426c;
  color: white;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}
.btn_3:disabled {
  background-color: #ccc;
}
.text-danger {
  color: red;
}
</style>
