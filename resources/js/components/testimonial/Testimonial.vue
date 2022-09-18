<template xmlns="http://www.w3.org/1999/html">
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <h3 class="card-title">Testimonials</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-sm btn-primary" @click="addTestimonial">
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
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Message</th>
                                    <th>Rating</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="testimonial in testimonials.data" :key="testimonial.id">

                                    <td>{{testimonial.id}}</td>
                                    <td>{{testimonial.user.name}}</td>
                                    <td v-if="testimonial.message.length<50">{{testimonial.message}}</td>
                                    <td v-else>{{testimonial.message.substring(0,50)+"..."}}</td>
                                    <td><i class="fa fa-star yellow" v-for="index in testimonial.rating"></i></td>
                                    <td>

                                        <a href="#" @click="updateTestimonial(testimonial)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteTestimonial(testimonial.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="testimonials" @pagination-change-page="getResults"></pagination>
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
                            <h5 class="modal-title" v-if="editmode === false">Create New Testimonial</h5>
                            <h5 class="modal-title" v-else>Edit Testimonial</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="editmode? update() : create()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Rating</label>
                                    <select class="form-control" v-model="form.rating" :class="{ 'is-invalid': form.errors.has('user_id') }">
                                        <option
                                            v-for="number in 5"
                                            :value="number"
                                            :selected="number === form.rating">
                                            {{ number }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="rating"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>User</label>
                                    <select class="form-control" v-model="form.user_id" :class="{ 'is-invalid': form.errors.has('user_id') }">
                                        <option
                                            v-for="(user,index) in users" :key="index"
                                            :value="user.id"
                                            :selected="user.id === form.user_id"
                                            >{{ user.name }}</option>
                                    </select>
                                    <has-error :form="form" field="user_id"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea v-model="form.message" type="text" name="message" rows="4" cols="50"
                                           class="form-control" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
                                    <has-error :form="form" field="message"></has-error>
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
import users from "../Users";

export default {
    name: "testimonial",

    data(){
        return{
            editmode:false,
            users: [],
            testimonials: {},
            form: new Form({
                id: '',
                user_id: '',
                message: '',
                rating:'',
                created_at: '',
                updated_at:''
            }),
    }
    },
    methods:{
        getResults(page = 1) {

            this.$Progress.start();

            axios.get('api/testimonial?page=' + page).then(({ data }) => (this.testimonials = data.data));

            this.$Progress.finish();
        },
        loadTestimonial: function(){
           axios.get('api/testimonial').then(({data}) => (this.testimonials = data.data));
        },
        addTestimonial: function(){
           this.editmode = false;
            this.form.reset();
            this.form.clear();
            $('#addNew').modal('show');
        },
        loadUsers: function(){
            axios.get("api/user/list").then(({ data }) => (this.users = data));
        },
        create: function(){
            this.$Progress.start();
            this.form.post('api/testimonial')
            .then((response) => {
               if(response.data.status){
                   $('#addNew').modal('hide');
                   this.loadTestimonial();
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

        updateTestimonial:function(testimonial){
            this.form.clear();
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(testimonial);
        },
        update: function(){
            this.$Progress.start();
            this.form.put('api/testimonial/'+this.form.id)
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
                        this.loadTestimonial();
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

        deleteTestimonial: function(id){
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
                    this.form.delete('api/testimonial/'+id).then(()=>{
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Fire.$emit('AfterCreate');
                        this.loadTestimonial();
                    }).catch((data)=> {
                        Swal.fire("Failed!", data.message, "warning");
                    });
                }
            })
        },
    },

    created(){
        this.$Progress.start();
        this.loadUsers();
        this.loadTestimonial();
        this.$Progress.finish();
    }
}
</script>

<style scoped>

</style>
