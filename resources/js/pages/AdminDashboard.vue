<template>
    <div>
        <div class="flex justify-between items-center px-5 md:px-20 py-5">
            <h1 class="font-kadwa font-medium text-xl">Hi, Admin  {{ name }}</h1>
            <button @click="logout" class="font-kadwa font-medium text-xl bg-[#D9D9D9] px-3 py-2 rounded-md">Log Out</button>
        </div>
        <div class="line-2 h-px bg-black mt-1.5"></div>
    </div>

    <div class="bg-[#F2F1E9] h-screen">
    <div class="md:grid md:grid-cols-3 flex flex-col px-5 gap-5 lg:gap-5 xl:gap-7 justify-items-center pt-10">
        <router-link class="bg-[#58AB91] rounded-md md:min-w-[200px] lg:min-h-[90px] lg:min-w-[250px] lg:min-h-[100px] xl:min-w-[300px] xl:min-h-[150px] flex items-center justify-center"   :to="{name: 'CategoriesCreate'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <img :src="createIcon" class="w-10 h-10">
                <p class="font-istok-web font-bold text-white text-2xl">Create category</p>
            </div>
        </router-link>

        <router-link class="bg-[#58AB91] rounded-md md:min-w-[200px] lg:min-h-[90px] lg:min-w-[250px] lg:min-h-[100px] xl:min-w-[300px] xl:min-h-[150px] flex items-center justify-center"   :to="{name: 'AdminCategoriesList'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <img :src="createIcon" class="w-10 h-10">
                <p class="font-istok-web font-bold text-white text-2xl">Categories List</p>
            </div>
        </router-link>

        <router-link class="bg-[#58AB91] rounded-md md:min-w-[200px] lg:min-h-[90px] lg:min-w-[250px] lg:min-h-[100px] xl:min-w-[300px] xl:min-h-[150px] flex items-center justify-center"  :to="{name: 'AdminApprovalPosts'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <p class="font-istok-web font-bold text-white text-4xl">{{ totalCount }}</p>
                <p class="font-istok-web font-bold text-white text-2xl">Approval posts</p>
            </div>
        </router-link>

        <router-link class="bg-[#58AB91] rounded-md lg:min-w-[250px] md:min-w-[200px] lg:min-h-[90px] lg:min-h-[100px] xl:min-w-[300px] xl:min-h-[150px] flex items-center justify-center"   :to="{name: 'CreatePost'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <img :src="writeIcon" class="w-10 h-10">
                <p class="font-istok-web font-bold text-white text-2xl">Write a post</p>
            </div>
        </router-link>

        <router-link class="bg-[#58AB91] rounded-md lg:min-w-[250px] md:min-w-[200px] lg:min-h-[90px] lg:min-h-[100px] xl:min-w-[300px] xl:min-h-[150px] flex items-center justify-center"  :to="{name: 'PostsList'}">
            <div class="justify-center items-center flex-col flex px-4 py-8">
                <p class="font-istok-web font-bold text-white text-4xl">{{ postCount }}</p>
                <p class="font-istok-web font-bold text-white text-2xl">Your posts</p>
            </div>
        </router-link>
    </div>
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
            writeIcon,
            postCount: 0,
            totalCount: 0
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
    created(){
        this.fetchPostCount();

        axios.get('http://127.0.0.1:8000/api/posts/totalCount')
            .then(response => {
                this.totalCount = response.data.totalCount;
            })
            .catch(error => {
                console.error(error);
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
        },

        fetchPostCount(){
            axios.get('/api/posts/count').then((response)=>{
                this.postCount = response.data.count;
            }).catch((error)=>{
                console.log(error);
            })
        }
    }
}
</script>

