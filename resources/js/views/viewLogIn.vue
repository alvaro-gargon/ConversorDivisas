<template>
  <div class="wrapper">
      <div class="formulario">
      <h2>Iniciar sesión</h2>
      <p v-if="error" style="color:red">{{ error }}</p>
      <input class="camposFormulario" v-model="email" type="email" placeholder="Email" /><br>
      <input class="camposFormulario" v-model="password" type="password" placeholder="Contraseña" /><br>
      <button class="botonForm" @click="login">Entrar</button>
      <p>¿No tienes cuenta? <RouterLink to="/registro" class="linkRegistro">Regístrate</RouterLink></p>
    </div>
  </div>
  
</template>

<script>
import axios from 'axios'
import { setToken } from '@/auth.js'

export default {
  name: 'LoginView',
  data() {
    return {
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

<style scoped>

  .wrapper{
    display: flex;
    flex-direction: column;
    width: 100%;
    height: 80%;
    padding-top: 5%;
  }
  .formulario{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
  }

  .botonForm {
    color: #EDE9E0;
    background: #16171C;
    border: 1px solid #252629;
    border-radius: 12px;
    padding: 1.1rem 1.25rem;
    cursor: pointer;
    text-align: left;
    display: flex;
    flex-direction: column;
    transition: border-color 0.2s, background 0.2s;
  }
  .botonForm:hover {
    border-color: #B8955A;
    background: #1C1C22;
  }

  .linkRegistro{
    color: #B8955A;
  }

  .camposFormulario{
    margin-bottom: 1%;
    border-radius: 5px;
  }
</style>