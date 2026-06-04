import axios from 'axios'
import { ref } from 'vue'
console.log('API URL:', import.meta.env.VITE_API_URL)
axios.defaults.baseURL = import.meta.env.VITE_API_URL

export const tokenReactivo = ref(localStorage.getItem('token'))

export function obtenerToken()  
{ 
    return tokenReactivo.value 
}
export function estaLogeado()
{ 
    return !!tokenReactivo.value
}

export function setToken(token) {
    tokenReactivo.value=token
    localStorage.setItem('token', token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}` //esto sirve para añadir a la cabezera de la url el token en el campo Authorization
}

export function logout() {
    tokenReactivo.value=null
    localStorage.removeItem('token')
    delete axios.defaults.headers.common['Authorization']
}

// Esta linea sirve para, una vez se recarga la pagina, se restaura el token i no se pierda
if (obtenerToken()) setToken(obtenerToken())