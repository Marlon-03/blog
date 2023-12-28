<template>
  <div>
    <h1>Create Post</h1>
    <form @submit.prevent="submitPost" class="flex flex-row">
      <div>
        <label for="title">Title</label>
        <input type="text" id="title" v-model="post.title">
        
        <label for="image">Image</label>
        <input type="file" id="image" @change="grabFile">
        <div class="preview">
          <img :src="url" alt="">
        </div>

        <label for="categories">Category</label>
        <select v-model="post.category_id" id="categories">
          <option disabled value="">Select Options</option>
          <option :value="category.id" v-for="category in categories" :key="category.id">{{category.name}}</option>
        </select>

        <label for="content">Content</label>
        <quill-editor v-model:content="post.body" contentType="html" />
        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Create Post</button>
      </div>
    </form>
  </div>
</template>

<script>
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';

export default {
  components: {
    QuillEditor
  },
  data() {
    return {
      post: {
        title: '',
        file: null,
        category_id: '',
        body: ''
      },
      url: '',
      categories: []
    };
  },
  methods: {
    grabFile(e) {
      const file = e.target.files[0];
      this.post.file = file;
      this.url = URL.createObjectURL(file);
      URL.revokeObjectURL(file);
    },
    submitPost() {
      axios.post('/api/posts',this.post,{
        headers: {'content-type': 'multipart/form-data'},
        
      })
        .then(() =>{
          this.post = {};
          this.url = null;
          this.post.file = null;
          this.post.category_id = '';
          this.post.body = '';
          console.log('post created');
      })
        .catch((error)=>
        this.errors = error.response.data.errors);
    }
  },
  mounted() {
    // Fetch categories
    axios.get('/api/categories')
      .then((response) => {
        this.categories = response.data;
      })
      .catch((error) => {
        console.error(error);
      });
  }
};
</script>

<style scoped>
.preview img {
  max-width: 100%;
  max-height: 120px;
}
</style>
