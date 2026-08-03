import { createRouter, createWebHistory } from 'vue-router';

// Import your components
import Home from './Home.vue';
import Register from './Register.vue';
import Login from './Login.vue';
import About from './About.vue';
import Blog from './Blog.vue';
import Cart from './Cart.vue';
import Category from './Category.vue';
import Checkout from './Checkout.vue';
import Confirmation from './Confirmation.vue';
import Contact from './Contact.vue';
import Elements from './Elements.vue';
import Main from './Main.vue';
import Product_list from './Product_list.vue';
import Single_blog from './Single_blog.vue';
import Single_product from './Single_product.vue';
import Otp_form from './Otp_form.vue';
import User_profile from './User_profile.vue';
import Update_profile from './Update_profile.vue';
import Forgot_Password from './Forgot_Password.vue';
import Verify_OTP from './Verify_OTP.vue';
import Reset_new_password from './Reset_new_password.vue';
import ProductDetail from './ProductDetail.vue';
import PaymentSuccess from './PaymentSuccess.vue';
// import PaymentSuccess from './PaymentSuccess.vue';




// Define your routes
const routes = [
    
    {
        path: '/',
        name: 'home',
        component: Home,

    },
    {
        path: '/login',
        name: 'login',
        component: Login,
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
    },
    {
        path: '/about',
        name: 'about',
        component: About,
    },
    {
        path: '/blog',
        name: 'blog',
        component: Blog,
    },
    {
        path: '/cart',
        name: 'cart',
        component: Cart,
    },
    {
        path: '/category',
        name: 'category',
        component: Category,
    },
    {
        path: '/payment_success',
        name: 'PaymentSuccess',
        component: PaymentSuccess,
    },
    {
        path: '/checkout',
        name: 'checkout',
        component: Checkout,
    },
    {
        path: '/confirmation',
        name: 'confirmation',
        component: Confirmation,
    },
    {
        path: '/contact',
        name: 'contact',
        component: Contact,
    },
    {
        path: '/elements',
        name: 'elements',
        component: Elements,
    },
    {
        path: '/main',
        name: 'main',
        component: Main,
    },
    {
        path: '/product_list',
        name: 'product_list',
        component: Product_list,
    },
    {
        path: '/single_blog',
        name: 'single_blog',
        component: Single_blog,
    },
    {
        path: '/single_product',
        name: 'single_product',
        component: Single_product,
    },
    {
        path: '/otp_form',
        name: 'otp_form',
        component: Otp_form,
    },
    {
        path: '/user_profile',
        name: 'user_profile',
        component: User_profile,
    },
    {
        path: '/update_profile',
        name: 'update_profile',
        component: Update_profile,
    },
    {
        path: '/forgot-password',
        name: 'forgot',
        component: Forgot_Password,
    },
    {
        path: '/reset_verify_otp',
        name: 'reset_verify_otp',
        component: Verify_OTP,
    },
    {
        path: '/reset_new_password',
        name: 'reset_new_password',
        component: Reset_new_password,
    },
    {
        path: '/product_detail/:id',
        name: 'product_detail',
        component: ProductDetail,
    },
];

// Create and export the router
const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;


// In your routes.js, add navigation guard
router.beforeEach((to, from, next) => {
    const user = localStorage.getItem('user');
    
    // Check if route requires authentication
    if (to.path === '/checkout' && !user) {
        // Redirect to login with return URL
        next({
            path: '/login',
            query: { redirect: '/checkout' }
        });
    } else {
        next();
    }
});