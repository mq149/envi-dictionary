import {createRouter, createWebHistory} from "vue-router";

import Dictionary from "../components/dictionary/Dictionary";

const routes = [
    {
        path: '/dictionary',
        name: 'Dictionary',
        component: Dictionary
    },
];

export default createRouter({
    history: createWebHistory(),
    routes
});
