/**Este archivo simplemente sirve para gestionar las vista de la aplicacion */
import { createRouter, createWebHistory } from 'vue-router'
import viewVistaPrincipal from './views/viewVistaPrincipal.vue'
import viewSinResultado from './views/viewSinResultado.vue'
import ViewLogIn from './views/viewLogIn.vue'
import ViewRegistro from './views/viewRegistro.vue'
import { estaLogeado } from './auth.js'
import ViewConversor from './views/viewConversor.vue'
import ViewHistorico from './views/viewHistorico.vue'
import ViewGestionarDivisas from './views/viewGestionarDivisas.vue'
import ViewAvatares from './views/viewAvatares.vue'
// import viewApi from './views/viewApi.vue'
// import viewComponentes from './views/viewComponentes.vue'
// import viewComponentesDinamicos from './views/viewComponentesDinamicos.vue'
const router = createRouter({
  history: createWebHistory('/'),
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
      meta: { requiresAuth: true }
    },
    {
      path: '/conversor',
      name: 'conversor',
      component: ViewConversor,
      meta: { requiresAuth: true }
    },
    {
      path: '/historico',
      name: 'historico',
      component: ViewHistorico,
      meta: { requiresAuth: true }
    },
    {
      path: '/gestionDivisas',
      name: 'gestionDivisas',
      component: ViewGestionarDivisas,
      meta: { requiresAuth: true }
    },
    {
      path: '/avatares',
      name: 'avatares',
      component: ViewAvatares,
      meta: { requiresAuth: true }
    },
     //esta tiene que ser siempre la ultima (ruta para cuando no encuentra la ruta(valga la redundancia))
    {
      path: '/:pathMatch(.*)*',
      name: 'SinResultado',
      component: viewSinResultado,
    },
  ],

  
})


//comprobacion de que ha iniciado sesion
router.beforeEach((to, from, next) => {
  if (to.meta.requiresAuth && !estaLogeado()) {
    next('/')  // mandar al login sino ha iniciado sesion
  } else {
    next()
  }
})
export default router