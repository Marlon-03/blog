

<template>
  <div class="bg-[#F2F1E9]">
  <div class="w-full flex justify-center items-center">
    <form @submit.prevent="submitPost" class="w-4/5 flex flex-col justify-center py-2 px-2 my-10 bg-white">
        <h1 class="font-istok-web font-bold text-center text-4xl">Edit a post</h1>
        <label class="font-semibold">Title</label>
        <input type="text" v-model="posts.title" id="title"
        class="rounded-md  border border-t-1 border-l-1 border-r-1 border-b-1 border-gray-300 p-2 focus:outline-none focus:border-[#58AB91] ">
        <br/>

        <label class="font-semibold">Image</label>
        <input type="file" @input="grabFile" id="image" ref="fileInput"
        class="rounded-md  border border-t-1 border-l-1 border-r-1 border-b-1 border-gray-300 p-2 focus:outline-none focus:border-[#58AB91] ">
        <div class="preview">
            <img v-bind:src="url" alt="">
        </div>
        <br/> 

        <label class="font-semibold">Category</label>
        <select v-model="posts.category_id"  id="categories"
        class="rounded-md  border border-t-1 border-l-1 border-r-1 border-b-1 border-gray-300 p-2 focus:outline-none focus:border-[#58AB91] ">
            <option disabled value="">Select Options</option>
            <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
        </select>
        <br/>

        <label class="font-semibold">Body</label>
        <quill-editor theme="snow" v-model:content="posts.body" contentType="text" />
        <br/>

        <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">Update Post</button>
        
    </form>
    </div>
</div>
</template>


<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  emits: ['showNavbar'],
  props: ['slug'],
  components: {
    QuillEditor
  },
  data(){
      return{
          posts:{
            category_id: '',
          },
          url: '',
          categories: [],
          }
  },

  methods: {
      grabFile(e){
          const file = e.target.files[0];
          this.posts.file = file;
          this.url = URL.createObjectURL(file);
          URL.revokeObjectURL(file);
      },
      submitPost() {
        const formData = new FormData();
        formData.append('title', this.posts.title);
        formData.append('category_id', this.posts.category_id);
        if (this.posts.file) {
            formData.append('file', this.posts.file);
        }
        formData.append('body', this.posts.body);

        formData.append('_method', 'PUT');

        axios.post('/api/posts/' + this.slug, formData, 
        {
            headers: {
            'Content-Type': 'multipart/form-data'
            },
        })
        .then((response) => {
            console.log(response);

            // Show a success message with SweetAlert2
            Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Post updated successfully',
            });

            this.$router.push({name: 'PostsList'});
        }).catch((error) => {
            console.log(error);
            this.errors = error.response.data.errors;

            if (error.response.status === 403) {
            // Show an error message with SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'You are not authorized to perform this action',
            });

            this.$router.push({name: 'PostsList'});
            } else if (error.response.data.errors) {
            // Show a validation error message with SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Validation Error',
                text: 'Please correct the errors and try again.',
                footer: '<ul>' + Object.values(this.errors).map(error => `<li>${error}</li>`).join('') + '</ul>'
            });
            } else {
            // Show a general error message with SweetAlert2
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred while updating the post',
            });
            }
        });
    },
},
  mounted() {
        axios.get('/api/categories')
        .then((response) => {
            this.categories = response.data;
        }).catch((error) => {
            console.log(error);
        });

        axios.get('/api/posts/' + this.slug)
    .then((response) => {
        this.posts = response.data.data;
        this.url = response.data.data.imagePath;
    }).catch((error) => {
        if (error.response.status === 403) {
            this.$router.push({name: 'PostsList'});
        }
    });
    },
}
</script>

<style scoped>
.preview img{
    max-width: 100%;
    max-height: 120px;
}
</style>