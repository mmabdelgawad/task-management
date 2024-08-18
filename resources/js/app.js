import { createApp } from 'vue';
import router from './router.js';
import App from './App.vue';
import './bootstrap.js';
import 'bootstrap/dist/css/bootstrap.min.css';
import axios from './axios.js';

const app = createApp(App);
app.config.globalProperties.$axios = axios;

app.use(router).mount('#app');