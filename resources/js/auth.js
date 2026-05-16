import axios from 'axios'

axios.defaults.baseURL = 'http://localhost:8000'

export function obtenerToken()  
{ 
    return localStorage.getItem('token') 
}
export function estaLogeado()
{ 
    return !!getToken() 
}

export function setToken(token) {
    localStorage.setItem('token', token)
    axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
}

export function logout() {
    localStorage.removeItem('token')
    delete axios.defaults.headers.common['Authorization']
}

// Esta linea sirve para, una vez se recarga la pagina, se restaura el token i no se pierda
if (getToken()) setToken(getToken())