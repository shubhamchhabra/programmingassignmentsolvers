<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <h3 class="card-title">Blog posts</h3>
                            <div class="card-tools">

                                <a type="button" class="btn btn-sm btn-primary" href="post/create">
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
                                <tr v-for="post in posts.data" :key="post.id">

                                    <td>{{post.title}}</td>
                                    <td>{{post.slug}}</td>
                                    <td>{{post.image_path}}</td>
                                    <td>{{post.updated_at | moment}}</td>
                                    <td>

                                        <a role="button" @click="viewPost(post)">
                                            <i class="fa fa-eye blue"></i>
                                        </a>
                                        /
                                        <a role="button" @click="editPost(post)">
                                            <i class="fa fa-edit green"></i>
                                        </a>
                                        /
                                        <a role="button" @click="deletePost(post.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <pagination :data="posts" @pagination-change-page="loadPosts"></pagination>
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
            posts:{}
        }
    },
    filters:{
      moment: function (date){
          return moment(date).format('MMMM Do YYYY');
      }
    },
    methods: {
        loadPosts: function(page = 1){
            axios.get('api/post?page=' + page).then(({data}) => (this.posts = data.data));
        },
        viewPost: function(post){
            this.$router.push({path:'post/view', query: {post:post.id}});
        },
        editPost: function(post){
           this.$router.push({path:'/post/edit',query: {post:post.id}})
        },
        deletePost: function(id){
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
                    axios.delete('api/post/'+id).then(()=>{
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Fire.$emit('AfterCreate');
                        this.loadPosts();
                    }).catch((data)=> {
                        Swal.fire("Failed!", data.message, "warning");
                    });
                }
            })
        },
    },
    created() {
        this.loadPosts();
    }
}
</script>

<style scoped>

</style>
