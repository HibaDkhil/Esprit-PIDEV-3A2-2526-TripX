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

    // 3. ARIA Chat Panel (shared on all pages)
    const ariaOrb = document.getElementById('aria-orb');
    const ariaPanel = document.getElementById('aria-panel');
    const ariaClose = document.getElementById('aria-close');
    const ariaInput = document.getElementById('aria-input');
    const ariaSend = document.getElementById('aria-send');
    const ariaMessages = document.getElementById('aria-messages');
    const ariaInputRow = ariaPanel?.querySelector('.aria-input-row');
    if (ariaInputRow && !ariaInputRow.querySelector('#aria-attach-btn')) {
        const attachBtn = document.createElement('button');
        attachBtn.id = 'aria-attach-btn';
        attachBtn.className = 'aria-action-btn';
        attachBtn.title = 'Attach image';
        attachBtn.textContent = '📎';
        ariaInputRow.insertBefore(attachBtn, ariaInputRow.firstChild);
    }
    if (ariaInputRow && !ariaInputRow.querySelector('#aria-voice-btn')) {
        const voiceBtn = document.createElement('button');
        voiceBtn.id = 'aria-voice-btn';
        voiceBtn.className = 'aria-action-btn';
        voiceBtn.title = 'Voice search';
        voiceBtn.textContent = '🎤';
        ariaInputRow.insertBefore(voiceBtn, ariaInputRow.firstChild.nextSibling);
    }
    if (ariaInputRow && !ariaInputRow.querySelector('#aria-stop-voice-btn')) {
        const stopBtn = document.createElement('button');
        stopBtn.id = 'aria-stop-voice-btn';
        stopBtn.className = 'aria-action-btn';
        stopBtn.title = 'Stop voice';
        stopBtn.textContent = '⏹';
        ariaInputRow.appendChild(stopBtn);
    }
    if (ariaInputRow && !ariaInputRow.querySelector('#aria-file-input')) {
        const fileInput = document.createElement('input');
        fileInput.type = 'file';
        fileInput.id = 'aria-file-input';
        fileInput.accept = 'image/*';
        fileInput.style.display = 'none';
        ariaInputRow.appendChild(fileInput);
    }
    const ariaAttachBtn = document.getElementById('aria-attach-btn');
    const ariaVoiceBtn = document.getElementById('aria-voice-btn');
    const ariaStopVoiceBtn = document.getElementById('aria-stop-voice-btn');
    const ariaFileInput = document.getElementById('aria-file-input');

    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const speechRecognition = SpeechRecognition ? new SpeechRecognition() : null;
    let selectedImageBase64 = null;
    let selectedImageMimeType = null;

    if (ariaOrb && ariaPanel && !window.__ariaChatInitialized) {
        ariaOrb.textContent = '🤖';
        const ariaAvatar = ariaPanel.querySelector('.aria-avatar');
        if (ariaAvatar) ariaAvatar.textContent = '🤖';
        const ariaStatus = ariaPanel.querySelector('.aria-status');
        if (ariaStatus) ariaStatus.textContent = 'AI Travel Assistant';

        ariaOrb.addEventListener('click', () => {
            ariaPanel.classList.add('open');
            ariaInput?.focus();
        });

        if (ariaClose) {
            ariaClose.addEventListener('click', () => {
                ariaPanel.classList.remove('open');
            });
        }

        const appendBubble = (role, txt) => {
            if (!ariaMessages) return;
            const wrap = document.createElement('div');
            wrap.className = `aria-msg ${role}`;
            const bubble = document.createElement('div');
            bubble.className = 'aria-bubble';
            bubble.textContent = txt;
            wrap.appendChild(bubble);
            ariaMessages.appendChild(wrap);
            ariaMessages.scrollTop = ariaMessages.scrollHeight;
        };

        const speakText = (text) => window.TRIPX_ARIA?.speak?.(text);

        const stopSpeaking = () => {
            if (window.speechSynthesis) {
                window.speechSynthesis.cancel();
            }
        };

        const clearImagePreview = () => {
            ariaPanel?.classList.remove('has-image-preview');
            const prev = document.getElementById('aria-img-preview');
            const img = document.getElementById('aria-preview-img');
            if (prev) prev.style.display = 'none';
            if (img) img.removeAttribute('src');
        };

        const ensureImagePreview = () => {
            let wrap = document.getElementById('aria-img-preview');
            if (wrap || !ariaPanel || !ariaInputRow) return wrap;
            wrap = document.createElement('div');
            wrap.id = 'aria-img-preview';
            wrap.className = 'aria-img-preview';
            wrap.style.display = 'none';
            const img = document.createElement('img');
            img.id = 'aria-preview-img';
            img.alt = 'Attached image';
            const rm = document.createElement('button');
            rm.type = 'button';
            rm.className = 'remove-img';
            rm.id = 'aria-remove-img';
            rm.title = 'Remove image';
            rm.textContent = '✕';
            rm.addEventListener('click', () => {
                selectedImageBase64 = null;
                selectedImageMimeType = null;
                if (ariaFileInput) ariaFileInput.value = '';
                clearImagePreview();
            });
            wrap.appendChild(img);
            wrap.appendChild(rm);
            ariaPanel.insertBefore(wrap, ariaInputRow);
            return wrap;
        };

        const sendMessage = async () => {
            const txt = ariaInput.value.trim();
            if (!txt && !selectedImageBase64) return;
            appendBubble('user', txt || '📷 Image');
            ariaInput.value = '';
            const imagePayload = selectedImageBase64;
            const imageMimeType = selectedImageMimeType;
            selectedImageBase64 = null;
            selectedImageMimeType = null;
            if (ariaFileInput) ariaFileInput.value = '';
            clearImagePreview();

            const typingEl = document.createElement('div');
            typingEl.className = 'aria-msg bot';
            typingEl.innerHTML = '<div class="aria-bubble aria-typing-bubble" aria-live="polite"><span class="aria-ellipsis">...</span></div>';
            ariaMessages.appendChild(typingEl);
            ariaMessages.scrollTop = ariaMessages.scrollHeight;

            try {
                const res = await fetch('/api/chat', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
                    credentials: 'same-origin',
                    body: JSON.stringify({ message: txt, image: imagePayload, imageMimeType })
                });
                const raw = await res.text();
                let data = {};
                try {
                    data = raw ? JSON.parse(raw) : {};
                } catch (parseErr) {
                    typingEl.remove();
                    appendBubble('bot', '⚠️ Server returned non-JSON (HTTP ' + res.status + '). Try refreshing if you are logged in.');
                    return;
                }
                typingEl.remove();
                if (data.response) {
                    appendBubble('bot', data.response);
                    speakText(data.response);
                } else if (data.error) {
                    appendBubble('bot', '⚠️ ' + data.error);
                } else {
                    appendBubble('bot', '⚠️ No response from server (HTTP ' + res.status + '). Try again.');
                }
            } catch (e) {
                typingEl.remove();
                appendBubble('bot', '⚠️ Connection issue. Check your network and try again.');
            }
        };

        if (ariaSend) ariaSend.addEventListener('click', sendMessage);
        if (ariaInput) ariaInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') sendMessage();
        });

        ariaAttachBtn?.addEventListener('click', () => ariaFileInput?.click());
        ariaFileInput?.addEventListener('change', () => {
            const file = ariaFileInput.files?.[0];
            if (!file || !file.type.startsWith('image/')) return;
            if (file.size > 5 * 1024 * 1024) {
                appendBubble('bot', '⚠️ Image too large (max 5MB).');
                return;
            }
            const reader = new FileReader();
            reader.onload = (ev) => {
                const dataUrl = String(ev.target?.result || '');
                selectedImageBase64 = dataUrl.includes(',') ? dataUrl.split(',')[1] : null;
                selectedImageMimeType = file.type || 'image/jpeg';
                const wrap = ensureImagePreview();
                const img = document.getElementById('aria-preview-img');
                if (wrap && img) {
                    img.src = dataUrl;
                    wrap.style.display = 'block';
                    ariaPanel?.classList.add('has-image-preview');
                }
            };
            reader.readAsDataURL(file);
        });

        if (speechRecognition) {
            speechRecognition.lang = 'en-US';
            speechRecognition.interimResults = false;
            speechRecognition.maxAlternatives = 1;
            ariaVoiceBtn?.addEventListener('click', () => {
                ariaVoiceBtn.classList.add('active');
                speechRecognition.start();
            });
            speechRecognition.addEventListener('result', (event) => {
                const transcript = event.results?.[0]?.[0]?.transcript || '';
                if (ariaInput) ariaInput.value = transcript;
                sendMessage();
            });
            speechRecognition.addEventListener('end', () => ariaVoiceBtn?.classList.remove('active'));
        }
        ariaStopVoiceBtn?.addEventListener('click', stopSpeaking);
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
