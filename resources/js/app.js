import './bootstrap';
import { createApp } from 'vue';
import { createI18n } from 'vue-i18n'
import App from '../js/App.vue';
import '../css/app.css'
import '../css/style.css'
import router from './router/index.js';

import en from '../../src/locales/en.json';
import es from '../../src/locales/es.json';

const messages = {
  en,
  es,
};

const i18n = createI18n({
  locale: 'en', 
  fallbackLocale: 'en', 
  messages,
});

createApp(App)
  .use(router)
  .use(i18n)
  .mount('#app');