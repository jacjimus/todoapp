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
                        <Link :href="route('tasks.create')" :active="route().current('task.create')"
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
                                <td class="px-6 py-4 white-space-nowrap text-sm leading-5 text-gray-900">{{ task.title }}</td>
                                <td class="px-6 py-4 white-space-nowrap text-sm leading-5 text-gray-900">{{ task.description }}</td>
                                <td class="px-6 py-4 white-space-nowrap text-sm leading-5 text-gray-900">
                                    <Button @click="openModal(task)"  class="px-2 py-1 mr-2  bg-green-500  text-white rounded cursor-pointer"> View</Button>
                                    <Link :href="route('tasks.edit', {id: task.id})"  class="px-2 py-1 mr-2 bg-blue-500  text-white rounded cursor-pointer"> Edit</Link>
                                    <button @click="destroy(task.id)" class="px-2 py-1  bg-red-500  text-white rounded cursor-pointer"> Delete</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <Modal v-if="show" :task="selectedTask" @close="closeModal" />
    </AuthenticatedLayout>
</template>
 <script>
 import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
 import Modal from '@/Components/Modal.vue';
 import  ShowTask from '@/Pages/Task/TaskModal.vue';
 import { Head, Link, usePage } from '@inertiajs/vue3';
 import { Inertia } from '@inertiajs/inertia';
 import { reactive } from 'vue';

 export default {
     components: {
         AuthenticatedLayout,
         Modal,
         ShowTask,
         Head,
         Link,
     },
     props: {
         tasks: Object,
     },
     setup() {
         let showModal = reactive(false);
         let selectedTask = reactive(null);
         const destroy = (id) => {
             if(confirm('Are you sure?')) {
                 Inertia.delete(route('tasks.destroy', id))
             }
         }
         const openModal = (task) => {
             selectedTask = task;
             showModal = true;
         };

         const closeModal = () => {
             showModal = false;
             selectedTask = null;
         };

         return {
             showModal,
             selectedTask,
             destroy,
             openModal,
             closeModal,
         };
     },
 };
 </script>

