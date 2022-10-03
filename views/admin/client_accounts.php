<?php include_once "includes/adminPageRestriction.inc.php" ?>
<section class="my-5" id="app">
    <div class="container">
        <h2 class="text-center">Client Accounts</h2>
        <p class="text-center text-secondary">Clients registered accounts and date</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr tr v-for="(items, index) in table_accounts" :id="index" :key="index">
                        <td>{{items["id"]}}</td>
                        <td>
                            <img :src="'/pcsps/public/images/profile/'+items['image']" id="profile_picture" alt="profile picture" style="width: 50px;" class="rounded">
                        </td>
                        <td>{{items["firstname"]}}</td>
                        <td>{{items["lastname"]}}</td>
                        <td>{{items["email"]}}</td>
                        <td>{{items["type"]}}</td>
                        <td>{{items["status"]}}</td>
                        <td>{{items["created_at"]}}</td>
                    </tr>
                    <tr v-if="table_accounts.length == 0">
                        <td class="text-center" colspan="7">Empty</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<script>
    const {
        createApp
    } = Vue

    createApp({
        created() {
            this.getMessages();
        },
        data() {
            return {
                table_accounts: [],
                details: [],
                downloadLink: ""
            }
        },
        methods: {
            async getMessages() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/getClientAccounts.inc.php'
                });

                this.table_accounts = response.data;
            },
        }
    }).mount('#app')
</script>