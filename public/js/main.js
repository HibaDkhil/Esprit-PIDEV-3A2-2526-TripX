document.addEventListener('DOMContentLoaded', () => {

    // 1. Scroll Reveal Logic
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('active');
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.reveal, .stagger').forEach(el => {
        observer.observe(el);
    });

    // 2. Theme Toggle (Persistent & Universal)
    const setLocalTheme = (isLight) => {
        const themeStr = isLight ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', themeStr);
        localStorage.setItem('tripx-theme', themeStr);
    };

    // Load from local storage
    const savedTheme = localStorage.getItem('tripx-theme');
    if (savedTheme) document.documentElement.setAttribute('data-theme', savedTheme);

    // Apply listener to all toggle buttons
    document.querySelectorAll('.theme-toggle, #theme-toggle-dash').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const isLight = document.documentElement.getAttribute('data-theme') === 'light';
            setLocalTheme(!isLight);
        });
    });

    // 3. ARIA Chat Panel
    const ariaOrb = document.getElementById('aria-orb');
    const ariaPanel = document.getElementById('aria-panel');
    const ariaClose = document.getElementById('aria-close');
    const ariaInput = document.getElementById('aria-input');
    const ariaSend = document.getElementById('aria-send');
    const ariaMessages = document.getElementById('aria-messages');

    if (ariaOrb && ariaPanel) {
        ariaOrb.addEventListener('click', () => {
            ariaPanel.style.display = 'flex';
            ariaOrb.style.display = 'none';
        });

        ariaClose.addEventListener('click', () => {
            ariaPanel.style.display = 'none';
            ariaOrb.style.display = 'flex';
        });

        const sendMessage = () => {
            const txt = ariaInput.value.trim();
            if (!txt) return;
            // User MSG
            const userMsg = document.createElement('div');
            userMsg.className = 'aria-msg user';
            userMsg.innerHTML = `<div class="aria-bubble">${txt}</div>`;
            ariaMessages.appendChild(userMsg);
            ariaInput.value = '';

            // Bot MSG Simulate
            setTimeout(() => {
                const botMsg = document.createElement('div');
                botMsg.className = 'aria-msg bot';
                botMsg.innerHTML = `<div class="aria-bubble">I'm searching my AI models for the best matches for your trip. Give me a moment! ✈️</div>`;
                ariaMessages.appendChild(botMsg);
                ariaMessages.scrollTop = ariaMessages.scrollHeight;
            }, 600);
        };

        if (ariaSend) ariaSend.addEventListener('click', sendMessage);
        if (ariaInput) ariaInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });
    }

    // 4. Custom Cursor
    const cursorDot = document.getElementById('cursor-dot');
    const cursorHalo = document.getElementById('cursor-halo');
    
    if (cursorDot && cursorHalo) {
        // Ensure cursor is explicitly black in light mode, white in dark mode
        const updateCursorColor = () => {
            const isLight = document.documentElement.getAttribute('data-theme') === 'light';
            const color = isLight ? '#0f172a' : '#ffffff';
            cursorDot.style.background = color;
            cursorHalo.style.border = `1px solid ${color}`;
        };
        updateCursorColor();
        
        // Re-check color on click
        document.addEventListener('click', () => setTimeout(updateCursorColor, 50));

        window.addEventListener('mousemove', (e) => {
            cursorDot.style.transform = `translate(${e.clientX}px, ${e.clientY}px)`;
            cursorHalo.style.transform = `translate(${e.clientX - 15}px, ${e.clientY - 15}px)`;
        });

        document.querySelectorAll('a, button, .interactive').forEach(el => {
            el.addEventListener('mouseenter', () => cursorHalo.style.transform = 'scale(1.5)');
            el.addEventListener('mouseleave', () => cursorHalo.style.transform = 'scale(1)');
        });
    }

});

function handleSearch() {
    alert("Running AI Search for your destination...");
}
