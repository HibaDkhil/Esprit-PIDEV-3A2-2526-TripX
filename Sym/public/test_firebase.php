<?php
require __DIR__.'/../vendor/autoload.php';
$dotenv = new \Symfony\Component\Dotenv\Dotenv();
$envVars = [];
if (file_exists(__DIR__.'/../.env')) {
    $envVars = $dotenv->parse(file_get_contents(__DIR__.'/../.env'), __DIR__.'/../.env');
}

$getEnv = function($key) use ($envVars) {
    return $_ENV[$key] ?? $_SERVER[$key] ?? $envVars[$key] ?? '';
};

$config = [
    'apiKey' => $getEnv('FIREBASE_API_KEY'),
    'authDomain' => $getEnv('FIREBASE_AUTH_DOMAIN'),
    'databaseURL' => $getEnv('FIREBASE_DATABASE_URL'),
    'projectId' => $getEnv('FIREBASE_PROJECT_ID'),
    'storageBucket' => $getEnv('FIREBASE_STORAGE_BUCKET'),
    'messagingSenderId' => $getEnv('FIREBASE_MESSAGING_SENDER_ID'),
    'appId' => $getEnv('FIREBASE_APP_ID'),
];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Firebase Connection Test</title>
    <style>
        body { font-family: monospace; background: #1e1e1e; color: #00ff00; padding: 20px; }
        .error { color: #ff5555; font-weight: bold; }
        .success { color: #55ff55; font-weight: bold; }
        .log-line { margin: 5px 0; border-bottom: 1px solid #333; padding-bottom: 5px; }
    </style>
</head>
<body>
    <h2>Firebase Diagnostic Tool</h2>
    <div id="output"></div>

    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.7.1/firebase-database-compat.js"></script>
    
    <script>
        function log(msg, type='info') {
            const div = document.createElement('div');
            div.className = 'log-line ' + type;
            div.innerText = '[' + new Date().toLocaleTimeString() + '] ' + msg;
            document.getElementById('output').appendChild(div);
        }

        const config = <?php echo json_encode($config); ?>;
        log('1. Extracted config from .env: ' + (config.apiKey ? 'Valid API Key' : 'Empty API Key'));
        
        try {
            log('2. Initializing Firebase...');
            firebase.initializeApp(config);
            log('Firebase Initialized Successfully!', 'success');
        } catch (e) {
            log('Firebase Init Error: ' + e.message, 'error');
        }

        const db = firebase.database();
        
        log('3. Monitoring connection state...');
        db.ref('.info/connected').on('value', snap => {
            if (snap.val() === true) {
                log('Websocket Connected to Firebase Server!', 'success');
            } else {
                log('Disconnect / Waiting to connect...', 'info');
            }
        });

        log('4. Testing READ permission on admin_messages...');
        db.ref('admin_messages').limitToLast(1).once('value')
            .then(() => log('READ TEST: SUCCESS (Rules allow read)', 'success'))
            .catch(e => log('READ TEST FAILED: ' + e.message + ' (Check Firebase Rules!)', 'error'));

        log('5. Testing WRITE permission on admin_messages...');
        db.ref('admin_messages').push({ test: true, time: Date.now() })
            .then(() => log('WRITE TEST: SUCCESS (Rules allow write)', 'success'))
            .catch(e => log('WRITE TEST FAILED: ' + e.message + ' (Check Firebase Rules!)', 'error'));
            
    </script>
</body>
</html>
