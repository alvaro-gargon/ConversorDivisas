<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Logo from '@/components/logo.vue'
import { tokenReactivo } from './auth';
import { computed } from 'vue';
import { logout } from './auth';

//computed en setup
const estaLogeado = computed(() => !!tokenReactivo.value)

function cerrarSesion(){
  logout();
  
}

const enlace = "/images/logo/logo-lg.svg"
const alt = "Logo app"
</script>

<template>
  <main>
    <header class="header-pagina-principal-vue">
      <div class="cajaLogo">
        <button class="botonLogo" @click="$router.push('/home')">
          <Logo :url="enlace" :texto="alt"></Logo>
        </button>
      </div>
      <h1>Álvaro García González</h1>
      <div v-if="estaLogeado" class="cajaPerfil">
        <button @click="$router.push('/'); cerrarSesion()">Cerrar sesion</button>
      </div>
    </header>

    <RouterView />
  </main>
  <footer>
      <h2>Álvaro García González</h2>
      <div class="cajaInfo">
        <p>DAW I.E.S Los Sauces</p>
      </div>
  </footer>
</template>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@400;500&display=swap');

html,
body,
#app {
  height: 100%;
  margin: 0;
}
*{
  color:#EDE9E0;
}
#app {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}

main {
  flex-grow: 1;
  background: #0E0F12;
}

.header-pagina-principal-vue {
  display: flex;
  align-content: center;
  justify-content: space-around;
  text-align: center;
  background: #0E0F12;
  border-bottom: 1px solid #252629;
  padding: 0.85rem 2rem;
  align-items: center;
}

.header-pagina-principal-vue h1 {
  font-family: 'Playfair Display', Georgia, serif;
  font-weight: 400;
  font-size: 18px;
  color: #EDE9E0;
  letter-spacing: -0.02em;
  margin: 0;
  margin-right: 14%;
}

.botonLogo{
  background: #0E0F12;
  border: 0px;
}

.botonLogo:hover{
  cursor: pointer;
}

.cajaLogo {
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 13px;
  color: #5A5856;
}

.cajaInfo {
  align-content: center;
  text-align: center;
}

.cajaInfo p {
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 11px;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: #B8955A;
  margin: 0;
}

footer {
  background: #0E0F12;
  border-top: 1px solid #252629;
  display: flex;
  justify-content: space-around;
  padding: 10px;
}

.cajaPerfil button {
  width: 160px;
  height: 40px;
  background: #16171C;
  color: #EDE9E0;
  border: 1px solid #252629;
  border-radius: 10px;
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 13px;
  font-weight: 500;
  cursor: pointer;
  transition: border-color 0.2s, background 0.2s;
}

.cajaPerfil button:hover {
  border-color: #B8955A;
  background: #1C1C22;
}
</style>