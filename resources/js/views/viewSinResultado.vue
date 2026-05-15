<template>
  <div class="nf-wrap">
    <div class="nf-grid"></div>
    <div class="nf-number">4<span>0</span>4</div>
    <span class="nf-badge">Página no encontrada</span>
    <h1 class="nf-title">Vaya, esto no debería estar aquí.</h1>
    <p class="nf-sub">
      La dirección que has escrito no existe o ha sido movida.<br>
      Comprueba la URL o regresa al inicio.
    </p>
    <RouterLink to="/" class="nf-btn">
      <i class="ti ti-arrow-left"></i>
      Volver al inicio
    </RouterLink>
  </div>
</template>

<script setup>
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;1,400&family=DM+Sans:wght@400;500;700&display=swap');

.nf-wrap {
  min-height: 100vh;
  background: #0E0F12;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  text-align: center;
  padding: 3rem 1rem;
  position: relative;
  overflow: hidden;
}

.nf-grid {
  position: absolute;
  inset: 0;
  background-image:
    linear-gradient(rgba(255,255,255,0.025) 1px, transparent 1px),
    linear-gradient(90deg, rgba(255,255,255,0.025) 1px, transparent 1px);
  background-size: 48px 48px;
  pointer-events: none;
}

.nf-number {
  font-family: 'Playfair Display', Georgia, serif;
  font-weight: 400;
  font-size: 160px;
  line-height: 1;
  letter-spacing: -6px;
  color: transparent;
  -webkit-text-stroke: 1.5px #2A2B30;
  animation: drift 0.7s ease-out both;
}
.nf-number span {
  color: #B8955A;
  -webkit-text-stroke: 0;
}

.nf-badge {
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 11px;
  font-weight: 500;
  letter-spacing: 0.12em;
  text-transform: uppercase;
  color: #B8955A;
  border: 1px solid rgba(184,149,90,0.3);
  background: rgba(184,149,90,0.08);
  border-radius: 100px;
  padding: 5px 14px;
  margin-bottom: 1.5rem;
  display: inline-block;
  animation: fadeUp 0.5s 0.2s ease-out both;
}

.nf-title {
  font-family: 'Playfair Display', Georgia, serif;
  font-style: italic;
  font-size: 32px;
  font-weight: 400;
  color: #EDE9E0;
  margin: 0.75rem 0 0.5rem;
  line-height: 1.2;
  animation: fadeUp 0.5s 0.3s ease-out both;
}

.nf-sub {
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 14px;
  color: #5A5856;
  max-width: 320px;
  line-height: 1.7;
  margin: 0 auto 2rem;
  animation: fadeUp 0.5s 0.4s ease-out both;
}

.nf-btn {
  font-family: 'DM Sans', system-ui, sans-serif;
  font-size: 13px;
  font-weight: 500;
  color: #EDE9E0;
  background: #16171C;
  border: 1px solid #252629;
  border-radius: 10px;
  padding: 12px 24px;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  transition: border-color 0.2s, background 0.2s;
  animation: fadeUp 0.5s 0.5s ease-out both;
}
.nf-btn:hover {
  border-color: #B8955A;
  background: #1C1C22;
}
.nf-btn:active { transform: scale(0.97); }

@keyframes drift {
  from { opacity: 0; transform: translateY(-16px); }
  to   { opacity: 1; transform: translateY(0); }
}
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(12px); }
  to   { opacity: 1; transform: translateY(0); }
}
</style>