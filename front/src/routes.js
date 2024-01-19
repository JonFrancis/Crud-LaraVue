import HomePage from "./components/HomePage" 
import EditPage from "./components/EditPage" 
import AddPage from "./components/AddPage"
import {createRouter, createWebHashHistory} from "vue-router"

const routes = [
    {
        name:"HomePage",
        component: HomePage,
        path: "/",
    },
    {
        name:"AddPage",
        component: AddPage,
        path: "/add",
    },
    {
        name:"EditPage",
        component: EditPage,
        path: "/:id/edit",
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
})

export default router
