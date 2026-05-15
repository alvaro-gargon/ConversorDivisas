<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <main>
    <header class="header-pagina-principal-vue">
      <div class="cajaLogo">
        "imagen logo"
      </div>
      <h1>Álvaro García González</h1>
      <div class="cajaInfo">
        <p>DAW I.E.S Los Sauces</p>
      </div>
    </header>

    <RouterView />
  </main>
  <footer>

  </footer>
</template>

<style scoped>
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
  display: flex;
  align-content: center;
  justify-content: space-evenly;
  background-color: orange;
  text-align: center;
}

.header-pagina-principal-vue h1 {
  /* margin: 0; */
}

.cajaInfo{
  align-content: center;
  text-align: center;
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