<?php
$file = 'c:\Users\USER\Downloads\Sym\templates\admin\admin_base.html.twig';
$content = file_get_contents($file);

// 1. Inject phosphor icons script
if (strpos($content, '@phosphor-icons/web') === false) {
    // Actually this is an extended template. It might not have <head>. It extends base.html.twig.
    // I can put the script in the block stylesheets.
    $content = str_replace(
        '{% block stylesheets %}',
        "{% block stylesheets %}\n  <script src=\"https://unpkg.com/@phosphor-icons/web\"></script>",
        $content
    );
}

// 2. Replace CSS
$startMarker = '<style>';
$endMarker = '</style>';
$startPos = strpos($content, $startMarker);
$endPos = strpos($content, $endMarker, $startPos);

if ($startPos !== false && $endPos !== false) {
    $before = substr($content, 0, $startPos + strlen($startMarker));
    $after = substr($content, $endPos);

    $newCss = <<<CSS

    /* ── Hide user navbar ── */
    nav.nav#main-nav { display: none !important; }

    *, *::before, *::after { box-sizing: border-box; }

    /* ── Luminous Admin Base CSS ── */
    :root {
      --admin-bg-dark: #0f172a;
      --admin-bg-light: #f8fafc;
      --admin-glass-bg: rgba(30, 41, 59, 0.7);
      --admin-glass-border: rgba(255, 255, 255, 0.1);
      --admin-accent: #00e5ff;
      --admin-accent-gradient: linear-gradient(135deg, #00e5ff, #8a2be2);
      --admin-text: #f1f5f9;
      --admin-text-muted: #94a3b8;
      --admin-sidebar-w: 280px;
    }
    [data-theme="light"] {
      --admin-glass-bg: rgba(255, 255, 255, 0.85);
      --admin-glass-border: rgba(0, 0, 0, 0.08);
      --admin-text: #1e293b;
      --admin-text-muted: #64748b;
      --admin-accent: #0284c7;
      --admin-accent-gradient: linear-gradient(135deg, #0284c7, #6366f1);
    }
    body {
      background-color: var(--admin-bg-dark) !important;
      background-image: 
        radial-gradient(circle at 15% 50%, rgba(0, 229, 255, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 85% 30%, rgba(138, 43, 226, 0.05) 0%, transparent 50%) !important;
      color: var(--admin-text) !important;
      font-family: 'Inter', system-ui, sans-serif !important;
      overflow: hidden !important; 
      margin: 0 !important; 
      padding-top: 0 !important;
      transition: background-color 0.5s ease, color 0.5s ease !important;
    }
    [data-theme="light"] body {
      background-color: var(--admin-bg-light) !important;
      background-image: 
        radial-gradient(circle at 15% 50%, rgba(2, 132, 199, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 85% 30%, rgba(99, 102, 241, 0.05) 0%, transparent 50%) !important;
    }

    .admin-shell { display: flex; height: 100vh; overflow: hidden; }

    /* ══════════════════════════════════════
       SIDEBAR
    ══════════════════════════════════════ */
    .sidebar {
      width: var(--admin-sidebar-w); min-width: var(--admin-sidebar-w);
      background: var(--admin-glass-bg); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
      border-right: 1px solid var(--admin-glass-border);
      display: flex; flex-direction: column;
      transition: width 0.4s cubic-bezier(.4,0,.2,1), min-width 0.4s cubic-bezier(.4,0,.2,1);
      z-index: 100;
    }
    .sidebar.collapsed { width: 80px; min-width: 80px; }

    /* Brand */
    .sidebar-brand {
      padding: 24px; display: flex; align-items: center; gap: 14px;
      border-bottom: 1px solid var(--admin-glass-border); height: 84px; flex-shrink: 0; position: relative;
    }
    .sidebar-brand img { width: 40px; height: 40px; border-radius: 12px; object-fit: contain; filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1)); transition: 0.3s; }
    .sidebar-brand .brand-text {
      font-family: var(--font-display); font-size: 24px; font-weight: 800;
      background: var(--admin-accent-gradient); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
      white-space: nowrap; transition: opacity 0.3s;
    }
    .sidebar.collapsed .brand-text { opacity: 0; width: 0; }
    .sidebar.collapsed .sidebar-brand img { transform: translateX(8px); }
    
    .sidebar-toggle {
      position: absolute; right: -16px; top: 26px; width: 32px; height: 32px;
      background: var(--admin-glass-bg); border: 1px solid var(--admin-glass-border);
      border-radius: 50%; display: flex; align-items: center; justify-content: center;
      color: var(--admin-text); cursor: pointer; z-index: 101; transition: all 0.3s;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .sidebar-toggle:hover { background: var(--admin-accent); color: #fff; transform: scale(1.1); box-shadow: 0 4px 15px rgba(0,229,255,0.4); border-color: var(--admin-accent); }
    [data-theme="light"] .sidebar-toggle:hover { box-shadow: 0 4px 15px rgba(2, 132, 199, 0.4); }
    .sidebar-toggle .bar { display: none; }
    .sidebar-toggle::before { content: '\\25C0'; font-size: 10px; }
    .sidebar.collapsed .sidebar-toggle::before { content: '\\25B6'; }
    
    /* Nav */
    .sidebar-nav { flex: 1; padding: 24px 16px; overflow-y: auto; overflow-x: hidden; display: flex; flex-direction: column; gap: 6px; }
    .sidebar-nav::-webkit-scrollbar { width: 4px; }
    .sidebar-nav::-webkit-scrollbar-thumb { background: var(--admin-glass-border); border-radius: 4px; }
    
    .nav-section-label { font-size: 11px; font-weight: 800; letter-spacing: 0.15em; text-transform: uppercase; color: var(--admin-text-muted); padding: 16px 12px 8px; opacity: 1; transition: 0.3s; white-space: nowrap; }
    .sidebar.collapsed .nav-section-label { opacity: 0; height: 0; padding: 0; }
    
    .nav-item, .nav-group-toggle {
      display: flex; align-items: center; gap: 14px; padding: 12px 14px;
      border-radius: 12px; text-decoration: none; color: var(--admin-text-muted);
      font-size: 15px; font-weight: 600; cursor: pointer; background: transparent; border: none; width: 100%; text-align: left;
      transition: all 0.3s cubic-bezier(.4,0,.2,1); position: relative; overflow: hidden; white-space: nowrap;
    }
    .nav-item:hover, .nav-group-toggle:hover { background: rgba(0, 229, 255, 0.08); color: var(--admin-accent); transform: translateX(4px); }
    [data-theme="light"] .nav-item:hover, [data-theme="light"] .nav-group-toggle:hover { background: rgba(2, 132, 199, 0.08); }
    
    .nav-item.active { background: var(--admin-accent-gradient); color: #fff; box-shadow: 0 4px 15px rgba(0, 229, 255, 0.3); }
    [data-theme="light"] .nav-item.active { box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3); }
    .nav-icon { font-size: 22px; width: 24px; text-align: center; display: flex; align-items: center; justify-content: center; }
    .nav-label { white-space: nowrap; transition: 0.3s; }
    .sidebar.collapsed .nav-label { opacity: 0; width: 0; }
    .sidebar.collapsed .nav-item, .sidebar.collapsed .nav-group-toggle { padding: 12px; justify-content: center; }
    
    .nav-group-arrow { margin-left: auto; transition: transform 0.3s; font-size: 14px; }
    .nav-group-toggle.open .nav-group-arrow { transform: rotate(180deg); }
    .nav-sub { display: flex; flex-direction: column; gap: 4px; overflow: hidden; max-height: 0; transition: max-height 0.4s ease; padding-left: 14px; border-left: 2px solid var(--admin-glass-border); margin-left: 24px; margin-top: 4px; }
    .nav-sub.open { max-height: 400px; }
    .nav-sub .nav-item { padding: 10px 12px; font-size: 14px; border-radius: 10px; }
    .sidebar.collapsed .nav-sub { display: none; }
    .sidebar.collapsed .nav-group-arrow { display: none; }

    /* Tooltip on collapsed */
    .sidebar.collapsed .nav-item::after {
      content: attr(data-label);
      position: absolute;
      left: calc(100% + 12px);
      top: 50%;
      transform: translateY(-50%);
      background: var(--admin-glass-bg);
      backdrop-filter: blur(10px);
      border: 1px solid var(--admin-glass-border);
      color: var(--admin-text);
      padding: 6px 12px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      white-space: nowrap;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.15s ease;
      z-index: 999;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    }
    .sidebar.collapsed .nav-item:hover::after { opacity: 1; }

    /* Footer toggle */
    .sidebar-footer { padding: 20px 16px; border-top: 1px solid var(--admin-glass-border); flex-shrink: 0; }

    /* ══════════════════════════════════════
       TOP BAR
    ══════════════════════════════════════ */
    .admin-right { flex: 1; display: flex; flex-direction: column; overflow: hidden; }
    .topbar {
      height: 84px; min-height: 84px; background: var(--admin-glass-bg); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
      border-bottom: 1px solid var(--admin-glass-border); display: flex; align-items: center; justify-content: space-between;
      padding: 0 32px; gap: 20px; flex-shrink: 0; z-index: 90;
    }
    
    /* Breadcrumbs */
    .breadcrumbs { display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 600; color: var(--admin-text-muted); background: rgba(0,0,0,0.2); padding: 10px 20px; border-radius: 20px; border: 1px solid var(--admin-glass-border); }
    [data-theme="light"] .breadcrumbs { background: rgba(255,255,255,0.5); }
    .breadcrumbs .crumb { color: var(--admin-text-muted); text-decoration: none; transition: 0.3s; display: flex; align-items: center; gap: 6px; }
    .breadcrumbs .crumb:hover { color: var(--admin-accent); }
    .breadcrumbs .crumb.active { color: var(--admin-text); }
    .breadcrumbs .sep { opacity: 0.5; }

    /* Topbar actions */
    .topbar-actions { display: flex; align-items: center; gap: 14px; }
    .topbar-btn {
      width: 44px; height: 44px; border-radius: 14px; background: var(--admin-glass-bg);
      border: 1px solid var(--admin-glass-border); display: flex; align-items: center; justify-content: center;
      font-size: 20px; color: var(--admin-text); cursor: pointer; transition: all 0.3s; position: relative;
      text-decoration: none;
    }
    .topbar-btn:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); color: var(--admin-accent); border-color: var(--admin-accent); }
    
    .topbar-divider { width: 1px; height: 32px; background: var(--admin-glass-border); margin: 0 8px; }
    
    /* Profile */
    .profile-btn {
      display: flex; align-items: center; gap: 12px; padding: 6px 16px 6px 6px;
      background: var(--admin-glass-bg); border: 1px solid var(--admin-glass-border); border-radius: 24px;
      cursor: pointer; text-decoration: none; transition: all 0.3s;
    }
    .profile-btn:hover { background: rgba(0, 229, 255, 0.05); border-color: var(--admin-accent); transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
    [data-theme="light"] .profile-btn:hover { background: rgba(2, 132, 199, 0.05); }
    .profile-avatar { width: 36px; height: 36px; border-radius: 50%; background: var(--admin-accent-gradient); display: flex; align-items: center; justify-content: center; font-size: 16px; font-weight: 800; color: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.2); }
    .profile-name { font-size: 14px; font-weight: 700; color: var(--admin-text); margin-bottom: 2px; }
    .profile-role { font-size: 11px; font-weight: 600; color: var(--admin-accent); text-transform: uppercase; letter-spacing: 0.05em; }
    
    /* Logout */
    .logout-btn {
      display: flex; align-items: center; gap: 8px; padding: 10px 18px;
      border-radius: 14px; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2);
      color: #ef4444; font-size: 14px; font-weight: 700; cursor: pointer; text-decoration: none; transition: all 0.3s;
    }
    .logout-btn i { font-size: 18px; }
    .logout-btn:hover { background: #ef4444; color: #fff; box-shadow: 0 8px 20px rgba(239, 68, 68, 0.3); transform: translateY(-2px); }
    .logout-btn .sign { display: none; }

    /* Main */
    .admin-main { flex: 1; overflow-y: auto; padding: 40px; position: relative; z-index: 1; }
    .admin-main::-webkit-scrollbar { width: 6px; }
    .admin-main::-webkit-scrollbar-track { background: transparent; }
    .admin-main::-webkit-scrollbar-thumb { background: var(--admin-glass-border); border-radius: 4px; }
    .admin-main::-webkit-scrollbar-thumb:hover { background: var(--admin-accent); }

    /* Notifications Dropdown Overrides */
    .notification-panel { background: var(--admin-glass-bg); backdrop-filter: blur(20px); border: 1px solid var(--admin-glass-border); box-shadow: 0 20px 40px rgba(0,0,0,0.3); border-radius: 16px; }
    .notification-header { background: rgba(0,0,0,0.2); border-bottom: 1px solid var(--admin-glass-border); }
    [data-theme="light"] .notification-header { background: rgba(255,255,255,0.4); }
    .notification-item { border-bottom: 1px solid var(--admin-glass-border); transition: 0.3s; }
    .notification-item.unread { background: rgba(0, 229, 255, 0.05); }
    [data-theme="light"] .notification-item.unread { background: rgba(2, 132, 199, 0.05); }
    .notification-item:hover { background: rgba(0, 229, 255, 0.1) !important; }
    [data-theme="light"] .notification-item:hover { background: rgba(2, 132, 199, 0.1) !important; }
    .notification-title { color: var(--admin-text); }
    .notification-message { color: var(--admin-text-muted); }
    .notification-badge { background: #ef4444; box-shadow: 0 0 10px #ef4444; animation: pulseGlow 2s infinite; }

    {% block page_styles %}{% endblock %}

CSS;

    $content = $before . $newCss . $after;
}

// 3. Replace Emojis with Phosphor Icons
$replacements = [
    '<span class="nav-icon">📊</span>' => '<span class="nav-icon"><i class="ph ph-squares-four"></i></span>',
    '<span class="nav-icon">👥</span>' => '<span class="nav-icon"><i class="ph ph-users"></i></span>',
    '<span class="nav-icon">🌍</span>' => '<span class="nav-icon"><i class="ph ph-globe-hemisphere-west"></i></span>',
    '<span class="nav-icon">📋</span>' => '<span class="nav-icon"><i class="ph ph-list-dashes"></i></span>',
    '<span class="nav-icon">🧗</span>' => '<span class="nav-icon"><i class="ph ph-person-simple-walk"></i></span>',
    '<span class="nav-icon">📅</span>' => '<span class="nav-icon"><i class="ph ph-calendar-blank"></i></span>',
    '<span class="nav-icon">⭐</span>' => '<span class="nav-icon"><i class="ph ph-star"></i></span>',
    '<span class="nav-icon">🏨</span>' => '<span class="nav-icon"><i class="ph ph-buildings"></i></span>',
    '<span class="nav-icon">✈️</span>' => '<span class="nav-icon"><i class="ph ph-airplane-tilt"></i></span>',
    '<span class="nav-icon">🧳</span>' => '<span class="nav-icon"><i class="ph ph-suitcase-rolling"></i></span>',
    '<span class="nav-icon">📦</span>' => '<span class="nav-icon"><i class="ph ph-package"></i></span>',
    '<span class="nav-icon">🏷️</span>' => '<span class="nav-icon"><i class="ph ph-tag"></i></span>',
    '<span class="nav-icon">🎟️</span>' => '<span class="nav-icon"><i class="ph ph-ticket"></i></span>',
    '<span class="nav-icon">📝</span>' => '<span class="nav-icon"><i class="ph ph-article"></i></span>',
    '<span class="nav-icon">🌙</span>' => '<span class="nav-icon"><i class="ph ph-moon"></i></span>',
    '<span class="nav-icon">☀️</span>' => '<span class="nav-icon"><i class="ph ph-sun"></i></span>',
    '<span class="nav-group-arrow">▼</span>' => '<span class="nav-group-arrow"><i class="ph ph-caret-down"></i></span>',
    '🏠 Home' => '<i class="ph ph-house" style="font-size:18px;"></i> Home',
    '💬' => '<i class="ph ph-chat-circle-dots"></i>',
    '⚙️' => '<i class="ph ph-gear"></i>',
    '🔔' => '<i class="ph ph-bell"></i>',
    '<div class="text">Logout</div>' => '<i class="ph ph-sign-out"></i> <div class="text">Logout</div>',
];

$content = strtr($content, $replacements);

// Replace SVG logout icon manually since we changed the class
$content = preg_replace('/<svg viewBox="0 0 512 512".*?<\/svg>/s', '', $content);

file_put_contents($file, $content);
echo "Successfully updated admin_base.html.twig\n";
