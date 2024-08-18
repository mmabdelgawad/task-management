import { createRouter, createWebHistory } from 'vue-router';
import LoginComponent from './components/LoginComponent.vue';
import TaskManagement from "./components/TaskManagement.vue";

const routes = [
    {
        path: '/login',
        name: 'login',
        component: LoginComponent,
    },
    {
        path: '/tasks',
        name: 'TaskManagement',
        component: TaskManagement,
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('authToken');

    if (token && to.name === 'login') {
        next({ name: 'TaskManagement' });
    } else if (!token && to.name !== 'login') {
        next({ name: 'login' });
    } else {
        next();
    }
});

export default router;
