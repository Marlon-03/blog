<template>

<div class="bg-[#F2F1E9] h-screen flex justify-center items-center">
<div class="mx-auto flex justify-center align-center items-center h-96">
  <table class="table-auto bg-white">
    <thead> 
      <tr>
        <th class="border px-4 py-2">ID</th>
        <th class="border px-4 py-2">Name</th>
        <th class="border px-4 py-2">Actions</th>
      </tr>
    </thead>
    <tbody v-for="(category, index) in categories" :key="category.id" :class="index % 2 ? 'bg-green-100' : 'bg-white'" class="text-center">
      <tr>
        <td class="border px-4 py-2">{{category.id}}</td>
        <td class="border px-4 py-2">{{category.name}}</td>
        <td class="border px-4 py-2">
          <div class="gap-2 flex justify-center">
            <router-link v-if="category.id !== undefined" :to="{ name: 'EditCategoriesList', params: { id: category.id } }" class="bg-yellow-500 px-2 py-2 rounded-md">edit</router-link>
            <button v-if="category.id !== undefined" @click="deleteCategory(category.id)" class="bg-red-500 px-2 py-2 rounded-md">delete</button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>
</div>
</template>

<script>
export default{
  emits: ['showNavbar'],
    data(){
        return{
            categories: []
        }
    },
    methods:{
      deleteCategory(id) {
        Swal.fire({
          title: "Are you sure?",
          text: "You won't be able to revert this!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
            axios.delete('/api/categories/' + id)
              .then((response) => { 
                console.log(response);
                this.fetchCategories(); // Fetch the updated list after deletion
                Swal.fire({
                  title: "Deleted!",
                  text: "Your file has been deleted.",
                  icon: "success"
                });
              }).catch((error) => {
                console.log(error);
              });
          }
        });
      },
    fetchCategories() {
        axios.get('/api/categories')
        .then((response) => {
            this.categories = response.data;
        }).catch((error) => {
            console.log(error);
        });
      }
    },
    created() {
        this.fetchCategories(); // Fetch the categories when the component is created
    },
}
</script>