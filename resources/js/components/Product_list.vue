<template>
  <div>
    <!-- Slider Area Start (Optional Hero) -->
    <div class="slider-area">
      <div class="single-slider slider-height2 d-flex align-items-center"
        data-background="assets/img/hero/category.jpg">
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

    <!-- Categories Display -->
    <div class="container my-5">
      <h2 class="text-2xl font-bold mb-4 text-center">Categories</h2>
      <div class="d-flex flex-wrap justify-content-start" style="gap: 10px;">
        <!-- All Category -->
        <div class="category-card text-center p-3 border rounded shadow-sm" @click="filterProductsByCategory(null)">
          <a href="#" class="category-link ">

            <p class="text-lg font-semibold mb-0 ">All</p>
          </a>
        </div>
        <!-- Loop Through Categories -->
        <div v-for="category in categories" :key="category.id"
          class="category-card text-center p-3 border rounded shadow-sm" @click="filterProductsByCategory(category.id)">
          <a href="#" class="category-link">
            <img :src="getCategoryImageUrl(category.image)" alt="Category Image" class="category-img mb-2" />
            <p class="text-lg font-semibold mb-0">{{ category.name }}</p>
          </a>
        </div>
      </div>
    </div>

    <!-- Product List -->
    <section class="container px-6">
      <div class="hero-cap text-center my-6">
        <h2 class="text-3xl font-bold uppercase">Product List</h2>
      </div>

      <h2 class="text-2xl font-bold mb-4">Products</h2>

      <div v-if="loading" class="text-center text-lg font-semibold text-primary">
        Loading...
      </div>

      <div v-else class="container row g-4 ">
        <div v-for="product in filteredProducts" :key="product.id" class="col-12 col-sm-6 col-md-4 col-lg-3 mt-4 ">
          <router-link :to="'/product_detail/' + product.id" class="text-decoration-none text-dark">
            <div class="card shadow-sm">
              <img :src="`/storage/${product.image}`" alt="Product Image" class="card-img-top img-fluid mt-0"
                style="width: 260px; height: 260px; object-fit: cover;" />
              <div class="card-body ">
                <h5 class="card-title">{{ product.name }}</h5>
                <p class="card-text">{{ product.description }}</p>
                <p class=" font-weight-bold" style="color:#764a78 ;">PKR {{ product.price }}</p>
                <p class="text-muted">Category: {{ product.category?.name || 'Uncategorized' }}</p>
              </div>
              <div class="card-footer text-center ">
                <button style="background-color:#764a78; padding: 5px; border-radius: 8px;" class="cart shadow">🛒Add to
                  Cart</button>
              </div>
            </div>
          </router-link>
        </div>
      </div>
    </section>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const categories = ref([])
const products = ref([])
const filteredProducts = ref([])
const loading = ref(true)

// Fetch Categories
const fetchCategories = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/categories')
    categories.value = response.data
  } catch (error) {
    console.error("Error fetching categories:", error)
  }
}

// Fetch Products
const fetchProducts = async () => {
  try {
    const response = await axios.get('http://127.0.0.1:8000/api/products')
    products.value = response.data
    filteredProducts.value = products.value // Initially show all products
  } catch (error) {
    console.error('Error fetching products:', error)
  } finally {
    loading.value = false
  }
}

// Filter Products by Category
const filterProductsByCategory = (categoryId) => {
  if (categoryId) {
    filteredProducts.value = products.value.filter(product => product.category.id === categoryId)
  } else {
    filteredProducts.value = products.value // Show all products if "All" is selected
  }
}

// Utility for category images
const getCategoryImageUrl = (imagePath) => {
  return `/storage/${imagePath}`
}

onMounted(() => {
  fetchCategories()
  fetchProducts()
})
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
  cursor: pointer;
}

.category-card:hover {
  transform: translateY(-3px);
}

.cart:hover {
  background-color: rgb(144, 142, 157);
  color: rgb(38, 56, 32);
}
</style>
