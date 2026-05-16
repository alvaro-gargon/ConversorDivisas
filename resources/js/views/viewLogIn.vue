<template>
  <div>
    <h2>Iniciar sesión</h2>
    <p v-if="error" style="color:red">{{ error }}</p>
    <input v-model="nombre" type="text" placeholder="Nombre">
    <input v-model="email" type="email" placeholder="Email" /><br>
    <input v-model="password" type="password" placeholder="Contraseña" /><br>
    <button @click="login">Entrar</button>
    <p>¿No tienes cuenta? <RouterLink to="/registro">Regístrate</RouterLink></p>
  </div>
</template>

<script>
import axios from 'axios'
import { setToken } from '@/auth.js'

export default {
  name: 'LoginView',
  data() {
    return {
      nombre: '',
      email: '',
      password: '',
      error: ''
    }
  },
  methods: {
    async login() {
      try {
        const { data } = await axios.post('/api/login', {
          email: this.email,
          password: this.password
        })
        setToken(data.token)
        this.$router.push('/home')
      } catch {
        this.error = 'Correo o contraseña incorrectos'
      }
    }
  }
}
</script>