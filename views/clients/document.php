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
                                {'is-valid': validtype},
                                {'is-invalid': !validtype && isSubmitted},
                                'form-select'
                            ]"
                            name="type"
                            id="type"
                            v-model="type"
                            @change="validatetype"
                            aria-label="ID type"
                            required
                        >
                            <option value="" selected>-- Select Document Type --</option>
                            <option v-for="(document, index) in Object.keys(document_list)" :key="index" :value="document">{{document}}</option>
                        </select>
                        <div class="invalid-feedback" v-if="!validtype">{{errtype}}</div>
                    </div>
                    <div class="mb-3 d-flex">
                        <a type="button" class="btn btn-dark ms-auto" :href="downloadLink" @click="downloadLink = 'public/files/' + type + '.docx'" download><i class="fa-solid fa-download"></i> Download {{type}}</a>
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
                downloadLink: "",
                product: "Document",
                quantity: 0,
                type: "",
                price: 0,
                document: "",
                validProductName: false,
                validQuantity: false,
                validtype: false,
                validPrice: false,
                validDocument: false,
                errQuantity: "",
                errtype: "",
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
                this.validatetype();
                this.validatePicture();

                const { validProductName, validQuantity, validtype, validPrice, validDocument } = this;

                if(validProductName && validQuantity && validtype && validPrice && validDocument) {
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
            validatetype() {
                const { type } = this;

                if(this.isSubmitted) {
                    if(type == "") {
                        this.errtype = "Document type is required";
                        this.validtype = false;
                    } else this.validtype = true;
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
                const { document_list, quantity, type } = this;

                if(quantity > 0 && type != "") {
                    this.price = document_list[type] * quantity;
                    this.validPrice = true;
                } else this.price = 0;
            }
        }
    }).mount('#app')
</script>