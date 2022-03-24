import { createWebHistory, createRouter } from "vue-router";
// import NotFound from './components/NotFoundComponent';
// import Home from './components/HomeComponent';
// import About from './components/AboutComponent';
//
// import Register from './components/RegisterComponent';
// import Login from './components/LoginComponent';
//
// import Dashboard from './components/account/DashboardComponent';

const routes = [
    // {
    //     // for urls that don't exist
    //     path: "/:catchAll(.*)",
    //     name: "NotFound",
    //     component: NotFound,
    //     meta: {
    //         requiresAuth: false
    //     }
    // },
    // {
    //     path: '/',
    //     name: "Home",
    //     component: Home,
    // },
    // {
    //     path: '/about',
    //     name: "About",
    //     component: About,
    // },
    // {
    //     path: '/register',
    //     name: "Register",
    //     component: Register,
    // },
    // {
    //     path: '/login',
    //     name: "Login",
    //     component: Login,
    // },
    // {
    //     path: '/account/dashboard',
    //     name: "AccountDashboard",
    //     component: Dashboard,
    //     beforeEnter: (to, from, next) => {
    //         axios.get('/api/authenticated').then(() => {
    //             next()
    //         }).catch(() => {
    //             return next({ name: 'Login' })
    //         });
    //     }
    // },
];

const router = createRouter({
    linkExactActiveClass: 'text-dark font-weight-bold',
    history: createWebHistory(),
    routes,
});

export default router;
