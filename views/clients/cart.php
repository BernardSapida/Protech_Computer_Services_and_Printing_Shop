<section class="my-5" id="app">
    <div class="container mb-5">
        <h2>Cart</h2>
        <p class="text-secondary">You currently have {{cart_items.length}} item(s) in your cart</p>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
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
                        <td>{{+index+1}}</td>
                        <td>{{items["date"]}}</td>
                        <td>{{items["product"]}}</td>
                        <td>{{items["quantity"]}}</td>
                        <td>{{items["price"]}}</td>
                        <td>{{items["size"]}}</td>
                        <td><button type="button" class="btn btn-danger" @click="removeRow(index)">Remove</button></td>
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
        <form class="needs-validation" @submit.prevent="submitForm" novalidate>
            <div class="row">
                <div class="col-md-8 col-sm-12 mb-4">
                    <div class="row mb-3">
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="firstname">Firstname</label>
                            <input type="text" :class="['form-control']" v-model="firstname" id="firstname" placeholder="Firstname" required/>
                            <div class="invalid-feedback">Firstname is required</div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <label class="form-label" for="lastname">Lastname</label>
                            <input type="text" :class="['form-control']" v-model="lastname" id="lastname" placeholder="Lastname" required/>
                            <div class="invalid-feedback">Lastname is required</div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" :class="['form-control']" v-model="email" id="email" placeholder="Email" required/>
                        <div class="invalid-feedback">Email is required</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="address">Address</label>
                        <input type="text" :class="['form-control']" v-model="address" id="address" placeholder="Address" required/>
                        <div class="invalid-feedback">Address is required</div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-12">
                    <h3>Order Summary</h3>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><strong>Cart Total</strong></p>
                        <p>Php 0.00</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p><strong>Delivery Fee</strong></p>
                        <p>Php 0.00</p>
                    </div>
                    <div class="d-flex justify-content-between">
                        <p><strong>Discount</strong></p>
                        <p>Php 0.00</p>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p><strong>Total</strong></p>
                        <p>Php 0.00</p>
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
        data() {
            return {
                firstname: "",
                lastname: "",
                email: "",
                address: "",
                password: "",
                confirmPassword: "",
                cart_items: []
            }
        },
        methods: {
            submitForm() {
                const FORM = document.querySelector('.needs-validation')
                FORM.classList.add('was-validated')
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
            },
        }
    }).mount('#app')
</script>