<template>
    <div class="container mt-5">
        <h2 class="mb-4">Task Management</h2>

        <!-- Task Form -->
        <div class="card mb-4">
            <div class="card-header">
                <h3>{{ editingTask ? 'Edit Task' : 'Create Task' }}</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="submitTask">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" v-model="task.title" required />
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" v-model="task.description" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ editingTask ? 'Update Task' : 'Create Task' }}</button>
                    &nbsp;
                    <button type="button" class="btn btn-secondary" v-if="editingTask" @click="cancelEdit">Cancel</button>
                </form>
            </div>
        </div>

        <!-- Task List -->
        <div class="card">
            <div class="card-header">
                <h3>Task List</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item" v-for="task in tasks" :key="task.id">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>{{ task.title }}</h5>
                                <p>{{ task.description }}</p>
                            </div>
                            <div>
                                <button class="btn btn-warning btn-sm me-2" @click="editTask(task)">Edit</button>
                                <button class="btn btn-danger btn-sm" v-if="isAdmin" @click="deleteTask(task.id)">Delete</button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'TaskManagement',
    data() {
        return {
            tasks: [],
            task: {
                title: '',
                description: '',
            },
            editingTask: false,
            isAdmin: true, // Set this based on your actual admin check
        };
    },
    methods: {
        async fetchTasks() {
            try {
                const response = await this.$axios.get('tasks');
                this.tasks = response.data.data;
            } catch (error) {
                console.error('Error fetching tasks:', error);
            }
        },
        async submitTask() {
            if (this.editingTask) {
                await this.updateTask();
            } else {
                await this.createTask();
            }
        },
        async createTask() {
            try {
                const response = await this.$axios.post('tasks', this.task);
                this.tasks.unshift(response.data.data);
                this.resetTaskForm();
            } catch (error) {
                console.error('Error creating task:', error);
            }
        },
        async updateTask() {
            try {
                const response = await this.$axios.put(`tasks/${this.task.id}`, this.task);
                const index = this.tasks.findIndex(t => t.id === this.task.id);
                this.tasks[index] = response.data.data;
                this.resetTaskForm();
            } catch (error) {
                console.error('Error updating task:', error);
            }
        },
        async deleteTask(id) {
            if (confirm('Are you sure you want to delete this task?')) {
                try {
                    await this.$axios.delete(`tasks/${id}`);

                    this.tasks = this.tasks.filter(task => task.id !== id);
                } catch (error) {
                    alert(error.response.data.message);
                    console.error('Error deleting task:', error);
                }
            }
        },
        editTask(task) {
            this.task = {...task};
            this.editingTask = true;
        },
        cancelEdit() {
            this.resetTaskForm();
        },
        resetTaskForm() {
            this.task = {title: '', description: ''};
            this.editingTask = false;
        },
    },
    mounted() {
        this.fetchTasks();
    },
};
</script>

<style scoped>
/* Add any specific styles here */
</style>
