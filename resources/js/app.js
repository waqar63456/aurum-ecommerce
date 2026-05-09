/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import router from './components/routes.js';
import Toast, { POSITION } from 'vue-toastification';
import 'vue-toastification/dist/index.css';
import axios from 'axios';

// Configure axios for session authentication
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.withCredentials = true;  // Important for session cookies
window.axios.defaults.withXSRFToken = true;

// Get CSRF token from meta tag
const token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
}

// Set base URL if needed
window.axios.defaults.baseURL = 'http://127.0.0.1:8000';

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
    toastClassName: "custom-toast-white",
};

// Use the Toastification plugin in the app
app.use(Toast, options);
app.use(router);

app.mount('#app');