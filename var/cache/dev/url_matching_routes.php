<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/activity/log' => [[['_route' => 'app_activity_log', '_controller' => 'App\\Controller\\ActivityController::log'], null, ['POST' => 0], null, false, false, null]],
        '/test-db' => [[['_route' => 'test_db', '_controller' => 'App\\Controller\\TestDbController::testDatabase'], null, null, null, false, false, null]],
        '/admin/profile' => [[['_route' => 'admin_profile', '_controller' => 'App\\Controller\\admin\\AdminController::profile'], null, null, null, false, false, null]],
        '/admin/profile/update' => [[['_route' => 'admin_profile_update', '_controller' => 'App\\Controller\\admin\\AdminController::updateProfile'], null, ['POST' => 0], null, false, false, null]],
        '/admin/profile/password' => [[['_route' => 'admin_profile_password', '_controller' => 'App\\Controller\\admin\\AdminController::updatePassword'], null, ['POST' => 0], null, false, false, null]],
        '/admin/dashboard' => [[['_route' => 'admin_dashboard', '_controller' => 'App\\Controller\\admin\\AdminController::dashboard'], null, null, null, false, false, null]],
        '/admin/users' => [[['_route' => 'admin_users', '_controller' => 'App\\Controller\\admin\\AdminController::users'], null, null, null, false, false, null]],
        '/admin/destinations' => [[['_route' => 'admin_destinations', '_controller' => 'App\\Controller\\admin\\AdminController::destinations'], null, null, null, false, false, null]],
        '/admin/destinations/add' => [[['_route' => 'admin_destination_add', '_controller' => 'App\\Controller\\admin\\AdminController::addDestination'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/activities' => [[['_route' => 'admin_activities', '_controller' => 'App\\Controller\\admin\\AdminController::activities'], null, null, null, false, false, null]],
        '/admin/activities/add' => [[['_route' => 'admin_activity_add', '_controller' => 'App\\Controller\\admin\\AdminController::addActivity'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/accommodations' => [[['_route' => 'admin_accommodations', '_controller' => 'App\\Controller\\admin\\AdminController::accommodations'], null, null, null, false, false, null]],
        '/admin/transport' => [[['_route' => 'admin_transport', '_controller' => 'App\\Controller\\admin\\AdminController::transport'], null, null, null, false, false, null]],
        '/admin/offers' => [[['_route' => 'admin_offers', '_controller' => 'App\\Controller\\admin\\AdminController::offers'], null, null, null, false, false, null]],
        '/admin/blog' => [[['_route' => 'admin_blog', '_controller' => 'App\\Controller\\admin\\AdminController::blog'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\user\\AuthController::login'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_user_auth_login', '_controller' => 'App\\Controller\\user\\AuthController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\user\\AuthController::logout'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\user\\AuthController::register'], null, ['POST' => 0], null, false, false, null]],
        '/onboarding' => [[['_route' => 'app_onboarding', '_controller' => 'App\\Controller\\user\\AuthController::onboarding'], null, null, null, false, false, null]],
        '/preferences/save' => [[['_route' => 'app_save_preferences', '_controller' => 'App\\Controller\\user\\AuthController::savePreferences'], null, ['POST' => 0], null, false, false, null]],
        '/api/chat' => [[['_route' => 'api_chat', '_controller' => 'App\\Controller\\user\\ChatController::chat'], null, ['POST' => 0], null, false, false, null]],
        '/home' => [[['_route' => 'index', '_controller' => 'App\\Controller\\user\\FrontController::index'], null, null, null, false, false, null]],
        '/destinations' => [[['_route' => 'destinations', '_controller' => 'App\\Controller\\user\\FrontController::destinations'], null, null, null, false, false, null]],
        '/activities' => [[['_route' => 'activities', '_controller' => 'App\\Controller\\user\\FrontController::activities'], null, null, null, false, false, null]],
        '/accommodations' => [[['_route' => 'accommodations', '_controller' => 'App\\Controller\\user\\FrontController::accommodations'], null, null, null, false, false, null]],
        '/transport' => [[['_route' => 'transport', '_controller' => 'App\\Controller\\user\\FrontController::transport'], null, null, null, false, false, null]],
        '/offers' => [[['_route' => 'offers', '_controller' => 'App\\Controller\\user\\FrontController::offers'], null, null, null, false, false, null]],
        '/blog' => [[['_route' => 'blog', '_controller' => 'App\\Controller\\user\\FrontController::blog'], null, null, null, false, false, null]],
        '/search' => [[['_route' => 'search', '_controller' => 'App\\Controller\\user\\FrontController::search'], null, null, null, false, false, null]],
        '/test-gemini' => [[['_route' => 'test_gemini', '_controller' => 'App\\Controller\\user\\TestGeminiController::test'], null, null, null, false, false, null]],
        '/profile' => [[['_route' => 'users', '_controller' => 'App\\Controller\\user\\UserController::profile'], null, ['GET' => 0], null, false, false, null]],
        '/profile/update' => [[['_route' => 'profile_update', '_controller' => 'App\\Controller\\user\\UserController::updateProfile'], null, ['POST' => 0], null, false, false, null]],
        '/profile/password' => [[['_route' => 'profile_password', '_controller' => 'App\\Controller\\user\\UserController::changePassword'], null, ['POST' => 0], null, false, false, null]],
        '/profile/stats' => [[['_route' => 'profile_stats', '_controller' => 'App\\Controller\\user\\UserController::getStats'], null, ['GET' => 0], null, false, false, null]],
        '/profile/preferences' => [[['_route' => 'profile_preferences', '_controller' => 'App\\Controller\\user\\UserController::saveTravelPreferences'], null, ['POST' => 0], null, false, false, null]],
        '/profile/delete' => [[['_route' => 'profile_delete', '_controller' => 'App\\Controller\\user\\UserController::deleteAccount'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/admin/(?'
                    .'|users/(?'
                        .'|edit/([^/]++)(*:74)'
                        .'|ban/([^/]++)(*:93)'
                        .'|delete/([^/]++)(*:115)'
                    .')'
                    .'|destinations/(?'
                        .'|edit/([^/]++)(*:153)'
                        .'|delete/([^/]++)(*:176)'
                    .')'
                    .'|activities/(?'
                        .'|edit/([^/]++)(*:212)'
                        .'|delete/([^/]++)(*:235)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        74 => [[['_route' => 'admin_user_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editUser'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        93 => [[['_route' => 'admin_user_ban', '_controller' => 'App\\Controller\\admin\\AdminController::banUser'], ['id'], null, null, false, true, null]],
        115 => [[['_route' => 'admin_user_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteUser'], ['id'], null, null, false, true, null]],
        153 => [[['_route' => 'admin_destination_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editDestination'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        176 => [[['_route' => 'admin_destination_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteDestination'], ['id'], null, null, false, true, null]],
        212 => [[['_route' => 'admin_activity_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editActivity'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        235 => [
            [['_route' => 'admin_activity_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteActivity'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
