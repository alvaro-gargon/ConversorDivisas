<template>
  <div class="principal">

    <div class="simbolo">◈</div>
    <h1 class="titulo">Cambio<em>X</em></h1>
    <p class="subtitulo">Conversor de divisas</p>

    <div class="divisor"></div>

    <nav class="nav-principal">
      <button class="botonNav" @click="$router.push('/conversor')">
        <span class="iconoBoton">⇄</span>
        <span class="tituloBoton">Conversor</span>
        <span class="descBoton">Tipos en tiempo real</span>
      </button>

      <button class="botonNav" @click="$router.push('/historico')">
        <span class="iconoBoton">◎</span>
        <span class="tituloBoton">Histórico</span>
        <span class="descBoton">Evolución y tendencias</span>
      </button>

      <button class="botonNav botonNavLargo" @click="$router.push('/gestionDivisas')">
        <div>
          <span class="tituloBoton">Divisas favoritas</span>
          <span class="descBoton">Gestiona tus divisas favoritas</span>
        </div>
        <span class="flechaBoton">→</span>
      </button>
    </nav>

  </div>
</template>

<script setup>
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@400;500&display=swap');

.principal {
  min-height: 100vh;
  background: #0E0F12;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  font-family: 'DM Sans', system-ui, sans-serif;
}

.simbolo {
  font-size: 28px;
  color: #B8955A;
  letter-spacing: 6px;
  margin-bottom: 1.25rem;
}

.titulo {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(2.4rem, 6vw, 3.2rem);
  font-weight: 400;
  color: #EDE9E0;
  margin: 0 0 0.4rem;
  letter-spacing: -0.02em;
}
.titulo em {
  font-style: italic;
  color: #B8955A;
}

.subtitulo {
  font-size: 11px;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: #5A5856;
  margin: 0 0 2rem;
}

.divisor {
  width: 36px;
  height: 1px;
  background: #B8955A;
  opacity: 0.35;
  margin-bottom: 2rem;
}

.nav-principal {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  width: 100%;
  max-width: 420px;
}

.botonNav {
  background: #16171C;
  border: 1px solid #252629;
  border-radius: 12px;
  padding: 1.1rem 1.25rem;
  cursor: pointer;
  text-align: left;
  display: flex;
  flex-direction: column;
  transition: border-color 0.2s, background 0.2s;
}
.botonNav:hover {
  border-color: #B8955A;
  background: #1C1C22;
}

.botonNavLargo {
  grid-column: span 2;
  flex-direction: row;
  align-items: center;
  justify-content: space-between;
  background: #B8955A;
  border-color: transparent;
}
.botonNavLargo:hover {
  background: #C9A466;
  border-color: transparent;
}
.botonNavLargo .tituloBoton { color: #0E0F12; }
.botonNavLargol .descBoton  { color: rgba(14,15,18,0.55); }

.iconoBoton {
  font-size: 18px;
  color: #B8955A;
  margin-bottom: 8px;
}
.tituloBoton {
  display: block;
  font-size: 13px;
  font-weight: 500;
  color: #EDE9E0;
  margin-bottom: 3px;
}
.descBoton {
  display: block;
  font-size: 11px;
  color: #5A5856;
}
.flechaBoton {
  font-size: 18px;
  color: #0E0F12;
  opacity: 0.5;
}
</style>