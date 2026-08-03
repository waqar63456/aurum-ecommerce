<template>
  <div class="container my-5" v-if="product">
    <h2 class="text-2xl font-bold mb-4">{{ product.name }}</h2>
    <img
      :src="getProductImageUrl(product.image)"
      alt="Product Image"
      class="img-fluid mb-4"
      style="width: 300px; height: 300px; object-fit: cover;"
    />
    <p class="mb-2"><strong>Description:</strong> {{ product.description }}</p>
    <p class="mb-2"><strong>Price:</strong> Rs {{ product.price }}</p>
    <p class="mb-2"><strong>Category:</strong> {{ product.category?.name || 'Uncategorized' }}</p>
  </div>
  <div v-else>
  <!-- <div v-else> -->

    <p>Loading product...</p>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  name: 'ProductDetail',
  data() {
    return {
      product: null
    };
  },
  mounted() {
    this.fetchProduct();
  },
  methods: {
    fetchProduct() {
      const productId = this.$route.params.id;
      axios.get(`http://127.0.0.1:8000/api/products/${productId}`)
        .then(response => {
          this.product = response.data;
        })
        .catch(error => {
          console.error("Error fetching product:", error);
        });
    },
    getProductImageUrl(imagePath) {
      return `/storage/${imagePath}`;
    }
  }
}
</script>

<style scoped>
/* Optional styling */
</style>
