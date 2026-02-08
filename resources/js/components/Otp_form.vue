<template>
    <!-- slider Area Start-->
    <div class="slider-area ">
        <!-- Mobile Menu -->
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="assets/img/hero/category.jpg">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>OTP Verification</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->

    <!--================otp_form Area =================-->
    <section class="login_part section_padding">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>Verify Your OTP</h2>
                            <p>Please verify the OTP sent to your email address to complete your Registration.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3 class="text-center">Enter OTP</h3>
                            <form class="row contact_form" @submit.prevent="submitForm" novalidate="novalidate">
                                <!-- Email Input -->
                                <div class="col-md-12 form-group p_star">
                                    <input
                                        type="email"
                                        class="form-control"
                                        v-model="form.email"
                                        id="email"
                                        :class="{'input-error': errors.email}"
                                        placeholder="Email"
                                    />
                                    <small v-if="errors.email">{{ errors.email[0] }}</small>
                                </div>

                                <!-- OTP Input -->
                                <div class="col-md-12 form-group p_star">
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="form.otp"
                                        id="otp"
                                        :class="{'input-error': errors.otp}"
                                        placeholder="OTP"
                                    />
                                    <small v-if="errors.otp">{{ errors.otp[0] }}</small>
                                </div>

                                <!-- Verify Button -->
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn_3" :disabled="loading">
                                        <span v-if="loading" class="loader"></span>
                                        <span v-else>Verify OTP</span>
                                    </button>
                                </div>

                                <!-- Countdown Timer -->
                                <div class="col-md-12 form-group">
                                    <div id="timer">{{ timerMessage }}</div>
                                </div>

                                <!-- Resend OTP Button -->
                                <div class="col-md-12 form-group">
                                    <button
                                        type="button"
                                        class="btn_3"
                                        :disabled="isResendDisabled"
                                        @click="resendOtp"
                                    >
                                        Resend OTP
                                    </button>
                                </div>
                            </form>

                            <!-- Success and Error Messages -->
                            <div v-if="successMessage" class="success-message">✅{{ successMessage }}</div>
                            <div v-if="errorMessage" class="error-message">❌{{ errorMessage }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================otp_form end =================-->
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                email: '',
                otp: '',
            },
            errors: {},
            successMessage: '',
            errorMessage: '',
            loading: false, // Loader state
            countdown: 120, // Countdown for resend button
            isResendDisabled: true, // Controls Resend OTP button state
            timerMessage: '', // Countdown display message
        };
    },
    methods: {
        // Function to submit form and verify OTP
        async submitForm() {
            this.errors = {}; // Reset errors
            this.successMessage = '';
            this.errorMessage = '';
            this.loading = true; // Start loading

            try {
                const response = await axios.post('http://127.0.0.1:8000/api/customer/verify-otp', {
                    email: this.form.email,
                    otp: this.form.otp,
                });

                // Handle successful OTP verification
                this.successMessage = response.data.message;
                this.loading = false; // Stop loading

                // Reset form fields
                this.form = {
                    email: '',
                    otp: '',
                };

                alert(" ✅ Registration Complete! OTP Verified Successfully.");
                this.$router.push({
                    path: '/',
                });
            } catch (error) {
                // Handle validation or OTP errors
                if (error.response && error.response.data) {
                    this.errors = error.response.data;
                    this.errorMessage = error.response.data.message || '❌Failed to verify OTP';
                }
                this.loading = false; // Stop loading
            }
        },

        // Function to resend OTP
        async resendOtp() {
            this.isResendDisabled = true;
            this.errors = {};
            this.successMessage = '';
            this.errorMessage = '';
            try {
                const response = await axios.post('http://127.0.0.1:8000/api/customer/resend-otp', {
                    email: this.form.email,
                });

                // Reset countdown and start again
                this.countdown = 120;
                this.startCountdown();

                // Display success message for OTP resend
             
                alert(" ✅ A New OTP is Sent to Your Email.");
            } catch (error) {
                this.errorMessage = alert("❌Failed to resend OTP");
            }
           
        },

        // Start countdown for Resend OTP button
        startCountdown() {
            const interval = setInterval(() => {
                if (this.countdown <= 0) {
                    clearInterval(interval);
                    this.isResendDisabled = false;
                    this.timerMessage = 'OTP expired. Click Resend for New OTP';
                } else {
                    this.countdown--;
                    const minutes = Math.floor(this.countdown / 60);
                    const seconds = this.countdown % 60;
                    this.timerMessage = `OTP expires in ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
                }
            }, 1000);
        },
    },
    mounted() {
        // Start the countdown on component mount
        this.startCountdown();
    },
};
</script>

<style scoped>
/* Same styling as the login form */
.otp-container {
    max-width: 400px;
    margin: auto;
    padding: 20px;
}

.form-group {
    margin-bottom: 15px;
}

input {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

input.input-error {
    border-color: red;
}

small {
    color: red;
}

button {
    padding: 10px 15px;
    background-color: rgb(128, 81, 132);
    color: white;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:disabled {
    background-color: gray;
}

.loader {
    border: 2px solid #f3f3f3;
    border-top: 2px solid blue;
    border-radius: 50%;
    width: 15px;
    height: 15px;
    animation: spin 1s linear infinite;
    display: inline-block;
}

@keyframes spin {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
}

.success-message {
    margin-top: 15px;
    color: rgb(11, 194, 11);
}

.error-message {
    margin-top: 15px;
    color: red;
}

#timer {
    margin-top: 10px;
    font-weight: bold;
    color: #502d56f3;
}
</style>
