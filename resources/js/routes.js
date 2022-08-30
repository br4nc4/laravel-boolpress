import VueRouter from "vue-router"

import Home from "./pages/home.vue"
import Contacts from "./pages/contacts.vue"
import PostShow from "./pages/posts/show.vue"

export const routes =[
    {path: "/", component: Home},
    {path: "/contatti", component: Contacts},
    {path: "/posts/idpost", component: PostShow},
];

/* export default new VueRouter({
    routes
}) */