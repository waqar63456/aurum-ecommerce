<template>
    <main>
      <!-- Slider Area Start -->
      <div class="slider-area">
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/category.jpg">
          <div class="container">
            <div class="row">
              <div class="col-xl-12">
                <div class="hero-cap text-center">
                  <h2>Product Categories</h2>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Slider Area End -->
  
      <!-- Categories Display -->
      <div class="container my-5">
        <h2 class="text-2xl font-bold mb-4 text-center">Categories</h2>
        <div class="d-flex flex-wrap justify-content-start" style="gap: 10px;">
          <div
            v-for="category in categories"
            :key="category.id"
            class="category-card text-center p-3 border rounded shadow-sm"
          >
            <a href="#" class="category-link">
              <img
                :src="getCategoryImageUrl(category.image)"
                alt="Category Image"
                class="category-img mb-2"
              />
              <p class="text-lg font-semibold mb-0">{{ category.name }}</p>
            </a>
          </div>
        </div>
      </div>
  
      <!-- Add your other product sections below -->
    </main>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    name: 'Categories',
    data() {
      return {
        categories: []
      };
    },
    mounted() {
      this.fetchCategories();
    },
    methods: {
      fetchCategories() {
        axios.get('http://127.0.0.1:8000/api/categories')
          .then(response => {
            this.categories = response.data;
          })
          .catch(error => {
            console.error("Error fetching categories:", error);
          });
      },
      getCategoryImageUrl(imagePath) {
        return `/storage/${imagePath}`;
      }
    }
  }
  </script>
  
  <style scoped>
  .category-img {
    width: 70px;
    height: 70px;
    object-fit: cover;
    border-radius: 8px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  
  .category-link:hover .category-img {
    transform: scale(1.1);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
  }
  
  .category-card {
    border-radius: 10px;
    transition: transform 0.2s;
  }
  
  .category-card:hover {
    transform: translateY(-3px);
  }
  </style>
  