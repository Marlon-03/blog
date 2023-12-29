<template>
    <section class="single-blog-post">
        <h1>{{ post.title }}</h1>
        <p>
            {{ post.created_at }}
            <span>Written by{{ post.user }}</span>
        </p>
        <img :src="`${post.imagePath}`" alt="">
        {{ post.body }}
    </section>
</template>

<script>
export default{
    props: ['slug'],
    data(){
        return{
            post: {},
        };
    },
    mounted(){
        axios.get('/api/posts/' + this.slug)
        .then((response) => {
            this.post = response.data.data;
        }).catch((error) => {
            console.log(error);
        });
    }
}
</script>