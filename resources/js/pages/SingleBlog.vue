<template>
    <div class="bg-[#F2F1E9] py-5">
    <div class="single-blog-post container mx-auto flex justify-center items-center flex-col bg-white pb-5">
        <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image" class="w-full h-[450px] object-scale-down">
        <div class="container w-4/5 flex flex-col justify-center pt-10">
            <h1 class="text-black font-bold font-istok-web text-4xl">{{ post.title }}</h1>
            <div class="flex justify-around mb-2">
                <span>Written by {{ post.user }}</span>
                <span>{{ formatDate(post.created_at)}}</span>
            </div>
            {{ post.body }}
        </div>
    </div>
</div>

<div class="bg-[#F2F1E9]">
<div class="related pb-20 max-w-custom mx-auto ">
    <div class="line-1 h-px bg-[#D9D9D9]"></div>
    <h1 class="font-kadwa text-4xl font-bold text-center mb-10 pt-5">Related Posts</h1>
    <div class="related-posts flex justify-around">
    <router-link class="card-blog-content flex flex-col items-center bg-white rounded-lg md:w-[350px] my-4" 
                v-for="relatedPost in relatedPosts.slice(0, 3)" 
                :key="relatedPost.id"
                :to="{name: 'SingleBlog', params: {slug: relatedPost.slug}}">
        <div class="w-full">
            <img :src="`${relatedPost.imagePath}`" alt="Post images" loading="lazy" class="w-full h-[200px] object-cover rounded-t">
        </div>
        <div class="w-full px-5 py-5">
            <h4 class="font-bold">{{ relatedPost.title }}</h4>
            <div class="line-clamp-2 overflow-hidden overflow-ellipsis">
                {{ relatedPost.body }}
            </div>
            <div class="line-1 h-px bg-[#D9D9D9] my-1.5"></div>
            <div class="flex justify-between">
                <span>Written by {{ relatedPost.user }}</span>
                {{ formatDate(relatedPost.created_at)}}
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
            window.scrollTo(0, 0); // Scroll to top after post data has been loaded
        }).catch((error) => {
            console.log(error);
        });

        axios.get('/api/related-posts/' + this.slug)
    .then((response) => {
        this.relatedPosts = response.data.data;
        window.scrollTo(0, 0); // Scroll to top after related posts data has been loaded
    }).catch((error) => {
        console.log(error);
    });
    },
    methods:{
        formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        },
    }
}
</script>
