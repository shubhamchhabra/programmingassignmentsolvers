<template xmlns="http://www.w3.org/1999/html">
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <h3 class="card-title">FAQ</h3>

                            <div class="card-tools">

                                <button type="button" class="btn btn-sm btn-primary" @click="addFaq">
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
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="faq in faqs.data" :key="faq.id">

                                    <td>{{faq.id}}</td>
                                    <td>{{faq.question}}</td>
                                    <td v-if="faq.answer.length<50">{{faq.aswer}}</td>
                                    <td v-else>{{faq.answer.substring(0,50)+"..."}}</td>
                                    <td>

                                        <a href="#" @click="updateFaq(faq)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteFaq(faq.id)">
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
                            <h5 class="modal-title" v-if="editmode === false">Create New FAQ</h5>
                            <h5 class="modal-title" v-else>Edit FAQ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form @submit.prevent="editmode? update() : create()">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label>Question</label>
                                    <input class="form-control" name="question" v-model="form.question" :class="{ 'is-invalid': form.errors.has('question') }" />
                                    <has-error :form="form" field="question"></has-error>
                                </div>

                                <div class="form-group">
                                    <label>Answer</label>
                                    <textarea v-model="form.answer" type="text" name="answer" rows="4" cols="50"
                                              class="form-control" :class="{ 'is-invalid': form.errors.has('answer') }"></textarea>
                                    <has-error :form="form" field="answer"></has-error>
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
    name: "Faq",

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
        loadFaq: function(){
            axios.get('api/faq').then(({data}) => (this.faqs = data.data));
        },
        addFaq: function(){
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
                        this.loadFaq();
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

        updateFaq:function(testimonial){
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
                        this.loadFaq();
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

        deleteFaq: function(id){
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
                        this.loadFaq();
                    }).catch((data)=> {
                        Swal.fire("Failed!", data.message, "warning");
                    });
                }
            })
        },
    },

    created(){
        this.$Progress.start();
        this.loadFaq();
        this.$Progress.finish();
    }
}
</script>

<style scoped>

</style>
