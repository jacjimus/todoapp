<template>
    <div>
        <h2>Edit Task</h2>
        <form @submit="updateTask">
            <label for="title">Title</label>
            <input type="text" id="title" v-model="task.title" required>
            <label for="description">Description</label>
            <textarea id="description" v-model="task.description" required></textarea>
            <button type="submit">Update Task</button>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

export default {
    setup() {
        const route = useRoute();
        const taskId = route.params.id;
        const task = ref(null);

        // Fetch the task data from the API
        const fetchTask = async () => {
            try {
                const response = await axios.get(`/api/tasks/${taskId}`);
                task.value = response.data;
            } catch (error) {
                console.error(error);
            }
        };

        // Update the task data
        const updateTask = async () => {
            try {
                await axios.put(`/api/tasks/${taskId}`, task.value);
                // Redirect to the task details page after updating
                router.push({ name: 'tasks.show', params: { id: taskId } });
            } catch (error) {
                console.error(error);
            }
        };

        // Fetch the task data when the component is mounted
        fetchTask();

        return {
            task,
            updateTask,
        };
    },
};
</script>
