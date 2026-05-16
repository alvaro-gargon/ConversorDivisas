<template>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <p>{{ token }}</p>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>
    <h1>Hola</h1>

</template> 
<script>
    export default {
        data() {
            return {
            token: localStorage.getItem('token')
            }
        }
    }
</script>
<style scoped>
</style>