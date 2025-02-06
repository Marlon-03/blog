<template>
<div class="bg-[#F2F1E9] h-screen flex justify-center items-center">
  <div class="mx-auto flex justify-center align-center items-center h-96">
  <table class="table-auto bg-white">
    <thead> 
      <tr>
        <th class="border p-6">ID</th>
        <th class="border p-6">Name</th>
      </tr>
    </thead>
    <tbody v-for="(category, index) in categories" :key="category.id" :class="index % 2 ? 'bg-green-100' : 'bg-white'" class="text-center">
      <tr>
        <td class="border p-6">{{category.id}}</td>
        <td class="border p-6">{{category.name}}</td>
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