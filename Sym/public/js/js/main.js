/* ============================================================
   TripX — Main JavaScript
   Custom Cursor | Dark Mode | Scroll Reveal | Ripple | Aria
   ============================================================ */

(function initTheme() {
  const saved = localStorage.getItem('tripx-theme') || 'dark';
  document.documentElement.setAttribute('data-theme', saved);
})();

function toggleTheme() {
  const html = document.documentElement;
  const current = html.getAttribute('data-theme');
  const next = current === 'dark' ? 'light' : 'dark';
  html.setAttribute('data-theme', next);
  localStorage.setItem('tripx-theme', next);
}

(function initCursor() {
  const dot  = document.getElementById('cursor-dot');
  const halo = document.getElementById('cursor-halo');
  if (!dot || !halo) return;

  let mouseX = 0, mouseY = 0;
  let haloX  = 0, haloY  = 0;

  document.addEventListener('mousemove', (e) => {
    mouseX = e.clientX;
    mouseY = e.clientY;
    dot.style.left = mouseX + 'px';
    dot.style.top  = mouseY + 'px';
  });

  function animateHalo() {
    haloX += (mouseX - haloX) * 0.13;
    haloY += (mouseY - haloY) * 0.13;
    halo.style.left = haloX + 'px';
    halo.style.top  = haloY + 'px';
    requestAnimationFrame(animateHalo);
  }
  animateHalo();

  document.addEventListener('mouseover', (e) => {
    const target = e.target.closest('a, button, .card, .trending-item');
    if (target) {
      dot.style.transform  = 'translate(-50%,-50%) scale(1.5)';
      halo.style.transform = 'translate(-50%,-50%) scale(1.3)';
    }
  });
  document.addEventListener('mouseout', (e) => {
    const target = e.target.closest('a, button, .card, .trending-item');
    if (target) {
      dot.style.transform  = 'translate(-50%,-50%) scale(1)';
      halo.style.transform = 'translate(-50%,-50%) scale(1)';
    }
  });
})();

document.addEventListener('DOMContentLoaded', () => {
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }});
  }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
  document.querySelectorAll('.reveal, .stagger').forEach(el => observer.observe(el));

  const toggleBtn = document.getElementById('theme-toggle');
  if (toggleBtn) toggleBtn.addEventListener('click', toggleTheme);
});
