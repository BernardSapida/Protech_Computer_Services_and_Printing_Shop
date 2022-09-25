<section class="container contact_form my-5" id="app">
    <div class="my-5">
        <h1 class="text-center">Contact Us</h1>
        <p class="text-center text-secondary">If you have any questions, feel free to contact us.</p>
    </div>
    <form class="row g-3 needs-validation" @submit.prevent="submitForm" novalidate>
        <div class="col-md-6 col-sm-12">
            <label for="firstname" class="form-label">Firstname</label>
            <input type="text" class="form-control" id="firstname" v-model="firstname" placeholder="Firstname" required>
            <div class="invalid-feedback">Firstname is required</div>
        </div>
        <div class="col-md-6 col-sm-12">
            <label for="lastname" class="form-label">Lastname</label>
            <input type="text" class="form-control" id="lastname" v-model="lastname" placeholder="Lastname" required>
            <div class="invalid-feedback">Lastname is required</div>
        </div>
        <div class="col-md-12">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" v-model="email" placeholder="Email" required>
            <div class="invalid-feedback">Email is required</div>
        </div>
        <div class="col-md-12">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" name="message" id="message" rows="5" placeholder="Message" required></textarea>
            <div class="invalid-feedback">Message is required</div>
        </div>
        <div class="col-12 d-flex">
            <button class="btn btn-primary ms-auto" type="submit"><i class="fa-solid fa-paper-plane"></i> Submit</button>
        </div>
    </form>
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
                message: ""
            }
        },
        methods: {
            submitForm() {
                'use strict'

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