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

                        <form class="form-horizontal" @submit.prevent="form.post(route('tasks.store'))">
                            <div class="form-group">
                                <label for="title" class="block font-medium text-sm text-grey-700">Title</label>
                                <input type="text" id="title" v-model="form.title" class="block mt-1 w-full rounded">
                                <div v-if="form.errors.title" style="color: red;">{{ form.errors.title }}</div>
                            </div>

                            <div class="form-group">
                                <label for="description" class="block font-medium text-sm text-grey-700">Description</label>
                                <textarea id="description" v-model="form.description" class="block mt-1 w-full rounded"></textarea>
                                <div v-if="form.errors.description" style="color: red;">{{ form.errors.description }}</div>
                            </div>
                            <div class="py-4">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Create
                            </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script >
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { Head, Link } from '@inertiajs/vue3';
import { reactive } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
export default {
    components: {
        AuthenticatedLayout,PrimaryButton, Head, Link
    },
    setup() {
        const form = useForm({
            title: '',
            description: '',
        })
        return { form }
    }
}

</script>


<style>
/* Your custom styles here */
</style>
