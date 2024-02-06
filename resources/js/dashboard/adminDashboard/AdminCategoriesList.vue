<template>
<div class="mx-auto flex justify-center align-center items-center h-96">
  <table class="table-auto">
    <thead> 
      <tr>
        <th class="border px-4 py-2">ID</th>
        <th class="border px-4 py-2">Name</th>
        <th class="border px-4 py-2">Actions</th>
      </tr>
    </thead>
    <tbody v-for="category in categories" :key="category.id">
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
    deleteCategory(id){
        axios.delete('/api/categories/' + id)
        .then((response)=>{ 
            console.log(response);
            this.fetchCategories(); // Fetch the updated list after deletion
        }).catch((error)=>{
            console.log(error);
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