<template>
    <router-link :to="{name: 'CategoriesList'}">Back</router-link>
  <form @submit.prevent="submitCategory">
    <label>Category Name</label>
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
  data() {
    return {
      category: {
        name: '',
      },
      validationErrors: null,
    };
  },
  methods: {
    submitCategory() {
      this.validationErrors = null;

      axios.post('/api/categories/create', this.category)
        .then(response => {
          console.log('Response:', response.data);
          this.category = {};  // Reset the form
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
};
</script>