// ════════════════════════════════════════════════════════════════════════
// ARIA AI CHAT ASSISTANT - COMPLETE IMPLEMENTATION
// ════════════════════════════════════════════════════════════════════════

document.addEventListener('DOMContentLoaded', function () {
    console.log('🤖 ARIA: Initializing chat assistant...');

    // ── DOM Elements ──────────────────────────────────────────────────────
    const orb = document.getElementById('aria-orb');
    const panel = document.getElementById('aria-panel');
    const closeBtn = document.getElementById('aria-close');
    const messagesContainer = document.getElementById('aria-messages');
    const inputEl = document.getElementById('aria-input');
    const sendBtn = document.getElementById('aria-send');
    const attachBtn = document.getElementById('aria-attach-btn');
    const fileInput = document.getElementById('aria-file-input');
    const imgPreview = document.getElementById('aria-img-preview');
    const previewImg = document.getElementById('aria-preview-img');
    const removeImgBtn = document.getElementById('aria-remove-img');
    const voiceBtn = document.getElementById('aria-voice-btn');
    const stopVoiceBtn = document.getElementById('aria-stop-voice-btn');

    // ── State Management ──────────────────────────────────────────────────
    let isPanelOpen = false;
    let selectedImageBase64 = null;
    let typingIndicator = null;

    // ── Verify Elements ───────────────────────────────────────────────────
    const elements = {
        orb, panel, closeBtn, messagesContainer, inputEl, sendBtn,
        attachBtn, fileInput, imgPreview, previewImg, removeImgBtn,
        voiceBtn, stopVoiceBtn
    };

    console.log('🔍 ARIA: Element check:', Object.fromEntries(
        Object.entries(elements).map(([k, v]) => [k, !!v])
    ));

    // Ensure panel starts hidden
    if (panel) {
        panel.style.display = 'none';
    }
    
    if (stopVoiceBtn) {
        stopVoiceBtn.style.display = 'none';
    }

    // ── Speech Recognition ──────────────────────────────────────────────
    let recognition = null;
    let isRecording = false;

    if ('webkitSpeechRecognition' in window || 'SpeechRecognition' in window) {
        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
        recognition = new SpeechRecognition();
        recognition.continuous = false;
        recognition.interimResults = true;
        recognition.lang = 'en-US'; // Or map to user pref!

        recognition.onstart = function() {
            isRecording = true;
            if (voiceBtn) {
                voiceBtn.classList.add('active');
                voiceBtn.style.color = '#ff4d6d'; // Visual feedback
                voiceBtn.style.borderColor = '#ff4d6d';
            }
            if (stopVoiceBtn) stopVoiceBtn.style.display = 'inline-block';
            if (inputEl) inputEl.placeholder = 'Listening...';
        };

        recognition.onresult = function(event) {
            let interimTranscript = '';
            for (let i = event.resultIndex; i < event.results.length; ++i) {
                if (event.results[i].isFinal) {
                    // Overwrite the input when final
                    if (inputEl) inputEl.value = event.results[i][0].transcript;
                } else {
                    interimTranscript += event.results[i][0].transcript;
                }
            }
            if (inputEl && interimTranscript !== '') {
                 // optionally update value iteratively
                 inputEl.value = interimTranscript;
            }
        };

        recognition.onerror = function(event) {
            console.error('🎤 ARIA Voice Error:', event.error);
            stopRecording();
        };

        recognition.onend = function() {
            if (isRecording) {
                stopRecording();
                // Auto-send if there is text
                if (inputEl && (inputEl.value.trim() !== '' || selectedImageBase64)) {
                    sendMessage();
                }
            }
        };
    } else {
        console.warn('SpeechRecognition API not supported in this browser.');
        if (voiceBtn) voiceBtn.style.display = 'none';
        if (stopVoiceBtn) stopVoiceBtn.style.display = 'none';
    }

    function startRecording() {
        if (recognition && !isRecording) {
            if (inputEl) inputEl.value = '';
            try {
                recognition.start();
            } catch (e) {
                console.error(e);
            }
        }
    }

    function stopRecording() {
        if (recognition && isRecording) {
            recognition.stop();
        }
        isRecording = false;
        if (voiceBtn) {
            voiceBtn.classList.remove('active');
            voiceBtn.style.color = '';
            voiceBtn.style.borderColor = '';
        }
        if (stopVoiceBtn) stopVoiceBtn.style.display = 'none';
        if (inputEl) inputEl.placeholder = '';
    }

    if (voiceBtn) {
        voiceBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (isRecording) {
                stopRecording();
            } else {
                startRecording();
            }
        });
    }

    if (stopVoiceBtn) {
        stopVoiceBtn.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            stopRecording();
        });
    }

    // ── Create Typing Indicator ──────────────────────────────────────────
    function createTypingIndicator() {
        const wrapper = document.createElement('div');
        wrapper.className = 'aria-msg bot';
        wrapper.id = 'aria-typing-wrapper';

        const bubble = document.createElement('div');
        bubble.className = 'aria-bubble';

        const typing = document.createElement('div');
        typing.className = 'aria-typing';
        typing.style.display = 'flex';
        typing.innerHTML = '<span></span><span></span><span></span>';

        bubble.appendChild(typing);
        wrapper.appendChild(bubble);
        return wrapper;
    }

    // ── Panel Toggle Functions ────────────────────────────────────────────
    function openPanel() {
        isPanelOpen = true;
        if (panel) {
            panel.style.display = 'flex';
            console.log('✅ ARIA: Panel opened');

            // Focus input after animation
            setTimeout(() => {
                if (inputEl) inputEl.focus();
            }, 100);

            // Scroll to bottom
            scrollToBottom();
        }
    }

    function closePanel() {
        isPanelOpen = false;
        if (panel) {
            panel.style.display = 'none';
            console.log('❌ ARIA: Panel closed');
        }
    }

    // ── Event Listeners: Panel Toggle ─────────────────────────────────────
    if (orb) {
        orb.addEventListener('click', function (e) {
            e.stopPropagation();
            console.log('🎯 ARIA: Orb clicked, isPanelOpen:', isPanelOpen);
            isPanelOpen ? closePanel() : openPanel();
        });
    }

    if (closeBtn) {
        closeBtn.addEventListener('click', function (e) {
            e.stopPropagation();
            closePanel();
        });
    }

    // Prevent panel clicks from closing it
    if (panel) {
        panel.addEventListener('click', function (e) {
            e.stopPropagation();
        });
    }

    // Close panel when clicking outside
    document.addEventListener('click', function (e) {
        if (isPanelOpen && panel && orb) {
            if (!panel.contains(e.target) && !orb.contains(e.target)) {
                closePanel();
            }
        }
    });

    // ── Scroll Function ───────────────────────────────────────────────────
    function scrollToBottom() {
        if (messagesContainer) {
            setTimeout(() => {
                messagesContainer.scrollTo({
                    top: messagesContainer.scrollHeight,
                    behavior: 'smooth'
                });
            }, 50);
        }
    }

    // ── Add Message Function ──────────────────────────────────────────────
    function addMessage(text, role, imageUrl = null) {
        if (!messagesContainer) {
            console.error('❌ ARIA: Messages container not found');
            return;
        }

        const msgWrapper = document.createElement('div');
        msgWrapper.className = `aria-msg ${role}`;

        const bubble = document.createElement('div');
        bubble.className = 'aria-bubble';

        // Add image if provided
        if (imageUrl) {
            const img = document.createElement('img');
            img.src = imageUrl;
            img.style.maxWidth = '200px';
            img.style.borderRadius = '12px';
            img.style.marginBottom = '8px';
            img.style.display = 'block';
            bubble.appendChild(img);
        }

        // Add text if provided
        if (text) {
            const textNode = document.createTextNode(text);
            bubble.appendChild(textNode);
        }

        msgWrapper.appendChild(bubble);
        messagesContainer.appendChild(msgWrapper);

        scrollToBottom();
        console.log(`💬 ARIA: Message added (${role}):`, text?.substring(0, 50));
    }

    // ── Typing Indicator Functions ────────────────────────────────────────
    function showTyping() {
        if (!messagesContainer) return;

        // Remove existing typing indicator
        const existing = document.getElementById('aria-typing-wrapper');
        if (existing) existing.remove();

        // Add new typing indicator
        typingIndicator = createTypingIndicator();
        messagesContainer.appendChild(typingIndicator);
        scrollToBottom();

        console.log('⏳ ARIA: Typing indicator shown');
    }

    function hideTyping() {
        if (typingIndicator && typingIndicator.parentNode) {
            typingIndicator.remove();
            typingIndicator = null;
            console.log('✓ ARIA: Typing indicator hidden');
        }
    }

    // ── Image Upload Functions ────────────────────────────────────────────
    if (attachBtn && fileInput) {
        attachBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            fileInput.click();
            console.log('📎 ARIA: File picker opened');
        });

        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            console.log('📷 ARIA: Image selected:', file.name, file.type);

            // Validate image type
            if (!file.type.startsWith('image/')) {
                alert('Please select an image file.');
                return;
            }

            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                alert('Image size must be less than 5MB.');
                return;
            }

            const reader = new FileReader();
            reader.onload = function (event) {
                const dataUrl = event.target.result;
                selectedImageBase64 = dataUrl.split(',')[1]; // Remove data:image/...;base64, prefix

                // Show preview
                if (previewImg && imgPreview) {
                    previewImg.src = dataUrl;
                    imgPreview.style.display = 'block';
                    console.log('✅ ARIA: Image preview shown');
                }
            };
            reader.readAsDataURL(file);
        });
    }

    // Remove image preview
    if (removeImgBtn) {
        removeImgBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            clearImagePreview();
        });
    }

    function clearImagePreview() {
        selectedImageBase64 = null;
        if (fileInput) fileInput.value = '';
        if (imgPreview) imgPreview.style.display = 'none';
        if (previewImg) previewImg.src = '';
        console.log('🗑️ ARIA: Image preview cleared');
    }

    // ── Send Message Function ─────────────────────────────────────────────
    async function sendMessage() {
        if (!inputEl) return;

        const text = inputEl.value.trim();
        const hasImage = selectedImageBase64 !== null;

        // Must have either text or image
        if (!text && !hasImage) {
            console.warn('⚠️ ARIA: No message to send');
            return;
        }

        console.log('📤 ARIA: Sending message:', { text, hasImage });

        // Add user message to UI
        if (hasImage && previewImg) {
            addMessage(text || 'What destination is this?', 'user', previewImg.src);
        } else {
            addMessage(text, 'user');
        }

        // Clear input
        inputEl.value = '';
        const imageData = selectedImageBase64;
        clearImagePreview();

        // Show typing indicator
        showTyping();

        try {
            const payload = { message: text || 'Analyze this travel image' };
            if (imageData) {
                payload.image = imageData;
            }

            const response = await fetch('/api/chat', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });

            if (!response.ok) {
                throw new Error(`HTTP ${response.status}: ${response.statusText}`);
            }

            const data = await response.json();
            hideTyping();

            if (data.response) {
                addMessage(data.response, 'bot');
                console.log('✅ ARIA: Response received');
            } else if (data.error) {
                addMessage(`⚠️ ${data.error}`, 'bot');
                console.error('❌ ARIA: API error:', data.error);
            } else {
                addMessage('Sorry, I didn\'t receive a proper response.', 'bot');
                console.warn('⚠️ ARIA: Empty response from API');
            }

        } catch (error) {
            hideTyping();
            console.error('❌ ARIA: Network error:', error);
            addMessage('🔌 Connection error. Please check your internet and try again.', 'bot');
        }

        // Refocus input
        if (inputEl) inputEl.focus();
    }

    // ── Event Listeners: Send Message ─────────────────────────────────────
    if (sendBtn) {
        sendBtn.addEventListener('click', function (e) {
            e.preventDefault();
            sendMessage();
        });
    }

    if (inputEl) {
        inputEl.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                sendMessage();
            }
        });

        // Prevent input from clearing on focus
        inputEl.addEventListener('focus', function (e) {
            e.stopPropagation();
        });
    }

    // ── Initial Setup ─────────────────────────────────────────────────────
    scrollToBottom();
    console.log('✨ ARIA: Initialization complete! Chat assistant ready.');
});