import './bootstrap';
import { createApp } from 'vue';
import App from '../js/App.vue';
import '../css/app.css'
import '../css/style.css'
import router from './router/index.js';
import store from './store'; // make sure the path is correct

createApp(App)
  .use(router)
  .use(store) // add this line
  .mount('#app');