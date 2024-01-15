<template>
    <router-link :to="{name: 'Dashboard'}">Back</router-link>
       <table class="table-auto">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody v-for="category in categories" :key="category.id">
        <tr>
          <td>{{category.id}}</td>
          <td>{{category.name}}</td>
        
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