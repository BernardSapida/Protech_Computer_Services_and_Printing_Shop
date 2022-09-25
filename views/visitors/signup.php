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
                                <form class="needs-validation" @submit.prevent="submitForm" novalidate>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="./public/images/logo/logo.png" alt="PCSPS Logo">&nbsp;&nbsp;&nbsp;
                                        <span class="h1 fw-bold mb-0">PCSPS</span>
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create your account</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label" for="firstname">Firstname</label>
                                            <input type="text" :class="['form-control']" v-model="firstname" id="firstname" placeholder="Firstname" required/>
                                            <div class="invalid-feedback">Firstname is required</div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label" for="lastname">Lastname</label>
                                            <input type="text" :class="['form-control']" v-model="lastname" id="lastname" placeholder="Lastname" required/>
                                            <div class="invalid-feedback">Lastname is required</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="form2Example17">Email address</label>
                                        <input type="email" :class="['form-control']" v-model="email" id="email" placeholder="Email address" required/>
                                        <div class="invalid-feedback">Email address is required</div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" :class="['form-control']" v-model="password" id="password" placeholder="Password" required/>
                                            <div class="invalid-feedback">Password is required</div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="form-label" for="confirmPassword">Confirm Password</label>
                                            <input type="password" :class="['form-control']" v-model="confirmPassword" id="confirmPassword" placeholder="Confirm password" required/>
                                            <div class="invalid-feedback">Confirm password is required</div>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-dark" type="submit">Create account</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Do you have an account? <a href="index.php?page=signin" style="color: #393f81;">Signin here</a></p>
                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>
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
        mounted() {
            this.submitForm();
        },
        data() {
            return {
                firstname: "",
                lastname: "",
                email: "",
                password: "",
                confirmPassword: "",
            }
        },
        methods: {
            submitForm() {
                const forms = document.querySelectorAll('.needs-validation')

                Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            }
        }
    }).mount('#app')
</script>