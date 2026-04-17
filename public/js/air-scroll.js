/**
 * Air Scroll Module - Phone-like gesture control for accommodations page
 * Requires MediaPipe Hands library
 * FIXED: Hand detection works regardless of scroll position
 * SECRET: Middle finger gesture -> Home page (shh! 🤫)
 */

const AirScroll = (function() {
    // Private variables
    let airScrollActive = false;
    let airHands = null;
    let airCamera = null;
    let airScrollVelocity = 0;
    let airScrollAnimationId = null;
    let airLastScrollTime = 0;
    let airLastFingerY = null;
    let airLastGesture = null;
    let airScrollElement = null;
    let videoStream = null; // Store stream reference
    
    // DOM elements
    let widget = null;
    let toggleBtn = null;
    let statusDot = null;
    let statusText = null;
    let gestureText = null;
    let video = null;
    let canvas = null;
    
    // Secret gesture cooldown (avoid accidental triggers)
    let lastSecretTrigger = 0;
    const SECRET_COOLDOWN = 3000; // 3 seconds
    
    // Private methods
    function startMomentum() {
        if (airScrollAnimationId) cancelAnimationFrame(airScrollAnimationId);
        
        function update() {
            if (Math.abs(airScrollVelocity) > 0.5 && airScrollActive && airScrollElement) {
                airScrollVelocity *= 0.92; // friction
                const newTop = airScrollElement.scrollTop + airScrollVelocity;
                if (newTop >= 0 && newTop <= airScrollElement.scrollHeight - airScrollElement.clientHeight) {
                    airScrollElement.scrollTop = newTop;
                } else {
                    airScrollVelocity = 0;
                }
                airScrollAnimationId = requestAnimationFrame(update);
            } else {
                airScrollVelocity = 0;
                airScrollAnimationId = null;
            }
        }
        update();
    }
    
    function scrollBy(delta) {
        if (!airScrollElement) return;
        const newTop = airScrollElement.scrollTop + delta;
        if (newTop >= 0 && newTop <= airScrollElement.scrollHeight - airScrollElement.clientHeight) {
            airScrollElement.scrollTop = newTop;
        }
    }
    
    function setPosition(position) {
        if (!airScrollElement) return;
        airScrollElement.scrollTop = Math.max(0, Math.min(position, airScrollElement.scrollHeight - airScrollElement.clientHeight));
    }
    
    function detectGesture(landmarks) {
        function isExtended(tipIdx, pipIdx) {
            return landmarks[pipIdx].y - landmarks[tipIdx].y > 0.02;
        }
        
        const indexExt = isExtended(8, 6);
        const middleExt = isExtended(12, 10);
        const ringExt = isExtended(16, 14);
        const pinkyExt = isExtended(20, 18);
        const thumbExt = Math.abs(landmarks[4].x - landmarks[2].x) > 0.05;
        
        const extendedCount = [indexExt, middleExt, ringExt, pinkyExt].filter(Boolean).length;
        
        // 🖕 SECRET GESTURE: Middle finger only (index and ring/pinky NOT extended)
        // This detects when ONLY middle finger is up
        if (!indexExt && middleExt && !ringExt && !pinkyExt) {
            return 'middle_finger';
        }
        
        if (indexExt && !middleExt && !ringExt && !pinkyExt) return 'pointing';
        if (indexExt && middleExt && !ringExt && !pinkyExt) return 'victory';
        if (extendedCount === 4) return 'open_palm';
        if (extendedCount === 0 && !thumbExt) return 'fist';
        return 'unknown';
    }
    
    function drawHand(landmarks) {
        if (!video || !canvas) return;
        
        const ctx = canvas.getContext('2d');
        const W = canvas.width = video.videoWidth || 640;
        const H = canvas.height = video.videoHeight || 480;
        
        ctx.clearRect(0, 0, W, H);
        ctx.save();
        ctx.scale(-1, 1);
        ctx.translate(-W, 0);
        
        const connections = [
            [0,1], [1,2], [2,3], [3,4],
            [0,5], [5,6], [6,7], [7,8],
            [0,9], [9,10], [10,11], [11,12],
            [0,13], [13,14], [14,15], [15,16],
            [0,17], [17,18], [18,19], [19,20]
        ];
        
        ctx.beginPath();
        ctx.strokeStyle = '#00ff00';
        ctx.lineWidth = 3;
        connections.forEach(([a,b]) => {
            ctx.moveTo(landmarks[a].x * W, landmarks[a].y * H);
            ctx.lineTo(landmarks[b].x * W, landmarks[b].y * H);
            ctx.stroke();
        });
        
        landmarks.forEach(p => {
            ctx.beginPath();
            ctx.arc(p.x * W, p.y * H, 5, 0, 2 * Math.PI);
            ctx.fillStyle = '#ff0000';
            ctx.fill();
        });
        
        ctx.restore();
    }
    
    // Secret function - shhh! 🤫
    function goHome() {
        const now = Date.now();
        if (now - lastSecretTrigger < SECRET_COOLDOWN) {
            console.log('Secret gesture on cooldown');
            return;
        }
        lastSecretTrigger = now;
        
        // Visual feedback (subtle, only in status)
        if (statusText) statusText.textContent = '🤫 Shhh... taking you home';
        if (gestureText) gestureText.textContent = '🖕';
        
        // Short delay so user sees the feedback
        setTimeout(() => {
            window.location.href = '/';
        }, 200);
    }
    
    function handleResults(results) {
        if (!airScrollActive) return;
        
        if (results.multiHandLandmarks && results.multiHandLandmarks.length > 0) {
            const landmarks = results.multiHandLandmarks[0];
            const gesture = detectGesture(landmarks);
            const fingerY = landmarks[8].y;
            
            if (statusDot) statusDot.classList.add('active');
            
            // 🖕 SECRET GESTURE DETECTION - HIGHEST PRIORITY
            if (gesture === 'middle_finger') {
                goHome();
                // Still show in UI briefly
                if (gestureText) gestureText.textContent = '🖕';
                return; // Don't process other gestures
            }
            
            if (gestureText) gestureText.textContent = gesture;
            
            const now = Date.now();
            
            switch(gesture) {
                case 'pointing':
                    if (statusText) statusText.textContent = '🎯 1:1 Tracking';
                    if (fingerY !== null && airScrollElement) {
                        const targetScroll = fingerY * (airScrollElement.scrollHeight - airScrollElement.clientHeight);
                        setPosition(targetScroll);
                        airScrollVelocity = 0;
                    }
                    break;
                    
                case 'open_palm':
                    if (statusText) statusText.textContent = '🖐️ Continuous';
                    if (airLastFingerY !== null && fingerY !== null && now - airLastScrollTime > 30) {
                        const delta = (airLastFingerY - fingerY) * 25;
                        if (Math.abs(delta) > 0.5) {
                            scrollBy(delta);
                            airLastScrollTime = now;
                        }
                    }
                    airLastFingerY = fingerY;
                    break;
                    
                case 'fist':
                    if (statusText) statusText.textContent = '✊ Brake';
                    airScrollVelocity = 0;
                    break;
                    
                case 'victory':
                    if (statusText) statusText.textContent = '✌️ Reset';
                    setPosition(0);
                    break;
                    
                default:
                    if (statusText) statusText.textContent = '🤚 Detecting...';
                    break;
            }
            
            // Flick detection
            if (airLastGesture === 'pointing' && gesture !== 'pointing' && airLastFingerY !== null && fingerY !== null) {
                const flickSpeed = (airLastFingerY - fingerY) * 100;
                if (Math.abs(flickSpeed) > 15) {
                    airScrollVelocity = flickSpeed;
                    startMomentum();
                    if (statusText) statusText.textContent = '⚡ Flick!';
                }
            }
            
            airLastGesture = gesture;
            airLastFingerY = fingerY;
            drawHand(landmarks);
        } else {
            if (statusDot) statusDot.classList.remove('active');
            if (statusText) statusText.textContent = '👋 No hand detected';
            if (gestureText) gestureText.textContent = '—';
            airLastFingerY = null;
            
            if (canvas) {
                const ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }
        }
    }
    
    async function startCamera() {
        try {
            // Stop any existing stream first
            if (videoStream) {
                videoStream.getTracks().forEach(track => track.stop());
                videoStream = null;
            }
            
            const stream = await navigator.mediaDevices.getUserMedia({ 
                video: { 
                    width: { ideal: 640 },
                    height: { ideal: 480 },
                    facingMode: "user"
                } 
            });
            videoStream = stream;
            
            if (!video) {
                video = document.getElementById('airWebcam');
            }
            if (!video) return;
            
            video.srcObject = stream;
            await new Promise(resolve => {
                video.onloadedmetadata = () => {
                    // Ensure video plays
                    video.play().then(resolve).catch(resolve);
                };
            });
            
            // Wait a bit for video to be ready
            await new Promise(resolve => setTimeout(resolve, 100));
            
            // Re-initialize hands if needed
            if (!airHands) {
                airHands = new Hands({
                    locateFile: (file) => `https://cdn.jsdelivr.net/npm/@mediapipe/hands/${file}`
                });
                airHands.setOptions({
                    maxNumHands: 1,
                    modelComplexity: 1,
                    minDetectionConfidence: 0.5,
                    minTrackingConfidence: 0.5
                });
                airHands.onResults(handleResults);
            }
            
            airCamera = new Camera(video, {
                onFrame: async () => {
                    if (airHands && airScrollActive && video && video.videoWidth > 0) {
                        try {
                            await airHands.send({ image: video });
                        } catch (err) {
                            // Silent fail - sometimes happens during rapid toggles
                        }
                    }
                },
                width: 640,
                height: 480
            });
            airCamera.start();
            
            if (statusText) statusText.textContent = '✅ Camera ready! Show your hand';
            console.log('Air Scroll: Camera started successfully');
        } catch (err) {
            console.error('Camera error:', err);
            if (statusText) statusText.textContent = '❌ Camera access denied';
        }
    }
    
    function stopCamera() {
        if (airCamera) {
            airCamera.stop();
            airCamera = null;
        }
        
        if (videoStream) {
            videoStream.getTracks().forEach(track => track.stop());
            videoStream = null;
        }
        
        if (video && video.srcObject) {
            video.srcObject = null;
        }
        
        airScrollVelocity = 0;
        
        // Clear canvas
        if (canvas) {
            const ctx = canvas.getContext('2d');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
        }
        
        console.log('Air Scroll: Camera stopped');
    }
    
    function makeDraggable() {
        if (!widget) return;
        const header = document.getElementById('airScrollHeader');
        if (!header) return;
        
        let pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
        
        function dragMouseDown(e) {
            e = e || window.event;
            e.preventDefault();
            pos3 = e.clientX;
            pos4 = e.clientY;
            document.onmouseup = closeDragElement;
            document.onmousemove = elementDrag;
        }
        
        function elementDrag(e) {
            e = e || window.event;
            e.preventDefault();
            pos1 = pos3 - e.clientX;
            pos2 = pos4 - e.clientY;
            pos3 = e.clientX;
            pos4 = e.clientY;
            let top = widget.offsetTop - pos2;
            let left = widget.offsetLeft - pos1;
            const maxLeft = window.innerWidth - widget.offsetWidth;
            const maxTop = window.innerHeight - widget.offsetHeight;
            widget.style.top = Math.min(Math.max(0, top), maxTop) + 'px';
            widget.style.left = Math.min(Math.max(0, left), maxLeft) + 'px';
            widget.style.bottom = 'auto';
            widget.style.right = 'auto';
        }
        
        function closeDragElement() {
            document.onmouseup = null;
            document.onmousemove = null;
        }
        
        header.onmousedown = dragMouseDown;
    }
    
    // Public methods
    function init(scrollElementId = 'acc-cards-area') {
        airScrollElement = document.getElementById(scrollElementId);
        widget = document.getElementById('airScrollWidget');
        toggleBtn = document.getElementById('airScrollToggle');
        statusDot = document.getElementById('airStatusDot');
        statusText = document.getElementById('airStatusText');
        gestureText = document.getElementById('airGestureText');
        video = document.getElementById('airWebcam');
        canvas = document.getElementById('airCanvas');
        
        if (!airScrollElement || !widget || !toggleBtn) {
            console.warn('Air Scroll: Required elements not found');
            return false;
        }
        
        makeDraggable();
        
        // Remove existing listener to avoid duplicates
        const newToggleBtn = toggleBtn.cloneNode(true);
        toggleBtn.parentNode.replaceChild(newToggleBtn, toggleBtn);
        toggleBtn = newToggleBtn;
        
        toggleBtn.addEventListener('click', toggle);
        const closeBtn = document.getElementById('airScrollClose');
        if (closeBtn) {
            const newCloseBtn = closeBtn.cloneNode(true);
            closeBtn.parentNode.replaceChild(newCloseBtn, closeBtn);
            newCloseBtn.addEventListener('click', close);
        }
        
        console.log('Air Scroll: Initialized successfully');
        return true;
    }
    
    function toggle() {
        if (!airScrollActive) {
            activate();
        } else {
            deactivate();
        }
    }
    
    function activate() {
        if (!widget || !toggleBtn) return;
        
        widget.style.display = 'block';
        toggleBtn.classList.add('active');
        if (toggleBtn.querySelector('.toggle-text')) {
            toggleBtn.querySelector('.toggle-text').textContent = 'Stop Air Scroll';
        }
        airScrollActive = true;
        
        // Reset tracking variables
        airLastFingerY = null;
        airLastGesture = null;
        airScrollVelocity = 0;
        
        // Start camera with a small delay to ensure DOM is ready
        setTimeout(() => {
            if (airScrollActive) {
                startCamera();
            }
        }, 100);
    }
    
    function deactivate() {
        if (!widget || !toggleBtn) return;
        
        widget.style.display = 'none';
        toggleBtn.classList.remove('active');
        if (toggleBtn.querySelector('.toggle-text')) {
            toggleBtn.querySelector('.toggle-text').textContent = 'Air Scroll';
        }
        airScrollActive = false;
        stopCamera();
        airScrollVelocity = 0;
        airLastFingerY = null;
        airLastGesture = null;
        
        if (statusText) statusText.textContent = '👋 Air Scroll off';
    }
    
    function close() {
        if (airScrollActive) {
            deactivate();
        } else if (widget) {
            widget.style.display = 'none';
        }
    }
    
    function isActive() {
        return airScrollActive;
    }
    
    function restart() {
        if (airScrollActive) {
            deactivate();
            setTimeout(() => activate(), 200);
        }
    }
    
    // Return public API
    return {
        init: init,
        toggle: toggle,
        activate: activate,
        deactivate: deactivate,
        close: close,
        isActive: isActive,
        restart: restart
    };
})();

// Auto-initialize when DOM is ready
if (typeof document !== 'undefined') {
    document.addEventListener('DOMContentLoaded', function() {
        // Small delay to ensure accommodations page is ready
        setTimeout(function() {
            if (document.getElementById('airScrollWidget')) {
                AirScroll.init('acc-cards-area');
                console.log('Air Scroll: Auto-initialized');
            }
        }, 500);
    });
}

// Expose globally
window.AirScroll = AirScroll;