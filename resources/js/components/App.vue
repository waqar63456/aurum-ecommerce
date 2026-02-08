<template>
    <!-- Preloader Start -->
    <div id="preloader-active" v-if="isLoading">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/a_logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader End -->

    <header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header">

            <!-- Desktop Header -->
            <div class="header-top top-bg d-none d-lg-block">
                <div class="container-fluid">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="header-info-left d-flex align-items-center">
                            <div class="flag">
                                <img src="assets/img/icon/header_icon.png" alt="">
                            </div>
                            <div class="select-this ml-3">
                                <form action="#">
                                    <div class="select-items">
                                        <select name="select" id="select4">
                                            <option value="1">USA</option>
                                            <option value="2">SPN</option>
                                            <option value="3">CDA</option>
                                            <option value="4">USD</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <ul class="contact-now ml-4">
                                <li>+777 2345 7886</li>
                            </ul>
                        </div>
                        <div class="header-info-right">
                            <ul class="d-flex justify-content-center">
                                <li class="mx-2"><a href="/user_profile">My Account</a></li>
                                <li class="mx-2"><a href="/product_list">Wish List</a></li>
                                <li class="mx-2"><a href="/cart">Shopping</a></li>
                                <li class="mx-2"><a href="/cart">Cart</a></li>
                                <li class="mx-2"><a href="/checkout">Checkout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="header-bottom header-sticky shadow d-none d-lg-block">
                <div class="container-fluid">
                    <div class="row align-items-center d-flex justify-content-between">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-2 col-sm-4 ">
                            <div class="logo">
                                <a href="/"><img src="assets/img/logo/a_logo.png" alt="" class="logo"></a>
                            </div>
                        </div>

                        <!-- Main-menu -->
                        <div class="col-xl-6 col-lg-7 col-md-6 col-sm-5">
                            <div class="main-menu">
                                <nav>
                                    <ul id="navigation" class="d-flex justify-content-around">
                                        <li><a href="/">Home</a></li>
                                        <li><a href="/category">Category</a></li>
                                        <li class="hot"><a href="/product_list">Products</a>
                                            <ul class="submenu">
                                                <li><a href="/product_list">Product list</a></li>
                                                <li><a href="/single-product">Product Details</a></li>
                                                <li><a href="/main">Main</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="/blog">Blog</a>
                                            <ul class="submenu">
                                                <li><a href="#">Blog</a></li>
                                                <li><a href="/single-blog">Blog Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="#">Pages</a>
                                            <ul class="submenu">
                                                <li><a href="/login">Login</a></li>
                                                <li><a href="/main">Main</a></li>
                                                <li><a href="/elements">Element</a></li>
                                                <li><a href="/about">About</a></li>
                                                <li><a href="/confirmation">Confirmation</a></li>
                                                <li><a href="/checkout">Checkout</a></li>
                                                <li><a href="/contact">Contact</a></li>
                                                <li><a href="/product_list">Product List</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                        <!-- Right side -->
                        <div class="col-xl-4 col-lg-3 col-md-4 col-sm-3 d-flex justify-content-end align-items-center">
                            <ul class="header-right  align-items-center" style="gap: 10px;">
                                <!-- Search -->
                                <li class="d-none d-xl-block">
                                    <div class="form-box d-flex align-items-center">
                                        <input type="text" name="Search" placeholder="Search" style="width: 180px;">
                                        <i class="fas fa-search special-tag" style="margin-left: -30px; cursor: pointer;"></i>
                                    </div>
                                </li>

                                <!-- Cart -->
                                <li>
                                    <div class="shopping-card">
                                        <a href="/cart"><i class="fas fa-shopping-cart" style="margin-right: -30px;"></i></a>
                                    </div>
                                </li>

                                <!-- Register Button -->
                                <li class="d-none d-lg-block">
                                    <a href="/register" class="btn header-btn"
                                        style="background-color: #9a6a94; padding: 5px 5px; font-size: 15px;">Sign up</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mobile Header -->
            <div class="mobile-header d-block d-lg-none py-2 px-3 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Logo -->
                    <a href="/" class="mobile-logo">
                        <img src="assets/img/logo/a_logo.png" alt="Logo" style="height: 40px;">
                    </a>

                    <!-- My Account -->
                    <a href="/user_profile" class="text-dark">
                        <i class="fas fa-user fa-lg"></i>
                    </a>

                    <!-- Cart -->
                    <a href="/cart" class="text-dark">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                    </a>

                   <!-- Hamburger Button (Vue method) -->
