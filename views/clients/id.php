<?php include_once "includes/id.inc.php" ?>

<section class="my-5">
    <div class="container">
        <div class="d-flex justify-content-center gap-5">
            <div>
                <img src="public/images/products/id.jpg" width="500px" alt="ID">
            </div>
            <div id="app">
                <form class="needs-validation" @submit.prevent="submitForm" action="" method="POST" novalidate>
                    <div class="mb-3">
                        <label class="form-label" for="product">Product Name</label>
                        <input type="text" :class="['form-control']" v-model="product" id="product" placeholder="Product Name" style="pointer-events: none;" required/>
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
                            <option value="" selected>-- Select ID Type --</option>
                            <option value="seta">Set A (2x2 4pcs)</option>
                            <option value="setb">Set B (1x1 8pcs)</option>
                            <option value="setc">Set C (Passport Size 5pcs)</option>
                            <option value="setd">Set D (2x2 3pcs & 1x1 4pcs)</option>
                            <option value="sete">Set E (2x2 2pcs & 1x1 2pcs & Passport Size 2pcs)</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Price</label>
                        <input type="number" :class="['form-control']" v-model="price" id="price" placeholder="Price" style="pointer-events: none;" required/>
                        <div class="invalid-feedback">Price is required</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="picture">ID Picture</label>
                        <input type="file" :class="['form-control']" @change="getPictureName" id="picture" placeholder="Picture" required/>
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
        data() {
            return {
                product: "ID",
                quantity: 0,
                price: 100,
                picture: ""
            }
        },
        methods: {
            submitForm() {
                const form = document.querySelector('.needs-validation')
                form.classList.add('was-validated')
            },
            getPictureName() {
                console.log(document.getElementById('picture').value);
            }
        }
    }).mount('#app')
</script>