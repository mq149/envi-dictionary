require("./bootstrap");

import {createApp} from "vue";
import router from './router';
import Dictionary from "./components/dictionary/Dictionary";
import {Lang} from 'laravel-vue-lang';

createApp({
    components: {
        Dictionary
    }
}).use(router)
    .use(Lang, {
        locale: 'vi',
        fallback: 'en',
    })
    .mount("#app")
