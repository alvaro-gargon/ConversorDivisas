<template>
  <div class="principal">

    <h1 class="titulo">Selecciona un avatar</h1>

    <nav class="nav-principal">
      <div class="cajaAvatar" v-for="avatar in avatares" :key="avatar" @click="cambiarAvatar(avatar)">
            <Avatar :nombreArchivo="avatar" />
        </div>
    </nav>

  </div>
</template>

<script>
import axios from 'axios';
import Avatar from '@/components/avatar.vue'

export default{
    name: 'vistaAvatares',
    components:{
        Avatar
    },
    data(){
        return{
            avatares:[],
        }
    },
    mounted() {
        axios.get('/api/avatares').then(response => {
                this.avatares = response.data
            })
    },
    methods: {
        cambiarAvatar(avatar) {
            axios.patch('/api/editarFotoPerfil', { imagen_usuario: avatar })
            .then(() => {
                localStorage.setItem('imagenUsuario', avatar)
                window.dispatchEvent(new Event('avatarActualizado'))
            })
        }
    }

}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@400;500&display=swap');

.principal {
  min-height: 100vh;
  background: #0E0F12;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 2rem;
  font-family: 'DM Sans', system-ui, sans-serif;
}

.titulo {
  font-family: 'Playfair Display', Georgia, serif;
  font-size: clamp(2.4rem, 6vw, 3.2rem);
  font-weight: 400;
  color: #EDE9E0;
  margin: 0 0 0.4rem;
  letter-spacing: -0.02em;
}

.nav-principal {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 10px;
  width: 100%;
  max-width: 420px;
}

.cajaAvatar{
    width: 205px;height: 219px;
}
</style>