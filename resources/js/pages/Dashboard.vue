<template>
    <h1>this is dashboard page</h1>
    <h1>{{ name }}</h1>
    <button @click="logout">Log Out</button>
    <router-link :to="{name: 'CreatePost'}">Create Post</router-link>
    <router-link :to="{name: 'ContributorCategoriesList'}">Category List</router-link>
    <router-link :to="{name: 'PostsList'}">Post List</router-link>
</template>

<script>
export default{
    emits: ['showNavbar'], 
    data(){
        return{
            name: '',
        };
    },
    mounted() {
    const apiToken = localStorage.getItem('apiToken');

    axios.get('/api/user', {
        headers: {
            'Authorization': `Bearer ${apiToken}`,
        }
    })
    .then((response) => {
        this.name = response.data.name;
    })
    .catch((error) => {
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