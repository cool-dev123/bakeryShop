import VueRouter from 'vue-router'

import AppBar from "@/components/layout/AppBar";
import Dashboard from "@/components/layout/Dashboard";


export default new VueRouter({
        mode: "history",
        routes: [
            {
                path: '/',
                component: AppBar
            },
            {
                path: '/dashboard',
                component: Dashboard
            }
        ]
    }
)