<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <div class="card-tools">

                                <a type="button" class="btn btn-sm btn-primary" href="/posts">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>

                        <div class="card w-75 mx-auto my-4" style="border:none;" >
                            <img :src="url" class="card-img-top" alt="..." style="max-height: 400px;">
                            <div class="card-body pb-0">
                                <p class="card-text" v-html="post.description"></p>
                                <div class="pt-0 mb-3" style="display: flex; flex-direction: row; align-items: center;">
                                        <img class="d-block" src="https://cdn-icons-png.flaticon.com/128/945/945226.png?uid=R76116723&ga=GA1.2.701253051.1658765313" height="70px" alt="">
                                    <span class="ml-3">
                                        <p class="text-sm mb-0 mt-2">{{post.user.name}}</p>
                                        <p class="text-sm mt-1">{{post.updated_at | moment}}</p>
                                    </span>
                                </div>
                            </div>

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
    name: "View",
    data(){
        return{
            post:{},
            id: this.$route.query.post,
            url:'',

        }
    },
    filters:{
        moment: function (date){
            return moment(date).format('MMMM Do YYYY');
        }
    },
    methods:{
        loadPost: function (){
            axios.get('/api/post/edit',{params:{id:this.id}})
                .then(({data}) => (this.post = data, this.url = '/post/' + data.image_path
                ))
        }
    },

    created() {
        this.loadPost()
    }

}
</script>

<style scoped>

</style>
