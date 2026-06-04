<template>
    <img :src="nombreArchivo" :alt="alt">
</template>
<script>
export default {
    name: 'avatar',
    props: {
        nombreArchivo: { //el nombre del prop no tiene que ser el mismo que el del parametro, pero es menos lioso asi
            type: String,
            required: true,
        },
        alt: {
            type: String,
            default: 'Avatar',
        },
    },
    computed: {
        nombreArchivo() {
            return `/images/avatares/${this.nombreArchivo}`
        }
    },
}
</script>
<style scoped>
img{
    width: 100%;height: 100%;
    border-radius: 100px;
}
</style>