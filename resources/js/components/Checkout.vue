<template>
  <!-- slider Area Start-->
  <div class="slider-area ">
    <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/category.jpg">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <div class="hero-cap text-center">
              <h2>Checkout</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- slider Area End-->

  <!--================Checkout Area =================-->
  <section class="checkout_area section_padding">
    <div class="container">
      <div class="returning_customer">
        <div class="check_title">
          <h2>
            Returning Customer?
            <a href="#" @click.prevent="goToLogin">Click here to login</a>
          </h2>
        </div>
        <p>
          If you have shopped with us before, please enter your details in the
          boxes below. If you are a new customer, please proceed to the
          Billing & Shipping section.
        </p>
        <form class="row contact_form" @submit.prevent="handleLogin">
          <div class="col-md-6 form-group p_star">
            <input type="text" class="form-control" id="name" v-model="loginCredentials.email" />
            <span class="placeholder" data-placeholder="Username or Email"></span>
          </div>
          <div class="col-md-6 form-group p_star">
            <input type="password" class="form-control" id="password" v-model="loginCredentials.password" />
            <span class="placeholder" data-placeholder="Password"></span>
          </div>
          <div class="col-md-12 form-group">
            <button type="submit" value="submit" class="btn_3">
              log in
            </button>
            <div class="creat_account">
              <input type="checkbox" id="f-option" v-model="rememberMe" />
              <label for="f-option">Remember me</label>
            </div>
            <a class="lost_pass" href="#" @click.prevent="goToForgotPassword">Lost your password?</a>
          </div>
        </form>
      </div>
      
      <div class="cupon_area">
        <div class="check_title">
          <h2>
            Have a coupon?
            <a href="#" @click.prevent="showCoupon = !showCoupon">Click here to enter your code</a>
          </h2>
        </div>
        <input type="text" placeholder="Enter coupon code" v-model="couponCode" v-if="showCoupon" />
        <a class="tp_btn" href="#" @click.prevent="applyCoupon" v-if="showCoupon">Apply Coupon</a>
      </div>
      
      <div class="billing_details">
        <div class="row">
          <div class="col-lg-8">
            <h3>Billing Details</h3>
            <form class="row contact_form">
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="first" v-model="billingDetails.firstName" required />
                <span class="placeholder" data-placeholder="First name"></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="last" v-model="billingDetails.lastName" required />
                <span class="placeholder" data-placeholder="Last name"></span>
              </div>
              <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="company" v-model="billingDetails.company" placeholder="Company name" />
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="text" class="form-control" id="number" v-model="billingDetails.phone" required />
                <span class="placeholder" data-placeholder="Phone number"></span>
              </div>
              <div class="col-md-6 form-group p_star">
                <input type="email" class="form-control" id="email" v-model="billingDetails.email" required />
                <span class="placeholder" data-placeholder="Email Address"></span>
              </div>
              <div class="col-md-12 form-group p_star">
                <select class="country_select" v-model="billingDetails.country">
                  <option value="US">United States</option>
                  <option value="UK">United Kingdom</option>
                  <option value="CA">Canada</option>
                  <option value="PK">Pakistan</option>
                </select>
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="add1" v-model="billingDetails.address1" required />
                <span class="placeholder" data-placeholder="Address line 01"></span>
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="add2" v-model="billingDetails.address2" />
                <span class="placeholder" data-placeholder="Address line 02"></span>
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="city" v-model="billingDetails.city" required />
                <span class="placeholder" data-placeholder="Town/City"></span>
              </div>
              <div class="col-md-12 form-group p_star">
                <input type="text" class="form-control" id="state" v-model="billingDetails.state" placeholder="State/Province" required />
              </div>
              <div class="col-md-12 form-group">
                <input type="text" class="form-control" id="zip" v-model="billingDetails.zip" placeholder="Postcode/ZIP" required />
              </div>
              <div class="col-md-12 form-group">
                <div class="creat_account">
                  <input type="checkbox" id="f-option2" v-model="billingDetails.createAccount" />
                  <label for="f-option2">Create an account?</label>
                </div>
              </div>
              <div class="col-md-12 form-group">
                <div class="creat_account">
                  <h3>Shipping Details</h3>
                  <input type="checkbox" id="f-option3" v-model="differentShipping" />
                  <label for="f-option3">Ship to a different address?</label>
                </div>
                <textarea class="form-control" rows="1" placeholder="Order Notes" v-model="orderNotes"></textarea>
              </div>
            </form>
          </div>
          
          <div class="col-lg-4">
            <div class="order_box">
              <h2>Your Order</h2>
              <ul class="list">
                <li>
                  <a href="#">Product
                    <span>Total</span>
                  </a>
                </li>
                <li v-for="item in cartItems" :key="item.id">
                  <a href="#">{{ item.name }}
                    <span class="middle">x {{ item.quantity }}</span>
                    <span class="last">${{ (item.price * item.quantity).toFixed(2) }}</span>
                  </a>
                </li>
              </ul>
              <ul class="list list_2">
                <li>
                  <a href="#">Subtotal
                    <span>${{ subtotal.toFixed(2) }}</span>
                  </a>
                </li>
                <li>
                  <a href="#">Shipping
                    <span>Flat rate: ${{ shippingCost.toFixed(2) }}</span>
                  </a>
                </li>
                <li v-if="discount > 0">
                  <a href="#">Discount
                    <span>-${{ discount.toFixed(2) }}</span>
                  </a>
                </li>
                <li>
                  <a href="#">Total
                    <span>${{ totalAmount.toFixed(2) }}</span>
                  </a>
                </li>
              </ul>
              
              <!-- Stripe Payment Element - ONLY ONE COPY -->
              <div class="payment_item active">
                <div class="radion_btn">
                  <input type="radio" id="stripe_payment" name="payment_method" checked />
                  <label for="stripe_payment">Credit/Debit Card (Stripe)</label>
                  <div class="check"></div>
                </div>
                
                <!-- Loading indicator -->
                <div v-if="!stripeInitialized" style="margin: 15px 0; padding: 10px; text-align: center;">
                  <div class="spinner-border text-success" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <p>Loading payment system...</p>
                </div>
                
                <!-- Stripe Elements will mount here -->
                <div id="payment-element" style="margin: 15px 0; padding: 10px;"></div>
                
                <div v-if="paymentError" class="alert alert-danger mt-2">
                  {{ paymentError }}
                </div>
                <div v-if="paymentSuccess" class="alert alert-success mt-2">
                  {{ paymentSuccess }}
                </div>
              </div>
              
              <div class="creat_account">
                <input type="checkbox" id="f-option4" v-model="acceptTerms" required />
                <label for="f-option4">I’ve read and accept the </label>
                <a href="#">terms & conditions*</a>
              </div>
              
              <button type="button" class="btn_3" @click="handlePayment" :disabled="processing" style="width: 100%;">
                <span v-if="processing">Processing...</span>
                <span v-else>Pay ${{ totalAmount.toFixed(2) }} with Stripe</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
