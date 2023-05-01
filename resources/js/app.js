import './bootstrap';
import '../css/app.css';

import {createApp, markRaw} from 'vue'
import Notifications from '@kyvg/vue3-notification'
import { createPinia } from 'pinia'
import router from "./router/index.js";
import app from './app.vue'

const pinia = createPinia()
// In order to use router inside pinia stores.
pinia.use(({ store }) => {
    store.router = markRaw(router)
})

createApp(app).
    use(router).
    use(pinia).
    use(Notifications).
    mount("#app")
