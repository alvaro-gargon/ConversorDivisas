<template>
    <div class="vistaHistorico">
        <div class="cajaHistorico">

            <div class="cabeceraTitulo">
                <h2 class="tituloSeccion">Histórico del <em>oro</em></h2>
                <p class="subtituloSeccion">Precio de la onza en la divisa seleccionada</p>
            </div>

            <div class="filaControles">

                <div class="cajaControl">
                    <label class="etiquetaCampo">Divisa</label>
                    <SelectorDivisa v-model="divisa" :divisas="divisas" :favoritas="favoritos" />
                </div>

                <div class="cajaControl">
                    <label class="etiquetaCampo">Fecha inicio</label>
                    <input class="inputFecha" type="date" v-model="fechaInicio" :min="FECHA_MIN" :max="fechaHoy" />
                </div>

                <div class="cajaControl">
                    <label class="etiquetaCampo">Fecha fin</label>
                    <input class="inputFecha" type="date" v-model="fechaFin" :min="fechaInicio || FECHA_MIN"
                        :max="fechaHoy" />
                </div>

            </div>

            <p class="mensajeError" v-if="error">{{ error }}</p>

            <button class="botonBuscar" @click="buscar" :disabled="cargando">
                <span v-if="cargando">Cargando…</span>
                <span v-else>Ver histórico <span class="flechaBoton">→</span></span>
            </button>

            <div class="cajaGrafica" v-if="serieGrafica.length">
                <apexchart type="line" height="320" :options="opcionesGrafica" :series="series" />
            </div>

            <div class="cajaVacia" v-else-if="!cargando">
                <p>Selecciona una divisa y un rango de fechas para ver la evolución.</p>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios'
import VueApexCharts from 'vue3-apexcharts'
import divisasJson from '@/assets/divisas.json'
import oroJson from '@/assets/xaueur.json'
import SelectorDivisa from '@/components/selectorDivisa.vue'

// esta fecha minima esta establecida por la limitacion de sacar el valor del oro de una web
const FECHA_MIN = '2006-08-01'

export default {
    components: {
        SelectorDivisa,
        apexchart: VueApexCharts,
    },

    data() {
        const hoy = new Date().toISOString().split('T')[0]
        return {
            FECHA_MIN,
            fechaHoy: hoy,
            divisa: 'USD',
            fechaInicio: FECHA_MIN,
            fechaFin: hoy,
            divisas: divisasJson,
            favoritos: [],
            serieGrafica: [],
            cargando: false,
            error: null,
        }
    },

    mounted() {
        this.cargarFavoritos()
    },

    computed: {
        series() {
            return [{
                name: `Oro en ${this.divisa}`,
                data: this.serieGrafica,
            }]
        },

        opcionesGrafica() {
            return {
                chart: {
                    type: 'line',
                    background: 'transparent',
                    toolbar: { show: false },
                    zoom: { enabled: true },
                    animations: { enabled: true, speed: 600 },
                },
                theme: { mode: 'dark' },
                colors: ['#B8955A'],
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                grid: {
                    borderColor: '#252629',
                    strokeDashArray: 4,
                },
                xaxis: {
                    type: 'datetime',
                    labels: {
                        style: { colors: '#5A5856', fontFamily: 'DM Sans, sans-serif', fontSize: '11px' },
                        datetimeUTC: false,
                    },
                    axisBorder: { color: '#252629' },
                    axisTicks: { color: '#252629' },
                },
                yaxis: {
                    labels: {
                        style: { colors: '#5A5856', fontFamily: 'DM Sans, sans-serif', fontSize: '11px' },
                        formatter: (val) => `${val.toFixed(2)} ${this.divisa}`,
                    },
                },
                tooltip: {
                    theme: 'dark',
                    x: { format: 'MMM yyyy' },
                    y: {
                        formatter: (val) => `${val.toFixed(2)} ${this.divisa}`,
                    },
                    style: { fontFamily: 'DM Sans, sans-serif' },
                },
                markers: {
                    size: 0,
                    hover: { size: 5, fillColor: '#B8955A' },
                },
            }
        },
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

        async buscar() {
            this.error = null
            this.serieGrafica = []
            this.cargando = true

            try {
                let tipoCambioPorFecha = {}

                if (this.divisa === 'EUR') {
                    oroJson.forEach(entrada => {
                        tipoCambioPorFecha[entrada.fecha.substring(0, 7)] = 1
                    })
                } else {
                    const { data } = await axios.get('/api/historico', {
                        params: {
                            divisa: this.divisa,
                            fecha_inicio: this.fechaInicio,
                            fecha_fin: this.fechaFin,
                        }
                    })

                    console.log('Datos Frankfurter:', data.datos.slice(0, 3))

                    data.datos.forEach(entrada => {
                        const mesAnio = entrada.fecha.substring(0, 7)
                        tipoCambioPorFecha[mesAnio] = entrada.tipoCambio
                    })
                }

                console.log('tipoCambioPorFecha (primeras claves):', Object.keys(tipoCambioPorFecha).slice(0, 5))
                console.log('Primeras entradas oro:', oroJson.slice(0, 3))
                console.log('fechaInicio:', this.fechaInicio, 'fechaFin:', this.fechaFin)

                this.serieGrafica = oroJson
                    .filter(entrada => {
                        const mesAnio = entrada.fecha.substring(0, 7)
                        const dentroRango = entrada.fecha >= this.fechaInicio && entrada.fecha <= this.fechaFin
                        const tieneCambio = tipoCambioPorFecha[mesAnio] !== undefined
                        if (!dentroRango) console.log('Fuera de rango:', entrada.fecha)
                        if (!tieneCambio) console.log('Sin tipo de cambio:', mesAnio)
                        return dentroRango && tieneCambio
                    })
                    .map(entrada => ({
                        x: new Date(entrada.fecha).getTime(),
                        y: parseFloat((entrada.precio * tipoCambioPorFecha[entrada.fecha.substring(0, 7)]).toFixed(2)),
                    }))

                console.log('serieGrafica generada:', this.serieGrafica.slice(0, 3))

                if (this.serieGrafica.length === 0) {
                    this.error = 'No hay datos disponibles para el rango y divisa seleccionados.'
                }

            } catch (e) {
                console.error('Error completo:', e)
                this.error = e.response?.data?.error ?? 'Error al conectar con el servidor.'
            } finally {
                this.cargando = false
            }
        },
    }
}