import { loadStripe } from '@stripe/stripe-js';
import axios from 'axios';

export default {
    data() {
        return {
            stripe: null,
            elements: null,
            paymentElement: null,
            clientSecret: null,
            processing: false,
            paymentError: null,
            paymentSuccess: null,
            acceptTerms: false,
            differentShipping: false,
            orderNotes: '',
            showCoupon: false,
            couponCode: '',
            discount: 0,
            rememberMe: false,
            stripeInitialized: false,
            paymentReady: false,
            loginCredentials: {
                email: '',
                password: ''
            },
            billingDetails: {
                firstName: '',
                lastName: '',
                company: '',
                phone: '',
                email: '',
                country: 'PK',
                address1: '',
                address2: '',
                city: '',
                state: '',
                zip: '',
                createAccount: false
            },
            cartItems: [],
            shippingCost: 50
        }
    },
    computed: {
        subtotal() {
            return this.cartItems.reduce((total, item) => total + (item.price * item.quantity), 0);
        },
        totalAmount() {
            return this.subtotal + this.shippingCost - this.discount;
        }
    },
    async mounted() {
        // Check if this is a single product checkout
        const checkoutProduct = sessionStorage.getItem('checkoutProduct');
        
        if (checkoutProduct) {
            sessionStorage.removeItem('checkoutProduct');
            const product = JSON.parse(checkoutProduct);
            this.cartItems = [{
                id: product.id,
                name: product.name,
                price: product.price,
                quantity: product.quantity,
                size: product.size,
                colors: product.colors,
                image: product.image
            }];
            if (this.$toast) {
                this.$toast.success(`Proceeding with ${product.name}`);
            }
        } else {
            this.loadCart();
        }
        
        // Initialize Stripe and create payment element
        await this.initStripe();
        await this.createPaymentElement();
        this.loadUserData();
    },
    methods: {
        async initStripe() {
            const stripeKey = import.meta.env.VITE_STRIPE_KEY;
            
            if (!stripeKey) {
                console.error('Stripe key not found');
                this.paymentError = 'Payment system not configured. Please contact support.';
                return false;
            }
            
            try {
                this.stripe = await loadStripe(stripeKey);
                this.stripeInitialized = true;
                console.log('Stripe loaded successfully');
                return true;
            } catch (error) {
                console.error('Failed to load Stripe:', error);
                this.paymentError = 'Failed to initialize payment system: ' + error.message;
                return false;
            }
        },
        
        async createPaymentElement() {
            if (!this.stripeInitialized) {
                console.log('Stripe not initialized yet');
                return;
            }
            
            try {
                // First, create a payment intent
                const orderId = 'ORD_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
                
                const response = await axios.post('/api/initiate-payment', {
                    amount: this.totalAmount,
                    order_id: orderId,
                    billing_details: this.billingDetails,
                    cart_items: this.cartItems
                });
                
                if (!response.data.success) {
                    throw new Error(response.data.error || 'Failed to initiate payment');
                }
                
                this.clientSecret = response.data.clientSecret;
                this.currentOrderId = orderId;
                
                // Create Elements with client secret
                this.elements = this.stripe.elements({
                    clientSecret: this.clientSecret,
                    appearance: {
                        theme: 'flat',
                        variables: {
                            colorPrimary: '#7fad39',
                            colorBackground: '#ffffff',
                            colorText: '#30313d',
                            colorDanger: '#df1b41',
                            fontFamily: 'system-ui, -apple-system, "Segoe UI", Roboto, sans-serif',
                            spacingUnit: '4px',
                            borderRadius: '4px',
                        }
                    }
                });
                
                // Create payment element
                this.paymentElement = this.elements.create('payment');
                
                // Mount the payment element
                const container = document.getElementById('payment-element');
                if (container) {
                    this.paymentElement.mount('#payment-element');
                    this.paymentReady = true;
                    console.log('Payment element mounted successfully');
                } else {
                    throw new Error('Payment form container not found');
                }
                
            } catch (error) {
                console.error('Failed to create payment element:', error);
                this.paymentError = error.message || 'Failed to initialize payment form';
            }
        },
        
        loadCart() {
            const savedCart = localStorage.getItem('cart');
            if (savedCart && JSON.parse(savedCart).length > 0) {
                this.cartItems = JSON.parse(savedCart);
            } else {
                if (this.$toast) {
                    this.$toast.warning('Your cart is empty. Please add items to checkout.');
                }
                setTimeout(() => {
                    this.$router.push('/');
                }, 2000);
            }
        },
        
        loadUserData() {
            const user = localStorage.getItem('user');
            if (user) {
                const userData = JSON.parse(user);
                this.billingDetails.email = userData.email || '';
                this.billingDetails.firstName = userData.name?.split(' ')[0] || '';
                this.billingDetails.lastName = userData.name?.split(' ')[1] || '';
                this.billingDetails.phone = userData.phone || '';
            }
        },
        
        async handlePayment() {
            // Validate form
            if (!this.validateForm()) {
                return;
            }
            
            // Make sure payment element is ready
            if (!this.paymentReady) {
                this.paymentError = 'Payment form is still loading. Please wait...';
                return;
            }
            
            this.processing = true;
            this.paymentError = null;
            this.paymentSuccess = null;
            
            try {
                // Confirm payment with Stripe
                const { error } = await this.stripe.confirmPayment({
                    elements: this.elements,
                    confirmParams: {
                        return_url: `${window.location.origin}/payment_success`,
                        payment_method_data: {
                            billing_details: {
                                name: `${this.billingDetails.firstName} ${this.billingDetails.lastName}`,
                                email: this.billingDetails.email,
                                phone: this.billingDetails.phone,
                                address: {
                                    line1: this.billingDetails.address1,
                                    line2: this.billingDetails.address2,
                                    city: this.billingDetails.city,
                                    state: this.billingDetails.state,
                                    country: this.billingDetails.country,
                                    postal_code: this.billingDetails.zip,
                                }
                            }
                        }
                    },
                    redirect: 'if_required'
                });
                
                if (error) {
                    // Payment failed
                    this.paymentError = error.message;
                    this.processing = false;
                } else {
                    // Payment successful
                    this.paymentSuccess = 'Payment successful! Redirecting...';
                    this.processing = false;
                    
                    // Clear cart
                    localStorage.removeItem('cart');
                    
                    // Redirect to success page after 2 seconds
                    setTimeout(() => {
                        this.$router.push({
                            path: '/payment_success',
                            query: { order_id: this.currentOrderId, amount: this.totalAmount }
                        });
                    }, 2000);
                }
                
            } catch (error) {
                console.error('Payment confirmation error:', error);
                this.paymentError = error.message || 'Payment failed. Please try again.';
                this.processing = false;
            }
        },
        
        validateForm() {
            if (!this.acceptTerms) {
                this.paymentError = 'Please accept the terms and conditions';
                return false;
            }
            
            if (this.cartItems.length === 0) {
                this.paymentError = 'Your cart is empty';
                return false;
            }
            
            if (!this.billingDetails.firstName || !this.billingDetails.lastName) {
                this.paymentError = 'Please enter your full name';
                return false;
            }
            
            if (!this.billingDetails.email) {
                this.paymentError = 'Please enter your email address';
                return false;
            }
            
            if (!this.billingDetails.phone) {
                this.paymentError = 'Please enter your phone number';
                return false;
            }
            
            if (!this.billingDetails.address1 || !this.billingDetails.city || !this.billingDetails.zip) {
                this.paymentError = 'Please complete your address details';
                return false;
            }
            
            return true;
        },
        
        goToLogin() {
            this.$router.push('/login');
        },
        
        goToForgotPassword() {
            this.$router.push('/forgot-password');
        },
        
        applyCoupon() {
            if (this.couponCode === 'DISCOUNT10') {
                this.discount = this.subtotal * 0.1;
                if (this.$toast) {
                    this.$toast.success('Coupon applied! 10% discount');
                }
            } else {
                if (this.$toast) {
                    this.$toast.error('Invalid coupon code');
                }
            }
            this.showCoupon = false;
        }
    }
}
</script>

<style scoped>
.alert {
    margin-top: 10px;
    padding: 10px;
    border-radius: 4px;
}

.alert-danger {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.btn_3:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.spinner-border {
    display: inline-block;
    width: 2rem;
    height: 2rem;
    vertical-align: text-bottom;
    border: 0.25em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    animation: spinner-border 0.75s linear infinite;
}

@keyframes spinner-border {
    to { transform: rotate(360deg); }
}

.visually-hidden {
    position: absolute;
    width: 1px;
    height: 1px;
    padding: 0;
    margin: -1px;
    overflow: hidden;
    clip: rect(0, 0, 0, 0);
    white-space: nowrap;
    border: 0;
}
</style>