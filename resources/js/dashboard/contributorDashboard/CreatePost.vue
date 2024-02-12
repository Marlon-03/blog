<template>
  <div class="bg-[#F2F1E9] h-screen flex justify-center items-center">
  <div class="w-full flex h-screen justify-center items-center py-10">
    <form @submit.prevent="submitPost" class="w-4/5 flex flex-col justify-center py-2 px-2 my-10 bg-white">
      <h1 class="font-istok-web font-bold text-center text-4xl">Create a post</h1>
        <label class="font-semibold">Title</label>
        <input type="text" v-model="posts.title" id="title"
        class="rounded-md  border border-t-1 border-l-1 border-r-1 border-b-1 border-gray-300 p-2 focus:outline-none focus:border-[#58AB91] ">
        <br/>
        <label class="font-semibold">Image</label>
        <input type="file" @input="grabFile" id="image" ref="fileInput"
        class="rounded-md  border border-t-1 border-l-1 border-r-1 border-b-1 border-gray-300 p-2 focus:outline-none focus:border-[#58AB91] ">
        <div class="preview">
          <img :src="url" alt="">
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

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Post</button>
      
    </form>
  </div>
</div>
</template>


<script>
import { QuillEditor } from '@vueup/vue-quill'
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  // emits: ['showNavbar'],
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
          validationErrors: null,
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
  axios.post('/api/posts', this.posts, {
    headers: {'Content-Type': 'multipart/form-data'}
  })
  .then(() => {
    this.posts = {};
    this.url = null;
    this.posts.category_id = '';
    this.$refs.fileInput.value = ''; // Clear the file input
    this.posts.body = ''; // Clear the Quill editor

    // Show a success message with SweetAlert2
    Swal.fire({
      icon: 'success',
      title: 'Success',
      text: 'Post created successfully',
    });
  })
  .catch(error => {
    if (error.response && error.response.data && error.response.data.errors) {
      this.validationErrors = error.response.data.errors;

      // Show a validation error message with SweetAlert2
      Swal.fire({
        icon: 'error',
        title: 'Validation Error',
        text: 'Please correct the errors and try again.',
        footer: '<ul>' + Object.values(this.validationErrors).map(error => `<li>${error}</li>`).join('') + '</ul>'
      });
    } else {
      // Show a general error message with SweetAlert2
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'An error occurred while creating the post',
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
      },
    }
</script>

<style scoped>
.preview img{
    max-width: 100%;
    max-height: 120px;
}

</style>