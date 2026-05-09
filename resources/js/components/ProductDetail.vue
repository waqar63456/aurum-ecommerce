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

        <!-- Quantity Selection -->
        <div class="mb-3">
          <label><strong>Quantity:</strong></label>
          <input 
            type="number" 
            v-model.number="quantity" 
            min="1" 
            max="10" 
            class="form-control w-auto mt-2"
            style="width: 100px;"
          />
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
import { useToast } from 'vue-toastification'

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
      selectedSize: '',
      quantity: 1
    }
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
      if (!this.validateSelection()) return
      
      // Get existing cart from localStorage
      let cart = localStorage.getItem('cart')
      cart = cart ? JSON.parse(cart) : []
      
      // Check if product already in cart
      const existingItem = cart.find(item => 
        item.id === this.product.id && 
        item.size === this.selectedSize && 
        JSON.stringify(item.colors) === JSON.stringify(this.selectedColors)
      )
      
      if (existingItem) {
        existingItem.quantity += this.quantity
      } else {
        cart.push({
          id: this.product.id,
          name: this.product.name,
          price: this.product.price,
          quantity: this.quantity,
          size: this.selectedSize,
          colors: this.selectedColors,
          image: this.product.image
        })
      }
      
      // Save to localStorage
      localStorage.setItem('cart', JSON.stringify(cart))
      
      // Show success message
      const toast = useToast()
      toast.success('✅ Product added to cart!')
    },
    
    buyNow() {
      if (!this.validateSelection()) return
      
      // Check if user is logged in
      const user = localStorage.getItem('user')
      
      if (!user) {
        // Save product data to sessionStorage for after login
        const productForCheckout = {
          id: this.product.id,
          name: this.product.name,
          price: this.product.price,
          quantity: this.quantity,
          size: this.selectedSize,
          colors: this.selectedColors,
          image: this.product.image,
          isBuyNow: true
        }
        sessionStorage.setItem('buyNowProduct', JSON.stringify(productForCheckout))
        
        // Show message and redirect to login
        const toast = useToast()
        toast.warning('⚠️ Please login to continue with checkout')
        
        // Redirect to login with return URL
        this.$router.push({
          path: '/login',
          query: { redirect: '/checkout' }
        })
      } else {
        // User is logged in, proceed to checkout
        this.proceedToCheckout()
      }
    },
    
    validateSelection() {
      if (!this.selectedSize) {
        const toast = useToast()
        toast.error('Please select a size')
        return false
      }
      
      if (this.selectedColors.length === 0) {
        const toast = useToast()
        toast.error('Please select at least one color')
        return false
      }
      
      if (this.quantity < 1) {
        const toast = useToast()
        toast.error('Quantity must be at least 1')
        return false
      }
      
      return true
    },
    
    proceedToCheckout() {
      // Prepare product for checkout
      const checkoutProduct = {
        id: this.product.id,
        name: this.product.name,
        price: this.product.price,
        quantity: this.quantity,
        size: this.selectedSize,
        colors: this.selectedColors,
        image: this.product.image
      }
      
      // Store in sessionStorage for checkout page
      sessionStorage.setItem('checkoutProduct', JSON.stringify(checkoutProduct))
      
      // Clear any existing buyNow flag
      sessionStorage.removeItem('buyNowProduct')
      
      // Navigate to checkout
      this.$router.push('/checkout')
    }
  },
  watch: {
    '$route.params.id': 'fetchProduct'
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

.form-control {
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 8px;
}

.d-flex {
  display: flex;
  gap: 10px;
}
</style>