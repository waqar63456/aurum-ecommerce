<template>
    <div class="container my-5" v-if="product">
      <div class="row">
        <!-- Product Image -->
        <div class="col-md-6 mb-4">
          <img
            :src="getProductImageUrl(product.image)"
            alt="Product Image"
            class="img-fluid"
            style="width: 100%; height: auto; object-fit: cover; border-radius: 10px;"
          />
        </div>
  
        <!-- Product Info -->
        <div class="col-md-6">
          <h2 class="text-3xl font-bold mb-3">{{ product.name }}</h2>
  
          <p class="mb-3"><strong>Description:</strong> {{ product.description }}</p>
          <p class="mb-2"><strong>Price:</strong> Rs {{ product.price }}</p>
          <p class="mb-2"><strong>Category:</strong> {{ product.category?.name || 'Uncategorized' }}</p>
  
          <!-- Static Color Options -->
          <div class="mb-3">
            <strong>Select Color:</strong><br />
            <label v-for="color in colors" :key="color.value" class="me-3">
              <input type="checkbox" :value="color.value" v-model="selectedColors" />
              <span :style="{ backgroundColor: color.value, padding: '5px 10px', borderRadius: '5px', color: '#fff' }">
                {{ color.label }}
              </span>
            </label>
          </div>
  
          <!-- Size Selection -->
          <div class="mb-3">
            <label><strong>Select Size:</strong></label>
            <select v-model="selectedSize" class="form-select w-auto mt-2">
              <option disabled value="">Select size</option>
              <option v-for="size in sizes" :key="size" :value="size">{{ size }}</option>
            </select>
          </div>
  
          <!-- Buttons -->
          <div class="mt-4 d-flex gap-3">
            <button class="button1" @click="addToCart">🛒 Add to Cart</button>
            <button class="button" @click="buyNow">⚡ Buy Now</button>
          </div>
        </div>
      </div>
    </div>
  
    <div v-else>
      <p>Loading product...</p>
    </div>
  </template>
  
  <script>
  import axios from 'axios'
  
  export default {
    name: 'ProductDetail',
    data() {
      return {
        product: null,
        colors: [
          { label: 'Red', value: 'red' },
          { label: 'Blue', value: 'blue' },
          { label: 'Black', value: 'black' },
          { label: 'Green', value: 'green' }
        ],
        selectedColors: [],
        sizes: ['S', 'M', 'L', 'XL', 'XXL'],
        selectedSize: ''
      }
    },
    watch: {
      '$route.params.id': 'fetchProduct'
    },
    mounted() {
      this.fetchProduct()
    },
    methods: {
      fetchProduct() {
        const id = this.$route.params.id
        axios.get(`http://127.0.0.1:8000/api/products/${id}`)
          .then(res => {
            this.product = res.data
          })
          .catch(err => {
            console.error("Error:", err)
          })
      },
      getProductImageUrl(image) {
        return `/storage/${image}`
      },
      addToCart() {
        if (!this.selectedSize) {
          alert("Please select a size.")
          return
        }
        alert(`Added ${this.product.name} (Size: ${this.selectedSize}, Color: ${this.selectedColors.join(', ')}) to cart!`)
      },
      buyNow() {
        if (!this.selectedSize) {
          alert("Please select a size.")
          return
        }
        alert(`Proceeding to buy ${this.product.name} (Size: ${this.selectedSize}, Color: ${this.selectedColors.join(', ')})!`)
      }
    }
  }
  </script>
  
  <style scoped>
  .button1 {
    background-color: rgb(107, 43, 107);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    transition: background-color 0.3s ease;
  }
  .button1:hover {
    background-color: rgb(56, 4, 56);
    border-radius: 15px;
  }
  
  .button {
    background-color: rgb(107, 43, 107);
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 10px;
    font-weight: bold;
    transition: background-color 0.3s ease;
    margin-left: 15px;
  }
  .button:hover {
    background-color: rgb(56, 4, 56);
    border-radius: 15px;
  }
  </style>
  