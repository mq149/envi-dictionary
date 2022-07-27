require("./bootstrap");

import {createApp} from "vue";
import router from './router';
import Dictionary from "./components/dictionary/Dictionary";

createApp({
    components: {
        Dictionary
    }
}).use(router).mount("#app");
