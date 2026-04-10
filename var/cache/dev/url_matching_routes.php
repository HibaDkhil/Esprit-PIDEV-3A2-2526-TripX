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
        '/admin/blog' => [[['_route' => 'admin_blog', '_controller' => 'App\\Controller\\admin\\BlogAdminController::index'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\user\\AuthController::login'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_user_auth_login', '_controller' => 'App\\Controller\\user\\AuthController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\user\\AuthController::logout'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\user\\AuthController::register'], null, ['POST' => 0], null, false, false, null]],
        '/onboarding' => [[['_route' => 'app_onboarding', '_controller' => 'App\\Controller\\user\\AuthController::onboarding'], null, null, null, false, false, null]],
        '/preferences/save' => [[['_route' => 'app_save_preferences', '_controller' => 'App\\Controller\\user\\AuthController::savePreferences'], null, ['POST' => 0], null, false, false, null]],
        '/blog/user-names' => [[['_route' => 'blog_user_names', '_controller' => 'App\\Controller\\user\\BlogController::userNames'], null, ['GET' => 0], null, false, false, null]],
        '/blog/filter' => [[['_route' => 'blog_filter', '_controller' => 'App\\Controller\\user\\BlogController::filter'], null, ['GET' => 0], null, false, false, null]],
        '/home' => [[['_route' => 'index', '_controller' => 'App\\Controller\\user\\FrontController::index'], null, null, null, false, false, null]],
        '/destinations' => [[['_route' => 'destinations', '_controller' => 'App\\Controller\\user\\FrontController::destinations'], null, null, null, false, false, null]],
        '/activities' => [[['_route' => 'activities', '_controller' => 'App\\Controller\\user\\FrontController::activities'], null, null, null, false, false, null]],
        '/accommodations' => [[['_route' => 'accommodations', '_controller' => 'App\\Controller\\user\\FrontController::accommodations'], null, null, null, false, false, null]],
        '/transport' => [[['_route' => 'transport', '_controller' => 'App\\Controller\\user\\FrontController::transport'], null, null, null, false, false, null]],
        '/offers' => [[['_route' => 'offers', '_controller' => 'App\\Controller\\user\\FrontController::offers'], null, null, null, false, false, null]],
        '/blog' => [[['_route' => 'blog', '_controller' => 'App\\Controller\\user\\FrontController::blog'], null, null, null, false, false, null]],
        '/users' => [[['_route' => 'users', '_controller' => 'App\\Controller\\user\\FrontController::users'], null, null, null, false, false, null]],
        '/profile/update' => [[['_route' => 'profile_update', '_controller' => 'App\\Controller\\user\\FrontController::updateProfile'], null, ['POST' => 0], null, false, false, null]],
        '/profile/password' => [[['_route' => 'profile_password', '_controller' => 'App\\Controller\\user\\FrontController::changePassword'], null, ['POST' => 0], null, false, false, null]],
        '/search' => [[['_route' => 'search', '_controller' => 'App\\Controller\\user\\FrontController::search'], null, null, null, false, false, null]],
        '/post/create' => [[['_route' => 'post_create', '_controller' => 'App\\Controller\\user\\PostController::create'], null, null, null, false, false, null]],
        '/blog/saved' => [[['_route' => 'blog_saved', '_controller' => 'App\\Controller\\user\\SavedPostController::saved'], null, null, null, false, false, null]],
        '/travel-stories' => [[['_route' => 'travel_story_index', '_controller' => 'App\\Controller\\user\\TravelStoryController::index'], null, ['GET' => 0], null, false, false, null]],
        '/travel-stories/new' => [[['_route' => 'travel_story_new', '_controller' => 'App\\Controller\\user\\TravelStoryController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
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
                    .'|blog/(?'
                        .'|([^/]++)/(?'
                            .'|approve(*:271)'
                            .'|reject(*:285)'
                            .'|delete(*:299)'
                        .')'
                        .'|story/([^/]++)/delete(*:329)'
                    .')'
                .')'
                .'|/comment/(?'
                    .'|create/([^/]++)(*:366)'
                    .'|([^/]++)/(?'
                        .'|edit(*:390)'
                        .'|delete(*:404)'
                        .'|react/([^/]++)(*:426)'
                    .')'
                .')'
                .'|/post/(?'
                    .'|(\\d+)(*:450)'
                    .'|(\\d+)/edit(*:468)'
                    .'|(\\d+)/delete(*:488)'
                    .'|([^/]++)/(?'
                        .'|react/([^/]++)(*:522)'
                        .'|save(*:534)'
                    .')'
                .')'
                .'|/travel\\-stories/([^/]++)(?'
                    .'|(*:572)'
                    .'|/edit(*:585)'
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
        235 => [[['_route' => 'admin_activity_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteActivity'], ['id'], null, null, false, true, null]],
        271 => [[['_route' => 'admin_blog_approve', '_controller' => 'App\\Controller\\admin\\BlogAdminController::approve'], ['id'], ['POST' => 0], null, false, false, null]],
        285 => [[['_route' => 'admin_blog_reject', '_controller' => 'App\\Controller\\admin\\BlogAdminController::reject'], ['id'], ['POST' => 0], null, false, false, null]],
        299 => [[['_route' => 'admin_blog_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        329 => [[['_route' => 'admin_story_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::deleteStory'], ['id'], ['POST' => 0], null, false, false, null]],
        366 => [[['_route' => 'comment_create', '_controller' => 'App\\Controller\\user\\CommentController::create'], ['id'], ['POST' => 0], null, false, true, null]],
        390 => [[['_route' => 'comment_edit', '_controller' => 'App\\Controller\\user\\CommentController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        404 => [[['_route' => 'comment_delete', '_controller' => 'App\\Controller\\user\\CommentController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        426 => [[['_route' => 'comment_react', '_controller' => 'App\\Controller\\user\\ReactionController::reactToComment'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        450 => [[['_route' => 'post_show', '_controller' => 'App\\Controller\\user\\PostController::show'], ['id'], null, null, false, true, null]],
        468 => [[['_route' => 'post_edit', '_controller' => 'App\\Controller\\user\\PostController::edit'], ['id'], null, null, false, false, null]],
        488 => [[['_route' => 'post_delete', '_controller' => 'App\\Controller\\user\\PostController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        522 => [[['_route' => 'post_react', '_controller' => 'App\\Controller\\user\\ReactionController::reactToPost'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        534 => [[['_route' => 'post_save_toggle', '_controller' => 'App\\Controller\\user\\SavedPostController::toggle'], ['id'], ['POST' => 0], null, false, false, null]],
        572 => [[['_route' => 'travel_story_show', '_controller' => 'App\\Controller\\user\\TravelStoryController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        585 => [
            [['_route' => 'travel_story_edit', '_controller' => 'App\\Controller\\user\\TravelStoryController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
