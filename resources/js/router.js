/**Este archivo simplemente sirve para gestionar las vista de la aplicacion */
import { createRouter, createWebHistory } from 'vue-router'
import viewPrincipal from './views/viewPrincipal.vue'
import viewApi from './views/viewApi.vue'
import viewComponentes from './views/viewComponentes.vue'
import viewComponentesDinamicos from './views/viewComponentesDinamicos.vue'
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'principal',
      component: viewPrincipal,
    },
    {
      path: '/componentes',
      name: 'componentes',
      component: viewComponentes,
    },
    {
      path: '/componentes-dinamicos',
      name: 'componentes-dinamicos',
      component: viewComponentesDinamicos,
    },
    {
      path: '/apis',
      name: 'apis',
      component: viewApi,
    },
  ],
})

export default router