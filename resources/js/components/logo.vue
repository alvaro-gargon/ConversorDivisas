<template>
  <figure>
    <img :src="url" :alt="texto" loading="lazy"/>
    
  </figure>
</template>
<script>
export default {
  name: 'imagen',
  props: {
    url: String,
    texto: String,
  },
}
</script>
<style scoped>
img {
  display: block;
  width: 300px;
  height: 100px;
}
</style>