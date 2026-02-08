<template>
  <div class="user-profile-card">
    <div class="profile-card" v-if="user">
      <img :src="`images/profiles/${user.profile_image}`" :alt="`images/profiles${profileImage}`" class="profile-image" />
      <h2>{{ user.name }}</h2>
      <p>Email: {{ user.email }}</p>

      <!-- Logout button -->
      <button @click="logout" class="logout-button">Logout</button><br>
      <button @click="edit" class="edit-button">Edit</button>

    </div>
    <div v-else>
      <p>Loading...</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: null,
    };
  },
  computed: {
    profileImage() {
      return this.user && this.user.profile_image
        ? this.user.profile_image // Assuming the profile image is stored in localStorage
        : '/images/default-profile.png'; // Fallback image
    },
  },
  created() {
    this.loadUserProfile();
  },
  methods: {
    loadUserProfile() {
      const userData = localStorage.getItem('user');
      if (userData) {
        this.user = JSON.parse(userData);
      } else {
        this.$router.push('/login');
      }
    },
    logout() {
      // Clear user data from localStorage
      localStorage.removeItem('user');
      this.$router.push('/login');
    },
    edit() {
      // Clear user data from localStorage
      
      this.$router.push('/update_profile');
    },
  },
};
</script>

<style scoped>
/* Styling similar to what was used previously */
.user-profile-card {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f5f5f5;
}

.profile-card {
  width: 300px;
  padding: 20px;
  background-color: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  text-align: center;
}

.profile-image {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 15px;
}

.logout-button {
  background-color: #764a71;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
.edit-button {
  background-color: #764a71;
  color: #fff;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 5px;
}
</style>
