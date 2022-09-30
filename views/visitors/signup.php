<?php include_once "includes/visitorPageRestriction.inc.php" ?>
<?php include_once "includes/signup.inc.php" ?>

<section class="my-3">
    <div class="container py-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                        <img src="https://images.pexels.com/photos/2112651/pexels-photo-2112651.jpeg?cs=srgb&dl=pexels-leticia-ribeiro-2112651.jpg&fm=jpg"
                            alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; height: 100%;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black" id="app">
                                <form class="needs-validation" @submit.prevent="submitForm" action="" method="POST" novalidate>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="./public/images/logo/logo.png" alt="PCSPS Logo">&nbsp;&nbsp;&nbsp;
                                        <span class="h1 fw-bold mb-0">PCSPS</span>
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create your account</h5>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label class="form-label" for="firstname">Firstname</label>
                                            <input 
                                                type="text" 
                                                :class="[
                                                    {'is-valid': validFirstname},
                                                    {'is-invalid': !validFirstname && isSubmitted},
                                                    'form-control'
                                                ]"
                                                v-model="firstname" 
                                                name="firstname"
                                                id="firstname" 
                                                @keyup="validateFirstname" 
                                                placeholder="Firstname"
                                                required
                                            />
                                            <div class="invalid-feedback" v-if="!validFirstname">{{errFirstname}}</div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label class="form-label" for="lastname">Lastname</label>
                                            <input 
                                                type="text"
                                                :class="[
                                                    {'is-valid': validLastname},
                                                    {'is-invalid': !validLastname && isSubmitted},
                                                    'form-control'
                                                ]"
                                                v-model="lastname"
                                                name="lastname"
                                                id="lastname"
                                                @keyup="validateLastname" 
                                                placeholder="Lastname"
                                                required
                                            />
                                            <div class="invalid-feedback" v-if="!validLastname">{{errLastname}}</div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="email">Email address</label>
                                        <input 
                                            type="email" 
                                            :class="[
                                                {'is-valid': validEmail},
                                                {'is-invalid': !validEmail && isSubmitted},
                                                'form-control'
                                            ]" 
                                            v-model="email" 
                                            name="email"
                                            id="email" 
                                            @keyup="validateEmail" 
                                            placeholder="Email address" 
                                            required
                                        />
                                        <div class="invalid-feedback" v-if="!validEmail">{{errEmail}}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <input 
                                            type="text"
                                            :class="[
                                                {'is-valid': validAddress},
                                                {'is-invalid': !validAddress && isSubmitted},
                                                'form-control'
                                            ]"
                                            v-model="address"
                                            name="address"
                                            id="address"
                                            @keyup="validateAddress" 
                                            placeholder="Address"
                                            required
                                        />
                                        <div class="invalid-feedback" v-if="!validAddress">{{errAddress}}</div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="contact">Contact Number</label>
                                        <input 
                                            type="text"
                                            :class="[
                                                {'is-valid': validContact},
                                                {'is-invalid': !validContact && isSubmitted},
                                                'form-control'
                                            ]"
                                            v-model="contact"
                                            name="contact"
                                            id="contact"
                                            @keyup="validateContact" 
                                            placeholder="Contact Number"
                                            required
                                        />
                                        <div class="invalid-feedback" v-if="!validContact">{{errContact}}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label class="form-label" for="gcashName">Gcash Name</label>
                                            <input 
                                                type="text" 
                                                :class="[
                                                    {'is-valid': validGcashName},
                                                    {'is-invalid': !validGcashName && isSubmitted},
                                                    'form-control'
                                                ]"
                                                v-model="gcashName" 
                                                name="gcashName"
                                                id="gcashName" 
                                                @keyup="validateGcashName" 
                                                placeholder="Gcash Name"
                                                required
                                            />
                                            <div class="invalid-feedback" v-if="!validGcashName">{{errGcashName}}</div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-3">
                                            <label class="form-label" for="gcashNumber">Gcash Number</label>
                                            <input 
                                                type="text" 
                                                :class="[
                                                    {'is-valid': validGcashNumber},
                                                    {'is-invalid': !validGcashNumber && isSubmitted},
                                                    'form-control'
                                                ]"
                                                v-model="gcashNumber" 
                                                name="gcashNumber"
                                                id="gcashNumber" 
                                                @keyup="validateGcashNumber" 
                                                placeholder="Gcash Number"
                                                required
                                            />
                                            <div class="invalid-feedback" v-if="!validGcashNumber">{{errGcashNumber}}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input 
                                                type="password"
                                                :class="[
                                                    {'is-valid': validPassword},
                                                    {'is-invalid': !validPassword && isSubmitted},
                                                    'form-control'
                                                ]"
                                                v-model="password"
                                                name="password"
                                                id="password"
                                                @keyup="validatePassword" 
                                                placeholder="Password"
                                                required
                                            />
                                            <div class="invalid-feedback" v-if="!validPassword">{{errPassword}}</div>
                                        </div>
                                        <div class="col-md-6 col-sm-12 mb-4">
                                            <label class="form-label" for="confirmPassword">Confirm Password</label>
                                            <input 
                                                type="password"
                                                :class="[
                                                    {'is-valid': validConfirmPassword},
                                                    {'is-invalid': !validConfirmPassword && isSubmitted},
                                                    'form-control'
                                                ]"
                                                v-model="confirmPassword"
                                                name="confirmPassword"
                                                id="confirmPassword"
                                                @keyup="validateConfirmPassword" 
                                                placeholder="Confirm password"
                                                required
                                            />
                                            <div class="invalid-feedback" v-if="!validConfirmPassword">{{errConfirmPassword}}</div>
                                        </div>
                                    </div>
                                    <div class="d-grid">
                                        <button class="btn btn-dark" type="submit">Create account</button>
                                    </div>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Do you have an account? <a href="index.php?page=signin" style="color: #393f81;">Signin here</a></p>
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
                firstname: "",
                lastname: "",
                email: "",
                address: "",
                contact: "",
                gcashName: "",
                gcashNumber: "",
                address: "",
                password: "",
                confirmPassword: "",
                validFirstname: false,
                validLastname: false,
                validEmail: false,
                validAddress: false,
                validContact: false,
                validGcashName: false,
                validGcashNumber: false,
                validPassword: false,
                validConfirmPassword: false,
                errFirstname: "",
                errLastname: "",
                errEmail: "",
                errAddress: "",
                errContact: "",
                errGcashName: "",
                errGcashNumber: "",
                errPassword: "",
                errConfirmPassword: "",
                isSubmitted: false
            }
        },
        methods: {
            submitForm() {
                const form = document.querySelector('.needs-validation');

                this.isSubmitted = true;

                this.validateFirstname();
                this.validateLastname();
                this.validateEmail();
                this.validateAddress();
                this.validateContact();
                this.validateGcashName();
                this.validateGcashNumber();
                this.validatePassword();
                this.validateConfirmPassword();

                const { firstname, lastname, email, address, contact, gcashName, gcashNumber, password, confirmPassword, validFirstname, validLastname, validEmail, validAddress, validContact, validGcashName, validGcashNumber, validPassword, validConfirmPassword } = this;


                if(validFirstname && validLastname && validEmail && validAddress && validContact && validGcashName && validGcashNumber && validAddress && validPassword && validConfirmPassword) {
                    swal({
                        title: "Account successfully created!",
                        text: "You can now use your account to sign in",
                        icon: "success",
                        button: false,
                        timer: 2000
                    }).then((okay) => form.submit());
                }
            },
            validateFirstname() {
                const { firstname } = this;
                
                if(this.isSubmitted) {
                    if(firstname.length == 0) {
                        this.errFirstname = "Firstname is required";
                        this.validFirstname = false;
                    }
                    else if(firstname.length < 2) {
                        this.errFirstname = "First name is too short";
                        this.validFirstname = false;
                    }
                    else if(!/^[A-z]+$/.test(firstname)) {
                        this.errFirstname = "First name is invalid";
                        this.validFirstname = false;
                    }
                    else this.validFirstname = true;
                }
            },
            validateLastname() {
                const { lastname } = this;
                
                if(this.isSubmitted) {
                    if(lastname.length == 0) {
                        this.errLastname = "Lastname is required";
                        this.validLastname = false;
                    }
                    else if(lastname.length < 2) {
                        this.errLastname = "Lastname is too short";
                        this.validLastname = false;
                    }
                    else if(!/^[A-z]+$/.test(lastname)) {
                        this.errLastname = "First name is invalid";
                        this.validLastname = false;
                    }
                    else this.validLastname = true;
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
            validateAddress() {
                const { address } = this;
                
                if(this.isSubmitted) {
                    if(address.length == 0) {
                        this.errAddress = "Address is required";
                        this.validAddress = false;
                    }
                    else if(address.length < 5) {
                        this.errAddress = "Address is invalid";
                        this.validAddress = false;
                    }
                    else this.validAddress = true;
                }
            },
            validateContact() {
                const { contact } = this;
                if(this.isSubmitted) {
                    if(contact.length == 0) {
                        this.errContact = "Contact is required";
                        this.validContact = false;
                    }
                    else if(!/^(09)[0-9]{9}$/.test(contact) && !contact.length != 11) {
                        this.errContact = "Contact is invalid";
                        this.validContact = false;
                    }
                    else this.validContact = true;
                }
            },
            validateGcashName() {
                const { gcashName } = this;
                
                if(this.isSubmitted) {
                    if(gcashName.length == 0) {
                        this.errGcashName = "Gcash name is required";
                        this.validGcashName = false;
                    }
                    else if(gcashName.length < 5) {
                        this.errGcashName = "Gcash name is too short";
                        this.validGcashName = false;
                    }
                    else if(!/^[A-z ]+$/.test(gcashName)) {
                        this.errGcashName = "Gcash name is invalid";
                        this.validGcashName = false;
                    }
                    else this.validGcashName = true;
                }
            },
            validateGcashNumber() {
                const { gcashNumber } = this;
                
                if(this.isSubmitted) {
                    if(gcashNumber.length == 0) {
                        this.errGcashNumber = "Gcash number is required";
                        this.validGcashNumber = false;
                    }
                    else if(!/^(09)[0-9]{9}$/.test(gcashNumber) && !contact.length != 11) {
                        this.errGcashNumber = "Gcash number is invalid";
                        this.validGcashNumber = false;
                    }
                    else this.validGcashNumber = true;
                }
            },
            validatePassword() {
                const { password } = this;

                this.validateConfirmPassword();
                
                if(this.isSubmitted) {
                    if(password.length == 0) {
                        this.errPassword = "Password is required";
                        this.validPassword = false;
                    }
                    else if(password.length < 8) {
                        this.errPassword = "Password length must be greater than 8 characters";
                        this.validPassword = false;
                    }
                    else this.validPassword = true;
                }
            },
            validateConfirmPassword() {
                const { password, confirmPassword } = this;
                
                if(this.isSubmitted) {
                    if(confirmPassword.length == 0) {
                        this.errConfirmPassword = "Confirm password is required";
                        this.validConfirmPassword = false;
                    }
                    else if(password != confirmPassword) {
                        this.errConfirmPassword = "Confirm password didn't match to password";
                        this.validConfirmPassword = false;
                    }
                    else this.validConfirmPassword = true;
                }
            }
        }
    }).mount('#app')
</script>