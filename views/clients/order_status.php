<section class="my-5" id="app">
    <div class="container">
        <h2>Order Status</h2>
        <p class="text-secondary">Monitor your order status</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Order Number</th>
                        <th>Transaction Number</th>
                        <th>Transaction Status</th>
                        <th>Item Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(items, index) in table_items" :id="index" :key="index">
                        <td>{{index+1}}</td>
                        <td>{{items["order_number"]}}</td>
                        <td>{{items["transaction_number"]}}</td>
                        <td>{{items["transaction_status"]}}</td>
                        <td>{{items["item_status"]}}</td>
                        <td>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#viewOrderInformation" @click="getDetails(index)"><i class="fa-solid fa-file"></i> View</button>
                        </td>
                    </tr>
                    <tr v-if="table_items.length == 0">
                        <td class="text-center" colspan="7">Empty</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" id="viewOrderInformation" tabindex="-1" role="dialog" aria-labelledby="viewOrderInformation" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Order Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-dark">
                                <tr>
                                    <th>Product Name</th>
                                    <th>Detail</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-if="table_items.length > 0" v-for="(item, index) in details" :id="index" :key="index">
                                    <td>{{item["product"]}}</td>
                                    <td>{{item["size"] || item["type"]}}</td>
                                    <td>{{item["quantity"]}}</td>
                                    <td>Php {{item["price"].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")}}</td>
                                    <td>
                                        <a type="button" class="btn btn-primary" :href="downloadLink" @click="downloadLink = 'public/documents/' + item['file']" download><i class="fa-solid fa-download"></i> Download File</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    const { createApp } = Vue

    createApp({
        created() {
            this.getOrdersTable();
        },
        data() {
            return {
                table_items: [],
                details: [],
                downloadLink: ""
            }
        },
        methods: {
            async getOrdersTable() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/clientOrders.inc.php'
                });

                this.table_items = response.data;
                console.log(response.data);
            },
            async getDetails(id) {
                this.details = JSON.parse(this.table_items[id]["items"]);
            },
        }
    }).mount('#app')
</script>