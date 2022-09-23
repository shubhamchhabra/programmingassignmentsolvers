<template>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <h1>Update the blog post</h1>
                <form id="save-content-form" @submit.prevent="update()" enctype="application/x-www-form-urlencoded">
                    <div class="my-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            placeholder="Blog post 1" id="title"
                            v-model="title" :class="{ 'is-invalid': errors.title} " >

                        <p class="text-xs text-danger mt-1" v-if="errors.title">{{errors.title[0]}}</p>

                    </div>

                    <div class="my-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input
                            type="text"
                            class="form-control"
                            name="slug"
                            placeholder="hello-world" id="slug"
                            v-model="slug" :class="{ 'is-invalid': errors.slug} " >

                        <p class="text-xs text-danger mt-1" v-if="errors.slug">{{errors.slug[0]}}</p>
                    </div>

                    <div class="my-3">
                        <label for="image_path" class="form-label">Image</label>
                        <input
                            @change="onFileChange"
                            type="file"
                            class="form-control"
                            name="image_path"
                            id="image_path"
                            :class="{ 'is-invalid': errors.image_path} "
                        >
                        <p class="text-xs text-danger mt-1" v-if="errors.image_path">{{errors.image_path[0]}}</p>

                        <div v-if="url" class="card mt-2" style="width: 12rem; height: 100px">
                            <img :src="url" class="card-img-top" alt="..." height="90px">
                        </div>
                    </div>

                    <div class="my-3">

                        <ckeditor tag-name="textarea" row="5" :editor="editor" v-model="description"></ckeditor>

                    </div>

                    <div class="form-group text-center mt-2">
                        <button type="submit" class="w-25 btn btn-success btn-block">Publish</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>

<script>
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default {
    name: "Update.vue",
    data(){
        return{
            id: this.$route.query.post,
            post:{},
            errors:{},
            editor: ClassicEditor,
            url: null,
                image:'',
                title: '',
                slug: '',
                description: '',
                image_path: '',
        }
    },
    methods:{
        editPost: function(){
           axios.get('/api/post/edit',{params:{id:this.id}})
               .then(({data}) => (this.post = data,
                       this.title = data.title,
                       this.slug = data.slug,
                       this.image_path = data.image_path,
                       this.description = data.description,
                       this.url = '/post/'+ data.image_path
        ))
        },
        update: function (){
            let formData = new FormData();
            if(this.image !== ''){
                formData.append('image_path', this.image)
            }else{
                formData.append('image_path', this.image_path)
            }
            formData.append('title', this.title)
            formData.append('slug', this.slug)
            formData.append('description', this.description);
            formData.append('_method', 'PUT');

            axios.post('/api/post/'+this.post.id, formData,   {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            )
                .then((response) => {
                    console.log('Hello');
                        if(response.data.status){
                            Toast.fire({
                                icon: 'success',
                                title: response.data.message,
                            });

                            this.$router.push({path:'/posts'});
                            this.$Progress.finish();
                        }else{
                            Toast.fire({
                                icon: 'error',
                                title: response.data.message,
                            });
                        }
                    })
                    .catch((error) => {
                          if(error.response.status === 422){
                              this.errors = error.response.data.errors;
                          }
                            Toast.fire({
                                icon: 'error',
                                title: 'Some error occured! Please try again'
                            });

                    });
        },
        onFileChange(e) {
            this.image = e.target.files[0];
            this.image_path = this.image;
            this.url = URL.createObjectURL(this.image);
        },
    },

    created() {
        this.editPost();
    }
}
</script>

<style scoped>
#preview {
    display: flex;
    justify-content: center;
    align-items: center;
}

#preview img {
    max-width: 100%;
    max-height: 100px;
}
</style>
