<template>
    <div>
    <div class="flex justify-between items-center px-20 py-5">
        <h1 class="font-kadwa font-medium text-xl">Hi, Admin  {{ name }}</h1>
        <button @click="logout" class="font-kadwa font-medium text-xl bg-[#D9D9D9] px-3 py-2 rounded-md">Log Out</button>
    </div>
    <div class="line-2 h-px bg-black my-1.5"></div>
    </div>

    <div class="flex flex-wrap">
        <router-link class="bg-[#58AB91] rounded-md" :to="{name: 'CategoriesCreate'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <img :src="createIcon" class="w-10 h-10">
                <p class="font-istok-web font-bold text-white text-2xl">Create category</p>
            </div>
        </router-link>

        <router-link class="bg-[#58AB91] rounded-md" :to="{name: 'AdminCategoriesList'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <img :src="createIcon" class="w-10 h-10">
                <p class="font-istok-web font-bold text-white text-2xl">Categories List</p>
            </div>
        </router-link>

        <router-link class="bg-[#58AB91] rounded-md" :to="{name: 'AdminApprovalPosts'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <img :src="createIcon" class="w-10 h-10">
                <p class="font-istok-web font-bold text-white text-2xl">Approval posts</p>
            </div>
        </router-link>

        <router-link class="bg-[#58AB91] rounded-md" :to="{name: 'CreatePost'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <img :src="createIcon" class="w-10 h-10">
                <p class="font-istok-web font-bold text-white text-2xl">Write a post</p>
            </div>
        </router-link>

        <router-link class="bg-[#58AB91] rounded-md" :to="{name: 'PostsList'}">Post Lists
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <img :src="createIcon" class="w-10 h-10">
                <p class="font-istok-web font-bold text-white text-2xl">Your posts</p>
            </div>
        </router-link>

    </div>
</template>


<script>
import createIcon from '../../../public/img/create.svg';
import notesIcon from '../../../public/img/notes.svg';
import writeIcon from '../../../public/img/write.svg';
export default{
    emits: ['showNavbar'], 
    data(){
        return{
            name: '',
            createIcon,
            notesIcon,
            writeIcon
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