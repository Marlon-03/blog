<template>
    <h1>Edit Post</h1>
    <form @submit.prevent="submitPost" className="flex flex-col">
        <label for="">Title</label>
        <input type="text" v-model="posts.title" id="title">
        <br/>
        <label for="">Image</label>
        <input type="file" @input="grabFile" id="image" ref="fileInput">
        <div class="preview">
            <img v-bind:src="url" alt="">
        </div>
        <br/> 

        <label for="">Category</label>
        <select v-model="posts.category_id"  id="categories">
            <option disabled value="">Select Options</option>
            <option :value="category.id" v-for="category in categories" :key="category.id">{{ category.name }}</option>
        </select>
        <br/>

        <label for="">Body</label>
        <quill-editor theme="snow" v-model:content="posts.body" contentType="text" />
        <br/>

        <button type="submit" className="bg-blue-500 text-white px-4 py-2 rounded">Create Post</button>
        
    </form>
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
      submitPost(){
        axios.post('/api/posts', this.posts,{
            headers: {'Content-Type': 'multipart/form-data'}
        })
        .then(() =>{
          this.posts = {};
          this.url = null;
          this.posts.category_id = '';
          this.$refs.fileInput.value = ''; // Clear the file input
          this.posts.body = ''; // Clear the Quill editor
          console.log('Post created successfully');
        }
        ).catch((error) => {
            console.log(error);
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
        console.log(this.url);
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