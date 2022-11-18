<template xmlns="http://www.w3.org/1999/html">
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <h3 class="card-title">Prices</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-sm btn-primary" @click="addPrice">
                                    <i class="fa fa-plus-square"></i>
                                    Add New
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="price in prices.data" :key="price.id">

                                    <td>{{price.title}}</td>
                                    <td>{{price.price}}</td>
                                    <td v-if="price.description.length<50">{{price.description}}</td>
                                    <td v-else>{{price.description.substring(0,50)+"..."}}</td>
                                    <td>

                                        <a href="#" @click="updatePrice(price)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deletePrice(price.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="prices" @pagination-change-page="getResults"></pagination>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div v-if="!$gate.isAdmin()">
                <not-found></not-found>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" v-if="editmode === false">Create New Price</h5>
                            <h5 class="modal-title" v-else>Edit Price</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="editmode? update() : create()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" name="title" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" />
                                    <has-error :form="form" field="title"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" name="price" v-model="form.price" :class="{ 'is-invalid': form.errors.has('price') }" />
                                    <has-error :form="form" field="price"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea v-model="form.description" type="text" name="description" rows="4" cols="50"
                                              class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"></textarea>
                                    <has-error :form="form" field="description"></has-error>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                                <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>


<script>
export default {
    name: "Pricing",

    data(){
        return{
            editmode:false,
            prices: {},
            form: new Form({
                id: '',
                title: '',
                price: '',
                description:'',
                created_at: '',
                updated_at:''
            }),
        }
    },

    methods:{
        getResults(page = 1) {

            this.$Progress.start();

            axios.get('api/price?page=' + page).then(({ data }) => (this.prices = data.data));

            this.$Progress.finish();
        },
        loadPrices: function(){
            axios.get('api/price').then(({data}) => (this.prices = data.data));
        },
        addPrice: function(){
            this.editmode = false;
            this.form.reset();
            this.form.clear();
            $('#addNew').modal('show');
        },
        create: function(){
            this.$Progress.start();
            this.form.post('api/price')
                .then((response) => {
                    if(response.data.status){
                        $('#addNew').modal('hide');
                        this.loadPrices();
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message,
                        });
                        this.$Progress.finish();
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: response.data.message,
                        });

                        this.$Progress.failed();
                    }
                })

                .catch(() => {
                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
        },

        updatePrice:function(price){
            this.form.clear();
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(price);
        },
        update: function(){
            this.$Progress.start();
            this.form.put('api/price/'+this.form.id)
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
                        this.loadPrices();
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
        },

        deletePrice: function(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    this.form.delete('api/price/'+id).then(()=>{
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Fire.$emit('AfterCreate');
                        this.loadPrices();
                    }).catch((data)=> {
                        Swal.fire("Failed!", data.message, "warning");
                    });
                }
            })
        },
    },

    created(){
        this.$Progress.start();
        this.loadPrices();
        this.$Progress.finish();
    }
}
</script>

<style scoped>

</style>
