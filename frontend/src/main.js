import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import './assets/styles.css'; 
import WebFont from 'webfontloader';

WebFont.load({
  google: {
    families: ['Droid Sans', 'Droid Serif']
  }
});

createApp(App)
  .use(router)
  .use(store)
  .mount('#app')
