<template>
  <div class="vistaConversor">

    <div class="cajaConversor">

      <div class="cabeceraTitulo">
        <span class="iconoSeccion">⇄</span>
        <h2 class="tituloSeccion">Conversor de <em>divisas</em></h2>
        <p class="subtituloSeccion">Tipos de cambio actualizados al minuto</p>
      </div>

      <div class="filaDivisas">

        <div class="cajaInputDivisa">
          <label class="etiquetaCampo">Divisa origen</label>
          <SelectorDivisa v-model="divisaOrigen" :divisas="divisas" :favoritas="favoritos" />
          <div class="campoValor">
            <span class="valorDivisa">1</span>
            <span class="sufijoDivisa">{{ divisaOrigen }}</span>
          </div>
        </div>

        <button class="botonIntercambio" @click="intercambiar">⇅</button>

        <div class="cajaInputDivisa">
          <label class="etiquetaCampo">Divisa destino</label>
          <SelectorDivisa v-model="divisaDestino" :divisas="divisas" :favoritas="favoritos" />
          <div class="campoValor campoValorResultado">
            <span class="valorDivisa valorResultado">
              {{ tipoCambio !== null ? tipoCambio : '—' }}
            </span>
            <span class="sufijoDivisa">{{ divisaDestino }}</span>
          </div>
        </div>

      </div>

      <div class="filaTipoCambio">
        <span class="textoCambio" v-if="tipoCambio">
          1 {{ divisaOrigen }} = {{ tipoCambio }} {{ divisaDestino }}
        </span>
        <span class="textoCambio textoEspera" v-else>
          Selecciona dos divisas y pulsa Convertir
        </span>
        <span class="insigniaCambio" v-if="fechaCambio">{{ fechaCambio }}</span>
      </div>

      <p class="mensajeError" v-if="error">{{ error }}</p>

      <button class="botonConvertir" @click="convertir" :disabled="cargando">
        <span v-if="cargando">Calculando…</span>
        <span v-else>Convertir <span class="flechaBoton">→</span></span>
      </button>

    </div>

  </div>
</template>

<script>
import axios from 'axios'
import divisasJson from '@/assets/divisas.json'
import SelectorDivisa from '@/components/selectorDivisa.vue'

export default {
  components: { SelectorDivisa },

  data() {
    return {
      divisaOrigen:  'USD',
      divisaDestino: 'EUR',
      tipoCambio:    null,
      fechaCambio:   null,
      cargando:      false,
      error:         null,
      divisas:       divisasJson,
      favoritos:     [],
    }
  },

  mounted() {
    this.cargarFavoritos()
  },

  methods: {
    async cargarFavoritos() {
      try {
        const { data } = await axios.get('/api/favoritos')
        this.favoritos = data
      } catch (e) {
        console.error('Error cargando favoritos:', e)
      }
    },

    async convertir() {
      this.error    = null
      this.cargando = true

      try {
        const { data } = await axios.get('/api/convertir', {
          params: {
            desde: this.divisaOrigen,
            hasta: this.divisaDestino,
          }
        })

        this.tipoCambio  = data.tipoCambio
        this.fechaCambio = data.fecha
      } catch (e) {
        this.error = e.response?.data?.error ?? 'Error al conectar con el servidor.'
      } finally {
        this.cargando = false
      }
    },

    intercambiar() {
      [this.divisaOrigen, this.divisaDestino] = [this.divisaDestino, this.divisaOrigen]
      this.tipoCambio  = null
      this.fechaCambio = null
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

.filaDivisas {
  display: flex;
  align-items: flex-end;
  gap: 12px;
  margin-bottom: 1.25rem;
}

.cajaInputDivisa {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 8px;
  min-width: 0;
}

.etiquetaCampo {
  font-size: 11px;
  color: #5A5856;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.campoValor {
  display: flex;
  align-items: center;
  background: #0E0F12;
  border: 1px solid #252629;
  border-radius: 30px;
  padding: 10px 12px;
  gap: 8px;
}
.campoValorResultado {
  background: rgba(184,149,90,0.06);
  border-color: rgba(184,149,90,0.2);
}

.valorDivisa {
  flex: 1;
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 1.2rem;
  color: #EDE9E0;
  letter-spacing: -0.02em;
}
.valorResultado {
  color: #B8955A;
}
.sufijoDivisa {
  font-size: 12px;
  color: #5A5856;
  flex-shrink: 0;
}

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
  margin-bottom: 2px;
  transition: border-color 0.2s, background 0.2s;
}
.botonIntercambio:hover {
  border-color: #B8955A;
  background: #1C1C22;
}

.filaTipoCambio {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.85rem 1rem;
  background: #0E0F12;
  border: 1px solid #252629;
  border-radius: 20px;
  margin-bottom: 1rem;
}
.textoCambio {
  font-size: 13px;
  color: #EDE9E0;
  font-weight: 500;
}
.textoEspera {
  color: #3A3B40;
  font-weight: 400;
}
.insigniaCambio {
  font-size: 11px;
  color: #5A5856;
}

.mensajeError {
  font-size: 13px;
  color: #E05555;
  background: rgba(224,85,85,0.08);
  border: 1px solid rgba(224,85,85,0.2);
  border-radius: 8px;
  padding: 10px 14px;
  margin: 0 0 1rem;
}

.botonConvertir {
  width: 100%;
  background: #B8955A;
  border: none;
  border-radius: 20px;
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
.botonConvertir:disabled { opacity: 0.5; cursor: not-allowed; }
.flechaBoton { font-size: 16px; }
</style>