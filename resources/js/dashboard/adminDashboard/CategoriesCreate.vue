<template>
    <div class="bg-[#F2F1E9] h-screen">
  <div class="mx-auto flex justify-center align-center items-center h-full">
    <form @submit.prevent="submitCategory" class="flex  flex-col gap-5 justify-center items-center">
      <div>
        <label class="font-istok-web font-bold text-center text-4xl">Create a Category</label>
      </div>

      <div class="flex gap-5">
        <input type="text" v-model="category.name" id="name" placeholder="Enter a category"
        class="rounded-md  border border-t-1 border-l-1 border-r-1 border-b-1 border-gray-300 p-2 focus:outline-none focus:border-[#58AB91] ">
        <button type="submit" class="bg-blue-500 px-2 py-2 rounded-md font-semibold text-white">Create</button>
      </div>

      <!-- Display validation errors if present -->
      <div v-if="validationErrors" class="error-messages">
        <p v-for="(errors, field) in validationErrors" :key="field">{{ errors.join(', ') }}</p>
      </div>
    </form>
  </div>
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

<style scoped>
.body {
    height: 100%;
    overflow: hidden;
}
</style>