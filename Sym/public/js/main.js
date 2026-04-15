/**
 * Feminine English voice for ARIA (Web Speech API — picks best match per OS).
 */
window.TRIPX_ARIA = window.TRIPX_ARIA || {};
window.TRIPX_ARIA.pickFemaleVoice = function (voices) {
    const list = voices && voices.length ? voices : (window.speechSynthesis?.getVoices?.() || []);
    const femaleHints = ['samantha', 'victoria', 'karen', 'moira', 'tessa', 'fiona', 'serena', 'zira', 'hazel', 'susan', 'joanna', 'ivy', 'emma', 'nicole', 'catherine', 'katherine', 'melina', 'aria', 'female', 'girl', 'allison', 'paulina', 'jenny', 'sonia', 'amy', 'sarah', 'linda'];
    const maleHints = ['daniel', 'david', 'fred', 'microsoft david', 'mark ', 'thomas', 'arthur', 'james', 'george', 'brian', 'alex (', 'male'];
    let best = null;
    let bestScore = -999;
    list.forEach((v) => {
        const n = (v.name || '').toLowerCase();
        const lang = (v.lang || '').toLowerCase();
        if (!lang.startsWith('en')) return;
        let s = 0;
        if (lang === 'en-us') s += 4;
        else if (lang.startsWith('en-gb') || lang.startsWith('en-au')) s += 2;
        femaleHints.forEach((h) => { if (n.includes(h)) s += 18; });
        maleHints.forEach((h) => { if (n.includes(h.trim())) s -= 30; });
        if (s > bestScore) {
            bestScore = s;
            best = v;
        }
    });
    if (best) return best;
    return list.find((v) => (v.lang || '').toLowerCase().startsWith('en-')) || list[0] || null;
};
window.TRIPX_ARIA.speak = function (text) {
    if (!window.speechSynthesis || !text) return;
    const run = () => {
        const voices = window.speechSynthesis.getVoices();
        const voice = window.TRIPX_ARIA.pickFemaleVoice(voices);
        const u = new SpeechSynthesisUtterance(String(text).slice(0, 420));
        if (voice) {
            u.voice = voice;
            u.lang = voice.lang || 'en-US';
        } else {
            u.lang = 'en-US';
        }
        u.pitch = 1.12;
        u.rate = 0.94;
        window.speechSynthesis.cancel();
        window.speechSynthesis.speak(u);
    };
    if (window.speechSynthesis.getVoices().length === 0) {
        window.speechSynthesis.addEventListener('voiceschanged', run, { once: true });
    } else {
        run();
    }
};

if (typeof window !== 'undefined' && window.speechSynthesis) {
    window.speechSynthesis.getVoices();
    window.addEventListener('load', () => {
        window.speechSynthesis.getVoices();
    });
}

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
    document.querySelectorAll('.theme-toggle, #theme-toggle-dash, #theme-toggle').forEach(btn => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const isLight = document.documentElement.getAttribute('data-theme') === 'light';
            setLocalTheme(!isLight);
        });
    });

    // 3. ARIA Chat Panel - MOVED TO aria_chat.html.twig

    // 4. Custom Cursor — translate + scale together (avoids halo “pinging” vs mousemove)
    const cursorDot = document.getElementById('cursor-dot');
    const cursorHalo = document.querySelector('#cursor-halo');
    let cursorHaloScale = 1;

    if (cursorDot && cursorHalo) {
        const updateCursorColor = () => {
            const isLight = document.documentElement.getAttribute('data-theme') === 'light';
            const color = isLight ? '#0f172a' : '#ffffff';
            cursorDot.style.background = color;
            cursorHalo.style.border = `1px solid ${color}`;
        };
        updateCursorColor();
        document.addEventListener('click', () => setTimeout(updateCursorColor, 50));

        const applyCursor = (clientX, clientY) => {
            cursorDot.style.transform = `translate(${clientX}px, ${clientY}px)`;
            cursorHalo.style.transform = `translate(${clientX - 15}px, ${clientY - 15}px) scale(${cursorHaloScale})`;
        };

        window.addEventListener('mousemove', (e) => {
            applyCursor(e.clientX, e.clientY);
        });

        document.querySelectorAll('a, button, .interactive').forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursorHaloScale = 1.22;
            });
            el.addEventListener('mouseleave', () => {
                cursorHaloScale = 1;
            });
        });
    }

    document.addEventListener('mouseover', (e) => {
        if (e.target.closest?.('.pp-card, .aria-card')) {
            document.body.classList.add('tripx-native-cursor');
        }
    });
    document.addEventListener('mouseout', (e) => {
        const from = e.target.closest?.('.pp-card, .aria-card');
        const to = e.relatedTarget?.closest?.('.pp-card, .aria-card');
        if (from && !to) {
            document.body.classList.remove('tripx-native-cursor');
        }
    });

    window.tripxShowToast = function (msg, ms) {
        const el = document.getElementById('tripxToast');
        if (!el) return;
        el.textContent = msg;
        el.classList.add('tripx-toast--show');
        clearTimeout(window._tripxToastTid);
        window._tripxToastTid = setTimeout(() => {
            el.classList.remove('tripx-toast--show');
        }, ms || 4200);
    };

    let lastFeedSig = '';
    function pollPriceAlerts() {
        if (document.body.dataset.auth !== '1') return;
        fetch('/api/price-alerts/feed', { credentials: 'same-origin', headers: { Accept: 'application/json' } })
            .then((r) => r.json().catch(() => ({})))
            .then((data) => {
                if (!data || !data.message || !data.sig) return;
                if (data.sig === lastFeedSig) return;
                lastFeedSig = data.sig;
                window.tripxShowToast?.(data.message, 7000);
            })
            .catch(() => {});
    }
    if (document.body.dataset.auth === '1') {
        setInterval(pollPriceAlerts, 90000);
        setTimeout(pollPriceAlerts, 4000);
    }

});

function handleSearch() {
    alert("Running AI Search for your destination...");
}
