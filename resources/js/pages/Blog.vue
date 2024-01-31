<template>
<div class=" bg-[#F2F1E9]">
    <div class="py-20  max-w-custom mx-auto">
        <div class="flex justify-around bg-[#F2F1E9] pb-5">
            <div></div>

            <div class="categories">
                <ul class="flex  gap-x-4">
                    <li><a href="#" @click="fetchAll()">All</a></li>
                    <li v-for="category in categories" :key="category.id">
                        <a href="#" @click="filterByCategory(category.name)">{{ category.name }}</a>
                    </li>
                </ul>
            </div>

            <div>
                <form @submit.prevent>
                    <input type="text" v-model="title" class=" rounded-lg h-9 pl-2">
                    <button @click="searchPosts" class="text-white font-semibold ml-2 bg-[#ab5872] px-2.5 py-1.5 rounded-lg">Search</button>
                </form>
            </div>
        </div>

        <div class="cards-blog latest-blog grid-container flex justify-around">
            <div class="card-blog-content flex flex-col items-center bg-white rounded-lg md:w-[377px] my-4" v-for="post in posts.slice(0, 6)" :key="post.id">

                <div class="w-full">
                     <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image" class="w-full h-48 object-cover">
                </div>

                <div class="w-full px-5 py-5 ">
                    <h4 class="font-bold">
                        <a href="single-blog.html"></a>
                        <router-link :to="{name: 'SingleBlog', params: {slug: post.slug},}">{{ post.title }}</router-link>
                    </h4>
                    <div class="line-clamp-2 overflow-hidden overflow-ellipsis">
                    {{ post.body }}</div>
                    <div class="line-1 h-px bg-[#D9D9D9] my-1.5"></div>

                    <div class="flex justify-between">
                        <span>Written by {{ post.user }}</span>
                        {{ formatDate(post.created_at)}}
                    </div>

                </div>
            </div>
        </div> 

        <h3 v-if="!posts.length">NO MATCH WAS FOUND</h3>

        <div class="pagination flex justify-center pt-5" v-if="posts.length">
            <a href="#" v-for="(link, index) in links" :key="index"
            v-html="link.label" :class="{active: link.active, disabled: !link.url}"
            @click="changePage(link)"></a>
        </div>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import SearchIcon from '../../../public/img/search.svg';

export default{
    emits: ['showNavbar'], 
    data(){
        return{
            SearchIcon,
            posts: [],
            categories: [],
            title: '',
            links: [],
        };
    },

    methods: {
        searchPosts() {
            axios.get('api/posts', {
                params: {
                    search: this.title,
                },
            })
            .then((response) => {
                this.posts = response.data.data;
                this.links = response.data.meta.links;
            })
            .catch((error) => {
                console.log(error);
            });
        },

        formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
        },

        changePage(link){
            if(!link.url || link.active){
                return;
            }
            axios.get(link.url)
            .then((response) => {
                this.posts = response.data.data;
                this.links = response.data.meta.links;
            })
            .catch((error) => {
                console.log(error);
            });

        },

        filterByCategory(name){
            axios.get('api/posts', {
                params: {
                    category:name,
                },
            })
            .then((response) => {
                this.posts = response.data.data;
                this.links = response.data.meta.links;
            })
            .catch((error) => {
                console.log(error);
            });
        },

        fetchAll(){
            axios.get('api/posts')
            .then((response) => {
                this.posts = response.data.data;
            })
            .catch((error) => {
                console.log(error);
            });
        },

    },

    mounted(){
        axios.get('/api/posts')
        .then((response) => {
            this.posts = response.data.data;
            this.links = response.data.meta.links;
        }).catch((error) => {
            console.log(error);
        });

        axios.get('/api/categories')
        .then((response) => {
            this.categories = response.data;
        }).catch((error) => {
            console.log(error);
        });
    }
    }
</script> 

<style scoped>
.grid-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(377px, 1fr));
    gap: 1rem;
}
</style>