import { createRouter, createWebHistory } from 'vue-router';

import Dashboard from '../Pages/Dashboard.vue';
import CreateTask from '../Pages/Task/CreateTask.vue';

const routes = [
    {
        path: '/',
        name: 'dashboard',
        component: Dashboard,
    },
    {
        path: '/tasks/create',
        name: 'tasks.create',
        component: CreateTask,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
