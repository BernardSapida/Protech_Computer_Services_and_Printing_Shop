<?php include_once "includes/adminPageRestriction.inc.php" ?>
<section class="my-5" id="app">
    <div class="container my-5">
        <div class="row">
            <div class="col-md-3 col-sm-12 my-2">
                <div class="text-bg-warning p-3 rounded">
                    <p>Total Income</p>
                    <h3>Php {{this.totalIncome.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</h3>
                    <p class="text-dark"><strong>Overall Income</strong></p>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 my-2">
                <div class="text-bg-danger p-3 rounded">
                    <p>Clients</p>
                    <h3>{{totalClients}}</h3>
                    <p class="text-light"><strong>Total Clients</strong></p>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 my-2">
                <div class="text-bg-info p-3 rounded">
                    <p>Incomplete Orders</p>
                    <h3>{{totalIncompleteOrders}}</h3>
                    <p class="text-dark"><strong>Total Incomplete Orders</strong></p>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 my-2">
                <div class="text-bg-success p-3 rounded">
                    <p>Complete Orders</p>
                    <h3>{{totalCompleteOrders}}</h3>
                    <p class="text-light"><strong>Total Orders</strong></p>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h2 class="text-center">Client Orders</h2>
        <p class="text-center text-secondary">Clients orders details</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Transaction Number</th>
                        <th>Order Number</th>
                        <th>Amount</th>
                        <th>Reference No.</th>
                        <th>Transaction Status</th>
                        <th>Item Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr tr v-for="(items, index) in table_orders" :id="index" :key="index">
                        <td>{{items["id"]}}</td>
                        <td>{{items["name"]}}</td>
                        <td>{{items["transaction_number"]}}</td>
                        <td>{{items["order_number"]}}</td>
                        <td>Php {{items["total"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</td>
                        <td>{{items["reference_no"]}}</td>
                        <td>
                            <select 
                                class="form-select"
                                aria-label="Transaction Status"
                                :value="items['transaction_status']"
                                @change="updateTransactionStatus($event, items['transaction_number'])" 
                                required
                            >
                                <option value="Not paid">Not paid</option>
                                <option value="Paid">Paid</option>
                            </select>
                        </td>
                        <td>
                            <select 
                                class="form-select"
                                aria-label="Item Status"
                                :value="items['item_status']"
                                @change="updateItemStatus($event, items['transaction_number'])" 
                                required
                            >
                                <option value="Pending">Pending</option>
                                <option value="Processing">Processing</option>
                                <option value="Ready to claim">Ready to claim</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </td>
                        <td>{{items["date"]}}</td>
                    </tr>
                    <tr v-if="table_orders.length == 0">
                        <td class="text-center" colspan="7">Empty</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    const { createApp } = Vue

    createApp({
        created() {
            this.syncAllCards();
        },
        data() {
            return {
                totalIncome: 0,
                totalClients: 0,
                totalCompleteOrders: 0,
                totalIncompleteOrders: 0,
                transactionStatus: "",
                table_orders: [],
                downloadLink: ""
            }
        },
        methods: {
            async getOrders() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/adminClientOrders.inc.php'
                });

                this.table_orders = response.data;
            },
            async updateItemStatus($event, transactioNumber) {
                const selectedOption = $event.target.value;

                let response = await axios({
                    method: 'POST',
                    url: 'includes/updateItemStatus.inc.php',
                    data: {
                        transactioNumber: transactioNumber,
                        itemStatus: selectedOption,
                    }
                });
                
                window.location.reload();
            },
            async updateTransactionStatus(e, transactioNumber) {
                const selectedOption = e.target.value;

                let response = await axios({
                    method: 'POST',
                    url: 'includes/updateTransactionStatus.inc.php',
                    data: {
                        transactioNumber: transactioNumber,
                        transactionStatus: selectedOption,
                    }
                });

                window.location.reload();
            },
            async getTotalIncome() {
                total = 0;
                
                let response = await axios({
                    method: 'GET',
                    url: 'includes/totalIncome.inc.php'
                });
                
                response.data.forEach(obj => {
                    if(obj["transaction_status"] == "Paid") {
                        const entries = JSON.parse(obj['items']);
                        entries.forEach(entry => total += +entry["price"]);
                    }
                })

                this.totalIncome = total;
            },
            async getTotalClients() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/totalClients.inc.php'
                });
                
                this.totalClients = response.data.length;
            },
            async getTotalIncompleteOrders() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/totalIncompleteOrders.inc.php'
                });

                this.totalIncompleteOrders = response.data.length;
            },
            async getTotalCompleteOrders() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/totalCompleteOrders.inc.php'
                });

                this.totalCompleteOrders = response.data.length;
            },
            syncAllCards() {
                this.getOrders();
                this.getTotalIncome();
                this.getTotalClients();
                this.getTotalIncompleteOrders();
                this.getTotalCompleteOrders();
            },
        }
    }).mount('#app')
</script>