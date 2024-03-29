import { createRouter, createWebHistory } from "vue-router";


// global
import Home from '../pages/Home.vue';
import About from '../pages/About.vue';
import Blog from '../pages/Blog.vue';
import Contact from '../pages/Contact.vue';
import Login from '../pages/Login.vue';
import Register from '../pages/Register.vue';
import SingleBlog from '../pages/SingleBlog.vue';
import CreatePost from '../dashboard/contributorDashboard/CreatePost.vue';
import PostsList from '../dashboard/contributorDashboard/PostList.vue';
import EditPosts from '../dashboard/contributorDashboard/EditPosts.vue';

// user
import Dashboard from '../pages/Dashboard.vue';
import ContributorCategoriesList from '../dashboard/contributorDashboard/ContributorCategoriesList.vue';

// admin
import AdminDashboard from '../pages/AdminDashboard.vue';
import AdminCategoriesList from '../dashboard/adminDashboard/AdminCategoriesList.vue';
import CategoriesCreate from '../dashboard/adminDashboard/CategoriesCreate.vue';
import EditCategoriesList from '../dashboard/adminDashboard/EditCategoriesList.vue';
import AdminApprovalPosts from '../dashboard/adminDashboard/AdminApprovalPosts.vue';

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
        path: '/posts/create',
        name: 'CreatePost',
        component: CreatePost,
        meta: { requiresAuth: true},
    },
    {
        path: '/postlists',
        name: 'PostsList',
        component: PostsList,
        meta: { requiresAuth: true,},
    },
    {
        path: '/posts/:slug/edit',
        name: 'EditPosts',
        component: EditPosts,
        meta: { requiresAuth: true,},
        props: true,
    },


    // admin
    {
        path: '/adminDashboard',
        name: 'AdminDashboard',
        component: AdminDashboard,
        meta:{requiresAuth: true, role: 'admin'}
    },
    {
        path: '/categories/create',
        name: 'CategoriesCreate',
        component: CategoriesCreate,
        meta:{requiresAuth: true, role: 'admin'}
    },
    {
        path: '/adminCategories',
        name: 'AdminCategoriesList',
        component: AdminCategoriesList,
        meta:{requiresAuth: true, role: 'admin'}
    },
    {
        path: '/categories/:id/edit',
        name: 'EditCategoriesList',
        component: EditCategoriesList,
        meta: { requiresAuth: true, role: 'admin'},
        props: true,
    },
    {
        path: '/AdminApprovalPosts',
        name: 'AdminApprovalPosts',
        component: AdminApprovalPosts,
        meta:{requiresAuth: true, role: 'admin'}
    },

    // user
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard,
        meta:{requiresAuth: true,  role: 'contributor'} 
    },
    {
        path: '/categories/view',
        name: 'ContributorCategoriesList',
        component: ContributorCategoriesList,
        meta:{requiresAuth: true, role: 'contributor'}
    },

];


const router = createRouter({
    history: createWebHistory(),
    routes,
    scrollBehavior (to, from, savedPosition) {
        if (to.hash) {
          return {
            selector: to.hash
          }
        } else if (savedPosition) {
          return savedPosition;
        } else {
          return { x: 0, y: 0 }
        }
      }
    });

router.beforeEach((to, from, next) => {
    const authenticated = localStorage.getItem("authenticated");
    const userRole = localStorage.getItem('userRole');

    if (to.meta.requiresAuth && !authenticated) {
        next({ name: 'Login' });
    } else if (to.meta.requiresGuest && authenticated) {
        next();
    } else {
        // If the route does not require a guest, check the user's role
        if (authenticated) {
            if (to.meta.role && to.meta.role !== userRole) {
                // If the route requires a specific role and the user does not have that role, redirect them
                next({ name: userRole === 'admin' ? 'AdminDashboard' : 'Dashboard' });
            } else {
                next();
            }
        } else {
            next();
        }
    }
});
export default router;

