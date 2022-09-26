<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="https://images.pexels.com/photos/2112651/pexels-photo-2112651.jpeg?cs=srgb&dl=pexels-leticia-ribeiro-2112651.jpg&fm=jpg"
                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black" id="app">
                                <form class="needs-validation" @submit.prevent="submitForm" method="POST" novalidate>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="./public/images/logo/logo.png" alt="PCSPS Logo">&nbsp;&nbsp;&nbsp;
                                        <span class="h1 fw-bold mb-0">PCSPS</span>
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="email">Email address</label>
                                        <input 
                                            type="email"
                                            id="email"
                                            :class="[
                                                {'is-valid': validEmail},
                                                {'is-invalid': !validEmail && isSubmitted},
                                                'form-control', 'form-control-lg'
                                            ]"
                                            v-model="email"
                                            @keyup="validateEmail" 
                                            placeholder="Email address"
                                            required
                                        />
                                        <div class="invalid-feedback" v-if="!validEmail">{{errEmail}}</div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input
                                            type="password"
                                            id="password"
                                            :class="[
                                                {'is-valid': validPassword},
                                                {'is-invalid': !validPassword && isSubmitted},
                                                'form-control', 'form-control-lg'
                                            ]"
                                            v-model="password"
                                            @keyup="validatePassword" 
                                            placeholder="Password"
                                            required
                                        />
                                        <div class="invalid-feedback" v-if="!validPassword">{{errPassword}}</div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-dark" type="submit">Signin</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="index.php?page=signup" style="color: #393f81;">Signup here</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const { createApp } = Vue

    createApp({
        data() {
            return {
                email: "",
                password: "",
                errEmail: "",
                errPassword: "",
                validEmail: false,
                validPassword: false,
                isSubmitted: false
            }
        },
        methods: {
            async submitForm() {
                const forms = document.querySelector('.needs-validation');
                const { email, password } = this;

                let response = await axios({
                    method: 'post',
                    url: 'includes/signin.inc.php',
                    data: {
                        email: this.email,
                        password: this.password,
                    }
                });

                this.isSubmitted = true;
                
                this.validateEmail();
                this.validatePassword();

                if(this.email.length != 0 && this.password.length != 0) {
                    if(response.data == "Not found") {
                        this.errEmail = "Email didn't exist";
                        this.validEmail = false;
                    }
                    else if(response.data == "Incorrect password") {
                        this.errPassword = "Password is incorrect";
                        this.validPassword = false;
                    }
                    else if(response.data == "Authorized") {
                        swal({
                            title: "Successfully signed in!",
                            icon: "success",
                            button: "Okay",
                        }).then((okay) => window.location.href = "index.php?page=services");
                    }
                }
            },
            validateEmail() {
                const { email } = this;
                
                if(this.isSubmitted) {
                    if(email.length == 0) {
                        this.errEmail = "Email is required";
                        this.validEmail = false;
                    }
                    else if(!email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
                        this.errEmail = "Email is invalid";
                        this.validEmail = false;
                    }
                    else this.validEmail = true;
                }
            },
            validatePassword() {
                const { password } = this;

                if(this.isSubmitted) {
                    if(password.length == 0) {
                        this.errPassword = "Password is required";
                        this.validPassword = false;
                    }
                    else this.validPassword = true;
                }
            },
        }
    }).mount('#app')
</script>