// admin-chat.js
// ════════════════════════════════════════════════════════════════════
// TripX Admin Chat - Real-time Firebase Integration
// ════════════════════════════════════════════════════════════════════

(function() {
  'use strict';

  // ══════════════ DOM ELEMENTS ══════════════
  const messagesContainer = document.querySelector('.ac-messages');
  const messageInput = document.getElementById('messageInput');
  const sendBtn = document.getElementById('sendBtn');
  const typingIndicator = document.getElementById('typingIndicator');
  const connectionStatus = document.getElementById('connectionStatus');
  const onlineCount = document.getElementById('onlineCount');
  const adminsList = document.getElementById('adminsList');
  const emojiBtn = document.getElementById('emojiBtn');
  const emojiPicker = document.getElementById('emojiPicker');
  const attachBtn = document.getElementById('attachBtn');
  const imageInput = document.getElementById('imageInput');

  // ══════════════ STATE ══════════════
  let currentUser = null;
  let messagesRef = null;
  let typingRef = null;
  let presenceRef = null;
  let typingTimeout = null;
  let isTyping = false;

  // ══════════════ INITIALIZE ══════════════
  function init() {
    setupAuth();
    setupUI();
  }

  // ══════════════ AUTHENTICATION ══════════════
  function setupAuth() {
    // Bypass Firebase Auth and use backend-provided admin details
    if (window.TRIPX_ADMIN_USER) {
      currentUser = window.TRIPX_ADMIN_USER;
      console.log('✅ Authenticated via Symfony as:', currentUser.name);
      onUserAuthenticated();
    } else {
      showSystemMessage('Error: Admin user data not provided by backend.');
    }

    // Monitor connection status
    const connectedRef = database.ref('.info/connected');
    connectedRef.on('value', snapshot => {
      const connected = snapshot.val();
      updateConnectionStatus(connected);
    });
  }

  function onUserAuthenticated() {
    // Initialize Firebase references
    messagesRef = database.ref('admin_messages');
    typingRef = database.ref('admin_typing');
    presenceRef = database.ref('admin_presence/' + currentUser.uid);

    // Setup presence system
    setupPresence();
    
    // Load messages
    loadMessages();
    
    // Listen for typing indicators
    listenForTyping();
    
    // Listen for online admins
    listenForOnlineAdmins();
    
    // Show welcome message
    showSystemMessage(`Welcome, ${currentUser.name}! 👋`);
  }

  // ══════════════ PRESENCE SYSTEM ══════════════
  function setupPresence() {
    // Set user as online
    presenceRef.set({
      name: currentUser.name,
      avatar: currentUser.avatar,
      email: currentUser.email,
      online: true,
      lastSeen: firebase.database.ServerValue.TIMESTAMP
    });

    // Remove presence on disconnect
    presenceRef.onDisconnect().remove();

    // Update last seen periodically
    setInterval(() => {
      if (currentUser) {
        presenceRef.update({
          lastSeen: firebase.database.ServerValue.TIMESTAMP
        });
      }
    }, 30000); // Every 30 seconds
  }

  // ══════════════ MESSAGES ══════════════
  function loadMessages() {
    // Listen for new messages (last 50)
    messagesRef.orderByChild('timestamp').limitToLast(50).on('child_added', snapshot => {
      const message = snapshot.val();
      message.id = snapshot.key;
      displayMessage(message);
      scrollToBottom();
    });

    // Listen for deleted messages
    messagesRef.on('child_removed', snapshot => {
      const messageId = snapshot.key;
      const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
      if (messageElement) {
        messageElement.style.animation = 'fadeOut 0.3s ease';
        setTimeout(() => messageElement.remove(), 300);
      }
    });
  }

  function sendMessage() {
    const text = messageInput.value.trim();
    if (!text) return;
    if (emojiPicker) emojiPicker.style.display = 'none';

    // Create message object
    const message = {
      text: text,
      userId: currentUser.uid,
      userName: currentUser.name,
      userAvatar: currentUser.avatar,
      timestamp: firebase.database.ServerValue.TIMESTAMP,
      read: false
    };

    // Send to Firebase
    messagesRef.push(message)
      .then(() => {
        console.log('✅ Message sent');
        messageInput.value = '';
        messageInput.style.height = 'auto';
        stopTyping();
      })
      .catch(error => {
        console.error('❌ Error sending message:', error);
        showSystemMessage('Failed to send message. Please try again.');
      });
  }

  function sendImageMessage(base64Image) {
    const message = {
      text: '',
      imageUrl: base64Image,
      userId: currentUser.uid,
      userName: currentUser.name,
      userAvatar: currentUser.avatar,
      timestamp: firebase.database.ServerValue.TIMESTAMP,
      read: false
    };
    
    messagesRef.push(message)
      .then(() => console.log('✅ Image sent'))
      .catch(error => {
        console.error('❌ Error sending image:', error);
        showSystemMessage('Failed to send image. Ensure file is not too large.');
      });
  }

  function displayMessage(message) {
    // Remove welcome message if it exists
    const welcome = document.querySelector('.ac-welcome');
    if (welcome) welcome.remove();

    const isMine = message.userId === currentUser.uid;
    const messageEl = document.createElement('div');
    messageEl.className = `ac-msg ${isMine ? 'mine' : 'theirs'}`;
    messageEl.setAttribute('data-message-id', message.id);

    const time = message.timestamp ? formatTime(message.timestamp) : 'Just now';
    
    let contentHtml = '';
    if (message.text) {
      contentHtml += `<div>${escapeHtml(message.text)}</div>`;
    }
    if (message.imageUrl) {
      contentHtml += `<img src="${message.imageUrl}" style="max-width: 100%; border-radius: 8px; margin-top: 5px; max-height: 250px; cursor: pointer;" onclick="window.open(this.src)" />`;
    }
    
    messageEl.innerHTML = `
      <div class="ac-msg-avatar">${message.userAvatar || '?'}</div>
      <div class="ac-msg-content">
        ${!isMine ? `<div class="ac-msg-header">
          <span class="ac-msg-author">${escapeHtml(message.userName)}</span>
          <span class="ac-msg-time">${time}</span>
        </div>` : ''}
        <div class="ac-bubble">${contentHtml}</div>
        ${isMine ? `<div class="ac-msg-header">
          <span class="ac-msg-time">${time}</span>
        </div>` : ''}
      </div>
    `;

    messagesContainer.appendChild(messageEl);
    scrollToBottom();
  }

  function showSystemMessage(text) {
    const messageEl = document.createElement('div');
    messageEl.className = 'ac-msg system';
    messageEl.innerHTML = `<div class="ac-bubble">${escapeHtml(text)}</div>`;
    messagesContainer.appendChild(messageEl);
    scrollToBottom();
  }

  // ══════════════ TYPING INDICATOR ══════════════
  function startTyping() {
    if (!isTyping && currentUser) {
      isTyping = true;
      typingRef.child(currentUser.uid).set({
        name: currentUser.name,
        avatar: currentUser.avatar
      });
    }

    // Clear existing timeout
    clearTimeout(typingTimeout);
    
    // Stop typing after 3 seconds of inactivity
    typingTimeout = setTimeout(stopTyping, 3000);
  }

  function stopTyping() {
    if (isTyping && currentUser) {
      isTyping = false;
      typingRef.child(currentUser.uid).remove();
    }
    clearTimeout(typingTimeout);
  }

  function listenForTyping() {
    typingRef.on('value', snapshot => {
      const typing = snapshot.val();
      
      if (!typing) {
        typingIndicator.style.display = 'none';
        return;
      }

      // Get first user who is typing (excluding current user)
      const typingUsers = Object.entries(typing).filter(([uid]) => uid !== currentUser.uid);
      
      if (typingUsers.length > 0) {
        const [uid, user] = typingUsers[0];
        showTypingIndicator(user);
      } else {
        typingIndicator.style.display = 'none';
      }
    });
  }

  function showTypingIndicator(user) {
    typingIndicator.querySelector('.ac-typing-avatar').textContent = user.avatar || '?';
    typingIndicator.querySelector('.ac-typing-name').textContent = user.name + ' is typing...';
    typingIndicator.style.display = 'flex';
    scrollToBottom();
  }

  // ══════════════ ONLINE ADMINS ══════════════
  function listenForOnlineAdmins() {
    const presenceAllRef = database.ref('admin_presence');
    
    presenceAllRef.on('value', snapshot => {
      const admins = snapshot.val() || {};
      displayOnlineAdmins(admins);
    });
  }

  function displayOnlineAdmins(admins) {
    adminsList.innerHTML = '';
    
    const adminArray = Object.entries(admins)
      .map(([uid, data]) => ({ uid, ...data }))
      .sort((a, b) => {
        // Sort: online first, then by name
        if (a.online && !b.online) return -1;
        if (!a.online && b.online) return 1;
        return (a.name || '').localeCompare(b.name || '');
      });

    const onlineAdmins = adminArray.filter(admin => admin.online);
    onlineCount.textContent = onlineAdmins.length;

    adminArray.forEach(admin => {
      const isCurrentUser = admin.uid === currentUser.uid;
      const adminEl = document.createElement('div');
      adminEl.className = `ac-admin-item ${admin.online ? 'online' : ''}`;
      
      adminEl.innerHTML = `
        <div class="ac-admin-avatar">${admin.avatar || '?'}</div>
        <div class="ac-admin-info">
          <div class="ac-admin-name">${escapeHtml(admin.name || 'Admin')}${isCurrentUser ? ' (You)' : ''}</div>
          <div class="ac-admin-status">${admin.online ? 'Online' : formatLastSeen(admin.lastSeen)}</div>
        </div>
      `;
      
      adminsList.appendChild(adminEl);
    });
  }

  // ══════════════ CONNECTION STATUS ══════════════
  function updateConnectionStatus(connected) {
    const statusDot = connectionStatus.querySelector('.ac-status-dot');
    const statusText = connectionStatus.querySelector('.ac-status-text');
    
    if (connected) {
      connectionStatus.classList.add('connected');
      connectionStatus.classList.remove('disconnected');
      statusText.textContent = 'Connected';
    } else {
      connectionStatus.classList.remove('connected');
      connectionStatus.classList.add('disconnected');
      statusText.textContent = 'Disconnected';
    }
  }

  // ══════════════ UI SETUP ══════════════
  function setupUI() {
    // UI Events
    sendBtn.addEventListener('click', () => sendMessage());
    messageInput.addEventListener('keypress', e => {
      if (e.key === 'Enter' && !e.shiftKey) {
        e.preventDefault();
        sendMessage();
      }
    });

    messageInput.addEventListener('input', () => {
      // Auto-resize
      messageInput.style.height = 'auto';
      messageInput.style.height = Math.min(messageInput.scrollHeight, 120) + 'px';
      
      // Typing indicator
      if (messageInput.value.trim()) {
        startTyping();
      } else {
        stopTyping();
      }
    });

    // Emoji Picker Toggle
    if (emojiBtn && emojiPicker) {
      emojiBtn.addEventListener('click', () => {
        emojiPicker.style.display = emojiPicker.style.display === 'none' ? 'grid' : 'none';
      });
    }

    // Image Attachment
    if (attachBtn && imageInput) {
      attachBtn.addEventListener('click', () => imageInput.click());
      
      imageInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;
        if (!file.type.startsWith('image/')) {
          alert('Please select an image file.');
          return;
        }

        const reader = new FileReader();
        reader.onload = function(event) {
          const base64String = event.target.result;
          sendImageMessage(base64String);
        };
        reader.readAsDataURL(file);
        imageInput.value = ''; // Reset
      });
    }

    // Stop typing when losing focus
    messageInput.addEventListener('blur', stopTyping);
  }

  // ══════════════ UTILITIES ══════════════
  function scrollToBottom() {
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
  }

  function escapeHtml(text) {
    const div = document.createElement('div');
    div.textContent = text;
    return div.innerHTML;
  }

  function formatTime(timestamp) {
    const date = new Date(timestamp);
    const now = new Date();
    const isToday = date.toDateString() === now.toDateString();
    
    if (isToday) {
      return date.toLocaleTimeString('en-US', { 
        hour: 'numeric', 
        minute: '2-digit',
        hour12: true 
      });
    } else {
      return date.toLocaleDateString('en-US', { 
        month: 'short', 
        day: 'numeric',
        hour: 'numeric',
        minute: '2-digit'
      });
    }
  }

  function formatLastSeen(timestamp) {
    if (!timestamp) return 'Offline';
    
    const now = Date.now();
    const diff = now - timestamp;
    const minutes = Math.floor(diff / 60000);
    const hours = Math.floor(diff / 3600000);
    const days = Math.floor(diff / 86400000);
    
    if (minutes < 1) return 'Just now';
    if (minutes < 60) return `${minutes}m ago`;
    if (hours < 24) return `${hours}h ago`;
    return `${days}d ago`;
  }

  // ══════════════ INITIALIZE APP ══════════════
  init();

  // ══════════════ CLEANUP ON UNLOAD ══════════════
  window.addEventListener('beforeunload', () => {
    if (currentUser && presenceRef) {
      presenceRef.remove();
      stopTyping();
    }
  });

})();

console.log('✅ Admin Chat initialized');
