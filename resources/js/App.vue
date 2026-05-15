<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <main>
    <header class="header-pagina-principal-vue">
      <h1>Esta es una prueba de primer uso del framework VUE</h1>
    </header>
    <h3 style="text-align: center">
      Como se puede comprobar,esto es una SPA (single page application) ya que, aunque cambia la
      ruta en la url, en verdad seguimos en la misma página, y NO SE HA RECARGADO al cambiar la ruta
    </h3>

    <RouterView />
  </main>
  <footer>
    <RouterLink to="/"><button>Principal</button></RouterLink>
    <RouterLink to="/componentes"><button>Componentes</button></RouterLink>
    <RouterLink to="/apis"><button>APIs</button></RouterLink>
    <RouterLink to="/componentes-dinamicos"><button>Comp. Dinamicos</button></RouterLink>
  </footer>
</template>

<style>
html,
body,
#app {
  height: 100%;
  margin: 0;
}

#app {
  display: flex;
  flex-direction: column;
  min-height: 100vh;
}
main {
  flex-grow: 1;
}

.header-pagina-principal-vue {
  background-color: orange;
  text-align: center;
}

.header-pagina-principal-vue h1 {
  margin: 0;
}

footer {
  background-color: antiquewhite;
  display: flex;
  justify-content: space-around;
  padding: 10px;
}

footer button {
  width: 160px;
  height: 40px;
  background-color: orange;
  color: white;
  border: 1px solid black;
  border-radius: 10px;
}
</style>