/**
 * face-camera.js  –  Shared webcam + canvas helpers
 * Place at: public/js/face-camera.js
 *
 * Exposes window.FaceCamera  (used by both face-login.js and face-setup.js)
 */
(function () {
  'use strict';

  /* ── Grid canvas (ambient background) ── */
  (function initGrid() {
    var canvas = document.getElementById('fl-grid');
    if (!canvas) return;
    var ctx = canvas.getContext('2d');
    var offset = 0;
    function resize() {
      canvas.width  = window.innerWidth;
      canvas.height = window.innerHeight;
    }
    resize();
    window.addEventListener('resize', resize);
    function draw() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
      ctx.strokeStyle = 'rgba(244,185,66,0.5)';
      ctx.lineWidth = .4;
      var cell = 55;
      var ox = offset % cell;
      for (var x = -ox; x < canvas.width; x += cell) {
        ctx.beginPath(); ctx.moveTo(x,0); ctx.lineTo(x, canvas.height); ctx.stroke();
      }
      for (var y = -ox; y < canvas.height; y += cell) {
        ctx.beginPath(); ctx.moveTo(0,y); ctx.lineTo(canvas.width, y); ctx.stroke();
      }
      offset += .25;
      requestAnimationFrame(draw);
    }
    draw();
  })();

  /* ══ FaceCamera namespace ══ */
  var FaceCamera = {
    stream: null,
    videoEl: null,
    canvasEl: null,
    modelsLoaded: false,

    /** Load face-api models from CDN. */
    loadModels: function (onComplete) {
      if (this.modelsLoaded) { onComplete && onComplete(); return; }
      
      var url = window.TRIPX_FACE.modelsUrl;
      console.log('Loading face-api models from:', url);
      
      Promise.all([
        faceapi.nets.tinyFaceDetector.loadFromUri(url),
        faceapi.nets.faceLandmark68Net.loadFromUri(url),
        faceapi.nets.faceRecognitionNet.loadFromUri(url)
      ]).then(function () {
        FaceCamera.modelsLoaded = true;
        console.log('Face models ready.');
        onComplete && onComplete();
      }).catch(function (err) {
        console.error('Model load failed:', err);
      });
    },

    /**
     * Initialise the webcam stream.
     * (Starts immediately to avoid 'black screen' while models load)
     */
    init: function (video, canvas, onReady, onError) {
      this.videoEl  = video;
      this.canvasEl = canvas;

      if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        onError('Your browser does not support camera access.');
        return;
      }

      // Start camera immediately
      navigator.mediaDevices.getUserMedia({
        video: {
          width:       { ideal: 640 },
          height:      { ideal: 480 },
          facingMode:  'user',
          frameRate:   { ideal: 30 },
        },
        audio: false,
      })
        .then(function (stream) {
          FaceCamera.stream = stream;
          video.srcObject = stream;
          
          function startVideo() {
            video.play().then(onReady).catch(function(e) {
                console.error("Video play failed:", e);
                onError("Failed to start video stream.");
            });
          }

          if (video.readyState >= 3) {
            startVideo();
          } else {
            video.onloadedmetadata = startVideo;
          }
        })
        .catch(function (err) {
          console.error('Camera error:', err);
          var msg = 'Camera access denied.';
          if (err.name === 'NotFoundError')      msg = 'No camera found.';
          if (err.name === 'NotAllowedError')    msg = 'Camera permission denied.';
          onError(msg);
        });

      // Load models in background
      this.loadModels();
    },

    /** Extract a 128-float face descriptor. */
    getDescriptor: function () {
      console.log('getDescriptor requested...');
      if (typeof faceapi === 'undefined') {
        return Promise.reject(new Error('faceapi library not loaded. Check your internet connection or CDN.'));
      }
      if (!this.modelsLoaded) {
        return Promise.reject(new Error('AI models are still loading. Please wait a few seconds.'));
      }
      
      try {
        console.log('Running faceapi detection...');
        return faceapi.detectSingleFace(this.videoEl, new faceapi.TinyFaceDetectorOptions())
          .withFaceLandmarks()
          .withFaceDescriptor()
          .then(function (res) {
            console.log('Detection result:', res ? 'Found' : 'Not found');
            if (!res) return null;
            return Array.from(res.descriptor);
          })
          .catch(function (err) {
            console.error('Faceapi internal error:', err);
            throw err;
          });
      } catch (e) {
        console.error('getDescriptor sync error:', e);
        return Promise.reject(e);
      }
    },

    /** Stop the webcam stream. */
    stop: function () {
      if (this.stream) {
        this.stream.getTracks().forEach(function (t) { t.stop(); });
        this.stream = null;
      }
    },

    /**
     * Capture the current video frame as a base64 JPEG string.
     * @param {number} quality  0–1, default 0.92
     * @returns {string}  data:image/jpeg;base64,...
     */
    capture: function (quality) {
      quality = quality || 0.92;
      var video  = this.videoEl;
      var canvas = this.canvasEl;
      canvas.width  = video.videoWidth  || 640;
      canvas.height = video.videoHeight || 480;
      var ctx = canvas.getContext('2d');
      // Mirror to match the CSS transform on the video element
      ctx.translate(canvas.width, 0);
      ctx.scale(-1, 1);
      ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
      return canvas.toDataURL('image/jpeg', quality);
    },

    /** Show/hide a named overlay. */
    showOverlay: function (name) {
      ['Load', 'Success', 'Error'].forEach(function (n) {
        var el = document.getElementById('flOverlay' + n);
        if (el) el.style.display = (n === name) ? 'flex' : 'none';
      });
    },

    hideOverlays: function () {
      ['Load', 'Success', 'Error'].forEach(function (n) {
        var el = document.getElementById('flOverlay' + n);
        if (el) el.style.display = 'none';
      });
      this.stopScan();
    },

    /** Start the visual 0-100% scan animation */
    startScan: function(onComplete) {
      var pctEl = document.getElementById('flScanPct');
      if (!pctEl) return;
      
      pctEl.style.display = 'block';
      pctEl.textContent = '0%';
      
      var current = 0;
      var interval = setInterval(function() {
        if (current >= 100) {
          clearInterval(interval);
          if (onComplete) onComplete();
          return;
        }
        current += Math.floor(Math.random() * 5) + 2;
        if (current > 100) current = 100;
        pctEl.textContent = current + '%';
      }, 50);
      
      this._scanInterval = interval;
    },

    /** Stop and hide the scan animation */
    stopScan: function() {
      if (this._scanInterval) {
        clearInterval(this._scanInterval);
        this._scanInterval = null;
      }
      var pctEl = document.getElementById('flScanPct');
      if (pctEl) {
        pctEl.style.display = 'none';
        pctEl.textContent = '0%';
      }
    },

    /** Update the status bar. */
    setStatus: function (text, state) {
      var dot  = document.getElementById('flStatusDot');
      var span = document.getElementById('flStatusText');
      if (dot)  { dot.className  = 'fl-status-dot ' + (state || ''); }
      if (span) { span.textContent = text; }
    },

    /** Animate confidence meter (0-100). */
    showConfidence: function (pct) {
      var wrap = document.getElementById('flConfidence');
      var fill = document.getElementById('flConfFill');
      var val  = document.getElementById('flConfVal');
      if (!wrap) return;
      wrap.style.display = 'flex';
      setTimeout(function () {
        if (fill) fill.style.width = pct + '%';
        if (val)  val.textContent  = pct + '%';
      }, 80);
    },

    /** Generic JSON POST helper. */
    post: function (url, payload, csrfToken) {
      var headers = { 'Content-Type': 'application/json' };
      if (csrfToken) headers['X-CSRF-Token'] = csrfToken;
      return fetch(url, {
        method:  'POST',
        headers: headers,
        body:    JSON.stringify(payload),
      }).then(function (r) {
        if (!r.ok && r.status !== 422 && r.status !== 401 && r.status !== 403 && r.status !== 404) {
          throw new Error('HTTP ' + r.status);
        }
        return r.json();
      });
    },

    /** AI Guidance Engine: Real-time user instructions */
    _guidanceTimer: null,
    startGuidance: function(onUpdate) {
      if (this._guidanceTimer) return;
      var self = this;
      
      // Immediate feedback on start
      if (!this.modelsLoaded) {
          onUpdate({ status: "busy", message: "Initialising AI models... ⚙️", lighting: "none", position: "none" });
      }

      var tick = function() {
        if (!self.stream) { self.stopGuidance(); return; }
        
        // 1. Detection-based checks (Distance & Pos)
        if (self.modelsLoaded && typeof faceapi !== 'undefined') {
          // More sensitive detector options
          var options = new faceapi.TinyFaceDetectorOptions({ scoreThreshold: 0.35, inputSize: 320 });
          
          faceapi.detectSingleFace(self.videoEl, options)
            .then(function(res) {
              var feedback = { status: "ready", message: "Position ready ✓", lighting: "good", position: "good" };
              
              // Brightness check (Canvas sampling)
              var bright = self._sampleBrightness();
              if (bright < 60) { 
                feedback.message = "More light needed 💡"; 
                feedback.lighting = "bad"; 
                feedback.status = "busy";
              }
              else if (bright > 235) { 
                feedback.message = "Too bright! Move away ☀️"; 
                feedback.lighting = "warn"; 
                feedback.status = "busy";
              }

              if (!res) {
                 feedback.message = "Look at the camera 😐";
                 feedback.position = "bad";
                 feedback.status = "busy";
              } else {
                 var box = res.detection.box;
                 var vw = self.videoEl.videoWidth || 640;
                 var vh = self.videoEl.videoHeight || 480;
                 
                 // Distance (Box size)
                 var boxPct = (box.width / vw) * 100;
                 if (boxPct < 30) { feedback.message = "Move closer"; feedback.position = "warn"; feedback.status = "busy"; }
                 else if (boxPct > 70) { feedback.message = "Too close! Move back"; feedback.position = "warn"; feedback.status = "busy"; }

                 // Centering
                 var centerX = box.x + (box.width / 2);
                 var centerY = box.y + (box.height / 2);
                 var devX = Math.abs(centerX - (vw/2)) / vw;
                 var devY = Math.abs(centerY - (vh/2)) / vh;
                 if (devX > 0.15 || devY > 0.15) {
                    feedback.message = "Please center your face";
                    feedback.position = "warn";
                    feedback.status = "busy";
                 }
              }

              onUpdate(feedback);
              self._guidanceTimer = setTimeout(tick, 600);
            })
            .catch(function() { 
              self._guidanceTimer = setTimeout(tick, 1000); 
            });
        } else {
           self._guidanceTimer = setTimeout(tick, 1000);
        }
      };
      tick();
    },

    stopGuidance: function() {
      if (this._guidanceTimer) clearTimeout(this._guidanceTimer);
      this._guidanceTimer = null;
    },

    _sampleBrightness: function() {
      if (!this.videoEl) return 128;
      var c = document.createElement('canvas');
      c.width = 40; c.height = 30;
      var ctx = c.getContext('2d');
      ctx.drawImage(this.videoEl, 0, 0, 40, 30);
      var data = ctx.getImageData(0,0,40,30).data;
      var sum = 0;
      for (var i=0; i<data.length; i+=4) {
        sum += (data[i] + data[i+1] + data[i+2]) / 3;
      }
      return sum / (data.length / 4);
    }
  };

  window.FaceCamera = FaceCamera;

})();
