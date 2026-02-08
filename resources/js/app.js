/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue'; // Root Vue component
import router from './components/routes.js'; // Import routes




// Import Vue Toastification and the CSS file
import Toast, { POSITION } from 'vue-toastification';
import 'vue-toastification/dist/index.css';
// Create Vue app instance and use the router
const app = createApp(App);


// Optional options for Toastification
const options = {
    position: POSITION.TOP_RIGHT,
  timeout: 3000,
  hideProgressBar: true,
  closeOnClick: true,
  pauseOnHover: true,
  draggable: true,
  draggablePercent: 0.6,
  showCloseButtonOnHover: true,
  closeButton: "button",
  icon: true,
  rtl: false,
  // Custom style for white background
  toastClassName: "custom-toast-white",
  };
  
  // Use the Toastification plugin in the app
  app.use(Toast, options);
// Use the router for navigation
app.use(router);

// Mount the Vue app to the HTML element with id 'app'

app.mount('#app');
