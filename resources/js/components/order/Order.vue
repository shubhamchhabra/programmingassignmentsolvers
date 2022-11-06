<template xmlns="http://www.w3.org/1999/html">
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">
                    <!-- v-if="$gate.isAdmin()" -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subject</th>
                                    <th>Status</th>
                                    <th>Deadline</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="order in orders.data" :key="order.id">

                                    <td>{{order.name}}</td>
                                    <td>{{order.email}}</td>
                                    <td>{{order.subject}}</td>
                                    <td>{{order.status}}</td>
                                    <td>{{order.deadline}}</td>
                                    <td>

                                        <a role="button" @click="viewOrder(order)">
                                            <i class="fa fa-eye blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="orders" @pagination-change-page="loadOrders"></pagination>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div v-if="!$gate.isAdmin()">
                <not-found></not-found>
            </div>

        </div>
    </section>
</template>


<script>
export default {
    name:'Order',
    data(){
        return{
            orders:{}
        }
    },
    methods: {
       loadOrders: function(page = 1){
           axios.get('api/orders?page=' + page).then(({data}) => (this.orders = data.data));
       },
        viewOrder: function(order){
           this.$router.push({name:'order/view', query: {order:order.id}});
        }
    },
    created() {
        this.loadOrders();
    }
}
</script>

<style scoped>

</style>
