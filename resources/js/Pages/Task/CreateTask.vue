<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue'
import { router, useForm } from '@inertiajs/vue3'

const form = useForm({
    title: null,
    description: null,
})

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
                        <h3 class="font-semibold text-lg">Create a Tasks</h3>
                        <Link :href="route('tasks.index')" :active="route().current('task.create')"
                              class="text-blue-500 cursor-pointer">
                            Cancel
                        </Link>
                    </div>
                    <div class="p-6">

                        <form class="form-horizontal" method="post" @submit.prevent="form.post('task')">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" id="title" v-model="form.title" >
                                <div v-if="form.errors.title">{{ form.errors.title }}</div>
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" v-model="form.description" ></textarea>
                                <div v-if="form.errors.description">{{ form.errors.description }}</div>
                            </div>

                            <button type="submit" :disabled="form.processing" class="btn btn-primary">Save Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>



<style>
/* Your custom styles here */
</style>
