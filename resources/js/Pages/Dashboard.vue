<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
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
                        <Link :href="route('task.create')" :active="route().current('task.create')"
                                 class="text-blue-500 cursor-pointer">
                            Create New Task
                        </Link>
                    </div>
                    <div class="p-6">
                        <table class="table table-responsive w-100">
                            <thead>
                            <tr>
                            <th>Title</th>
                            <th>Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr  v-for="task in tasks" :key="task.id">
                                <td>{{ task.title }}</td>
                                <td>{{ task.description }}</td>
                                <td>
                                    <ResponsiveNavLink :href="route('task.show', {id: task.id})"  class="text-blue-500 cursor-pointer"> Edit Task </ResponsiveNavLink>
                                    <ResponsiveNavLink :href="route('task.delete', {id: task.id})" class="text-blue-500 cursor-pointer"> Delete Task </ResponsiveNavLink>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


