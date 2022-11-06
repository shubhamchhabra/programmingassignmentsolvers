<template>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-12">

                    <div class="card" v-if="$gate.isAdmin()">
                        <div class="card-header">
                            <div class="card-tools">

                                <a type="button" class="btn btn-sm btn-primary" href="/services">
                                    <i class="fa fa-arrow-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>

                        <div class="card w-75 mx-auto my-4" style="border:none;" >
                            <img :src="url" class="card-img-top" alt="..." style="max-height: 400px;">
                            <div class="card-body pb-0">
                                <p class="card-text" v-html="service.description"></p>
                                <div class="pt-0 mb-3" style="display: flex; flex-direction: row; align-items: center;">
                                        <img class="d-block" src="https://cdn-icons-png.flaticon.com/128/945/945226.png?uid=R76116723&ga=GA1.2.701253051.1658765313" height="70px" alt="">
                                    <span class="ml-3">
                                        <p class="text-sm mt-1">{{service.updated_at | moment}}</p>
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
            service:{},
            id: this.$route.query.service,
            url:'',

        }
    },
    filters:{
        moment: function (date){
            return moment(date).format('MMMM Do YYYY');
        }
    },
    methods:{
        loadService: function (){
            axios.get('/api/service/edit',{params:{id:this.id}})
                .then(({data}) => (this.service = data, this.url = '/service/' + data.image_path
                ))
        }
    },

    created() {
        this.loadService()
    }

}
</script>

<style scoped>

</style>
