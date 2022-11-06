<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <h3 class="card-title">Services</h3>
                            <div class="card-tools">

                                <a type="button" class="btn btn-sm btn-primary" href="service/create">
                                    <i class="fa fa-plus-square"></i>
                                    Create New
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Updated at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="service in services.data" :key="service.id">

                                    <td>{{service.title}}</td>
                                    <td>{{service.slug}}</td>
                                    <td>{{service.image_path}}</td>
                                    <td>{{service.updated_at | moment}}</td>
                                    <td>

                                        <a role="button" @click="viewService(service)">
                                            <i class="fa fa-eye blue"></i>
                                        </a>
                                        /
                                        <a role="button" @click="editService(service)">
                                            <i class="fa fa-edit green"></i>
                                        </a>
                                        /
                                        <a role="button" @click="deleteService(service.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="services" @pagination-change-page="loadServices"></pagination>
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
import moment from "moment";
export default {
    name: "Index.vue",
    data(){
        return{
            services:{}
        }
    },
    filters:{
      moment: function (date){
          return moment(date).format('MMMM Do YYYY');
      }
    },
    methods: {
        loadServices: function(page = 1){
            axios.get('api/service?page=' + page).then(({data}) => (this.services = data.data));
        },
        viewService: function(service){
            this.$router.push({path:'service/view', query: {service:service.id}});
        },
        editService: function(service){
           this.$router.push({path:'/service/edit',query: {service:service.id}})
        },
        deleteService: function(id){
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
                    axios.delete('api/service/'+id).then(()=>{
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Fire.$emit('AfterCreate');
                        this.loadServices();
                    }).catch((data)=> {
                        Swal.fire("Failed!", data.message, "warning");
                    });
                }
            })
        },
    },
    created() {
        this.loadServices();
    }
}
</script>

<style scoped>

</style>
