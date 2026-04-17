// firebase-config.js
// ════════════════════════════════════════════════════════════════════
// REPLACE THIS WITH YOUR ACTUAL FIREBASE CONFIG
// Get this from: Firebase Console → Project Settings → Your apps → SDK setup
// ════════════════════════════════════════════════════════════════════

const firebaseConfig = {
  apiKey: "YOUR_API_KEY",
  authDomain: "tripx-admin-chat.firebaseapp.com",
  databaseURL: "YOUR_DB_URL",
  projectId: "tripx-admin-chat",
  storageBucket: "tripx-admin-chat.firebasestorage.app",
  messagingSenderId: "SENDER_ID",
  appId: "APP_ID"
};

// Initialize Firebase
firebase.initializeApp(firebaseConfig);
const database = firebase.database();
const auth = firebase.auth();

console.log('✅ Firebase initialized successfully');
