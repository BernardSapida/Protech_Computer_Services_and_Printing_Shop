<?php include_once "includes/contact.inc.php" ?>

<section class="container contact_form my-5" id="app">
    <div class="my-5">
        <h1 class="text-center">Contact Us</h1>
        <p class="text-center text-secondary">If you have any questions, feel free to contact us.</p>
    </div>
    <form class="row g-3 needs-validation" @submit.prevent="submitForm" action="" method="POST" novalidate>
        <div class="col-md-6 col-sm-12">
            <label for="firstname" class="form-label">Firstname</label>
            <input 
                type="text" 
                :class="[
                    {'is-valid': validFirstname},
                    {'is-invalid': !validFirstname && isSubmitted},
                    'form-control'
                ]" 
                name="firstname" 
                id="firstname" 
                v-model="firstname" 
                @keyup="validateFirstname" 
                placeholder="Firstname" 
                required
            >
            <div class="invalid-feedback" v-if="!validFirstname">{{errFirstname}}</div>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="lastname" class="form-label">Lastname</label>
            <input 
                type="text" 
                :class="[
                    {'is-valid': validLastname},
                    {'is-invalid': !validLastname && isSubmitted},
                    'form-control'
                ]" 
                name="lastname" 
                id="lastname" 
                v-model="lastname" 
                @keyup="validateLastname" 
                placeholder="Lastname" 
                required
            >
            <div class="invalid-feedback" v-if="!validLastname">{{errLastname}}</div>
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Email</label>
            <input 
                type="text" 
                :class="[
                    {'is-valid': validEmail},
                    {'is-invalid': !validEmail && isSubmitted},
                    'form-control'
                ]" 
                name="email" 
                id="email" 
                v-model="email" 
                @keyup="validateEmail" 
                placeholder="Email" 
                required
            >
            <div class="invalid-feedback" v-if="!validEmail">{{errEmail}}</div>
        </div>
        <div class="col-md-12">
            <label for="message" class="form-label">Message</label>
            <textarea 
                :class="[
                    {'is-valid': validMessage},
                    {'is-invalid': !validMessage && isSubmitted},
                    'form-control'
                ]" 
                name="message" 
                id="message" 
                rows="5" 
                v-model="message" 
                @keyup="validateMessage" 
                placeholder="Message" 
                required
            ></textarea>
            <div class="invalid-feedback" v-if="!validMessage">{{errMessage}}</div>
        </div>
        <div class="col-12 d-flex">
            <button class="btn btn-primary ms-auto" type="submit"><i class="fa-solid fa-paper-plane"></i> Submit</button>
        </div>
    </form>
</section>

<script>
    const { createApp } = Vue

    createApp({
        data() {
            return {
                firstname: "<?php echo isset($_SESSION["firstname"]) ? $_SESSION["firstname"] : ""; ?>",
                lastname: "<?php echo isset($_SESSION["lastname"]) ? $_SESSION["lastname"] : ""; ?>",
                email: "<?php echo isset($_SESSION["email"]) ? $_SESSION["email"] : ""; ?>",
                message: "",
                validFirstname: false,
                validLastname: false,
                validEmail: false,
                validMessage: false,
                errFirstname: "",
                errLastname: "",
                errEmail: "",
                errMessage: "",
                isSubmitted: false
            }
        },
        methods: {
            submitForm() {
                const form = document.querySelector('.needs-validation')

                this.isSubmitted = true;

                this.validateFirstname();
                this.validateLastname();
                this.validateEmail();
                this.validateMessage();

                const { validFirstname, validLastname, validEmail, validMessage } = this;

                if(validFirstname && validLastname && validEmail && validMessage) {
                    swal({
                        title: "The form was submitted!",
                        text: "Thank you for sending us a message!",
                        icon: "success",
                        button: false,
                        timer: 2000
                    }).then(okay => form.submit());
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
                        this.errFirstname = "First name is invalid";
                        this.validFirstname = false;
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
            validateMessage() {
                const { message } = this;
                
                if(this.isSubmitted) {
                    if(message.trim().length == 0) {
                        this.errMessage = "Message is required";
                        this.validMessage = false;
                    }
                    else if(message.trim().length < 10) {
                        this.errMessage = "Message is too short";
                        this.validMessage = false;
                    }
                    else this.validMessage = true;
                }
            },
        }
    }).mount('#app')
</script>