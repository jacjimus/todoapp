<template>
    <div>
        <h2>Create New Task</h2>

        <form @submit.prevent="createTask">
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" v-model="form.title" required>
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" v-model="form.description" required></textarea>
            </div>

            <button type="submit">Save Task</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            form: {
                title: '',
                description: '',
            },
        };
    },
    methods: {
        createTask() {
            axios
                .post('/api/tasks', this.form)
                .then(response => {
                    // Handle success, e.g., show a success message or redirect to another page
                    console.log('Task created successfully:', response.data);
                })
                .catch(error => {
                    // Handle error, e.g., display error message or validation errors
                    console.error('Error creating task:', error.response.data);
                });
        },
    },
};
</script>

<style>
/* Your custom styles here */
</style>
