<template>
    <div class="relative background flex items-center justify-center">
                <div class=" flex flex-col gap-y-36">
                    <div class="hero-content flex flex-col gap-y-5 items-center text-white">
                        <h1 class="font-kadwa text-8xl">Hi, I'm Marlon</h1>
                        <p class="font-istok-web text text-4xl">An aspiring web developer</p>
                    </div>
                    <div class="flex text-center mx-auto">
                        <router-link :to="{ name: 'About' }" tag="button" class="bg-transparent text-white border-4 border-white px-4 py-4 text-center mx-auto">
                        <span class="font-istok-web font-bold text-2xl">Get to know me</span></router-link>
                    </div>
                </div>
    </div>
    <div class=" bg-[#F2F1E9]">
    <div class="py-20 max-w-custom mx-auto">
        <h1 class="font-kadwa text-4xl font-bold text-center mb-10">Latest Blog Posts</h1>

        <div class="cards-blog latest-blog flex justify-around">
        <router-link class="card-blog-content flex flex-col items-center bg-white rounded-lg md:w-[350px] my-4" 
                    v-for="post in posts.slice(0, 3)" 
                    :key="post.id"
                    :to="{name: 'SingleBlog', params: {slug: post.slug}}">
            <div class="w-full blog-pic">
                <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image" class="w-full h-[200px] object-cover">
            </div>

            <div class="w-full px-5 py-5 ">
                <h4 class="font-bold">{{ post.title }}</h4>
                <div class="line-clamp-2 overflow-hidden overflow-ellipsis">
                    {{ post.body }}
                </div>
                <div class="line-1 h-px bg-[#D9D9D9] my-1.5"></div>

                <div class="flex justify-between">
                    <span>Written by {{ post.user }}</span>
                    {{ formatDate(post.created_at)}}
                </div>
            </div>
        </router-link>
        </div>
    </div>
    </div>
</template>

<script>
export default{
    emits: ['showNavbar'], 
    data(){
        return{
            posts: [],
        };
    },

    mounted(){
        axios.get('/api/home-posts')
        .then((response) => {
            this.posts = response.data.data;
        }).catch((error) => {
            console.log(error);
        });
    },

    methods: {
    formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
    }
}
}
</script> 

<style scoped>
    .background {
        background-image: url('/public/img/bike.jpg');
        background-size: cover;
        background-position: center center;
        min-height: 100vh; 
    }

    .blog-pic{
        width: 100%;
        height: 200px;
    
    }
</style>