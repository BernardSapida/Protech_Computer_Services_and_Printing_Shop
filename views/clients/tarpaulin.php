<?php include_once "includes/tarpaulin.inc.php" ?>

<section class="my-5">
    <div class="container">
        <div class="d-flex justify-content-center gap-5">
            <div>
                <img src="public/images/products/tarpaulin.jpeg" width="500px" alt="ID">
            </div>
            <div id="app">
                <form class="needs-validation" @submit.prevent="submitForm" action="" method="POST"  enctype="multipart/form-data" novalidate>
                    <div class="mb-3">
                        <label class="form-label" for="product">Product Name</label>
                        <input 
                            type="text" 
                            :class="[
                                {'is-valid': validProductName},
                                'form-control'
                            ]" 
                            v-model="product"
                            name="product" 
                            id="product" 
                            placeholder="Product Name" 
                            style="pointer-events: none;" 
                            required
                        />
                        <div class="invalid-feedback">Product name is required</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantity">Quantity</label>
                        <input 
                            type="number" 
                            :class="[
                                {'is-valid': validQuantity},
                                {'is-invalid': !validQuantity && isSubmitted},
                                'form-control'
                            ]" 
                            v-model="quantity" 
                            name="quantity" 
                            id="quantity" 
                            @keyup="validateQuantity" 
                            placeholder="Quantity" 
                            required
                        />
                        <div class="invalid-feedback" v-if="!validQuantity">{{errQuantity}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantity">Tarpauline Size</label>
                        <select
                            :class="[
                                {'is-valid': validSize},
                                {'is-invalid': !validSize && isSubmitted},
                                'form-select'
                            ]" 
                            name="size"
                            id="size"
                            v-model="size"
                            @change="validateSize"
                            aria-label="Default select example" 
                            required
                        >
                            <option value="" selected>-- Select Tarpauline Size --</option>
                            <option value="5 x 7">5' x 7'</option>
                            <option value="6 x 8">6' x 8'</option>
                            <option value="7 x 9">7 x 9</option>
                            <option value="8 x 10">8' x 10'</option>
                            <option value="8 x 12">8' x 12'</option>
                            <option value="8 x 14">8' x 14'</option>
                            <option value="9 x 12">9' x 12'</option>
                            <option value="10 x 12">10' x 12'</option>
                            <option value="10 x 14">10' x 14'</option>
                            <option value="10 x 16">10' x 16'</option>
                            <option value="10 x 18">10' x 18'</option>
                            <option value="10 x 20">10' x 20'</option>
                            <option value="12 x 14">12' x 14'</option>
                            <option value="12 x 16">12' x 16'</option>
                            <option value="12 x 18">12' x 18'</option>
                            <option value="12 x 20">12' x 20'</option>
                            <option value="12 x 24">12' x 24'</option>
                            <option value="14 x 16">14' x 16'</option>
                            <option value="14 x 18">14' x 18'</option>
                            <option value="14 x 20">14' x 20'</option>
                            <option value="15 x 20">15' x 20'</option>
                            <option value="16 x 20">16' x 20'</option>
                            <option value="16 x 24">16' x 24'</option>
                            <option value="18 x 20">18' x 20'</option>
                            <option value="20 x 20">20' x 20'</option>
                            <option value="20 x 24">20' x 24'</option>
                            <option value="20 x 30">20' x 30'</option>
                        </select>
                        <div class="invalid-feedback" v-if="!validSize">{{errSize}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Price</label>
                        <input 
                            type="number" 
                            :class="[
                                {'is-valid': validPrice && isSubmitted},
                                {'is-invalid': !validPrice && isSubmitted},
                                'form-control'
                            ]" 
                            v-model="price" 
                            name="price" 
                            id="price" 
                            placeholder="Price" 
                            style="pointer-events: none;" 
                            required
                        />
                        <div class="invalid-feedback" v-if="!validPrice">{{errPrice}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="picture">Tarpaulin Picture</label>
                        <input type="file" 
                            :class="[
                                {'is-valid': validPicture},
                                {'is-invalid': !validPicture && isSubmitted},
                                'form-control'
                            ]" 
                            name="picture" 
                            id="picture" 
                            @change="validatePicture" 
                            placeholder="Picture" 
                            required
                        />
                        <div class="invalid-feedback" v-if="!validPicture">{{errPicture}}</div>
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
                size: "",
                price: 0,
                picture: "",
                validProductName: false,
                validQuantity: false,
                validSize: false,
                validPrice: false,
                validPicture: false,
                errQuantity: "",
                errSize: "",
                errPrice: "",
                errPicture: "",
                isSubmitted: false
            }
        },
        methods: {
            submitForm() {
                const FORM = document.querySelector('.needs-validation')

                this.isSubmitted = this.validProductName = true;

                this.validateQuantity();
                this.validateSize();
                this.validatePicture();

                const { validProductName, validQuantity, validSize, validPrice, validPicture } = this;

                if(validProductName && validQuantity && validSize && validPrice && validPicture) {
                    swal({
                        title: "Successfully added to cart!",
                        text: "View your items in cart",
                        icon: "success",
                        button: "Okay",
                    }).then((okay) => FORM.submit());
                }
            },
            validateQuantity() {
                const { quantity } = this;

                if(this.isSubmitted) {
                    if(quantity <= 0) {
                        this.errQuantity = "Quantity is required";
                        this.errPrice = "Answer all required fields";
                        this.validPrice = false;
                        this.validQuantity = false;
                    } else this.validQuantity = true;
                }

                this.getPrice();
            },
            validateSize() {
                const { size } = this;

                if(this.isSubmitted) {
                    if(size == "") {
                        this.errSize = "Tarpauline size is required";
                        this.validSize = false;
                    } else this.validSize = true;
                }

                this.getPrice();
            },
            validatePicture() {
                const FILE_PICTURE = document.getElementById('picture').value;

                if(this.isSubmitted) {
                    if(FILE_PICTURE == "") {
                        this.errPicture = "Tarpauline picture is required";
                        this.validPicture = false;
                        return;
                    }

                    const FILE = FILE_PICTURE.split("C:\\fakepath\\")[1].split(".");
                    const FILE_NAME = FILE[0];
                    const FILE_EXTERNAL = FILE[1];
                    const VALID_EXTERNAL = ["jpg", "jpeg", "png"];

                    if(VALID_EXTERNAL.indexOf(FILE_EXTERNAL) == -1) {
                        this.errPicture = "File external should be jpg, jpeg, or png";
                        this.validPicture = false;
                        return;
                    }

                    this.validPicture = true;
                }
            },
            getPrice() {
                const { quantity, size } = this;
                const PRICE_LIST = {
                    "5 x 7": 595,
                    "6 x 8": 816,
                    "7 x 9": 1071,
                    "8 x 10": 1360,
                    "8 x 12": 1632,
                    "8 x 14": 1904,
                    "9 x 12": 1336,
                    "10 x 12": 2040,
                    "10 x 14": 2380,
                    "10 x 16": 2720,
                    "10 x 18": 3060,
                    "10 x 20": 3400,
                    "12 x 14": 2856,
                    "12 x 16": 3264,
                    "12 x 18": 3672,
                    "12 x 20": 4080,
                    "12 x 24": 4896,
                    "14 x 16": 3808,
                    "14 x 18": 4284,
                    "14 x 20": 4760,
                    "15 x 20": 5100,
                    "16 x 20": 5440,
                    "16 x 24": 6528,
                    "18 x 20": 6120,
                    "20 x 20": 6800,
                    "20 x 24": 8160,
                    "20 x 30": 10200,
                }

                if(quantity > 0 && size != "") {
                    this.price = PRICE_LIST[size] * quantity;
                    this.validPrice = true;
                } else this.price = 0;
            }
        }
    }).mount('#app')
</script>