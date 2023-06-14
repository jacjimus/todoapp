<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tasks</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 flex justify-between items-center">
                        <h3 class="font-semibold text-lg">Your Tasks</h3>
                        <router-link :to="{ name: 'tasks.create' }" class="text-blue-500">Create New Task</router-link>
                    </div>
                    <div class="p-6">
                        <ul>
                            <li v-for="task in tasks" :key="task.id">{{ task.title }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const tasks = ref([]);

        const fetchTasks = () => {
            axios
                .get('/api/tasks')
                .then(response => {
                    tasks.value = response.data;
                })
                .catch(error => {
                    console.error(error);
                });
        };

        onMounted(fetchTasks);

        return {
            tasks,
        };
    },
};
</script>

<style>
/* Your custom styles here */
</style>

