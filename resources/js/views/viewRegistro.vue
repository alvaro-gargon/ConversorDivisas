<template>
  <div>
    <h2>Crear cuenta</h2>
    <p v-if="error" style="color:red">{{ error }}</p>
    <input v-model="nombre" type="text" placeholder="Nombre" /><br>
    <input v-model="email" type="email" placeholder="Email" /><br>
    <input v-model="password" type="password" placeholder="Contraseña" /><br>
    <button @click="registrarse">Crear cuenta</button>
    <p>¿Ya tienes cuenta? <RouterLink to="/">Inicia sesión</RouterLink></p>
  </div>
</template>

<script>
import axios from 'axios'
import { setToken } from '@/auth.js'

export default {
  name: 'RegistroView',
  data() {
    return {
      nombre: '',
      email: '',
      password: '',
      error: ''
    }
  },
  methods: {
    async registrarse() {
      try {
        const { data } = await axios.post('/api/registro', {
          nombre: this.nombre,
          email: this.email,
          password: this.password
        })
        setToken(data.token)
        this.$router.push('/home')
      } catch (e) {
        this.error = e.response?.data?.message || 'Error al registrarse'
      }
    }
  }
}
</script>