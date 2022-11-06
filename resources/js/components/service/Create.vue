<template  xmlns="http://www.w3.org/1999/html">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <h1>Create the service</h1>
                <form method="service" id="save-content-form" @submit.prevent="create()" enctype="multipart/form-data">
                    <div class="my-3">
                        <label for="title" class="form-label">Title</label>
                        <input
                            type="text"
                            class="form-control"
                            name="title"
                            placeholder="Blog service 1" id="title"
                            v-model="title" :class="{ 'is-invalid': errors.title} " >

                        <p class="text-xs text-danger mt-1" v-if="errors.title">{{errors.title[0]}}</p>

                    </div>

                    <div class="form-group">
                            <label>Is Featured</label>
                            <select name="is_featured" v-model="is_featured" id="is_featured" class="form-control" :class="{ 'is-invalid': errors.is_featured} ">
                                <option value="">Select User Role</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <p class="text-xs text-danger mt-1" v-if="errors.title">{{errors.is_featured[0]}}</p>

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
    name: "Create",
    data(){
        return{
            errors:{},
            editor: ClassicEditor,
            url: null,
            image:'',
            title: '',
            slug: '',
            description: '',
            image_path: '',
            is_featured : 0
        }
    },
    methods:{
        create: function (){
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            let formData = new FormData();
            formData.append('image_path', this.image)
            formData.append('title', this.title)
            formData.append('slug', this.slug)
            formData.append('description', this.description);
            formData.append('is_featured', this.is_featured);


            axios.post('/api/service/create',formData, config)
                .then((response) => {
                    console.log(response);
                    if(response.data.status){
                        Toast.fire({
                            icon: 'success',
                            title: response.data.message,
                        });
                        this.title = '';
                        this.slug = '';
                        this.image = '';
                        this.image_path = '';
                        this.description = '';

                        this.$router.push({path:'/services'});
                        this.$Progress.finish();
                    }else{
                        Toast.fire({
                            icon: 'error',
                            title: response.data.message,
                        });
                    }
                },
                (error) => {
                    if(error.response.status === 422){
                        console.log(error.response.data);
                        this.errors = error.response.data.errors;
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });
                    }

                })
                },
        onFileChange(e) {
            this.image = e.target.files[0];
            this.url = URL.createObjectURL(this.image);
        },
    },
    created() {

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
