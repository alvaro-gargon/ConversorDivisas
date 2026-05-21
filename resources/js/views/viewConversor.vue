<template>
  <div class="vistaConversor">

    <div class="cajaConversor">

      <div class="cabeceraTitulo">
        <span class="iconoSeccion">⇄</span>
        <h2 class="tituloSeccion">Conversor de <em>divisas</em></h2>
        <p class="subtituloSeccion">Tipos de cambio actualizados al minuto</p>
      </div>

      <div class="filaDivisas">

        <SelectorDivisa v-model="divisaOrigen"  :divisas="divisas" :favoritas="favoritas" />

        <!-- Botón intercambio -->
        <button class="botonIntercambio">⇅</button>

        <SelectorDivisa v-model="divisaDestino" :divisas="divisas" :favoritas="favoritas" />

      </div>

      <!-- Tipo de cambio -->
      <div class="filaTipoCambio">
        <span class="textoCambio">1 USD = 0,9241 EUR</span>
      </div>

      <button class="botonConvertir">
        Convertir
        <span class="flechaBoton">→</span>
      </button>

    </div>

  </div>
</template>

<script>
import divisasJson from '@/assets/divisas.json'
import SelectorDivisa from '@/components/selectorDivisa.vue'

export default {
  components: { SelectorDivisa },
  data() {
    return {
      divisaOrigen:  'USD',
      divisaDestino: 'EUR',
      favoritas:     [],
      divisas:       divisasJson
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap');

.vistaConversor {
  min-height: 100vh;
  background: #0E0F12;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 3rem 1.5rem;
  font-family: 'DM Sans', system-ui, sans-serif;
}

.cajaConversor {
  background: #16171C;
  border: 1px solid #252629;
  border-radius: 16px;
  padding: 2.5rem;
  width: 100%;
  max-width: 560px;
  box-shadow: 0 32px 64px rgba(0,0,0,0.4);
}

/* Cabecera */
.cabeceraTitulo {
  text-align: center;
  margin-bottom: 2rem;
}
.iconoSeccion {
  font-size: 22px;
  color: #B8955A;
  display: block;
  margin-bottom: 0.5rem;
}
.tituloSeccion {
  font-family: 'Playfair Display', Georgia, serif;
  font-weight: 400;
  font-size: 1.6rem;
  color: #EDE9E0;
  margin: 0 0 0.35rem;
  letter-spacing: -0.02em;
}
.tituloSeccion em {
  font-style: italic;
  color: #B8955A;
}
.subtituloSeccion {
  font-size: 12px;
  color: #5A5856;
  margin: 0;
  letter-spacing: 0.06em;
  text-transform: uppercase;
}

/* Fila divisas */
.filaDivisas {
  display: flex;
  align-items: center;
  gap: 12px;
  margin-bottom: 1.25rem;
}

/* Botón intercambio */
.botonIntercambio {
  background: #0E0F12;
  border: 1px solid #252629;
  border-radius: 50%;
  width: 36px;
  height: 36px;
  color: #B8955A;
  font-size: 16px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: border-color 0.2s, background 0.2s;
}
.botonIntercambio:hover {
  border-color: #B8955A;
  background: #1C1C22;
}

/* Tipo de cambio */
.filaTipoCambio {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.85rem 1rem;
  background: #0E0F12;
  border: 1px solid #252629;
  border-radius: 8px;
  margin-bottom: 1.5rem;
}
.textoCambio {
  font-size: 13px;
  color: #EDE9E0;
  font-weight: 500;
}

/* Botón convertir */
.botonConvertir {
  width: 100%;
  background: #B8955A;
  border: none;
  border-radius: 10px;
  padding: 13px;
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 14px;
  font-weight: 500;
  color: #0E0F12;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
  transition: opacity 0.2s;
}
.botonConvertir:hover { opacity: 0.85; }
.flechaBoton { font-size: 16px; }
</style>