</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@300;400;500&display=swap');

.vistaHistorico {
    min-height: 100vh;
    background: #0E0F12;
    display: flex;
    align-items: flex-start;
    justify-content: center;
    padding: 3rem 1.5rem;
    font-family: 'DM Sans', system-ui, sans-serif;
}

.cajaHistorico {
    background: #16171C;
    border: 1px solid #252629;
    border-radius: 16px;
    padding: 2.5rem;
    width: 100%;
    max-width: 760px;
    box-shadow: 0 32px 64px rgba(0, 0, 0, 0.4);
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

.filaControles {
    display: flex;
    gap: 12px;
    margin-bottom: 1.25rem;
    flex-wrap: wrap;
}

.cajaControl {
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
    min-width: 160px;
}

.etiquetaCampo {
    font-size: 11px;
    color: #5A5856;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.inputFecha {
    background: #0E0F12;
    border: 1px solid #252629;
    border-radius: 10px;
    padding: 10px 12px;
    color: #EDE9E0;
    font-family: 'DM Sans', system-ui, sans-serif;
    font-size: 14px;
    outline: none;
    transition: border-color 0.2s;
    width: 100%;
    box-sizing: border-box;
    color-scheme: dark;
}

.inputFecha:hover {
    border-color: #3A3B40;
}

.inputFecha:focus {
    border-color: #B8955A;
}

.mensajeError {
    font-size: 13px;
    color: #E05555;
    background: rgba(224, 85, 85, 0.08);
    border: 1px solid rgba(224, 85, 85, 0.2);
    border-radius: 8px;
    padding: 10px 14px;
    margin: 0 0 1rem;
}

.botonBuscar {
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
    margin-bottom: 1.5rem;
}

.botonBuscar:hover {
    opacity: 0.85;
}

.botonBuscar:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.flechaBoton {
    font-size: 16px;
}

.cajaGrafica {
    background: #0E0F12;
    border: 1px solid #252629;
    border-radius: 12px;
    padding: 1rem 0.5rem 0.5rem;
}

.cajaVacia {
    text-align: center;
    padding: 3rem 1rem;
    color: #3A3B40;
    font-size: 14px;
}
</style>