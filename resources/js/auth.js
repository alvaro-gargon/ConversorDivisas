import axios from 'axios'
console.log('API URL:', import.meta.env.VITE_API_URL)
axios.defaults.baseURL = import.meta.env.VITE_API_URL

export function obtenerToken()  
{ 
    return localStorage.getItem('token') 
}
export function estaLogeado()
{ 
    return !!obtenerToken() 
}

export function setToken(token) {
    localStorage.setItem('token', token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}` //esto sirve para añadir a la cabezera de la url el token en el campo Authorization
}

export function logout() {
    localStorage.removeItem('token')
    delete axios.defaults.headers.common['Authorization']
}

// Esta linea sirve para, una vez se recarga la pagina, se restaura el token i no se pierda
if (obtenerToken()) setToken(obtenerToken())