import Vue from 'vue'; 
import VueRouter from 'vue-router'; 
import Home from './components/Home'
import Dashboard from './components/Admin/Dashboard'
import Auteur from './components/Admin/Auteur'
import Books from './components/Admin/Books'
import Genre from './components/Admin/Genre'
import Livres from './components/Admin/Livres'
Vue.use(VueRouter)

const routes = [
    {
        path:'/', 
        component: Home,
    },
   
    {
        path:'/dashboard', 
        name: 'dashboard',
        component: Dashboard
    },
    {
        path:'/books', 
        name: 'books',
        component: Books
    },


    {
        path:'/auteur', 
        name: 'auteur',
        component: Auteur
    },
    {
        path:'/genre', 
        name: 'genre',
        component: Genre
    },
    {
        path:'/livres', 
        name: 'livres',
        component: Livres
    }

    





]; 

const router = new VueRouter ({
    routes : routes,
    mode:'history'
}); 

export default router; 


