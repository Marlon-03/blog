<template>
    <h1>this is blog page</h1>
    <div>
    <div>
        <form  @submit.prevent>
            <input type="text" placeholder="Search" v-model="title">
            <button @click="searchPosts">Search</button>
        </form>
    </div>

    <div class="categories">
        <ul>
            <li><a href="#" @click="fetchAll()">All</a></li>
            <li v-for="category in categories" :key="category.id">
                <a href="#" @click="filterByCategory(category.name)">{{ category.name }}</a>

            </li>
        </ul>
    </div>
    <section class="cards-blog latest-blog">
        <div class="card-blog-content" v-for="post in posts" :key="post.id">
            <img :src="post.imagePath + '?' + new Date().getTime()" alt="Post image">
            <p>
            {{ post.created_at }}
            <span>Written by{{ post.user }}</span>
            </p>
            <h4>

                <router-link :to="{name: 'SingleBlog', params: {slug: post.slug},}">{{ post.title }}</router-link>
            </h4>
        </div>

    </section>
    <h3 v-if="!posts.length">NO MATCH WAS FOUND</h3>

    <div class="pagination">
        <a href="#" v-for="(link, index) in links" :key="index"
        v-html="link.label" :class="{active: link.active, disabled: !link.url}"
        @click="changePage(link)"></a>
    </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    emits: ['showNavbar'], 
    data(){
        return{
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
            })
            .catch((error) => {
                console.log(error);
            });
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