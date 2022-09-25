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
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17">Email address</label>
                                        <input type="email" id="form2Example17" :class="['form-control', 'form-control-lg']" placeholder="Email address" required/>
                                        <div class="invalid-feedback">Firstname is required</div>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27">Password</label>
                                        <input type="password" id="form2Example27" :class="['form-control', 'form-control-lg']" placeholder="Password" required/>
                                        <div class="invalid-feedback">Firstname is required</div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-dark" type="submit">Signin</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="index.php?page=signup" style="color: #393f81;">Signup here</a></p>
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
                email: "",
                password: "",
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