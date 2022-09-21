<template xmlns="http://www.w3.org/1999/html">
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <h3 class="card-title">Static Pages</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-sm btn-primary" @click="addStaticPage">
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
                                    <th>Title</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="faq in faqs.data" :key="faq.id">

                                    <td>{{faq.id}}</td>
                                    <td>{{faq.title}}</td>
                                    <td>

                                        <a href="#" @click="updateStaticPage(faq)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteStaticPage(faq.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="faqs" @pagination-change-page="getResults"></pagination>
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
                            <h5 class="modal-title" v-if="editmode === false">Create New Static Page</h5>
                            <h5 class="modal-title" v-else>Edit Static Page</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="editmode? update() : create()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input class="form-control" name="title" v-model="form.question" :class="{ 'is-invalid': form.errors.has('title') }" />
                                    <has-error :form="form" field="title"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Descrtiption</label>
                                    <textarea v-model="form.answer" type="text" name="descrtiption" rows="4" cols="50"
                                              class="form-control" :class="{ 'is-invalid': form.errors.has('descrtiption') }"></textarea>
                                    <has-error :form="form" field="descrtiption"></has-error>
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
    name: "Static Page",

    data(){
        return{
            editmode:false,
            faqs: {},
            form: new Form({
                id: '',
                question: '',
                answer: '',
                created_at: '',
                updated_at:''
            }),
        }
    },
    methods:{
        getResults(page = 1) {

            this.$Progress.start();

            axios.get('api/faq?page=' + page).then(({ data }) => (this.faqs = data.data));

            this.$Progress.finish();
        },
        loadStaticPage: function(){
            axios.get('api/faq').then(({data}) => (this.faqs = data.data));
        },
        addStaticPage: function(){
            this.editmode = false;
            this.form.reset();
            this.form.clear();
            $('#addNew').modal('show');
        },
        create: function(){
            this.$Progress.start();
            this.form.post('api/faq')
                .then((response) => {
                    if(response.data.status){
                        $('#addNew').modal('hide');
                        this.loadStaticPage();
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

        updateStaticPage:function(testimonial){
            this.form.clear();
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(testimonial);
        },
        update: function(){
            this.$Progress.start();
            this.form.put('api/faq/'+this.form.id)
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
                        this.loadStaticPage();
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

        deleteStaticPage: function(id){
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
                    this.form.delete('api/faq/'+id).then(()=>{
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Fire.$emit('AfterCreate');
                        this.loadStaticPage();
                    }).catch((data)=> {
                        Swal.fire("Failed!", data.message, "warning");
                    });
                }
            })
        },
    },

    created(){
        this.$Progress.start();
        this.loadStaticPage();
        this.$Progress.finish();
    }
}
</script>

<style scoped>

</style>
