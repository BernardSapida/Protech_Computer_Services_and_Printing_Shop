<?php include_once "includes/document.inc.php" ?>

<section class="my-5">
    <div class="container">
        <div class="d-flex justify-content-center gap-5">
            <div>
                <img src="public/images/products/document.jpeg" width="500px" alt="ID">
            </div>
            <div id="app">
                <form class="needs-validation" @submit.prevent="submitForm" action="" method="POST" enctype="multipart/form-data" novalidate>
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
                        <label class="form-label" for="quantity">Type</label>
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
                            aria-label="ID Size"
                            required
                        >
                            <option value="" selected>-- Select Package --</option>
                            <option v-for="(package, index) in Object.keys(document_list)" :key="index" :value="package" >{{package}}</option>
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
                        <label class="form-label" for="document">Document</label>
                        <input
                            type="file" 
                            :class="[
                                {'is-valid': validDocument},
                                {'is-invalid': !validDocument && isSubmitted},
                                'form-control'
                            ]" 
                            name="document" 
                            id="document" 
                            @change="validatePicture" 
                            placeholder="document" 
                            required
                        />
                        <div class="invalid-feedback" v-if="!validDocument">{{errDocument}}</div>
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
                document_list: {
                    "Biodata": 15,
                    "Resume": 20,
                },
                product: "Document",
                quantity: 0,
                size: "",
                price: 0,
                document: "",
                validProductName: false,
                validQuantity: false,
                validSize: false,
                validPrice: false,
                validDocument: false,
                errQuantity: "",
                errSize: "",
                errPrice: "",
                errDocument: "",
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

                const { validProductName, validQuantity, validSize, validPrice, validDocument } = this;

                if(validProductName && validQuantity && validSize && validPrice && validDocument) {
                    swal({
                        title: "Successfully added to cart!",
                        text: "View your items in cart",
                        icon: "success",
                        button: false,
                        timer: 2000
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
                        this.errSize = "Document type is required";
                        this.validSize = false;
                    } else this.validSize = true;
                }

                this.getPrice();
            },
            validatePicture() {
                const FILE_PICTURE = document.getElementById('document').value;

                if(this.isSubmitted) {
                    if(FILE_PICTURE == "") {
                        this.errDocument = "Document is required";
                        this.validDocument = false;
                        return;
                    }

                    const FILE = FILE_PICTURE.split("C:\\fakepath\\")[1].split(".");
                    const FILE_NAME = FILE[0];
                    const FILE_EXTERNAL = FILE[1];
                    const VALID_EXTERNAL = ["docx", "pdf"];

                    if(VALID_EXTERNAL.indexOf(FILE_EXTERNAL) == -1) {
                        this.errDocument = "File external should be .docx or .pdf";
                        this.validDocument = false;
                        return;
                    }

                    this.validDocument = true;
                }
            },
            getPrice() {
                const { document_list, quantity, size } = this;

                if(quantity > 0 && size != "") {
                    this.price = document_list[size] * quantity;
                    this.validPrice = true;
                } else this.price = 0;
            }
        }
    }).mount('#app')
</script>