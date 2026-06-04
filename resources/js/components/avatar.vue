<template>
    <img :src="url" :alt="texto">
</template>
<script>
export default{
    name: 'avatar',
    props: {
        url: String,
        texto: String,
    },
}
</script>
<style scoped>

</style>