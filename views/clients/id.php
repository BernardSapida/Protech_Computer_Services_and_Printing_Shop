<?php include_once "includes/clientPageRestriction.inc.php" ?>
<?php include_once "includes/id.inc.php" ?>

<section class="my-5">
    <div class="container">
        <div class="d-flex justify-content-center gap-5">
            <div>
                <img src="public/images/products/id.jpg" width="500px" alt="ID">
            </div>
            <div id="app">
                <form class="needs-validation" @submit.prevent="submitForm" action="" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="mb-3">
                        <label class="form-label" for="product">Product Name</label>
                        <input type="text" :class="[
                                {'is-valid': validProductName},
                                'form-control'
                            ]" v-model="product" name="product" id="product" placeholder="Product Name" style="pointer-events: none;" required />
                        <div class="invalid-feedback">Product name is required</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantity">Quantity</label>
                        <input type="number" :class="[
                                {'is-valid': validQuantity},
                                {'is-invalid': !validQuantity && isSubmitted},
                                'form-control'
                            ]" v-model="quantity" name="quantity" id="quantity" @keyup="validateQuantity" placeholder="Quantity" required />
                        <div class="invalid-feedback" v-if="!validQuantity">{{errQuantity}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="quantity">Package</label>
                        <select :class="[
                                {'is-valid': validSize},
                                {'is-invalid': !validSize && isSubmitted},
                                'form-select'
                            ]" name="size" id="size" v-model="size" @change="validateSize" aria-label="ID Size" required>
                            <option value="" selected>-- Select Package --</option>
                            <option v-for="(package, index) in Object.keys(package_list)" :key="index" :value="package">{{package}}</option>
                        </select>
                        <div class="invalid-feedback" v-if="!validSize">{{errSize}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="price">Price</label>
                        <input type="number" :class="[
                                {'is-valid': validPrice && isSubmitted},
                                {'is-invalid': !validPrice && isSubmitted},
                                'form-control'
                            ]" v-model="price" name="price" id="price" placeholder="Price" style="pointer-events: none;" required />
                        <div class="invalid-feedback" v-if="!validPrice">{{errPrice}}</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="picture">ID Picture</label>
                        <input type="file" :class="[
                                {'is-valid': validPicture},
                                {'is-invalid': !validPicture && isSubmitted},
                                'form-control'
                            ]" name="picture" id="picture" @change="validatePicture" placeholder="Picture" required />
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
    const {
        createApp
    } = Vue

    createApp({
        data() {
            return {
                package_list: {
                    "PACKAGE 1: 3pcs 2x2 & 3pcs 1x1": 40,
                    "PACKAGE 2: 4pcs 2x2 & 4pcs 1x1": 50,
                    "PACKAGE 3: 3pcs 2x2": 30,
                    "PACKAGE 4: 6pcs Passport Size": 50,
                    "PACKAGE 5: 8pcs Passport Size": 60,
                    "PACKAGE 6: 2pcs Passport Size & 2pcs 1x1": 30,
                    "PACKAGE 7: 12pcs Passport Size & 16pcs 1x1": 150,
                    "PACKAGE 8: 16pc Passport Size": 130,
                },
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

                const {
                    validProductName,
                    validQuantity,
                    validSize,
                    validPrice,
                    validPicture
                } = this;

                if (validProductName && validQuantity && validSize && validPrice && validPicture) {
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
                const {
                    quantity
                } = this;

                if (this.isSubmitted) {
                    if (quantity <= 0) {
                        this.errQuantity = "Quantity is required";
                        this.errPrice = "Answer all required fields";
                        this.validPrice = false;
                        this.validQuantity = false;
                    } else this.validQuantity = true;
                }

                this.getPrice();
            },
            validateSize() {
                const {
                    size
                } = this;

                if (this.isSubmitted) {
                    if (size == "") {
                        this.errSize = "ID picture size is required";
                        this.validSize = false;
                    } else this.validSize = true;
                }

                this.getPrice();
            },
            validatePicture() {
                const FILE_PICTURE = document.getElementById('picture').value;

                if (this.isSubmitted) {
                    if (FILE_PICTURE == "") {
                        this.errPicture = "ID picture is required";
                        this.validPicture = false;
                        return;
                    }

                    const FILE = FILE_PICTURE.split("C:\\fakepath\\")[1].split(".");
                    const FILE_NAME = FILE[0];
                    const FILE_EXTERNAL = FILE[1];
                    const VALID_EXTERNAL = ["jpg", "jpeg", "png"];

                    if (VALID_EXTERNAL.indexOf(FILE_EXTERNAL) == -1) {
                        this.errPicture = "File external should be .jpg, .jpeg, or .png";
                        this.validPicture = false;
                        return;
                    }

                    this.validPicture = true;
                }
            },
            getPrice() {
                const {
                    package_list,
                    quantity,
                    size
                } = this;

                if (quantity > 0 && size != "") {
                    this.price = package_list[size] * quantity;
                    this.validPrice = true;
                } else this.price = 0;
            }
        }
    }).mount('#app')
</script>