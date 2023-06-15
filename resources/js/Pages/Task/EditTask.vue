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
                        <Link :href="route('tasks.index')" :active="route().current('task.edit')"
                              class="text-blue-500 cursor-pointer">
                            Cancel
                        </Link>
                    </div>
                    <div class="p-6">

                        <form class="form-horizontal" @submit.prevent="form.put(route('tasks.update', form.id))">
                            <div class="form-group">
                                <label for="title" class="block font-medium text-sm text-grey-700">Title</label>
                                <input type="text" id="title" v-model="form.title" class="block mt-1 w-full rounded">
                                <div v-if="errors.title" class="text-red-600">{{ form.errors.title }}</div>
                            </div>

                            <div class="form-group mt-4">
                                <label for="description"
                                       class="block font-medium text-sm text-grey-700">Description</label>
                                <textarea id="description" v-model="form.description"
                                          class="block mt-1 w-full rounded"></textarea>
                                <div v-if="errors.description" class="text-red-600">{{ form.errors.description }}</div>
                            </div>
                            <div class="py-4">
                                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Update
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, Link, useForm} from '@inertiajs/vue3';

export default {
    components: {
        AuthenticatedLayout,
        PrimaryButton,
        Link,
        Head
    },
    props: {
        task: Object,
        errors: Object,
    },
    setup(props) {
        const form = useForm(props.task);

        return {form}

    }
};
</script>
