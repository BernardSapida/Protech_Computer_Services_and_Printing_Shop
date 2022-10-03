<?php include_once "includes/adminPageRestriction.inc.php" ?>
<section class="my-5" id="app">
    <div class="container">
        <h2 class="text-center">Contact Us Messages</h2>
        <p class="text-center text-secondary">Clients feedback and question</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>
                    </tr>
                </thead>
                <tbody>
                    <tr tr v-for="(items, index) in table_messages" :id="index" :key="index">
                        <td>{{items["id"]}}</td>
                        <td>{{items["firstname"]}} {{items["lastname"]}}</td>
                        <td>{{items["email"]}}</td>
                        <td>{{items["message"]}}</td>
                    </tr>
                    <tr v-if="table_messages.length == 0">
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
                table_messages: [],
                details: [],
                downloadLink: ""
            }
        },
        methods: {
            async getMessages() {
                let response = await axios({
                    method: 'GET',
                    url: 'includes/getMessages.inc.php'
                });

                this.table_messages = response.data;
            },
        }
    }).mount('#app')
</script>