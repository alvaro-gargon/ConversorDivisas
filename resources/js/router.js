/**Este archivo simplemente sirve para gestionar las vista de la aplicacion */
import { createRouter, createWebHistory } from 'vue-router'
import viewVistaPrincipal from './views/viewVistaPrincipal.vue'
import viewSinResultado from './views/viewSinResultado.vue'
import ViewLogIn from './views/viewLogIn.vue'
import ViewRegistro from './views/viewRegistro.vue'
// import viewApi from './views/viewApi.vue'
// import viewComponentes from './views/viewComponentes.vue'
// import viewComponentesDinamicos from './views/viewComponentesDinamicos.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'login',
      component: ViewLogIn,
    },
    {
      path: '/registro',
      name: 'registrarse',
      component: ViewRegistro,
    },
    {
      path: '/home',
      name: 'principal',
      component: viewVistaPrincipal,
    },
    // {
    //   path: '/componentes',
    //   name: 'componentes',
    //   component: viewComponentes,
    // },
    // {
    //   path: '/componentes-dinamicos',
    //   name: 'componentes-dinamicos',
    //   component: viewComponentesDinamicos,
    // },
    // {
    //   path: '/apis',
    //   name: 'apis',
    //   component: viewApi,
    // },
     //esta tiene que ser siempre la ultima (ruta para cuando no encuentra la ruta(valga la redundancia))
    {
      path: '/:pathMatch(.*)*',
      name: 'SinResultado',
      component: viewSinResultado,
    },
  ],
})

export default router