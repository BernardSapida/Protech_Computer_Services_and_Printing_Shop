<section class="my-5">
    <div class="container">
        <div class="d-flex justify-content-center gap-5">
            <div>
                <img src="public/images/products/tarpaulin.jpeg" width="500px" alt="ID">
            </div>
            <div id="app">
                <form class="needs-validation" @submit.prevent="submitForm" novalidate>
                    <div class="mb-3">
                        <label class="form-label" for="product">Product Name</label>
                        <input type="text" :class="['form-control']" v-model="product" id="product" placeholder="Product Name" required/>
                        <div class="invalid-feedback">Product name is required</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantity">Quantity</label>
                        <input type="number" :class="['form-control']" v-model="quantity" id="quantity" placeholder="Quantity" required/>
                        <div class="invalid-feedback">Quantity is required</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantity">Type</label>
                        <select class="form-select" aria-label="Default select example" required>
                            <option value="" selected>-- Select Tarpauline Size --</option>
                            <option value="seta">6' x 4'</option>
                            <option value="seta">6' x 9'</option>
                            <option value="seta">12' x 8'</option>
                            <option value="seta">12' x 18'</option>
                            <option value="seta">24' x 18'</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Price</label>
                        <input type="number" :class="['form-control']" v-model="price" id="price" placeholder="Price" required/>
                        <div class="invalid-feedback">Price is required</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="picture">Tarpaulin Picture</label>
                        <input type="file" :class="['form-control']" v-model="picture" id="picture" placeholder="Picture" required/>
                        <div class="invalid-feedback">Picture is required</div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Add to cart</button>
                    </div>
                </form> 
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
                product: "Tarpaulin",
                price: 100,
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