<template>
    <h1>this is dashboard page</h1>
    <h1>{{ name }}</h1>
    <button @click="logout">Log Out</button>
    <router-link :to="{name: 'CreatePost'}">Create Post</router-link>
    <Router-link :to="{name: 'CategoriesCreate'}">Create Categories</Router-link>
    <Router-link :to="{name: 'CategoriesList'}">Category List</Router-link>
</template>

<script>
export default{
    emits: ['showNavbar'], 
    data(){
        return{
            name: '',
        };
    },
    mounted(){
        axios.get('/api/user').then((response)=>{
            this.name =response.data.name;
        }).catch((error)=>{
            console.log(error);
        });
    },
    methods:{
        logout(){
            axios.post('/api/logout').then((response)=>{
                this.$router.push({name: 'Home'});
                localStorage.removeItem('authenticated');
                this.$emit('showNavbar');
            }).catch((error)=>{
                console.log(error);
            })
        }
    }
}
</script>