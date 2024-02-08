<template>
  <div class="bg-[#F2F1E9] h-screen">
    <div class="mx-auto flex justify-center align-center items-center h-full">
      <form @submit.prevent="EditCategory"  class="flex  flex-col gap-5 justify-center items-center">
        <div>
        <label class="font-istok-web font-bold text-center text-4xl">Edit Category</label>
      </div>

      <div class="flex gap-5">
        <input type="text" v-model="category.name" id="name"
        class="rounded-md  border border-t-1 border-l-1 border-r-1 border-b-1 border-gray-300 p-2 focus:outline-none focus:border-[#58AB91] ">
        <button type="submit" class="bg-blue-500 px-2 py-2 rounded-md font-semibold text-white">Submit</button>
      </div>
    
      </form>
    </div>
  </div>
  </template>
  
  <script>
  import Swal from 'sweetalert2';
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
              Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Category updated successfully',
              }); 
              this.$router.push({ name: 'AdminCategoriesList' });
          })
            .catch(error => {
              if (error.response && error.response.data && error.response.data.errors) {
                this.validationErrors = error.response.data.errors;

                const errors = Object.values(this.validationErrors)
                  .flat()
                  .join('\n* ');

                Swal.fire({
                  icon: 'error',
                  title: 'Validation Errors',
                  text: '* ' + errors,
                });
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