import Vue from 'vue'; 
import App from './components/App.vue'
import router from './routes'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import axios from 'axios'
import Swal from 'sweetalert2'
require('./bootstrap');
Vue.use(Vuetify)
window.Swal = Swal; 
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  window.Toast = Toast;
  window.Fire = new Vue();
const app = new Vue({
    el: '#app',
    vuetify : new Vuetify(),
    router,
    render: h => h(App)
});
