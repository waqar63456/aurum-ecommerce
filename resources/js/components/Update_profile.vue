<template>
    <div class="profile-edit">
      <h2>Edit Profile</h2>
  
      <form @submit.prevent="updateProfile">
        <!-- Name Input -->
        <div class="form-group">
          <label for="name">Name</label>
          <input
            type="text"
            id="name"
            v-model="profile.name"
            class="form-control"
            placeholder="Enter your name"
            required
          />
        </div>
  
        <!-- Profile Image Upload -->
        <div class="form-group">
          <label for="profile_image">Profile Image</label>
          <input
            type="file"
            id="profile_image"
            class="form-control"
            @change="onFileChange"
            accept="image/*"
          />
          <!-- Show existing image if available -->
          <div v-if="previewImage || profile.existingImage">
            <h4>Preview:</h4>
            <img
              :src="previewImage || profile.existingImage"
              alt="Profile Preview"
              class="img-thumbnail"
            />
          </div>
        </div>
  
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Update Profile</button>
      </form>
  
      <!-- Success/Error Messages -->
      <div v-if="message" class="alert alert-success" v-html="message"></div>
      <div v-if="errorMessage" class="alert alert-danger" v-html="errorMessage"></div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        profile: {
          name: '',
          profile_image: null,
          existingImage: null, // Holds the URL of the current profile image
        },
        previewImage: null, // Holds the image preview of the uploaded file
        message: '',
        errorMessage: '',
      };
    },
    mounted() {
      this.fetchProfile();
    },
    methods: {
      // Fetch the current profile info
      fetchProfile() {
        axios
          .get('http://127.0.0.1:8000/api/customer/profile')
          .then((response) => {
            this.profile.name = response.data.customer.name;
            this.profile.existingImage = response.data.customer.profile_image; // Set the image URL
          })
          .catch((error) => {
            this.errorMessage = 'Error fetching profile data.';
          });
      },
      // Handle file input and show image preview
      onFileChange(e) {
        const file = e.target.files[0];
        this.profile.profile_image = file;
  
        if (file) {
          const reader = new FileReader();
          reader.onload = (e) => {
            this.previewImage = e.target.result;
          };
          reader.readAsDataURL(file);
        }
      },
      // Update the profile data
      updateProfile() {
        const formData = new FormData();
        formData.append('name', this.profile.name);
  
        if (this.profile.profile_image) {
          formData.append('profile_image', this.profile.profile_image);
        }
  
        axios
          .post('http://127.0.0.1:8000/api/customer/update-profile', formData, {
            headers: {
              'Content-Type': 'multipart/form-data',
            },
          })
          .then((response) => {
            this.message = response.data.message;
            this.errorMessage = '';
            if (response.data.customer.profile_image) {
              this.profile.existingImage = response.data.customer.profile_image;
              this.previewImage = null;
            }
          })
          .catch((error) => {
            this.errorMessage =
              error.response?.data?.message || 'Error updating profile.';
            this.message = '';
          });
      },
    },
  };
  </script>
  
  <style scoped>
  .profile-edit {
    max-width: 600px;
    margin: 0 auto;
  }
  
  .img-thumbnail {
    width: 100px;
    height: 100px;
    margin-top: 10px;
  }
  </style>
  