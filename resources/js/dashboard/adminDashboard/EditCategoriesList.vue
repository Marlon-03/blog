<template>
<router-link :to="{name: 'AdminCategoriesList'}">Back</router-link>
      
    <form @submit.prevent="EditCategory">
      <label>Edit Category</label>
      <input type="text" v-model="category.name" id="name">
      <button type="submit">Create Category</button>
  
      <!-- Display validation errors if present -->
      <div v-if="validationErrors" class="error-messages">
        <p v-for="(errors, field) in validationErrors" :key="field">{{ errors.join(', ') }}</p>
      </div>
    </form>
  </template>
  
  <script>
  export default {
    emits: ['showNavbar'],
    props: ['id'],
    data() {
      return {
        category: {
          name: '',
        },
        validationErrors: null,
      };
    },
    methods: {
        EditCategory() {
        this.validationErrors = null;
        const categoryId = this.$route.params.id;
        axios.put('/api/categories/'+ categoryId, this.category)
          .then(response => {
            console.log('Response:', response.data);
            this.category = {}; 
            this.$router.push({ name: 'AdminCategoriesList' });
          })
          .catch(error => {
            console.error('Error:', error);
  
            if (error.response && error.response.status === 422) {
              // Display validation errors
              this.validationErrors = error.response.data.errors;
            }
          });
      },
    },
    mounted() {
    const categoryId = this.$route.params.id;

    axios.get('/api/categories/' + categoryId)
        .then((response) => {
            console.log(response);
            this.category = response.data;
        })
        .catch((error) => {
            console.log(error);
        });
    },
  };
  </script>