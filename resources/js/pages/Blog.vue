<template>
<div class=" bg-[#F2F1E9]">
    <div class="py-10  max-w-custom mx-auto">
        <div class="flex flex-col sm:flex-row justify-around items-center bg-[#F2F1E9] pb-5 gap-y-4 sm:gap-y-0">
            <div></div>

            <div class="categories">
                <ul class="categories-list flex gap-x-4 text-white font-semibold">
                <li>
                    <a href="#" 
                    @click="fetchAll()" 
                    :class="{ 'active-category': activeCategory === null, 'px-2.5 py-1.5 rounded-lg': true }"
                    >
                    All
                    </a>
                </li>
                <li v-for="category in categories" :key="category.id">
                    <a href="#" 
                    @click="filterByCategory(category.name)" 
                    :class="{ 'active-category': activeCategory === category.name, 'px-2.5 py-1.5 rounded-lg': true }"
                    >
                    {{ category.name }}
                    </a>
                </li>
                </ul>
            </div>

            <div>
                <form @submit.prevent>
                <input type="text" v-model="title" class="rounded-lg h-9 pl-2">
                <button @click="searchPosts" class="text-white font-semibold ml-2 bg-[#ab5872] px-2.5 py-1.5 rounded-lg">Search</button>
                </form>
            </div>
        </div>

        <div class="cards-blog latest-blog flex flex-wrap justify-around px-3 py-3">
  <router-link class="card-blog-content flex flex-col items-center bg-white rounded-lg xl:w-[350px] lg:w-[300px] md:w-[230px] w-full sm:w-1/3 my-4" 
               v-for="post in posts.slice(0, 6)" 
               :key="post.id"
               :to="{name: 'SingleBlog', params: {slug: post.slug}}">
    <div class="w-full blog-pic">
      <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image" class="w-full h-[200px] object-cover">
    </div>

    <div class="w-full px-5 py-5 ">
      <h4 class="font-bold">{{ post.title }}</h4>
      <div class="line-clamp-2 overflow-hidden overflow-ellipsis text-sm">
        {{ post.body }}
      </div>
      <div class="line-1 h-px bg-[#D9D9D9] my-1.5"></div>

      <div class="flex justify-between">
        <span class="sm:text-xs">Written by {{ post.user }}</span>
        <span class="sm:text-xs">{{ formatDate(post.created_at)}}</span>
      </div>
    </div>
  </router-link>
</div>
        <h3 v-if="!posts.length">NO MATCH WAS FOUND</h3>

        <div class="pagination flex justify-center gap-x-4 pt-5" v-if="posts.length">
            <a href="#" v-for="(link, index) in links" :key="index"
            v-html="link.label" :class="{active: link.active, disabled: !link.url,'px-2.5 py-1.5 rounded-sm': true }"
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
            activeCategory: null,
            
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
            this.activeCategory = name;
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
            this.activeCategory = null;
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

.categories-list .active-category {
    background-color: #6BBFA5;
}
.categories-list a {
    background-color: rgba(107, 191, 165, 0.6);
}

.active {
    background-color: #58AB91;
}
.disabled {
    background-color: #D9D9D9;
}

</style>