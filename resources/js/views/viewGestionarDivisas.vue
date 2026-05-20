<template>
  <div class="vistaDivisas">

    <div class="cabeceraDivisas">
      <span class="iconoSeccion">◎</span>
      <h2 class="tituloSeccion">Divisas <em>disponibles</em></h2>
      <p class="subtituloSeccion">200+ monedas · Fuentes: 82 bancos centrales</p>
    </div>

    <div class="barraBusqueda">
      <span class="iconoBusqueda">⌕</span>
      <input class="inputBusqueda" type="text" placeholder="Buscar divisa..." />
    </div>

    <div class="filtroPestanas">
      <button class="pestana pestanaActiva">Todas</button>
      <button class="pestana">Favoritas</button>
    </div>

    <ul class="listaDivisas">
      <li
        v-for="divisa in divisas"
        :key="divisa.codigo"
        class="itemDivisa"
        :class="{ itemDivisaFavorita: divisa.favorita }"
      >
        <div class="codigoBadge">{{ divisa.codigo }}</div>
        <div class="infoDivisaItem">
          <span class="nombreDivisa">{{ divisa.nombre }}</span>
          <span class="codigoDivisa">{{ divisa.codigo }}</span>
        </div>
        <button class="botonFavorito" :class="{ botonFavoritoActivo: divisa.favorita }">
          {{ divisa.favorita ? '★' : '☆' }}
        </button>
      </li>
    </ul>

  </div>
</template>

<script setup>
import { ref } from 'vue'

// Divisas reales de la API de Frankfurter (https://api.frankfurter.app/currencies)
const divisas = ref([
  { codigo: 'AUD', nombre: 'Dólar australiano',       favorita: false },
  { codigo: 'BGN', nombre: 'Lev búlgaro',              favorita: false },
  { codigo: 'BRL', nombre: 'Real brasileño',           favorita: true  },
  { codigo: 'CAD', nombre: 'Dólar canadiense',         favorita: true  },
  { codigo: 'CHF', nombre: 'Franco suizo',             favorita: true  },
  { codigo: 'CNY', nombre: 'Yuan chino',               favorita: false },
  { codigo: 'CZK', nombre: 'Corona checa',             favorita: false },
  { codigo: 'DKK', nombre: 'Corona danesa',            favorita: false },
  { codigo: 'EUR', nombre: 'Euro',                     favorita: true  },
  { codigo: 'GBP', nombre: 'Libra esterlina',          favorita: true  },
  { codigo: 'HKD', nombre: 'Dólar de Hong Kong',       favorita: false },
  { codigo: 'HUF', nombre: 'Forinto húngaro',          favorita: false },
  { codigo: 'IDR', nombre: 'Rupia indonesia',          favorita: false },
  { codigo: 'ILS', nombre: 'Séquel israelí',           favorita: false },
  { codigo: 'INR', nombre: 'Rupia india',              favorita: false },
  { codigo: 'ISK', nombre: 'Corona islandesa',         favorita: false },
  { codigo: 'JPY', nombre: 'Yen japonés',              favorita: true  },
  { codigo: 'KRW', nombre: 'Won surcoreano',           favorita: false },
  { codigo: 'MXN', nombre: 'Peso mexicano',            favorita: false },
  { codigo: 'MYR', nombre: 'Ringgit malayo',           favorita: false },
  { codigo: 'NOK', nombre: 'Corona noruega',           favorita: false },
  { codigo: 'NZD', nombre: 'Dólar neozelandés',        favorita: false },
  { codigo: 'PHP', nombre: 'Peso filipino',            favorita: false },
  { codigo: 'PLN', nombre: 'Esloti polaco',            favorita: false },
  { codigo: 'RON', nombre: 'Leu rumano',               favorita: false },
  { codigo: 'SEK', nombre: 'Corona sueca',             favorita: false },
  { codigo: 'SGD', nombre: 'Dólar de Singapur',        favorita: false },
  { codigo: 'THB', nombre: 'Baht tailandés',           favorita: false },
  { codigo: 'TRY', nombre: 'Lira turca',               favorita: false },
  { codigo: 'USD', nombre: 'Dólar estadounidense',     favorita: true  },
  { codigo: 'ZAR', nombre: 'Rand sudafricano',         favorita: false },
])
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap');

.vistaDivisas {
  min-height: 100vh;
  background: #0E0F12;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 3rem 1.5rem;
  font-family: 'DM Sans', system-ui, sans-serif;
}

/* Cabecera */
.cabeceraDivisas {
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

/* Barra búsqueda */
.barraBusqueda {
  width: 100%;
  max-width: 520px;
  display: flex;
  align-items: center;
  gap: 10px;
  background: #16171C;
  border: 1px solid #252629;
  border-radius: 10px;
  padding: 10px 14px;
  margin-bottom: 1rem;
  transition: border-color 0.2s;
}
.barraBusqueda:focus-within {
  border-color: #B8955A;
}
.iconoBusqueda {
  font-size: 18px;
  color: #5A5856;
}
.inputBusqueda {
  flex: 1;
  background: transparent;
  border: none;
  outline: none;
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 14px;
  color: #EDE9E0;
}
.inputBusqueda::placeholder {
  color: #3A3B40;
}

/* Filtro pestañas */
.filtroPestanas {
  width: 100%;
  max-width: 520px;
  display: flex;
  gap: 6px;
  margin-bottom: 1.25rem;
}
.pestana {
  background: #16171C;
  border: 1px solid #252629;
  border-radius: 8px;
  padding: 6px 16px;
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 12px;
  color: #5A5856;
  cursor: pointer;
  transition: border-color 0.2s, color 0.2s;
}
.pestana:hover {
  color: #EDE9E0;
  border-color: #3A3B40;
}
.pestanaActiva {
  background: rgba(184,149,90,0.08);
  border-color: rgba(184,149,90,0.35);
  color: #B8955A;
}

/* Lista */
.listaDivisas {
  width: 100%;
  max-width: 520px;
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-direction: column;
  gap: 4px;
}

.itemDivisa {
  display: flex;
  align-items: center;
  gap: 14px;
  background: #16171C;
  border: 1px solid #252629;
  border-radius: 10px;
  padding: 12px 14px;
  transition: border-color 0.2s, background 0.2s;
  cursor: default;
}
.itemDivisa:hover {
  background: #1C1C22;
  border-color: #3A3B40;
}
.itemDivisaFavorita {
  border-color: rgba(184,149,90,0.2);
}
.itemDivisaFavorita:hover {
  border-color: rgba(184,149,90,0.4);
}

.codigoBadge {
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.06em;
  color: #5A5856;
  background: #0E0F12;
  border: 1px solid #252629;
  border-radius: 6px;
  padding: 3px 8px;
  min-width: 42px;
  text-align: center;
  flex-shrink: 0;
}
.itemDivisaFavorita .codigoBadge {
  color: #B8955A;
  border-color: rgba(184,149,90,0.25);
  background: rgba(184,149,90,0.06);
}

.infoDivisaItem {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 1px;
}
.nombreDivisa {
  font-size: 14px;
  color: #EDE9E0;
  font-weight: 400;
}
.codigoDivisa {
  font-size: 11px;
  color: #3A3B40;
}

.botonFavorito {
  background: transparent;
  border: none;
  font-size: 18px;
  color: #3A3B40;
  cursor: pointer;
  padding: 2px 4px;
  line-height: 1;
  transition: color 0.2s, transform 0.15s;
  flex-shrink: 0;
}
.botonFavorito:hover {
  color: #B8955A;
  transform: scale(1.15);
}
.botonFavoritoActivo {
  color: #B8955A;
}
</style>