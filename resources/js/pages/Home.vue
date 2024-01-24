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
        <h1 class="font-kadwa text-4xl font-bold text-center">Latest Blog Posts</h1>

        <div class="cards-blog latest-blog flex justify-around">
            <div class="card-blog-content flex flex-col items-center bg-white rounded-lg"  v-for="post in posts" :key="post.id">
                <div>
                <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image" class="w-96">
                </div>

                <div>
                    <h4 class="font-bold">
                        <a href="single-blog.html"></a>
                        <router-link :to="{name: 'SingleBlog', params: {slug: post.slug},}">{{ post.title }}</router-link>
                    </h4>
                    {{ post.body }}
                    <p>
                    {{ post.created_at }}
                    <span>Written by {{ post.user }}</span>
                    </p>

                </div>
            </div>
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
</style>