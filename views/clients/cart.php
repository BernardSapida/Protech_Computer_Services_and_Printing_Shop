<section class="my-5" id="app">
    <div class="container mb-5">
        <h2>Cart</h2>
        <p class="text-secondary">You currently have {{Object.entries(cart_items).length}} item(s) in your cart</p>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Date</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(items, index) in cart_items" :id="index" :key="index">
                        <td>{{items["date"]}}</td>
                        <td>{{items["product"]}}</td>
                        <td>{{items["quantity"]}}</td>
                        <td>{{items["price"]}}</td>
                        <td>{{items["type"] || items["size"]}}</td>
                        <td>
                            <button type="button" class="btn btn-danger mx-2" @click="removeRow(index)"><i class="fa-solid fa-trash"></i> Remove</button>
                        </td>
                    </tr>
                    <tr v-if="cart_items.length == 0">
                        <td class="text-center" colspan="7">Empty</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="container mb-5">
        <h2 class="mb-4">Personal Information</h2>
        <form class="needs-validation" @submit.prevent="submitForm" action="" method="POST" novalidate>
            <div class="row">
                <div class="col-md-8 col-sm-12 mb-4">
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
                            <label class="form-label" for="lastname">Lastname {{validLastname}}</label>
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
                        <label class="form-label" for="form2Example17">Email address</label>
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
                        <select 
                            :class="[
                                {'is-valid': validPaymentOption},
                                {'is-invalid': !validPaymentOption && isSubmitted},
                                'form-select'
                            ]"
                            name="paymentOption"
                            id="paymentOption"
                            v-model="paymentOption"
                            @change="validatePaymentOption" 
                            aria-label="Payment Option"
                            required
                        >
                            <option value="" selected>-- Select Mode of Payment --</option>
                            <option value="Onsite payment">On-site Payment</option>
                            <option value="Gcash payment">Gcash Payment</option>
                        </select>
                        <div class="invalid-feedback" v-if="!validPaymentOption">{{errPaymentOption}}</div>
                    </div>
                    <div v-if="paymentOption == 'Gcash payment'">
                        <div class="row mb-3">
                            <div class="col-md-6 col-sm-12">
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
                            <div class="col-md-6 col-sm-12">
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
                                    placeholder="Gcash number"
                                    required
                                />
                                <div class="invalid-feedback" v-if="!validGcashNumber">{{errGcashNumber}}</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="referenceNo">Payment Reference No.</label>
                            <input 
                                type="text"
                                :class="[
                                    {'is-valid': validReferenceNo},
                                    {'is-invalid': !validReferenceNo && isSubmitted},
                                    'form-control'
                                ]"
                                v-model="referenceNo"
                                name="referenceNo"
                                id="referenceNo"
                                @keyup="validateReferenceNo" 
                                placeholder="Reference number"
                                required
                            />
                            <div class="invalid-feedback" v-if="!validReferenceNo">{{errReferenceNo}}</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h3>Order Summary</h3>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><strong>Total</strong></p>
                        <p>Php {{total}}</p>
                    </div>
                    <div class="d-flex mt-3">
                        <button type="submit" class="btn btn-primary ms-auto"><i class="fa-solid fa-cart-shopping"></i>&nbsp; Checkout</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    const { createApp } = Vue

    createApp({
        created() {
            this.getCartItems();
        },
        watch: {
            paymentOption(option) {
                if(option == "Onsite payment") {
                    this.referenceNo = "None";
                    this.validGcashName = this.validGcashNumber = this.validReferenceNo = true;
                } else if (option == "Gcash payment") {
                    this.referenceNo = "";
                    this.validGcashName = this.validGcashNumber = this.validReferenceNo = false;
                }
            },
            cart_items() {
                this.total = 0;
                Object.entries(this.cart_items).forEach((item) => this.total += Number(item[1]["price"]));
            }
        },
        data() {
            return {
                firstname: "<?php echo $_SESSION["firstname"] ?>",
                lastname: "<?php echo $_SESSION["lastname"] ?>",
                email: "<?php echo $_SESSION["email"] ?>",
                address: "<?php echo $_SESSION["address"] ?>",
                paymentOption: "",
                gcashName: "<?php echo $_SESSION["gcash_name"] ?>",
                gcashNumber: "<?php echo $_SESSION["gcash_number"] ?>",
                referenceNo: "",
                validFirstname: false,
                validLastname: false,
                validEmail: false,
                validAddress: false,
                validPaymentOption: false,
                validGcashName: false,
                validGcashNumber: false,
                validReferenceNo: false,
                errFirstname: "",
                errLastname: "",
                errEmail: "",
                errAddress: "",
                errPaymentOption: "",
                errGcashName: "",
                errGcashNumber: "",
                errReferenceNo: "",
                isSubmitted: false,
                total: 0,
                cart_items: []
            }
        },
        methods: {
            submitForm() {
                const form = document.querySelector('.needs-validation')

                this.isSubmitted = true;

                this.validateFirstname();
                this.validateLastname();
                this.validateEmail();
                this.validateAddress();
                this.validatePaymentOption();
                
                if(this.paymentOption == "Gcash payment") {
                    this.validateGcashName();
                    this.validateGcashNumber();
                    this.validateReferenceNo();
                }

                const { firstname, lastname, email, address, gcashName, gcashNumber, referenceNo, cart_items, total, validFirstname, validLastname, validEmail, validAddress, validGcashName, validGcashNumber, validReferenceNo } = this;


                if(validFirstname && validLastname && validEmail && validAddress && validGcashName && validGcashNumber && validReferenceNo) {
                    if(cart_items.length == 0) {
                        swal({
                            title: "Checkout is prohibited",
                            text: "Please add items to your cart",
                            icon: "error",
                            button: false,
                            timer: 2000
                        })
                    } else {
                        swal({
                            title: "Orders are successfully checkout",
                            text: "You can check it in order status",
                            icon: "success",
                            button: false,
                            timer: 2000
                        }).then(async (okay) => {
                            let response = await axios({
                                method: 'POST',
                                url: 'includes/checkout.inc.php',
                                data: {
                                    firstname: firstname,
                                    lastname: lastname,
                                    email: email,
                                    address: address,
                                    gcashName: gcashName,
                                    gcashNumber: gcashNumber,
                                    referenceNo: referenceNo,
                                    items: cart_items,
                                    total: total
                                }
                            });

                            form.submit();
                        });
                    }
                }
            },
            removeRow(index) {
                swal("Are you sure you want to remove it?", {
                    dangerMode: true,
                    buttons: ["Cancel", "Remove"],
                }).then(async(remove) => {
                    if(remove) {
                        let response = await axios({
                            method: 'POST',
                            url: 'includes/removeCartItem.inc.php',
                            data: {
                                index: index
                            }
                        });

                        this.cart_items = response.data;
                    }
                });
            },
            async getCartItems() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/cart.inc.php'
                });

                this.cart_items = response.data;
                console.log(response.data)
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
                        this.errLastname = "Last name is invalid";
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
            validatePaymentOption() {
                const { paymentOption } = this;
                
                if(this.isSubmitted) {
                    if(paymentOption.length == 0) {
                        this.errPaymentOption = "Mode of payment is required";
                        this.validPaymentOption = false;
                    }
                    else this.validPaymentOption = true;
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
                    else if(!/^(09)[0-9]{9}$/.test(gcashNumber) && !gcashNumber.length != 11) {
                        this.errGcashNumber = "Gcash number is invalid";
                        this.validGcashNumber = false;
                    }
                    else this.validGcashNumber = true;
                }
            },
            validateReferenceNo() {
                const { referenceNo } = this;
                
                if(this.isSubmitted) {
                    if(referenceNo.length == 0) {
                        this.errReferenceNo = "Reference number is required";
                        this.validReferenceNo = false;
                    }
                    else if(referenceNo.length != 13) {
                        this.errReferenceNo = "Reference number is invalid";
                        this.validReferenceNo = false;
                    }
                    else this.validReferenceNo = true;
                }
            },
        }
    }).mount('#app')
</script>