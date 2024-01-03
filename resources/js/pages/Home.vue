<template>
    <h1>this is home page</h1>
    <section class="cards-blog latest-blog">
        <div class="card-blog-content" v-for="post in posts" :key="post.id">
            <img :src="post.imagePath" alt="">
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
</style>