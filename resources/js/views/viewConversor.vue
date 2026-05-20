<template>
  <div class="vistaConversor">

    <div class="cajaConversor">

      <div class="cabeceraTitulo">
        <span class="iconoSeccion">⇄</span>
        <h2 class="tituloSeccion">Conversor de <em>divisas</em></h2>
        <p class="subtituloSeccion">Tipos de cambio actualizados al minuto</p>
      </div>

      <div class="filaDivisas">

        <!-- Divisa origen -->
        <div class="cajaDivisa">
          <label class="etiquetaCampo">Divisa origen</label>
          <div class="selectorDivisa">
            <div class="infoDivisa">
              <span class="codigoDivisa">USD</span>
              <span class="nombreDivisa">Dólar estadounidense</span>
            </div>
            <span class="flechaSelector">▾</span>
          </div>
          <div class="campoImporte">
            <input class="inputImporte" type="number" value="1000" />
            <span class="sufijoDivisa">USD</span>
          </div>
        </div>

        <!-- Botón intercambio -->
        <button class="botonIntercambio">⇅</button>

        <!-- Divisa destino -->
        <div class="cajaDivisa">
          <label class="etiquetaCampo">Divisa destino</label>
          <div class="selectorDivisa">
            <div class="infoDivisa">
              <span class="codigoDivisa">EUR</span>
              <span class="nombreDivisa">Euro</span>
            </div>
            <span class="flechaSelector">▾</span>
          </div>
          <div class="campoImporte campoImporteResultado">
            <span class="inputImporte resultadoImporte">924,10</span>
            <span class="sufijoDivisa">EUR</span>
          </div>
        </div>

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

<script setup>
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
  align-items: flex-end;
  gap: 12px;
  margin-bottom: 1.25rem;
}

.cajaDivisa {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.etiquetaCampo {
  font-size: 11px;
  color: #5A5856;
  letter-spacing: 0.08em;
  text-transform: uppercase;
}

.selectorDivisa {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #0E0F12;
  border: 1px solid #252629;
  border-radius: 10px;
  padding: 10px 12px;
  cursor: pointer;
  transition: border-color 0.2s;
}
.selectorDivisa:hover {
  border-color: #B8955A;
}

.infoDivisa {
  display: flex;
  flex-direction: column;
  flex: 1;
}
.codigoDivisa {
  font-size: 14px;
  font-weight: 500;
  color: #EDE9E0;
  line-height: 1.2;
}
.nombreDivisa {
  font-size: 11px;
  color: #5A5856;
}
.flechaSelector {
  font-size: 12px;
  color: #5A5856;
}

.campoImporte {
  display: flex;
  align-items: center;
  background: #0E0F12;
  border: 1px solid #252629;
  border-radius: 10px;
  padding: 10px 12px;
  gap: 8px;
  transition: border-color 0.2s;
}
.campoImporte:focus-within {
  border-color: #B8955A;
}

.inputImporte {
  flex: 1;
  background: transparent;
  border: none;
  outline: none;
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 1.3rem;
  color: #EDE9E0;
  letter-spacing: -0.02em;
  width: 0;
}
input[type=number]::-webkit-inner-spin-button { -webkit-appearance: none; }

.campoImporteResultado {
  background: rgba(184,149,90,0.06);
  border-color: rgba(184,149,90,0.25);
}
.resultadoImporte {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: 1.3rem;
  color: #B8955A;
  letter-spacing: -0.02em;
  flex: 1;
}

.sufijoDivisa {
  font-size: 12px;
  color: #5A5856;
  letter-spacing: 0.04em;
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
  margin-bottom: 8px;
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