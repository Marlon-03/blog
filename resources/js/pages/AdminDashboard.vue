<template>
    <div>
    <div class="flex justify-between px-20 py-5">
        <h1 class="font-kadwa font-medium text-xl">Hi, Admin  {{ name }}</h1>
        <button @click="logout" class="font-kadwa font-medium text-xl">Log Out</button>
    </div>
    <div class="line-2 h-px bg-black my-1.5"></div>
    </div>

    <div>
        <div>
            <router-link :to="{name: 'CreatePost'}">Create Post</router-link>
        </div>

        <div>
            <router-link :to="{name: 'CategoriesCreate'}">Create Categories</router-link>
        </div>

        <div>
            <router-link :to="{name: 'AdminCategoriesList'}">Category List</router-link>
        </div>

        <div>
            <router-link :to="{name: 'AdminApprovalPosts'}">Approval Posts</router-link>
        </div>

        <div>
            <router-link :to="{name: 'PostsList'}">Post Lists</router-link>
        </div>
        
    </div>
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