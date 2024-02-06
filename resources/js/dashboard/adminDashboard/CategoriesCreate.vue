<template>
  <div class="mx-auto flex justify-center align-center items-center h-96">
    <form @submit.prevent="submitCategory" class="flex gap-5 justify-center items-center">
      <div>
        <label>Category Name</label>
      </div>

      <div>
        <input type="text" v-model="category.name" id="name"
        class="border border-t-1 border-l-1 border-r-1 border-b-1 border-gray-300 p-2 pl-10 focus:outline-none focus:border-[#58AB91] ">
      </div>

      <div>
        <button type="submit" class="bg-blue-500 px-2 py-2 rounded-md font-semibold text-white">Create Category</button>
      </div>

      <!-- Display validation errors if present -->
      <div v-if="validationErrors" class="error-messages">
        <p v-for="(errors, field) in validationErrors" :key="field">{{ errors.join(', ') }}</p>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  emits: ['showNavbar'],
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