<button class="hamburger-toggle bg-transparent border-0" @click="toggleMobileMenu">
    <i class="fas fa-bars fa-lg"></i>
</button>
                </div>

                <!-- Mobile Menu (Vue conditional rendering) -->
<div class="mobile-links mt-2" v-show="showMobileMenu">
                    <ul class="list-unstyled m-0 p-0">
                        <li><a href="/">Home</a></li>
                        <li><a href="/category">Category</a></li>
                        <li><a href="/product_list">Products</a></li>
                        <li><a href="/single-product">Product Details</a></li>
                        <li><a href="/blog">Blog</a></li>
                        <li><a href="/single-blog">Blog Details</a></li>
                        <li><a href="/login">Login</a></li>
                        <li><a href="/register">Sign Up</a></li>
                        <li><a href="/checkout">Checkout</a></li>
                        <li><a href="/contact">Contact</a></li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <!-- Header End -->
</header>



    <!-- Vue Router view to display the respective component -->
    <router-view></router-view>



    <footer>

        <!-- Footer Start-->
        <div class="footer-area footer-padding">
            <div class="container">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-6">
                        <div class="single-footer-caption mb-50">
                            <div class="single-footer-caption mb-30">
                                <!-- logo -->
                                <div class="footer-logo">
                                    <a href="/"><img src="assets/img/logo/a_logo.png" alt="" class="flogo"></a>
                                </div>
                                <div class="footer-tittle">
                                    <div class="footer-pera">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit sed do eiusmod
                                            tempor incididunt ut labore.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-3 col-md-3 col-sm-5">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Quick Links</h4>
                                <ul>
                                    <li><a href="/about">About</a></li>
                                    <li><a href="#"> Offers & Discounts</a></li>
                                    <li><a href="#"> Get Coupon</a></li>
                                    <li><a href="/contact"> Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-4 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>New Products</h4>
                                <ul>
                                    <li><a href="#">Woman Cloth</a></li>
                                    <li><a href="#">Fashion Accessories</a></li>
                                    <li><a href="#"> Man Accessories</a></li>
                                    <li><a href="#"> Rubber made Toys</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-5 col-sm-7">
                        <div class="single-footer-caption mb-50">
                            <div class="footer-tittle">
                                <h4>Support</h4>
                                <ul>
                                    <li><a href="#">Frequently Asked Questions</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                    <li><a href="#">Report a Payment Issue</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer bottom -->
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-7">
                        <div class="footer-copy-right">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                <!-- Copyright&copy;<script>document.write(new Date().getFullYear());</script>  All rights reserved | This template is made with <i class="ti-heart" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            </p>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-5">
                        <div class="footer-copy-right f-right">
                            <!-- social -->
                            <div class="footer-social">
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-behance"></i></a>
                                <a href="#"><i class="fas fa-globe"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End-->

    </footer>


</template>

<script>
export default {
    data() {
        return {
            isLoading: true,     // Loader is visible at first
            showMobileMenu: false // Controls mobile menu visibility
        };
    },
    methods: {
        toggleMobileMenu() {
            this.showMobileMenu = !this.showMobileMenu;
        }
    },
    mounted() {
        // Simulate page loading with a delay
        setTimeout(() => {
            this.isLoading = false;
        }, 1500); // Adjust delay as needed
    }
}
</script>


<style scoped>
.logo {
    height: 60px;
    width: 130px;
    margin-top: -3px;
    margin-left: 20px;
}

.flogo {
    width: 200px;
    height: 90px;
    margin-top: -10px;
}
.mobile-links ul li a {
        display: block;
        padding: 10px;
        border-bottom: 1px solid #eee;
        text-decoration: none;
        color: #333;
    }

    .mobile-links ul li a:hover {
        background-color: #f9f9f9;
    }

    .hamburger-toggle {
        padding: 5px;
    }
    li{
        font-weight: 600;
    }
</style>
