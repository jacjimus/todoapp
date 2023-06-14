import { createRouter, createWebHistory } from 'vue-router';

import Dashboard from '../Pages/Dashboard.vue';
import CreateTask from '../Pages/Task/CreateTask.vue';
import EditTask from '../Pages/Task/EditTask.vue';

const routes = [
    {
        path: '/dashboard',
        name: 'dashboard',
        component: Dashboard,
    },
    {
        path: '/tasks/create',
        name: 'tasks.create',
        component: CreateTask,
    },
    {
        path: '/tasks/edit/:id',
        name: 'task.edit',
        component: EditTask,
    },
    {
        path: '/tasks/delete/:id',
        name: 'tasks.delete',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
