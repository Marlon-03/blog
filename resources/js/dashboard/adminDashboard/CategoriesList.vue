<template>
<router-link :to="{name: 'Dashboard'}">Back</router-link>
   <table class="table-auto">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody v-for="category in categories" :key="category.id">
    <tr>
      <td>{{category.id}}</td>
      <td>{{category.name}}</td>
      <td>
        <router-link v-if="category.id !== undefined" :to="{ name: 'EditCategoriesList', params: { id: category.id } }">edit</router-link>
       <button v-if="category.id !== undefined" @click="deleteCategory(category.id)">delete</button>
      </td>
    </tr>
  </tbody>
</table>
</template>

<script>
export default{
  emits: ['showNavbar'],
    data(){
        return{
            categories: {
                id: '',
                name: '',
            
            }
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
    mounted(){
        axios.get('/api/categories')
        .then((response)=>{ console.log(response);
            this.categories = response.data;
        }).catch((error)=>{
            console.log(error);
        });
    },
}
</script>