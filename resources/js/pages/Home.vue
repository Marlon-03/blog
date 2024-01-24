<template>
    <div class="relative background flex items-center justify-center h-screen">
            <div class="">
                <div class=" flex flex-col gap-y-5">
                    <div class="hero-content flex flex-col gap-y-5 items-center">
                        <h1>Hi, I'm Marlon</h1>
                        <p>An aspiring web developer</p>
                    </div>

                    <router-link :to="{ name: 'About' }" tag="button" class="bg-transparent text-white border-4 border-white px-4 py-4 text-center">
                        <span class="font-istok-web font-bold text-2xl">Get to know me</span></router-link>
                </div>
            </div>
    </div>
    <section class="cards-blog latest-blog">
        <div class="card-blog-content" v-for="post in posts" :key="post.id">
            <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image">
            <p>
            {{ post.created_at }}
            <span>Written by {{ post.user }}</span>
            </p>
            <h4>
                <a href="single-blog.html"></a>
                <router-link :to="{name: 'SingleBlog', params: {slug: post.slug},}">{{ post.title }}</router-link>
            </h4>
        </div>
    </section>
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