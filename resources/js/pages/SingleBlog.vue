<template>
    <section class="single-blog-post">
        <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image">
        <h1>{{ post.title }}</h1>
        <p>
            {{ post.created_at }}
            <span>Written by{{ post.user }}</span>
        </p>
        <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image">
        {{ post.body }}
    </section>

    <section class="related">
        <p>Related Posts</p>
        <div class="related-posts">
            <router-link v-for="relatedPost in relatedPosts" :key="relatedPost.id"
            :to="{name: 'SingleBlog', params: {slug: relatedPost.slug}}">
            <div class="related-post">
                <img :src="`${relatedPost.imagePath}`" alt="" loading="lazy">
                <h4>{{ relatedPost.title }}</h4>
            </div>
            </router-link>
        </div>

    </section>
</template>

<script>
export default{
    emits: ['showNavbar'],
    props: ['slug'],
    data(){
        return{
            post: {},
            relatedPosts: []
        };
    },
    mounted(){
        axios.get('/api/posts/' + this.slug)
        .then((response) => {
            this.post = response.data.data;
        }).catch((error) => {
            console.log(error);
        });

        axios.get('/api/related-posts/' + this.slug)
    .then((response) => {
        this.relatedPosts = response.data.data;
    }).catch((error) => {
        console.log(error);
    });
    }
}
</script>