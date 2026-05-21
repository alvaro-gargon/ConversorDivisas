<template>
  <div class="selectorDivisa" ref="refContenedor">

    <!-- Botón disparador -->
    <button
      type="button"
      class="disparadorSelector"
      :class="{ disparadorAbierto: abierto }"
      @click="toggleAbierto"
    >
      <span class="codigoSeleccionado">{{ modelValue || 'Divisa' }}</span>
      <span class="nombreSeleccionado">{{ nombreDivisaSeleccionada }}</span>
      <span class="flechaSelector">{{ abierto ? '▴' : '▾' }}</span>
    </button>

    <!-- Desplegable -->
    <div v-if="abierto" class="desplegable">

      <div class="cajaBuscador">
        <span class="iconoBuscador">⌕</span>
        <input
          ref="refBuscador"
          v-model="textoBusqueda"
          class="inputBuscador"
          type="text"
          placeholder="Buscar divisa..."
        />
      </div>

      <div class="listaOpciones">

        <!-- Sección favoritas -->
        <template v-if="divisasFavoritas.length > 0">
          <div class="etiquetaSeccion">
            <span class="iconoEtiqueta">★</span> Favoritas
          </div>
          <button
            v-for="divisa in divisasFavoritas"
            :key="'fav-' + divisa.iso_code"
            type="button"
            class="opcionDivisa opcionFavorita"
            :class="{ opcionActiva: modelValue === divisa.iso_code }"
            @click="seleccionar(divisa)"
          >
            <span class="opcionCodigo">{{ divisa.iso_code }}</span>
            <span class="opcionNombre">{{ divisa.name }}</span>
          </button>
          <div class="separadorSecciones"></div>
        </template>

        <!-- Sección todas -->
        <div class="etiquetaSeccion">
          <span class="iconoEtiqueta">◎</span> Todas las divisas
        </div>
        <button
          v-for="divisa in divisasFiltradas"
          :key="divisa.iso_code"
          type="button"
          class="opcionDivisa"
          :class="{ opcionActiva: modelValue === divisa.iso_code }"
          @click="seleccionar(divisa)"
        >
          <span class="opcionCodigo">{{ divisa.iso_code }}</span>
          <span class="opcionNombre">{{ divisa.name }}</span>
        </button>

        <p v-if="divisasFiltradas.length === 0 && divisasFavoritas.length === 0" class="mensajeSinResultados">
          Sin resultados para "{{ textoBusqueda }}"
        </p>

      </div>
    </div>

  </div>
</template>

<script>
export default {
  name: 'SelectorDivisa',

  props: {
    modelValue: {
      type: String,
      default: null
    },
    // Array de objetos del JSON de Frankfurter: [{ iso_code, name, symbol, ... }]
    divisas: {
      type: Array,
      default: () => []
    },
    // Array de iso_codes favoritos del usuario 
    favoritas: {
      type: Array,
      default: () => []
    }
  },

  emits: ['update:modelValue'],

  data() {
    return {
      abierto: false,
      textoBusqueda: ''
    }
  },

  computed: {
    nombreDivisaSeleccionada() {
      if (!this.modelValue) return 'Selecciona una divisa'
      return this.divisas.find(d => d.iso_code === this.modelValue)?.name ?? ''
    },

    divisasFavoritas() {
      if (!this.favoritas.length) return []
      return this.divisas.filter(d => this.favoritas.includes(d.iso_code))
    },

    divisasFiltradas() {
      const texto = this.textoBusqueda.toLowerCase()
      return this.divisas.filter(d =>
        !this.favoritas.includes(d.iso_code) &&
        (d.iso_code.toLowerCase().includes(texto) ||
         d.name.toLowerCase().includes(texto))
      )
    }
  },

  watch: {
    abierto(val) {
      if (val) {
        this.textoBusqueda = ''
        this.$nextTick(() => this.$refs.refBuscador?.focus())
      }
    }
  },

  mounted() {
    document.addEventListener('mousedown', this.clickFuera)
  },

  beforeUnmount() {
    document.removeEventListener('mousedown', this.clickFuera)
  },

  methods: {
    toggleAbierto() {
      this.abierto = !this.abierto
    },

    seleccionar(divisa) {
      this.$emit('update:modelValue', divisa.iso_code)
      this.abierto = false
    },

    clickFuera(e) {
      if (this.$refs.refContenedor && !this.$refs.refContenedor.contains(e.target)) {
        this.abierto = false
      }
    }
  }
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500&display=swap');

.selectorDivisa {
  position: relative;
  width: 100%;
  font-family: 'DM Sans', system-ui, sans-serif;
}

.disparadorSelector {
  width: 100%;
  display: flex;
  align-items: center;
  gap: 10px;
  background: #0E0F12;
  border: 1px solid #252629;
  border-radius: 10px;
  padding: 10px 12px;
  cursor: pointer;
  text-align: left;
  transition: border-color 0.2s;
}
.disparadorSelector:hover,
.disparadorAbierto {
  border-color: #B8955A;
}

.codigoSeleccionado {
  font-size: 14px;
  font-weight: 500;
  color: #EDE9E0;
  min-width: 38px;
}
.nombreSeleccionado {
  flex: 1;
  font-size: 12px;
  color: #5A5856;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.flechaSelector {
  font-size: 11px;
  color: #5A5856;
  flex-shrink: 0;
}

.desplegable {
  position: absolute;
  top: calc(100% + 6px);
  left: 0;
  right: 0;
  background: #16171C;
  border: 1px solid #252629;
  border-radius: 12px;
  overflow: hidden;
  z-index: 50;
  box-shadow: 0 16px 40px rgba(0,0,0,0.5);
}

.cajaBuscador {
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 12px;
  border-bottom: 1px solid #252629;
}
.iconoBuscador {
  font-size: 16px;
  color: #3A3B40;
  flex-shrink: 0;
}
.inputBuscador {
  flex: 1;
  background: transparent;
  border: none;
  outline: none;
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 13px;
  color: #EDE9E0;
}
.inputBuscador::placeholder { color: #3A3B40; }

.listaOpciones {
  max-height: 280px;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: #252629 transparent;
}

.etiquetaSeccion {
  display: flex;
  align-items: center;
  gap: 6px;
  padding: 8px 12px 4px;
  font-size: 10px;
  font-weight: 500;
  letter-spacing: 0.1em;
  text-transform: uppercase;
  color: #3A3B40;
  position: sticky;
  top: 0;
  background: #16171C;
}
.iconoEtiqueta {
  font-size: 11px;
  color: #B8955A;
}

.separadorSecciones {
  height: 1px;
  background: #252629;
  margin: 4px 0;
}

.opcionDivisa {
  width: 100%;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 9px 12px;
  background: transparent;
  border: none;
  cursor: pointer;
  text-align: left;
  transition: background 0.15s;
}
.opcionDivisa:hover { background: #1C1C22; }
.opcionActiva { background: rgba(184,149,90,0.08); }
.opcionFavorita .opcionCodigo { color: #B8955A; }

.opcionCodigo {
  font-size: 13px;
  font-weight: 500;
  color: #EDE9E0;
  min-width: 40px;
}
.opcionNombre {
  font-size: 12px;
  color: #5A5856;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.mensajeSinResultados {
  font-size: 13px;
  color: #3A3B40;
  text-align: center;
  padding: 1.5rem;
  margin: 0;
}
</style>