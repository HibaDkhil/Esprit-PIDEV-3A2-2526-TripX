(function() {
    'use strict';

    const logUrl = '/activity/log';
    const startTime = Date.now();

    function logActivity(type, targetId, targetType) {
        if (!navigator.onLine) return;
        
        const data = {
            activity_type: type,
            target_id: targetId,
            target_type: targetType
        };

        // Use fetch with keepalive or sendBeacon for robustness
        if (navigator.sendBeacon) {
            navigator.sendBeacon(logUrl, JSON.stringify(data));
        } else {
            fetch(logUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data),
                keepalive: true
            }).catch(() => {});
        }
    }

    // Log page visit
    const pageTitle = document.title || 'Unknown Page';
    const pagePath = window.location.pathname;
    logActivity('VISIT', pagePath, 'PAGE');

    // Track time spent on page when user leaves
    window.addEventListener('beforeunload', () => {
        const timeSpent = Math.round((Date.now() - startTime) / 1000); // in seconds
        logActivity('TIME_SPENT', timeSpent.toString(), 'SECONDS');
    });

    // Track clicks on specific interactive features (e.g., ARIA, AI picks)
    document.addEventListener('click', (e) => {
        const target = e.target.closest('[data-track]');
        if (target) {
            logActivity('CLICK', target.dataset.track, target.dataset.trackType || 'FEATURE');
        }
    });

})();
