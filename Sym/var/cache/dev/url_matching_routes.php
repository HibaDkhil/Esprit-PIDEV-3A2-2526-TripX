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
        '/admin/accommodations' => [
            [['_route' => 'admin_accommodations_index', '_controller' => 'App\\Controller\\admin\\AccommodationController::index'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'admin_accommodations', '_controller' => 'App\\Controller\\admin\\AdminController::accommodations'], null, null, null, false, false, null],
        ],
        '/admin/accommodations/stats' => [[['_route' => 'admin_accommodations_stats', '_controller' => 'App\\Controller\\admin\\AccommodationController::stats'], null, ['GET' => 0], null, false, false, null]],
        '/admin/accommodations/search' => [[['_route' => 'admin_accommodations_search', '_controller' => 'App\\Controller\\admin\\AccommodationController::search'], null, ['GET' => 0], null, false, false, null]],
        '/admin/accommodations/new' => [[['_route' => 'admin_accommodations_new', '_controller' => 'App\\Controller\\admin\\AccommodationController::new'], null, ['POST' => 0], null, false, false, null]],
        '/admin/profile' => [[['_route' => 'admin_profile', '_controller' => 'App\\Controller\\admin\\AdminController::profile'], null, null, null, false, false, null]],
        '/admin/profile/update' => [[['_route' => 'admin_profile_update', '_controller' => 'App\\Controller\\admin\\AdminController::updateProfile'], null, ['POST' => 0], null, false, false, null]],
        '/admin/profile/password' => [[['_route' => 'admin_profile_password', '_controller' => 'App\\Controller\\admin\\AdminController::updatePassword'], null, ['POST' => 0], null, false, false, null]],
        '/admin/dashboard' => [[['_route' => 'admin_dashboard', '_controller' => 'App\\Controller\\admin\\AdminController::dashboard'], null, null, null, false, false, null]],
        '/admin/rooms' => [[['_route' => 'admin_rooms_all', '_controller' => 'App\\Controller\\admin\\AdminController::allRooms'], null, ['GET' => 0], null, false, false, null]],
        '/admin/users' => [[['_route' => 'admin_users', '_controller' => 'App\\Controller\\admin\\AdminController::users'], null, null, null, false, false, null]],
        '/admin/users/search' => [[['_route' => 'admin_users_search', '_controller' => 'App\\Controller\\admin\\AdminController::searchUsers'], null, ['GET' => 0], null, false, false, null]],
        '/admin/destinations' => [[['_route' => 'admin_destinations', '_controller' => 'App\\Controller\\admin\\AdminController::destinations'], null, null, null, false, false, null]],
        '/admin/destinations/api/sort' => [[['_route' => 'admin_destinations_api_sort', '_controller' => 'App\\Controller\\admin\\AdminController::sortDestinations'], null, ['GET' => 0], null, false, false, null]],
        '/admin/destinations/add' => [[['_route' => 'admin_destination_add', '_controller' => 'App\\Controller\\admin\\AdminController::addDestination'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/activities' => [[['_route' => 'admin_activities', '_controller' => 'App\\Controller\\admin\\AdminController::activities'], null, null, null, false, false, null]],
        '/admin/activities/api/sort' => [[['_route' => 'admin_activities_api_sort', '_controller' => 'App\\Controller\\admin\\AdminController::sortActivities'], null, ['GET' => 0], null, false, false, null]],
        '/admin/activities/add' => [[['_route' => 'admin_activity_add', '_controller' => 'App\\Controller\\admin\\AdminController::addActivity'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/chat' => [[['_route' => 'admin_chat', '_controller' => 'App\\Controller\\admin\\AdminController::chat'], null, ['GET' => 0], null, false, false, null]],
        '/admin/chat/user-info' => [[['_route' => 'admin_chat_user_info', '_controller' => 'App\\Controller\\admin\\AdminController::getUserInfo'], null, ['GET' => 0], null, false, false, null]],
        '/admin/api/notifications' => [[['_route' => 'admin_api_notifications', '_controller' => 'App\\Controller\\admin\\AdminController::getNotifications'], null, ['GET' => 0], null, false, false, null]],
        '/admin/packs' => [[['_route' => 'admin_packs', '_controller' => 'App\\Controller\\admin\\AdminPacksController::packs'], null, null, null, false, false, null]],
        '/admin/packs/add' => [[['_route' => 'admin_pack_add', '_controller' => 'App\\Controller\\admin\\AdminPacksController::addPack'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/pack-categories' => [[['_route' => 'admin_pack_categories', '_controller' => 'App\\Controller\\admin\\AdminPacksController::categories'], null, null, null, false, false, null]],
        '/admin/pack-categories/add' => [[['_route' => 'admin_pack_category_add', '_controller' => 'App\\Controller\\admin\\AdminPacksController::addCategory'], null, ['POST' => 0], null, false, false, null]],
        '/admin/offers' => [[['_route' => 'admin_offers', '_controller' => 'App\\Controller\\admin\\AdminPacksController::offers'], null, null, null, false, false, null]],
        '/admin/offers/add' => [[['_route' => 'admin_offer_add', '_controller' => 'App\\Controller\\admin\\AdminPacksController::addOffer'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/bookings' => [[['_route' => 'admin_pack_bookings', '_controller' => 'App\\Controller\\admin\\AdminPacksController::bookings'], null, null, null, false, false, null]],
        '/admin/loyalty' => [[['_route' => 'admin_loyalty', '_controller' => 'App\\Controller\\admin\\AdminPacksController::loyalty'], null, null, null, false, false, null]],
        '/admin/blog' => [[['_route' => 'admin_blog', '_controller' => 'App\\Controller\\admin\\BlogAdminController::index'], null, null, null, false, false, null]],
        '/admin/accommodations/bookings' => [[['_route' => 'admin_accommodations_bookings_index', '_controller' => 'App\\Controller\\admin\\BookingController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/accommodations/bookings/export/dashboard' => [[['_route' => 'admin_accommodations_bookings_export_dashboard', '_controller' => 'App\\Controller\\admin\\BookingController::exportDashboard'], null, ['GET' => 0], null, false, false, null]],
        '/admin/accommodations/bookings/export/excel' => [[['_route' => 'admin_accommodations_bookings_export_excel', '_controller' => 'App\\Controller\\admin\\BookingController::exportExcel'], null, ['GET' => 0], null, false, false, null]],
        '/admin/accommodations/bookings/ml-insights' => [[['_route' => 'admin_accommodations_bookings_ml_insights', '_controller' => 'App\\Controller\\admin\\BookingController::mlInsights'], null, ['GET' => 0], null, false, false, null]],
        '/admin/accommodations/bookings/search' => [[['_route' => 'admin_accommodations_bookings_search', '_controller' => 'App\\Controller\\admin\\BookingController::search'], null, ['GET' => 0], null, false, false, null]],
        '/admin/accommodations/bookings/stats' => [[['_route' => 'admin_accommodations_bookings_stats', '_controller' => 'App\\Controller\\admin\\BookingController::stats'], null, ['GET' => 0], null, false, false, null]],
        '/admin/bookings-des' => [[['_route' => 'admin_bookings_des_index', '_controller' => 'App\\Controller\\admin\\BookingDesController::index'], null, ['GET' => 0], null, false, false, null]],
        '/admin/bookings-des/api/sort' => [[['_route' => 'admin_bookings_des_api_sort', '_controller' => 'App\\Controller\\admin\\BookingDesController::sortBookings'], null, ['GET' => 0], null, false, false, null]],
        '/admin/google-acc/status' => [[['_route' => 'admin_google_acc_status', '_controller' => 'App\\Controller\\admin\\GoogleCalendarAccController::status'], null, ['GET' => 0], null, false, false, null]],
        '/admin/google-acc/authorize' => [[['_route' => 'admin_google_acc_authorize', '_controller' => 'App\\Controller\\admin\\GoogleCalendarAccController::authorize'], null, ['GET' => 0], null, false, false, null]],
        '/admin/google-acc/callback' => [[['_route' => 'admin_google_acc_callback', '_controller' => 'App\\Controller\\admin\\GoogleCalendarAccController::callback'], null, ['GET' => 0], null, false, false, null]],
        '/admin/google-acc/revoke' => [[['_route' => 'admin_google_acc_revoke', '_controller' => 'App\\Controller\\admin\\GoogleCalendarAccController::revoke'], null, ['POST' => 0], null, false, false, null]],
        '/admin/overview' => [[['_route' => 'admin_overview', '_controller' => 'App\\Controller\\admin\\OverviewController::index'], null, null, null, false, false, null]],
        '/admin/overview/charts-data' => [[['_route' => 'admin_overview_charts', '_controller' => 'App\\Controller\\admin\\OverviewController::chartsData'], null, ['GET' => 0], null, false, false, null]],
        '/admin/overview/analyze-transport' => [[['_route' => 'admin_overview_analyze', '_controller' => 'App\\Controller\\admin\\OverviewController::analyzeTransport'], null, ['POST' => 0], null, false, false, null]],
        '/admin/transport' => [[['_route' => 'admin_transport_index', '_controller' => 'App\\Controller\\admin\\TransportAdminController::index'], null, null, null, false, false, null]],
        '/admin/transport/list' => [[['_route' => 'admin_transport_list', '_controller' => 'App\\Controller\\admin\\TransportAdminController::transportList'], null, null, null, false, false, null]],
        '/admin/transport/add' => [[['_route' => 'admin_transport_add', '_controller' => 'App\\Controller\\admin\\TransportAdminController::addTransport'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/transport/export/pdf' => [[['_route' => 'admin_transport_export_pdf', '_controller' => 'App\\Controller\\admin\\TransportAdminController::exportPdf'], null, null, null, false, false, null]],
        '/admin/transport/schedules' => [[['_route' => 'admin_schedule_list', '_controller' => 'App\\Controller\\admin\\TransportAdminController::scheduleList'], null, null, null, false, false, null]],
        '/admin/transport/schedules/add' => [[['_route' => 'admin_schedule_add', '_controller' => 'App\\Controller\\admin\\TransportAdminController::addSchedule'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/transport/export/schedules-csv' => [[['_route' => 'admin_schedule_export_csv', '_controller' => 'App\\Controller\\admin\\TransportAdminController::exportSchedulesCsv'], null, null, null, false, false, null]],
        '/admin/transport/destinations' => [[['_route' => 'admin_trans_destination_list', '_controller' => 'App\\Controller\\admin\\TransportAdminController::listDestinations'], null, null, null, false, false, null]],
        '/admin/transport/destinations/add' => [[['_route' => 'admin_trans_destination_add', '_controller' => 'App\\Controller\\admin\\TransportAdminController::addDestination'], null, null, null, false, false, null]],
        '/admin/transport/bookings' => [[['_route' => 'admin_booking_list', '_controller' => 'App\\Controller\\admin\\TransportAdminController::bookingList'], null, null, null, false, false, null]],
        '/admin/transport/export/bookings-csv' => [[['_route' => 'admin_booking_export_csv', '_controller' => 'App\\Controller\\admin\\TransportAdminController::exportBookingsCsv'], null, null, null, false, false, null]],
        '/accommodations/compare' => [[['_route' => 'accommodations_compare', '_controller' => 'App\\Controller\\user\\AIComparisonController::compare'], null, ['POST' => 0], null, false, false, null]],
        '/api/book' => [[['_route' => 'api_book', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::createBooking'], null, ['POST' => 0], null, false, false, null]],
        '/' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\user\\AuthController::login'], null, null, null, false, false, null]],
        '/login' => [[['_route' => 'app_user_auth_login', '_controller' => 'App\\Controller\\user\\AuthController::login'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\user\\AuthController::logout'], null, null, null, false, false, null]],
        '/register' => [[['_route' => 'app_register', '_controller' => 'App\\Controller\\user\\AuthController::register'], null, ['POST' => 0], null, false, false, null]],
        '/verify-email' => [[['_route' => 'app_verify_email', '_controller' => 'App\\Controller\\user\\AuthController::verifyEmail'], null, null, null, false, false, null]],
        '/onboarding' => [[['_route' => 'app_onboarding', '_controller' => 'App\\Controller\\user\\AuthController::onboarding'], null, null, null, false, false, null]],
        '/preferences/save' => [[['_route' => 'app_save_preferences', '_controller' => 'App\\Controller\\user\\AuthController::savePreferences'], null, ['POST' => 0], null, false, false, null]],
        '/blog/user-names' => [[['_route' => 'blog_user_names', '_controller' => 'App\\Controller\\user\\BlogController::userNames'], null, ['GET' => 0], null, false, false, null]],
        '/blog' => [[['_route' => 'blog', '_controller' => 'App\\Controller\\user\\BlogController::index'], null, null, null, false, false, null]],
        '/blog/filter' => [[['_route' => 'blog_filter', '_controller' => 'App\\Controller\\user\\BlogController::filter'], null, ['GET' => 0], null, false, false, null]],
        '/api/chat' => [[['_route' => 'api_chat', '_controller' => 'App\\Controller\\user\\ChatController::chat'], null, ['POST' => 0], null, false, false, null]],
        '/emergency-exit' => [[['_route' => 'app_emergency_exit', '_controller' => 'App\\Controller\\user\\EmergencyExitController::exit'], null, null, null, false, false, null]],
        '/face/login-page' => [[['_route' => 'face_login_page', '_controller' => 'App\\Controller\\user\\FaceLoginController::loginPage'], null, ['GET' => 0], null, false, false, null]],
        '/face/setup' => [[['_route' => 'face_setup', '_controller' => 'App\\Controller\\user\\FaceLoginController::setup'], null, ['GET' => 0], null, false, false, null]],
        '/face/register' => [[['_route' => 'face_register', '_controller' => 'App\\Controller\\user\\FaceLoginController::register'], null, ['POST' => 0], null, false, false, null]],
        '/face/login' => [[['_route' => 'face_login', '_controller' => 'App\\Controller\\user\\FaceLoginController::login'], null, ['POST' => 0], null, false, false, null]],
        '/face/remove' => [[['_route' => 'face_remove', '_controller' => 'App\\Controller\\user\\FaceLoginController::remove'], null, ['POST' => 0], null, false, false, null]],
        '/face/dev-reset-lock' => [[['_route' => 'face_dev_reset_lock', '_controller' => 'App\\Controller\\user\\FaceLoginController::devResetLock'], null, ['GET' => 0], null, false, false, null]],
        '/blog/my-stats' => [[['_route' => 'blog_my_stats', '_controller' => 'App\\Controller\\user\\FollowController::myStats'], null, ['GET' => 0], null, false, false, null]],
        '/accommodations' => [[['_route' => 'accommodations', '_controller' => 'App\\Controller\\user\\FrontAccommodationController::index'], null, ['GET' => 0], null, false, false, null]],
        '/accommodations/search' => [[['_route' => 'accommodations_search', '_controller' => 'App\\Controller\\user\\FrontAccommodationController::search'], null, ['GET' => 0], null, false, false, null]],
        '/home' => [[['_route' => 'index', '_controller' => 'App\\Controller\\user\\FrontController::index'], null, null, null, false, false, null]],
        '/destinations' => [[['_route' => 'destinations', '_controller' => 'App\\Controller\\user\\FrontController::destinations'], null, null, null, false, false, null]],
        '/activities' => [[['_route' => 'activities', '_controller' => 'App\\Controller\\user\\FrontController::activities'], null, null, null, false, false, null]],
        '/transport' => [[['_route' => 'transport', '_controller' => 'App\\Controller\\user\\FrontController::transport'], null, null, null, false, false, null]],
        '/offers' => [
            [['_route' => 'offers', '_controller' => 'App\\Controller\\user\\FrontController::offers'], null, null, null, false, false, null],
            [['_route' => 'user_offers', '_controller' => 'App\\Controller\\user\\FrontPacksController::offersRedirect'], null, null, null, false, false, null],
        ],
        '/search' => [[['_route' => 'search', '_controller' => 'App\\Controller\\user\\FrontController::search'], null, null, null, false, false, null]],
        '/community' => [[['_route' => 'group_chat', '_controller' => 'App\\Controller\\user\\FrontController::groupChat'], null, null, null, false, false, null]],
        '/packs-offers' => [[['_route' => 'user_packs_offers', '_controller' => 'App\\Controller\\user\\FrontPacksController::packsAndOffers'], null, null, null, false, false, null]],
        '/packs-offers/search' => [[['_route' => 'user_packs_search', '_controller' => 'App\\Controller\\user\\FrontPacksController::searchPacks'], null, ['GET' => 0], null, false, false, null]],
        '/packs' => [[['_route' => 'user_packs', '_controller' => 'App\\Controller\\user\\FrontPacksController::packsRedirect'], null, null, null, false, false, null]],
        '/pack-bookings' => [[['_route' => 'user_pack_bookings', '_controller' => 'App\\Controller\\user\\FrontPacksController::bookingsRedirect'], null, null, null, false, false, null]],
        '/my-loyalty' => [[['_route' => 'user_loyalty', '_controller' => 'App\\Controller\\user\\FrontPacksController::loyaltyRedirect'], null, null, null, false, false, null]],
        '/my-bookings' => [[['_route' => 'my_bookings', '_controller' => 'App\\Controller\\user\\MyBookingsController::index'], null, null, null, false, false, null]],
        '/post/create' => [[['_route' => 'post_create', '_controller' => 'App\\Controller\\user\\PostController::create'], null, null, null, false, false, null]],
        '/price-dashboard' => [[['_route' => 'price_dashboard', '_controller' => 'App\\Controller\\user\\PricePredictionController::dashboard'], null, null, null, false, false, null]],
        '/api/price-alert' => [[['_route' => 'api_price_alert', '_controller' => 'App\\Controller\\user\\PricePredictionController::createPriceAlert'], null, ['POST' => 0], null, false, false, null]],
        '/api/price-alerts/feed' => [[['_route' => 'api_price_alerts_feed', '_controller' => 'App\\Controller\\user\\PricePredictionController::feedAlerts'], null, ['GET' => 0], null, false, false, null]],
        '/profile/report/generate' => [[['_route' => 'profile_report_generate', '_controller' => 'App\\Controller\\user\\ReportController::generateReport'], null, null, null, false, false, null]],
        '/profile/report/export' => [[['_route' => 'profile_report_export', '_controller' => 'App\\Controller\\user\\ReportController::exportPdf'], null, null, null, false, false, null]],
        '/forgot-password/send-code' => [[['_route' => 'app_forgot_password_send_code', '_controller' => 'App\\Controller\\user\\ResetPasswordController::sendCode'], null, ['POST' => 0], null, false, false, null]],
        '/forgot-password/verify-code' => [[['_route' => 'app_forgot_password_verify', '_controller' => 'App\\Controller\\user\\ResetPasswordController::verifyCode'], null, ['POST' => 0], null, false, false, null]],
        '/forgot-password/reset' => [[['_route' => 'app_forgot_password_reset', '_controller' => 'App\\Controller\\user\\ResetPasswordController::resetPassword'], null, ['POST' => 0], null, false, false, null]],
        '/blog/saved' => [[['_route' => 'blog_saved', '_controller' => 'App\\Controller\\user\\SavedPostController::saved'], null, null, null, false, false, null]],
        '/connect/google' => [[['_route' => 'connect_google_start', '_controller' => 'App\\Controller\\user\\SocialAuthController::connectGoogle'], null, null, null, false, false, null]],
        '/connect/google/check' => [[['_route' => 'google_auth_check', '_controller' => 'App\\Controller\\user\\SocialAuthController::connectGoogleCheck'], null, null, null, false, false, null]],
        '/test-gemini' => [[['_route' => 'test_gemini', '_controller' => 'App\\Controller\\user\\TestGeminiController::test'], null, null, null, false, false, null]],
        '/user/transport/schedules/search' => [[['_route' => 'user_transport_schedules_search', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::schedulesSearch'], null, ['GET' => 0], null, false, false, null]],
        '/user/transport' => [[['_route' => 'user_transport_index', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::schedules'], null, null, null, false, false, null]],
        '/user/transport/schedules' => [[['_route' => 'user_transport_schedules', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::schedules'], null, null, null, false, false, null]],
        '/user/transport/browse' => [[['_route' => 'user_transport_browse', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::browse'], null, null, null, false, false, null]],
        '/user/transport/browse/provider' => [[['_route' => 'user_transport_provider', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::providerTransports'], null, null, null, false, false, null]],
        '/user/transport/book' => [
            [['_route' => 'user_transport_book_form', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::bookForm'], null, ['GET' => 0], null, false, false, null],
            [['_route' => 'user_transport_book_submit', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::bookSubmit'], null, ['POST' => 0], null, false, false, null],
        ],
        '/user/transport/my-bookings' => [[['_route' => 'user_transport_mybookings', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::myBookings'], null, null, null, false, false, null]],
        '/user/transport/route-ai' => [[['_route' => 'user_transport_route_ai', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::routeAi'], null, ['POST' => 0], null, false, false, null]],
        '/travel-stories' => [[['_route' => 'travel_story_index', '_controller' => 'App\\Controller\\user\\TravelStoryController::index'], null, ['GET' => 0], null, false, false, null]],
        '/travel-stories/new' => [[['_route' => 'travel_story_new', '_controller' => 'App\\Controller\\user\\TravelStoryController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/profile' => [[['_route' => 'users', '_controller' => 'App\\Controller\\user\\UserController::profile'], null, ['GET' => 0], null, false, false, null]],
        '/profile/avatar' => [[['_route' => 'profile_avatar', '_controller' => 'App\\Controller\\user\\UserController::saveAvatar'], null, ['POST' => 0], null, false, false, null]],
        '/profile/update' => [[['_route' => 'profile_update', '_controller' => 'App\\Controller\\user\\UserController::updateProfile'], null, ['POST' => 0], null, false, false, null]],
        '/profile/password' => [[['_route' => 'profile_password', '_controller' => 'App\\Controller\\user\\UserController::changePassword'], null, ['POST' => 0], null, false, false, null]],
        '/profile/stats' => [[['_route' => 'profile_stats', '_controller' => 'App\\Controller\\user\\UserController::getStats'], null, ['GET' => 0], null, false, false, null]],
        '/profile/preferences' => [[['_route' => 'profile_preferences', '_controller' => 'App\\Controller\\user\\UserController::saveTravelPreferences'], null, ['POST' => 0], null, false, false, null]],
        '/profile/delete' => [[['_route' => 'profile_delete', '_controller' => 'App\\Controller\\user\\UserController::deleteAccount'], null, ['POST' => 0], null, false, false, null]],
        '/profile/2fa/setup' => [[['_route' => 'profile_2fa_setup', '_controller' => 'App\\Controller\\user\\UserController::setup2fa'], null, null, null, false, false, null]],
        '/profile/2fa/enable' => [[['_route' => 'profile_2fa_enable', '_controller' => 'App\\Controller\\user\\UserController::enable2fa'], null, ['POST' => 0], null, false, false, null]],
        '/profile/2fa/disable' => [[['_route' => 'profile_2fa_disable', '_controller' => 'App\\Controller\\user\\UserController::disable2fa'], null, ['POST' => 0], null, false, false, null]],
        '/2fa' => [[['_route' => '2fa_login', '_controller' => 'scheb_two_factor.form_controller::form'], null, null, null, false, false, null]],
        '/2fa_check' => [[['_route' => '2fa_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/qr\\-code/([^/]++)/([\\w\\W]+)(*:35)'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:70)'
                .'|/a(?'
                    .'|dmin/(?'
                        .'|ac(?'
                            .'|commodations/(?'
                                .'|(\\d+)(*:116)'
                                .'|(\\d+)/edit(*:134)'
                                .'|(\\d+)/delete(*:154)'
                                .'|bookings/(?'
                                    .'|(\\d+)(*:179)'
                                    .'|(\\d+)/confirm(*:200)'
                                    .'|(\\d+)/reject(*:220)'
                                    .'|(\\d+)/cancel(*:240)'
                                .')'
                                .'|([^/]++)/rooms(?'
                                    .'|(*:266)'
                                    .'|/(?'
                                        .'|list(*:282)'
                                        .'|new(*:293)'
                                        .'|(\\d+)(*:306)'
                                        .'|(\\d+)/edit(*:324)'
                                        .'|(\\d+)/delete(*:344)'
                                        .'|(\\d+)/images/upload(*:371)'
                                        .'|(\\d+)/images/(\\d+)/primary(*:405)'
                                        .'|(\\d+)/images/(\\d+)/delete(*:438)'
                                        .'|(\\d+)/images/reorder(*:466)'
                                        .'|insights(*:482)'
                                    .')'
                                .')'
                            .')'
                            .'|tivities/(?'
                                .'|edit/([^/]++)(*:518)'
                                .'|delete/([^/]++)(*:541)'
                            .')'
                        .')'
                        .'|users/(?'
                            .'|edit/([^/]++)(*:573)'
                            .'|ban/([^/]++)(*:593)'
                            .'|de(?'
                                .'|lete/([^/]++)(*:619)'
                                .'|tail/([^/]++)(*:640)'
                            .')'
                            .'|unban/([^/]++)(*:663)'
                        .')'
                        .'|destinations/(?'
                            .'|edit/([^/]++)(*:701)'
                            .'|delete/([^/]++)(*:724)'
                        .')'
                        .'|pack(?'
                            .'|s/(?'
                                .'|edit/([^/]++)(*:758)'
                                .'|delete/([^/]++)(*:781)'
                                .'|toggle/([^/]++)(*:804)'
                            .')'
                            .'|\\-categories/(?'
                                .'|edit/([^/]++)(*:842)'
                                .'|delete/([^/]++)(*:865)'
                            .')'
                        .')'
                        .'|offers/(?'
                            .'|edit/([^/]++)(*:898)'
                            .'|delete/([^/]++)(*:921)'
                            .'|toggle/([^/]++)(*:944)'
                        .')'
                        .'|b(?'
                            .'|ookings(?'
                                .'|/status/([^/]++)/([^/]++)(*:992)'
                                .'|\\-des/(?'
                                    .'|(\\d+)/confirm(*:1022)'
                                    .'|(\\d+)/reject(*:1043)'
                                    .'|(\\d+)/delete(*:1064)'
                                .')'
                            .')'
                            .'|log/(?'
                                .'|post/([^/]++)(*:1095)'
                                .'|story/([^/]++)(*:1118)'
                                .'|([^/]++)/(?'
                                    .'|approve(*:1146)'
                                    .'|reject(*:1161)'
                                    .'|edit(*:1174)'
                                    .'|delete(*:1189)'
                                .')'
                                .'|story/([^/]++)/delete(*:1220)'
                                .'|comment/([^/]++)/delete(*:1252)'
                            .')'
                        .')'
                        .'|transport/(?'
                            .'|edit/([^/]++)(*:1289)'
                            .'|de(?'
                                .'|lete/([^/]++)(*:1316)'
                                .'|stinations/(?'
                                    .'|edit/([^/]++)(*:1352)'
                                    .'|delete/([^/]++)(*:1376)'
                                .')'
                            .')'
                            .'|toggle/([^/]++)(*:1402)'
                            .'|schedules/(?'
                                .'|edit/([^/]++)(*:1437)'
                                .'|del(?'
                                    .'|ete/([^/]++)(*:1464)'
                                    .'|ay/([^/]++)(*:1484)'
                                .')'
                                .'|cancel/([^/]++)(*:1509)'
                            .')'
                            .'|bookings/(?'
                                .'|re(?'
                                    .'|ceipt/([^/]++)(*:1550)'
                                    .'|fund/([^/]++)(*:1572)'
                                .')'
                                .'|c(?'
                                    .'|onfirm/([^/]++)(*:1601)'
                                    .'|ancel/([^/]++)(*:1624)'
                                .')'
                                .'|de(?'
                                    .'|lete/([^/]++)(*:1652)'
                                    .'|tails/([^/]++)(*:1675)'
                                .')'
                            .')'
                        .')'
                    .')'
                    .'|c(?'
                        .'|commodations/(\\d+)(*:1710)'
                        .'|tivities/(\\d+)(*:1733)'
                    .')'
                    .'|pi/(?'
                        .'|weather/([^/]++)(*:1765)'
                        .'|flights/([^/]++)(*:1790)'
                        .'|nearby/([^/]++)(*:1814)'
                        .'|i(?'
                            .'|mages/([^/]++)(*:1841)'
                            .'|tinerary/([^/]++)(*:1867)'
                        .')'
                        .'|r(?'
                            .'|eviews/([^/]++)(*:1896)'
                            .'|oom/images/([^/]++)(*:1924)'
                        .')'
                        .'|accommodation/rooms/([^/]++)(*:1962)'
                    .')'
                .')'
                .'|/comment/(?'
                    .'|create(?'
                        .'|/([^/]++)(*:2003)'
                        .'|\\-(?'
                            .'|ajax/([^/]++)(*:2030)'
                            .'|story\\-ajax/([^/]++)(*:2059)'
                        .')'
                    .')'
                    .'|([^/]++)/(?'
                        .'|edit(?'
                            .'|(*:2089)'
                            .'|\\-ajax(*:2104)'
                        .')'
                        .'|delete(*:2120)'
                        .'|react/([^/]++)(*:2143)'
                    .')'
                .')'
                .'|/destinations/(?'
                    .'|(\\d+)(*:2176)'
                    .'|(\\d+)/book(*:2195)'
                .')'
                .'|/follow/([^/]++)(?'
                    .'|(*:2224)'
                    .'|/status(*:2240)'
                .')'
                .'|/p(?'
                    .'|ack(?'
                        .'|s/([^/]++)(*:2271)'
                        .'|\\-bookings/cancel/([^/]++)(*:2306)'
                    .')'
                    .'|ost/(?'
                        .'|(\\d+)(*:2328)'
                        .'|(\\d+)/edit(*:2347)'
                        .'|(\\d+)/delete(*:2368)'
                        .'|([^/]++)/(?'
                            .'|react/([^/]++)(*:2403)'
                            .'|save(*:2416)'
                        .')'
                    .')'
                .')'
                .'|/travel\\-stor(?'
                    .'|y/([^/]++)/react/([^/]++)(*:2469)'
                    .'|ies/([^/]++)(?'
                        .'|(*:2493)'
                        .'|/edit(*:2507)'
                    .')'
                .')'
                .'|/user/transport/(?'
                    .'|browse/detail/([^/]++)(*:2559)'
                    .'|my\\-bookings/(?'
                        .'|cancel/([^/]++)(*:2599)'
                        .'|add\\-schedule/([^/]++)(*:2630)'
                        .'|receipt/([^/]++)(*:2655)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => 'qr_code_generate', '_controller' => 'Endroid\\QrCodeBundle\\Controller\\GenerateController'], ['builder', 'data'], null, null, false, true, null]],
        70 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        116 => [[['_route' => 'admin_accommodations_view', '_controller' => 'App\\Controller\\admin\\AccommodationController::view'], ['id'], ['GET' => 0], null, false, true, null]],
        134 => [[['_route' => 'admin_accommodations_edit', '_controller' => 'App\\Controller\\admin\\AccommodationController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        154 => [[['_route' => 'admin_accommodations_delete', '_controller' => 'App\\Controller\\admin\\AccommodationController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        179 => [[['_route' => 'admin_accommodations_bookings_view', '_controller' => 'App\\Controller\\admin\\BookingController::view'], ['id'], ['GET' => 0], null, false, true, null]],
        200 => [[['_route' => 'admin_accommodations_bookings_confirm', '_controller' => 'App\\Controller\\admin\\BookingController::confirm'], ['id'], ['POST' => 0], null, false, false, null]],
        220 => [[['_route' => 'admin_accommodations_bookings_reject', '_controller' => 'App\\Controller\\admin\\BookingController::reject'], ['id'], ['POST' => 0], null, false, false, null]],
        240 => [[['_route' => 'admin_accommodations_bookings_cancel', '_controller' => 'App\\Controller\\admin\\BookingController::cancel'], ['id'], ['POST' => 0], null, false, false, null]],
        266 => [[['_route' => 'admin_rooms_index', '_controller' => 'App\\Controller\\admin\\RoomController::index'], ['accId'], ['GET' => 0], null, false, false, null]],
        282 => [[['_route' => 'admin_rooms_list', '_controller' => 'App\\Controller\\admin\\RoomController::list'], ['accId'], ['GET' => 0], null, false, false, null]],
        293 => [[['_route' => 'admin_rooms_new', '_controller' => 'App\\Controller\\admin\\RoomController::new'], ['accId'], ['POST' => 0], null, false, false, null]],
        306 => [[['_route' => 'admin_rooms_view', '_controller' => 'App\\Controller\\admin\\RoomController::view'], ['accId', 'roomId'], ['GET' => 0], null, false, true, null]],
        324 => [[['_route' => 'admin_rooms_edit', '_controller' => 'App\\Controller\\admin\\RoomController::edit'], ['accId', 'roomId'], ['POST' => 0], null, false, false, null]],
        344 => [[['_route' => 'admin_rooms_delete', '_controller' => 'App\\Controller\\admin\\RoomController::delete'], ['accId', 'roomId'], ['POST' => 0], null, false, false, null]],
        371 => [[['_route' => 'admin_rooms_images_upload', '_controller' => 'App\\Controller\\admin\\RoomController::uploadImages'], ['accId', 'roomId'], ['POST' => 0], null, false, false, null]],
        405 => [[['_route' => 'admin_rooms_images_primary', '_controller' => 'App\\Controller\\admin\\RoomController::setPrimary'], ['accId', 'roomId', 'imgId'], ['POST' => 0], null, false, false, null]],
        438 => [[['_route' => 'admin_rooms_images_delete', '_controller' => 'App\\Controller\\admin\\RoomController::deleteImage'], ['accId', 'roomId', 'imgId'], ['POST' => 0], null, false, false, null]],
        466 => [[['_route' => 'admin_rooms_images_reorder', '_controller' => 'App\\Controller\\admin\\RoomController::reorderImages'], ['accId', 'roomId'], ['POST' => 0], null, false, false, null]],
        482 => [[['_route' => 'admin_rooms_insights', '_controller' => 'App\\Controller\\admin\\RoomController::insights'], ['accId'], ['GET' => 0], null, false, false, null]],
        518 => [[['_route' => 'admin_activity_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editActivity'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        541 => [[['_route' => 'admin_activity_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteActivity'], ['id'], null, null, false, true, null]],
        573 => [[['_route' => 'admin_user_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editUser'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        593 => [[['_route' => 'admin_user_ban', '_controller' => 'App\\Controller\\admin\\AdminController::banUser'], ['id'], null, null, false, true, null]],
        619 => [[['_route' => 'admin_user_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteUser'], ['id'], null, null, false, true, null]],
        640 => [[['_route' => 'admin_user_detail', '_controller' => 'App\\Controller\\admin\\AdminController::userDetail'], ['id'], null, null, false, true, null]],
        663 => [[['_route' => 'admin_user_unban', '_controller' => 'App\\Controller\\admin\\AdminController::unbanUser'], ['id'], null, null, false, true, null]],
        701 => [[['_route' => 'admin_destination_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editDestination'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        724 => [[['_route' => 'admin_destination_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteDestination'], ['id'], null, null, false, true, null]],
        758 => [[['_route' => 'admin_pack_edit', '_controller' => 'App\\Controller\\admin\\AdminPacksController::editPack'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        781 => [[['_route' => 'admin_pack_delete', '_controller' => 'App\\Controller\\admin\\AdminPacksController::deletePack'], ['id'], null, null, false, true, null]],
        804 => [[['_route' => 'admin_pack_toggle', '_controller' => 'App\\Controller\\admin\\AdminPacksController::togglePack'], ['id'], null, null, false, true, null]],
        842 => [[['_route' => 'admin_pack_category_edit', '_controller' => 'App\\Controller\\admin\\AdminPacksController::editCategory'], ['id'], ['POST' => 0], null, false, true, null]],
        865 => [[['_route' => 'admin_pack_category_delete', '_controller' => 'App\\Controller\\admin\\AdminPacksController::deleteCategory'], ['id'], null, null, false, true, null]],
        898 => [[['_route' => 'admin_offer_edit', '_controller' => 'App\\Controller\\admin\\AdminPacksController::editOffer'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        921 => [[['_route' => 'admin_offer_delete', '_controller' => 'App\\Controller\\admin\\AdminPacksController::deleteOffer'], ['id'], null, null, false, true, null]],
        944 => [[['_route' => 'admin_offer_toggle', '_controller' => 'App\\Controller\\admin\\AdminPacksController::toggleOffer'], ['id'], null, null, false, true, null]],
        992 => [[['_route' => 'admin_booking_status', '_controller' => 'App\\Controller\\admin\\AdminPacksController::updateBookingStatus'], ['id', 'status'], null, null, false, true, null]],
        1022 => [[['_route' => 'admin_bookings_des_confirm', '_controller' => 'App\\Controller\\admin\\BookingDesController::confirm'], ['id'], null, null, false, false, null]],
        1043 => [[['_route' => 'admin_bookings_des_reject', '_controller' => 'App\\Controller\\admin\\BookingDesController::reject'], ['id'], null, null, false, false, null]],
        1064 => [[['_route' => 'admin_bookings_des_delete', '_controller' => 'App\\Controller\\admin\\BookingDesController::delete'], ['id'], null, null, false, false, null]],
        1095 => [[['_route' => 'admin_post_show', '_controller' => 'App\\Controller\\admin\\BlogAdminController::showPost'], ['id'], ['GET' => 0], null, false, true, null]],
        1118 => [[['_route' => 'admin_story_show', '_controller' => 'App\\Controller\\admin\\BlogAdminController::showStory'], ['id'], ['GET' => 0], null, false, true, null]],
        1146 => [[['_route' => 'admin_blog_approve', '_controller' => 'App\\Controller\\admin\\BlogAdminController::approve'], ['id'], ['POST' => 0], null, false, false, null]],
        1161 => [[['_route' => 'admin_blog_reject', '_controller' => 'App\\Controller\\admin\\BlogAdminController::reject'], ['id'], ['POST' => 0], null, false, false, null]],
        1174 => [[['_route' => 'admin_blog_edit', '_controller' => 'App\\Controller\\admin\\BlogAdminController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        1189 => [[['_route' => 'admin_blog_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        1220 => [[['_route' => 'admin_story_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::deleteStory'], ['id'], ['POST' => 0], null, false, false, null]],
        1252 => [[['_route' => 'admin_comment_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::deleteComment'], ['id'], ['POST' => 0], null, false, false, null]],
        1289 => [[['_route' => 'admin_transport_edit', '_controller' => 'App\\Controller\\admin\\TransportAdminController::editTransport'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        1316 => [[['_route' => 'admin_transport_delete', '_controller' => 'App\\Controller\\admin\\TransportAdminController::deleteTransport'], ['id'], null, null, false, true, null]],
        1352 => [[['_route' => 'admin_trans_destination_edit', '_controller' => 'App\\Controller\\admin\\TransportAdminController::editDestination'], ['id'], null, null, false, true, null]],
        1376 => [[['_route' => 'admin_trans_destination_delete', '_controller' => 'App\\Controller\\admin\\TransportAdminController::deleteDestination'], ['id'], null, null, false, true, null]],
        1402 => [[['_route' => 'admin_transport_toggle', '_controller' => 'App\\Controller\\admin\\TransportAdminController::toggleTransport'], ['id'], null, null, false, true, null]],
        1437 => [[['_route' => 'admin_schedule_edit', '_controller' => 'App\\Controller\\admin\\TransportAdminController::editSchedule'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        1464 => [[['_route' => 'admin_schedule_delete', '_controller' => 'App\\Controller\\admin\\TransportAdminController::deleteSchedule'], ['id'], null, null, false, true, null]],
        1484 => [[['_route' => 'admin_schedule_delay', '_controller' => 'App\\Controller\\admin\\TransportAdminController::delaySchedule'], ['id'], ['POST' => 0], null, false, true, null]],
        1509 => [[['_route' => 'admin_schedule_cancel', '_controller' => 'App\\Controller\\admin\\TransportAdminController::cancelSchedule'], ['id'], null, null, false, true, null]],
        1550 => [[['_route' => 'admin_booking_receipt_pdf', '_controller' => 'App\\Controller\\admin\\TransportAdminController::exportReceiptPdf'], ['id'], null, null, false, true, null]],
        1572 => [[['_route' => 'admin_booking_refund', '_controller' => 'App\\Controller\\admin\\TransportAdminController::refundBooking'], ['id'], null, null, false, true, null]],
        1601 => [[['_route' => 'admin_booking_confirm', '_controller' => 'App\\Controller\\admin\\TransportAdminController::confirmBooking'], ['id'], null, null, false, true, null]],
        1624 => [[['_route' => 'admin_booking_cancel', '_controller' => 'App\\Controller\\admin\\TransportAdminController::cancelBooking'], ['id'], ['POST' => 0], null, false, true, null]],
        1652 => [[['_route' => 'admin_booking_delete', '_controller' => 'App\\Controller\\admin\\TransportAdminController::deleteBooking'], ['id'], null, null, false, true, null]],
        1675 => [[['_route' => 'admin_booking_details', '_controller' => 'App\\Controller\\admin\\TransportAdminController::bookingDetails'], ['id'], null, null, false, true, null]],
        1710 => [[['_route' => 'accommodation_details', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1733 => [[['_route' => 'activity_detail', '_controller' => 'App\\Controller\\user\\ActivityFrontController::detail'], ['id'], null, null, false, true, null]],
        1765 => [[['_route' => 'api_weather', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getWeather'], ['id'], ['GET' => 0], null, false, true, null]],
        1790 => [[['_route' => 'api_flights', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getFlights'], ['id'], ['GET' => 0], null, false, true, null]],
        1814 => [[['_route' => 'api_nearby', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getNearby'], ['id'], ['GET' => 0], null, false, true, null]],
        1841 => [[['_route' => 'api_images', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getImages'], ['id'], ['GET' => 0], null, false, true, null]],
        1867 => [[['_route' => 'api_itinerary', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::generateItinerary'], ['id'], ['POST' => 0], null, false, true, null]],
        1896 => [[['_route' => 'api_reviews', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getReviews'], ['id'], ['GET' => 0], null, false, true, null]],
        1924 => [[['_route' => 'api_room_images', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getRoomImages'], ['id'], ['GET' => 0], null, false, true, null]],
        1962 => [[['_route' => 'api_accommodation_rooms', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getRooms'], ['id'], ['GET' => 0], null, false, true, null]],
        2003 => [[['_route' => 'comment_create', '_controller' => 'App\\Controller\\user\\CommentController::create'], ['id'], ['POST' => 0], null, false, true, null]],
        2030 => [[['_route' => 'comment_create_ajax', '_controller' => 'App\\Controller\\user\\CommentController::createAjax'], ['id'], ['POST' => 0], null, false, true, null]],
        2059 => [[['_route' => 'comment_create_story_ajax', '_controller' => 'App\\Controller\\user\\CommentController::createStoryAjax'], ['id'], ['POST' => 0], null, false, true, null]],
        2089 => [[['_route' => 'comment_edit', '_controller' => 'App\\Controller\\user\\CommentController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        2104 => [[['_route' => 'comment_edit_ajax', '_controller' => 'App\\Controller\\user\\CommentController::editAjax'], ['id'], ['POST' => 0], null, false, false, null]],
        2120 => [[['_route' => 'comment_delete', '_controller' => 'App\\Controller\\user\\CommentController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        2143 => [[['_route' => 'comment_react', '_controller' => 'App\\Controller\\user\\ReactionController::reactToComment'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        2176 => [[['_route' => 'destination_detail', '_controller' => 'App\\Controller\\user\\DestinationsController::detail'], ['id'], null, null, false, true, null]],
        2195 => [[['_route' => 'booking_form', '_controller' => 'App\\Controller\\user\\DestinationsController::bookingForm'], ['destinationId'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2224 => [[['_route' => 'follow_toggle', '_controller' => 'App\\Controller\\user\\FollowController::toggle'], ['id'], ['POST' => 0], null, false, true, null]],
        2240 => [[['_route' => 'follow_status', '_controller' => 'App\\Controller\\user\\FollowController::status'], ['id'], ['GET' => 0], null, false, false, null]],
        2271 => [[['_route' => 'user_pack_details', '_controller' => 'App\\Controller\\user\\FrontPacksController::packDetails'], ['id'], null, null, false, true, null]],
        2306 => [[['_route' => 'user_pack_booking_cancel', '_controller' => 'App\\Controller\\user\\FrontPacksController::cancelBooking'], ['id'], null, null, false, true, null]],
        2328 => [[['_route' => 'post_show', '_controller' => 'App\\Controller\\user\\PostController::show'], ['id'], null, null, false, true, null]],
        2347 => [[['_route' => 'post_edit', '_controller' => 'App\\Controller\\user\\PostController::edit'], ['id'], null, null, false, false, null]],
        2368 => [[['_route' => 'post_delete', '_controller' => 'App\\Controller\\user\\PostController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        2403 => [[['_route' => 'post_react', '_controller' => 'App\\Controller\\user\\ReactionController::reactToPost'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        2416 => [[['_route' => 'post_save_toggle', '_controller' => 'App\\Controller\\user\\SavedPostController::toggle'], ['id'], ['POST' => 0], null, false, false, null]],
        2469 => [[['_route' => 'travel_story_react', '_controller' => 'App\\Controller\\user\\ReactionController::reactToTravelStory'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        2493 => [[['_route' => 'travel_story_show', '_controller' => 'App\\Controller\\user\\TravelStoryController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2507 => [[['_route' => 'travel_story_edit', '_controller' => 'App\\Controller\\user\\TravelStoryController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2559 => [[['_route' => 'user_transport_detail', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::transportDetail'], ['id'], null, null, false, true, null]],
        2599 => [[['_route' => 'user_booking_cancel', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::cancelBooking'], ['id'], ['POST' => 0], null, false, true, null]],
        2630 => [[['_route' => 'user_booking_add_schedule', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::addScheduleToBooking'], ['bookingId'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        2655 => [
            [['_route' => 'user_booking_receipt_pdf', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::exportReceiptPdf'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
