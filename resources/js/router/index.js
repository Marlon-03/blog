import { createRouter, createWebHistory } from "vue-router";

import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import Blog from '../pages/Blog.vue';
import Contact from '../pages/Contact.vue';
import Dashboard from '../pages/Dashboard.vue';
import AdminDashboard from '../pages/AdminDashboard.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import SingleBlog from '../pages/SingleBlog.vue';
import CategoriesCreate from '../dashboard/adminDashboard/CategoriesCreate.vue';
import CategoriesList from '../dashboard/adminDashboard/CategoriesList.vue';
import EditCategoriesList from '../dashboard/adminDashboard/EditCategoriesList.vue';
import ContributorCategoryLists from '../dashboard/contributorDashboard/ContributorCategoryLists.vue';
import CreatePost from '../dashboard/contributorDashboard/CreatePost.vue';
import PostsList from '../dashboard/contributorDashboard/PostList.vue';
import EditPosts from '../dashboard/contributorDashboard/EditPosts.vue';



const routes = [
    {
        path: '/',
        name: 'Home',
        component: Home,
    },
    {
        path: '/about',
        name: 'About',
        component: About,
    },
    {
        path: '/blog',
        name: 'Blog',
        component: Blog,
    },
    {
        path: '/contact',
        name: 'Contact',
        component: Contact,
    },
    {
        path: '/blog/:slug',
        name: 'SingleBlog',
        component: SingleBlog,
        props: true,
    },
    {
        path: '/login',
        name: 'Login',
        component: Login,
        meta:{requiresGuest: true}
    },
    {
        path: '/register',
        name: 'Register',
        component: Register,
        meta:{requiresGuest: true}
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta:{requiresAuth: true}
    },
    {
        path: '/adminDashboard',
        name: 'AdminDashboard',
        component: AdminDashboard,
        meta:{requiresAuth: true}
    },
    {
        path: '/categories/create',
        name: 'CategoriesCreate',
        component: CategoriesCreate,
        meta:{requiresAuth: true}
    },
    {
        path: '/categories',
        name: 'CategoriesList',
        component: CategoriesList,
        meta:{requiresAuth: true}
    },
    {
        path: '/categories/view',
        name: 'ContributorCategoryLists',
        component: ContributorCategoryLists,
        meta:{requiresAuth: true}
    },
    {
        path: '/categories/:id/edit',
        name: 'EditCategoriesList',
        component: EditCategoriesList,
        meta: { requiresAuth: true },
        props: true,
    },
    {
        path: '/posts/create',
        name: 'CreatePost',
        component: CreatePost,
        meta: { requiresAuth: true },
    },
    {
        path: '/postlists',
        name: 'PostsList',
        component: PostsList,
        meta: { requiresAuth: true },
    },
    {
        path: '/posts/:slug/edit',
        name: 'EditPosts',
        component: EditPosts,
        meta: { requiresAuth: true },
        props: true,
    }

];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from) => {
    const authenticated = localStorage.getItem("authenticated");

    if (to.meta.requiresGuest && authenticated){
        return{
            name: 'Dashboard'
        };
    }else if (to.meta.requiresAuth && !authenticated){
        return{
            name: 'Login'
        }
    }
})

export default router;

