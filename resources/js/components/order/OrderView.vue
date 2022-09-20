<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">View Order</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Name</th>
                                        <td>{{order.name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Email</th>
                                        <td>{{order.email}}</td>
                                    </tr>
                                    <tr>
                                        <th>User</th>
                                        <td>{{order.user.name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{order.status}}
                                            <a href="#" class="ml-2" @click="updateStatus(order)">
                                              <i class="fa fa-edit blue"></i>
                                           </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Subject</th>
                                        <td>{{order.subject}}</td>
                                    </tr>
                                    <tr>
                                        <th>Subject Title</th>
                                        <td>{{order.subject_title}}</td>
                                    </tr>
                                    <tr>
                                        <th>Deadline</th>
                                        <td>{{order.deadline}}</td>
                                    </tr>
                                    <tr>
                                        <th>TimeZone</th>
                                        <td>{{order.timezone}}</td>
                                    </tr>
                                    <tr>
                                        <th>Reference Code</th>
                                        <td>{{order.ref_code}}</td>
                                    </tr>
                                    <tr>
                                        <th>Requirement</th>
                                        <td>{{order.requirement}}</td>
                                    </tr>
                                    <tr>
                                        <th>Academic</th>
                                        <td>{{order.academic}}</td>
                                    </tr>
                                    <tr>
                                        <th>Number of pages</th>
                                        <td>{{order.no_pages}}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{order.description}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-2">
                    <div class="card">
                        <button role="button" class="btn-primary btn">Send Quotation</button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Change the Status</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="update()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" v-model="form.status" :class="{ 'is-invalid': form.errors.has('status') }">
                                        <option
                                            v-for="(status,index) in orderStatus" :key="index"
                                            :value="status"
                                            :selected="status === form.status"
                                        >{{ status }}</option>
                                    </select>
                                    <has-error :form="form" field="status"></has-error>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button  type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div v-if="!$gate.isAdmin()">
                <not-found></not-found>
            </div>

        </div>
    </section>

</template>

<script>
import order from "./Order";

export default {
    name: "OrderView",
    data(){
        return{
            order:{},
            orderStatus:['Order Submitted', 'Quote Given', 'Order Completed'],
            id: this.$route.query.order,
            form: new Form({
                status: ''
            })
        }
    },
    methods:{
        view: function (){
            axios.get('/api/view/order',{params: {id: this.id}}).then(({data}) => (this.order = data))
        },
        updateStatus: function(order){
            this.form.clear();
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(order);
        },
        update: function (){
            this.$Progress.start();
            this.form.put('/api/orders/'+this.id)
                .then((response) => {
                    if(response.data.status){
                        // success
                        $('#addNew').modal('hide');
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                        this.$Progress.finish();
                        //  Fire.$emit('AfterCreate');
                        this.editmode = false;
                        this.view();
                    }else{
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message
                        });
                        this.$Progress.finish();
                    }

                })
                .catch(() => {
                    this.$Progress.fail();
                });
        }
    },
    created(){
        this.view();
    }
}
</script>

<style scoped>

</style>
