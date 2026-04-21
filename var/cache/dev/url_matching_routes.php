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
        '/admin/packs' => [[['_route' => 'admin_packs', '_controller' => 'App\\Controller\\admin\\AdminPacksController::packs'], null, null, null, false, false, null]],
        '/admin/packs/add' => [[['_route' => 'admin_pack_add', '_controller' => 'App\\Controller\\admin\\AdminPacksController::addPack'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/pack-categories' => [[['_route' => 'admin_pack_categories', '_controller' => 'App\\Controller\\admin\\AdminPacksController::categories'], null, null, null, false, false, null]],
        '/admin/pack-categories/add' => [[['_route' => 'admin_pack_category_add', '_controller' => 'App\\Controller\\admin\\AdminPacksController::addCategory'], null, ['POST' => 0], null, false, false, null]],
        '/admin/offers' => [[['_route' => 'admin_offers', '_controller' => 'App\\Controller\\admin\\AdminPacksController::offers'], null, null, null, false, false, null]],
        '/admin/offers/add' => [[['_route' => 'admin_offer_add', '_controller' => 'App\\Controller\\admin\\AdminPacksController::addOffer'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/admin/bookings' => [[['_route' => 'admin_pack_bookings', '_controller' => 'App\\Controller\\admin\\AdminPacksController::bookings'], null, null, null, false, false, null]],
        '/admin/loyalty' => [[['_route' => 'admin_loyalty', '_controller' => 'App\\Controller\\admin\\AdminPacksController::loyalty'], null, null, null, false, false, null]],
        '/admin/blog' => [[['_route' => 'admin_blog', '_controller' => 'App\\Controller\\admin\\BlogAdminController::index'], null, null, null, false, false, null]],
        '/admin/blog/bulk-action' => [[['_route' => 'admin_blog_bulk_action', '_controller' => 'App\\Controller\\admin\\BlogAdminController::bulkAction'], null, ['POST' => 0], null, false, false, null]],
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
        '/onboarding' => [[['_route' => 'app_onboarding', '_controller' => 'App\\Controller\\user\\AuthController::onboarding'], null, null, null, false, false, null]],
        '/preferences/save' => [[['_route' => 'app_save_preferences', '_controller' => 'App\\Controller\\user\\AuthController::savePreferences'], null, ['POST' => 0], null, false, false, null]],
        '/blog/user-names' => [[['_route' => 'blog_user_names', '_controller' => 'App\\Controller\\user\\BlogController::userNames'], null, ['GET' => 0], null, false, false, null]],
        '/blog' => [[['_route' => 'blog', '_controller' => 'App\\Controller\\user\\BlogController::index'], null, null, null, false, false, null]],
        '/blog/filter' => [[['_route' => 'blog_filter', '_controller' => 'App\\Controller\\user\\BlogController::filter'], null, ['GET' => 0], null, false, false, null]],
        '/blog/profile/edit' => [[['_route' => 'blog_profile_edit', '_controller' => 'App\\Controller\\user\\BlogProfileController::edit'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/api/chat' => [[['_route' => 'api_chat', '_controller' => 'App\\Controller\\user\\ChatController::chat'], null, ['POST' => 0], null, false, false, null]],
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
        '/packs-offers' => [[['_route' => 'user_packs_offers', '_controller' => 'App\\Controller\\user\\FrontPacksController::packsAndOffers'], null, null, null, false, false, null]],
        '/packs-offers/search' => [[['_route' => 'user_packs_search', '_controller' => 'App\\Controller\\user\\FrontPacksController::searchPacks'], null, ['GET' => 0], null, false, false, null]],
        '/packs' => [[['_route' => 'user_packs', '_controller' => 'App\\Controller\\user\\FrontPacksController::packsRedirect'], null, null, null, false, false, null]],
        '/pack-bookings' => [[['_route' => 'user_pack_bookings', '_controller' => 'App\\Controller\\user\\FrontPacksController::bookingsRedirect'], null, null, null, false, false, null]],
        '/my-loyalty' => [[['_route' => 'user_loyalty', '_controller' => 'App\\Controller\\user\\FrontPacksController::loyaltyRedirect'], null, null, null, false, false, null]],
        '/blog/live/list' => [[['_route' => 'blog_live_list', '_controller' => 'App\\Controller\\user\\LiveController::list'], null, ['GET' => 0], null, false, false, null]],
        '/blog/live/start' => [[['_route' => 'blog_live_start', '_controller' => 'App\\Controller\\user\\LiveController::start'], null, ['POST' => 0], null, false, false, null]],
        '/my-bookings' => [[['_route' => 'my_bookings', '_controller' => 'App\\Controller\\user\\MyBookingsController::index'], null, null, null, false, false, null]],
        '/post/create' => [[['_route' => 'post_create', '_controller' => 'App\\Controller\\user\\PostController::create'], null, null, null, false, false, null]],
        '/post/enhance-image' => [[['_route' => 'post_enhance_image', '_controller' => 'App\\Controller\\user\\PostController::enhanceImage'], null, ['POST' => 0], null, false, false, null]],
        '/price-dashboard' => [[['_route' => 'price_dashboard', '_controller' => 'App\\Controller\\user\\PricePredictionController::dashboard'], null, null, null, false, false, null]],
        '/api/price-alert' => [[['_route' => 'api_price_alert', '_controller' => 'App\\Controller\\user\\PricePredictionController::createPriceAlert'], null, ['POST' => 0], null, false, false, null]],
        '/api/price-alerts/feed' => [[['_route' => 'api_price_alerts_feed', '_controller' => 'App\\Controller\\user\\PricePredictionController::feedAlerts'], null, ['GET' => 0], null, false, false, null]],
        '/blog/legacy-profile/edit' => [[['_route' => 'legacy_blog_profile_edit', '_controller' => 'App\\Controller\\user\\ProfileController::edit'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/forgot-password' => [[['_route' => 'app_forgot_password', '_controller' => 'App\\Controller\\user\\ResetPasswordController::forgotPassword'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/blog/saved' => [[['_route' => 'blog_saved', '_controller' => 'App\\Controller\\user\\SavedPostController::saved'], null, null, null, false, false, null]],
        '/stories/create' => [[['_route' => 'story_create', '_controller' => 'App\\Controller\\user\\StoryController::create'], null, ['POST' => 0], null, false, false, null]],
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
        '/travel-stories/destination/geocode' => [[['_route' => 'travel_story_destination_geocode', '_controller' => 'App\\Controller\\user\\TravelStoryController::geocodeDestination'], null, ['GET' => 0], null, false, false, null]],
        '/profile' => [[['_route' => 'users', '_controller' => 'App\\Controller\\user\\UserController::profile'], null, ['GET' => 0], null, false, false, null]],
        '/profile/update' => [[['_route' => 'profile_update', '_controller' => 'App\\Controller\\user\\UserController::updateProfile'], null, ['POST' => 0], null, false, false, null]],
        '/profile/password' => [[['_route' => 'profile_password', '_controller' => 'App\\Controller\\user\\UserController::changePassword'], null, ['POST' => 0], null, false, false, null]],
        '/profile/stats' => [[['_route' => 'profile_stats', '_controller' => 'App\\Controller\\user\\UserController::getStats'], null, ['GET' => 0], null, false, false, null]],
        '/profile/preferences' => [[['_route' => 'profile_preferences', '_controller' => 'App\\Controller\\user\\UserController::saveTravelPreferences'], null, ['POST' => 0], null, false, false, null]],
        '/profile/delete' => [[['_route' => 'profile_delete', '_controller' => 'App\\Controller\\user\\UserController::deleteAccount'], null, ['POST' => 0], null, false, false, null]],
        '/blog/admin' => [[['_route' => 'blog_admin_legacy_redirect', 'route' => 'admin_blog', 'permanent' => false, 'keepQueryParams' => true, '_controller' => 'Symfony\\Bundle\\FrameworkBundle\\Controller\\RedirectController'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/a(?'
                    .'|dmin/(?'
                        .'|ac(?'
                            .'|commodations/(?'
                                .'|(\\d+)(*:81)'
                                .'|(\\d+)/edit(*:98)'
                                .'|(\\d+)/delete(*:117)'
                                .'|bookings/(?'
                                    .'|(\\d+)(*:142)'
                                    .'|(\\d+)/confirm(*:163)'
                                    .'|(\\d+)/reject(*:183)'
                                    .'|(\\d+)/cancel(*:203)'
                                .')'
                                .'|([^/]++)/rooms(?'
                                    .'|(*:229)'
                                    .'|/(?'
                                        .'|list(*:245)'
                                        .'|new(*:256)'
                                        .'|(\\d+)(*:269)'
                                        .'|(\\d+)/edit(*:287)'
                                        .'|(\\d+)/delete(*:307)'
                                        .'|(\\d+)/images/upload(*:334)'
                                        .'|(\\d+)/images/(\\d+)/primary(*:368)'
                                        .'|(\\d+)/images/(\\d+)/delete(*:401)'
                                        .'|(\\d+)/images/reorder(*:429)'
                                        .'|insights(*:445)'
                                    .')'
                                .')'
                            .')'
                            .'|tivities/(?'
                                .'|edit/([^/]++)(*:481)'
                                .'|delete/([^/]++)(*:504)'
                            .')'
                        .')'
                        .'|users/(?'
                            .'|edit/([^/]++)(*:536)'
                            .'|ban/([^/]++)(*:556)'
                            .'|de(?'
                                .'|lete/([^/]++)(*:582)'
                                .'|tail/([^/]++)(*:603)'
                            .')'
                            .'|unban/([^/]++)(*:626)'
                        .')'
                        .'|destinations/(?'
                            .'|edit/([^/]++)(*:664)'
                            .'|delete/([^/]++)(*:687)'
                        .')'
                        .'|pack(?'
                            .'|s/(?'
                                .'|edit/([^/]++)(*:721)'
                                .'|delete/([^/]++)(*:744)'
                                .'|toggle/([^/]++)(*:767)'
                            .')'
                            .'|\\-categories/(?'
                                .'|edit/([^/]++)(*:805)'
                                .'|delete/([^/]++)(*:828)'
                            .')'
                        .')'
                        .'|offers/(?'
                            .'|edit/([^/]++)(*:861)'
                            .'|delete/([^/]++)(*:884)'
                            .'|toggle/([^/]++)(*:907)'
                        .')'
                        .'|b(?'
                            .'|ookings(?'
                                .'|/status/([^/]++)/([^/]++)(*:955)'
                                .'|\\-des/(?'
                                    .'|(\\d+)/confirm(*:985)'
                                    .'|(\\d+)/reject(*:1005)'
                                    .'|(\\d+)/delete(*:1026)'
                                .')'
                            .')'
                            .'|log/(?'
                                .'|([^/]++)/approve(*:1060)'
                                .'|ig\\-story/([^/]++)/delete(*:1094)'
                                .'|live/([^/]++)/delete(*:1123)'
                                .'|([^/]++)/(?'
                                    .'|reject(*:1150)'
                                    .'|delete(*:1165)'
                                .')'
                                .'|story/([^/]++)/delete(*:1196)'
                                .'|([^/]++)/show(*:1218)'
                                .'|story/([^/]++)/show(*:1246)'
                                .'|comment/([^/]++)/delete(*:1278)'
                                .'|live\\-comment/([^/]++)/delete(*:1316)'
                            .')'
                        .')'
                        .'|transport/(?'
                            .'|edit/([^/]++)(*:1353)'
                            .'|de(?'
                                .'|lete/([^/]++)(*:1380)'
                                .'|stinations/(?'
                                    .'|edit/([^/]++)(*:1416)'
                                    .'|delete/([^/]++)(*:1440)'
                                .')'
                            .')'
                            .'|toggle/([^/]++)(*:1466)'
                            .'|schedules/(?'
                                .'|edit/([^/]++)(*:1501)'
                                .'|del(?'
                                    .'|ete/([^/]++)(*:1528)'
                                    .'|ay/([^/]++)(*:1548)'
                                .')'
                                .'|cancel/([^/]++)(*:1573)'
                            .')'
                            .'|bookings/(?'
                                .'|re(?'
                                    .'|ceipt/([^/]++)(*:1614)'
                                    .'|fund/([^/]++)(*:1636)'
                                .')'
                                .'|c(?'
                                    .'|onfirm/([^/]++)(*:1665)'
                                    .'|ancel/([^/]++)(*:1688)'
                                .')'
                                .'|de(?'
                                    .'|lete/([^/]++)(*:1716)'
                                    .'|tails/([^/]++)(*:1739)'
                                .')'
                            .')'
                        .')'
                    .')'
                    .'|c(?'
                        .'|commodations/(\\d+)(*:1774)'
                        .'|tivities/(\\d+)(*:1797)'
                    .')'
                    .'|pi/(?'
                        .'|weather/([^/]++)(*:1829)'
                        .'|flights/([^/]++)(*:1854)'
                        .'|nearby/([^/]++)(*:1878)'
                        .'|i(?'
                            .'|mages/([^/]++)(*:1905)'
                            .'|tinerary/([^/]++)(*:1931)'
                        .')'
                        .'|r(?'
                            .'|eviews/([^/]++)(*:1960)'
                            .'|oom/images/([^/]++)(*:1988)'
                        .')'
                        .'|accommodation/rooms/([^/]++)(*:2026)'
                    .')'
                .')'
                .'|/blog/(?'
                    .'|profile/(?'
                        .'|(\\d+)(*:2062)'
                        .'|(\\d+)/archive(*:2084)'
                    .')'
                    .'|l(?'
                        .'|ive/(?'
                            .'|(\\d+)/end(*:2114)'
                            .'|(\\d+)/saved\\-to\\-profile(*:2147)'
                            .'|(\\d+)/join(*:2166)'
                            .'|(\\d+)/leave(*:2186)'
                            .'|(\\d+)/comment(*:2208)'
                            .'|(\\d+)/react/([^/]++)(*:2237)'
                            .'|(\\d+)/state(*:2257)'
                            .'|(\\d+)/token(*:2277)'
                            .'|(\\d+)/recording(*:2301)'
                            .'|(\\d+)/delete(*:2322)'
                            .'|(\\d+)/dismiss\\-removed(*:2353)'
                        .')'
                        .'|egacy\\-profile/(?'
                            .'|(\\d+)(*:2386)'
                            .'|(\\d+)/archive(*:2408)'
                        .')'
                    .')'
                .')'
                .'|/comment/(?'
                    .'|create/([^/]++)(*:2447)'
                    .'|([^/]++)/(?'
                        .'|edit(*:2472)'
                        .'|delete(*:2487)'
                        .'|react/([^/]++)(*:2510)'
                    .')'
                .')'
                .'|/travel\\-stor(?'
                    .'|y/(?'
                        .'|comment/create/([^/]++)(*:2565)'
                        .'|([^/]++)/react/([^/]++)(*:2597)'
                    .')'
                    .'|ies/(?'
                        .'|([^/]++)(?'
                            .'|(*:2625)'
                            .'|/(?'
                                .'|edit(*:2642)'
                                .'|d(?'
                                    .'|elete(*:2660)'
                                    .'|ismiss\\-removed(*:2684)'
                                .')'
                            .')'
                        .')'
                        .'|ai\\-assist(*:2706)'
                    .')'
                .')'
                .'|/destinations/(?'
                    .'|(\\d+)(*:2739)'
                    .'|(\\d+)/book(*:2758)'
                .')'
                .'|/follow/(?'
                    .'|([^/]++)(*:2787)'
                    .'|accept/([^/]++)(*:2811)'
                    .'|reject/([^/]++)(*:2835)'
                    .'|([^/]++)/status(*:2859)'
                .')'
                .'|/p(?'
                    .'|ack(?'
                        .'|s/([^/]++)(*:2890)'
                        .'|\\-bookings/cancel/([^/]++)(*:2925)'
                    .')'
                    .'|ost/(?'
                        .'|(\\d+)(*:2947)'
                        .'|(\\d+)/edit(*:2966)'
                        .'|(\\d+)/delete(*:2987)'
                        .'|(\\d+)/dismiss\\-removed(*:3018)'
                        .'|([^/]++)/(?'
                            .'|react/([^/]++)(*:3053)'
                            .'|save(*:3066)'
                        .')'
                    .')'
                .')'
                .'|/stories/(?'
                    .'|user/(\\d+)(*:3100)'
                    .'|(\\d+)/delete(*:3121)'
                    .'|(\\d+)/seen(*:3140)'
                    .'|(\\d+)/viewers(*:3162)'
                    .'|(\\d+)/dismiss\\-removed(*:3193)'
                .')'
                .'|/user/transport/(?'
                    .'|browse/detail/([^/]++)(*:3244)'
                    .'|my\\-bookings/(?'
                        .'|cancel/([^/]++)(*:3284)'
                        .'|add\\-schedule/([^/]++)(*:3315)'
                        .'|receipt/([^/]++)(*:3340)'
                    .')'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        81 => [[['_route' => 'admin_accommodations_view', '_controller' => 'App\\Controller\\admin\\AccommodationController::view'], ['id'], ['GET' => 0], null, false, true, null]],
        98 => [[['_route' => 'admin_accommodations_edit', '_controller' => 'App\\Controller\\admin\\AccommodationController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        117 => [[['_route' => 'admin_accommodations_delete', '_controller' => 'App\\Controller\\admin\\AccommodationController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        142 => [[['_route' => 'admin_accommodations_bookings_view', '_controller' => 'App\\Controller\\admin\\BookingController::view'], ['id'], ['GET' => 0], null, false, true, null]],
        163 => [[['_route' => 'admin_accommodations_bookings_confirm', '_controller' => 'App\\Controller\\admin\\BookingController::confirm'], ['id'], ['POST' => 0], null, false, false, null]],
        183 => [[['_route' => 'admin_accommodations_bookings_reject', '_controller' => 'App\\Controller\\admin\\BookingController::reject'], ['id'], ['POST' => 0], null, false, false, null]],
        203 => [[['_route' => 'admin_accommodations_bookings_cancel', '_controller' => 'App\\Controller\\admin\\BookingController::cancel'], ['id'], ['POST' => 0], null, false, false, null]],
        229 => [[['_route' => 'admin_rooms_index', '_controller' => 'App\\Controller\\admin\\RoomController::index'], ['accId'], ['GET' => 0], null, false, false, null]],
        245 => [[['_route' => 'admin_rooms_list', '_controller' => 'App\\Controller\\admin\\RoomController::list'], ['accId'], ['GET' => 0], null, false, false, null]],
        256 => [[['_route' => 'admin_rooms_new', '_controller' => 'App\\Controller\\admin\\RoomController::new'], ['accId'], ['POST' => 0], null, false, false, null]],
        269 => [[['_route' => 'admin_rooms_view', '_controller' => 'App\\Controller\\admin\\RoomController::view'], ['accId', 'roomId'], ['GET' => 0], null, false, true, null]],
        287 => [[['_route' => 'admin_rooms_edit', '_controller' => 'App\\Controller\\admin\\RoomController::edit'], ['accId', 'roomId'], ['POST' => 0], null, false, false, null]],
        307 => [[['_route' => 'admin_rooms_delete', '_controller' => 'App\\Controller\\admin\\RoomController::delete'], ['accId', 'roomId'], ['POST' => 0], null, false, false, null]],
        334 => [[['_route' => 'admin_rooms_images_upload', '_controller' => 'App\\Controller\\admin\\RoomController::uploadImages'], ['accId', 'roomId'], ['POST' => 0], null, false, false, null]],
        368 => [[['_route' => 'admin_rooms_images_primary', '_controller' => 'App\\Controller\\admin\\RoomController::setPrimary'], ['accId', 'roomId', 'imgId'], ['POST' => 0], null, false, false, null]],
        401 => [[['_route' => 'admin_rooms_images_delete', '_controller' => 'App\\Controller\\admin\\RoomController::deleteImage'], ['accId', 'roomId', 'imgId'], ['POST' => 0], null, false, false, null]],
        429 => [[['_route' => 'admin_rooms_images_reorder', '_controller' => 'App\\Controller\\admin\\RoomController::reorderImages'], ['accId', 'roomId'], ['POST' => 0], null, false, false, null]],
        445 => [[['_route' => 'admin_rooms_insights', '_controller' => 'App\\Controller\\admin\\RoomController::insights'], ['accId'], ['GET' => 0], null, false, false, null]],
        481 => [[['_route' => 'admin_activity_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editActivity'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        504 => [[['_route' => 'admin_activity_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteActivity'], ['id'], null, null, false, true, null]],
        536 => [[['_route' => 'admin_user_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editUser'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        556 => [[['_route' => 'admin_user_ban', '_controller' => 'App\\Controller\\admin\\AdminController::banUser'], ['id'], null, null, false, true, null]],
        582 => [[['_route' => 'admin_user_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteUser'], ['id'], null, null, false, true, null]],
        603 => [[['_route' => 'admin_user_detail', '_controller' => 'App\\Controller\\admin\\AdminController::userDetail'], ['id'], null, null, false, true, null]],
        626 => [[['_route' => 'admin_user_unban', '_controller' => 'App\\Controller\\admin\\AdminController::unbanUser'], ['id'], null, null, false, true, null]],
        664 => [[['_route' => 'admin_destination_edit', '_controller' => 'App\\Controller\\admin\\AdminController::editDestination'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        687 => [[['_route' => 'admin_destination_delete', '_controller' => 'App\\Controller\\admin\\AdminController::deleteDestination'], ['id'], null, null, false, true, null]],
        721 => [[['_route' => 'admin_pack_edit', '_controller' => 'App\\Controller\\admin\\AdminPacksController::editPack'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        744 => [[['_route' => 'admin_pack_delete', '_controller' => 'App\\Controller\\admin\\AdminPacksController::deletePack'], ['id'], null, null, false, true, null]],
        767 => [[['_route' => 'admin_pack_toggle', '_controller' => 'App\\Controller\\admin\\AdminPacksController::togglePack'], ['id'], null, null, false, true, null]],
        805 => [[['_route' => 'admin_pack_category_edit', '_controller' => 'App\\Controller\\admin\\AdminPacksController::editCategory'], ['id'], ['POST' => 0], null, false, true, null]],
        828 => [[['_route' => 'admin_pack_category_delete', '_controller' => 'App\\Controller\\admin\\AdminPacksController::deleteCategory'], ['id'], null, null, false, true, null]],
        861 => [[['_route' => 'admin_offer_edit', '_controller' => 'App\\Controller\\admin\\AdminPacksController::editOffer'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        884 => [[['_route' => 'admin_offer_delete', '_controller' => 'App\\Controller\\admin\\AdminPacksController::deleteOffer'], ['id'], null, null, false, true, null]],
        907 => [[['_route' => 'admin_offer_toggle', '_controller' => 'App\\Controller\\admin\\AdminPacksController::toggleOffer'], ['id'], null, null, false, true, null]],
        955 => [[['_route' => 'admin_booking_status', '_controller' => 'App\\Controller\\admin\\AdminPacksController::updateBookingStatus'], ['id', 'status'], null, null, false, true, null]],
        985 => [[['_route' => 'admin_bookings_des_confirm', '_controller' => 'App\\Controller\\admin\\BookingDesController::confirm'], ['id'], null, null, false, false, null]],
        1005 => [[['_route' => 'admin_bookings_des_reject', '_controller' => 'App\\Controller\\admin\\BookingDesController::reject'], ['id'], null, null, false, false, null]],
        1026 => [[['_route' => 'admin_bookings_des_delete', '_controller' => 'App\\Controller\\admin\\BookingDesController::delete'], ['id'], null, null, false, false, null]],
        1060 => [[['_route' => 'admin_blog_approve', '_controller' => 'App\\Controller\\admin\\BlogAdminController::approve'], ['id'], ['POST' => 0], null, false, false, null]],
        1094 => [[['_route' => 'admin_ig_story_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::deleteIgStory'], ['id'], ['POST' => 0], null, false, false, null]],
        1123 => [[['_route' => 'admin_live_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::deleteLiveSession'], ['id'], ['POST' => 0], null, false, false, null]],
        1150 => [[['_route' => 'admin_blog_reject', '_controller' => 'App\\Controller\\admin\\BlogAdminController::reject'], ['id'], ['POST' => 0], null, false, false, null]],
        1165 => [[['_route' => 'admin_blog_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        1196 => [[['_route' => 'admin_story_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::deleteStory'], ['id'], ['POST' => 0], null, false, false, null]],
        1218 => [[['_route' => 'admin_blog_show', '_controller' => 'App\\Controller\\admin\\BlogAdminController::showPost'], ['id'], null, null, false, false, null]],
        1246 => [[['_route' => 'admin_story_show', '_controller' => 'App\\Controller\\admin\\BlogAdminController::showStory'], ['id'], null, null, false, false, null]],
        1278 => [[['_route' => 'admin_comment_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::deleteComment'], ['id'], ['POST' => 0], null, false, false, null]],
        1316 => [[['_route' => 'admin_live_comment_delete', '_controller' => 'App\\Controller\\admin\\BlogAdminController::deleteLiveComment'], ['id'], ['POST' => 0], null, false, false, null]],
        1353 => [[['_route' => 'admin_transport_edit', '_controller' => 'App\\Controller\\admin\\TransportAdminController::editTransport'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        1380 => [[['_route' => 'admin_transport_delete', '_controller' => 'App\\Controller\\admin\\TransportAdminController::deleteTransport'], ['id'], null, null, false, true, null]],
        1416 => [[['_route' => 'admin_trans_destination_edit', '_controller' => 'App\\Controller\\admin\\TransportAdminController::editDestination'], ['id'], null, null, false, true, null]],
        1440 => [[['_route' => 'admin_trans_destination_delete', '_controller' => 'App\\Controller\\admin\\TransportAdminController::deleteDestination'], ['id'], null, null, false, true, null]],
        1466 => [[['_route' => 'admin_transport_toggle', '_controller' => 'App\\Controller\\admin\\TransportAdminController::toggleTransport'], ['id'], null, null, false, true, null]],
        1501 => [[['_route' => 'admin_schedule_edit', '_controller' => 'App\\Controller\\admin\\TransportAdminController::editSchedule'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        1528 => [[['_route' => 'admin_schedule_delete', '_controller' => 'App\\Controller\\admin\\TransportAdminController::deleteSchedule'], ['id'], null, null, false, true, null]],
        1548 => [[['_route' => 'admin_schedule_delay', '_controller' => 'App\\Controller\\admin\\TransportAdminController::delaySchedule'], ['id'], ['POST' => 0], null, false, true, null]],
        1573 => [[['_route' => 'admin_schedule_cancel', '_controller' => 'App\\Controller\\admin\\TransportAdminController::cancelSchedule'], ['id'], null, null, false, true, null]],
        1614 => [[['_route' => 'admin_booking_receipt_pdf', '_controller' => 'App\\Controller\\admin\\TransportAdminController::exportReceiptPdf'], ['id'], null, null, false, true, null]],
        1636 => [[['_route' => 'admin_booking_refund', '_controller' => 'App\\Controller\\admin\\TransportAdminController::refundBooking'], ['id'], null, null, false, true, null]],
        1665 => [[['_route' => 'admin_booking_confirm', '_controller' => 'App\\Controller\\admin\\TransportAdminController::confirmBooking'], ['id'], null, null, false, true, null]],
        1688 => [[['_route' => 'admin_booking_cancel', '_controller' => 'App\\Controller\\admin\\TransportAdminController::cancelBooking'], ['id'], ['POST' => 0], null, false, true, null]],
        1716 => [[['_route' => 'admin_booking_delete', '_controller' => 'App\\Controller\\admin\\TransportAdminController::deleteBooking'], ['id'], null, null, false, true, null]],
        1739 => [[['_route' => 'admin_booking_details', '_controller' => 'App\\Controller\\admin\\TransportAdminController::bookingDetails'], ['id'], null, null, false, true, null]],
        1774 => [[['_route' => 'accommodation_details', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        1797 => [[['_route' => 'activity_detail', '_controller' => 'App\\Controller\\user\\ActivityFrontController::detail'], ['id'], null, null, false, true, null]],
        1829 => [[['_route' => 'api_weather', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getWeather'], ['id'], ['GET' => 0], null, false, true, null]],
        1854 => [[['_route' => 'api_flights', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getFlights'], ['id'], ['GET' => 0], null, false, true, null]],
        1878 => [[['_route' => 'api_nearby', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getNearby'], ['id'], ['GET' => 0], null, false, true, null]],
        1905 => [[['_route' => 'api_images', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getImages'], ['id'], ['GET' => 0], null, false, true, null]],
        1931 => [[['_route' => 'api_itinerary', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::generateItinerary'], ['id'], ['POST' => 0], null, false, true, null]],
        1960 => [[['_route' => 'api_reviews', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getReviews'], ['id'], ['GET' => 0], null, false, true, null]],
        1988 => [[['_route' => 'api_room_images', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getRoomImages'], ['id'], ['GET' => 0], null, false, true, null]],
        2026 => [[['_route' => 'api_accommodation_rooms', '_controller' => 'App\\Controller\\user\\AccommodationDetailsController::getRooms'], ['id'], ['GET' => 0], null, false, true, null]],
        2062 => [[['_route' => 'blog_user_profile', '_controller' => 'App\\Controller\\user\\BlogProfileController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2084 => [[['_route' => 'blog_user_archive', '_controller' => 'App\\Controller\\user\\BlogProfileController::archive'], ['id'], ['GET' => 0], null, false, false, null]],
        2114 => [[['_route' => 'blog_live_end', '_controller' => 'App\\Controller\\user\\LiveController::end'], ['id'], ['POST' => 0], null, false, false, null]],
        2147 => [[['_route' => 'blog_live_saved_to_profile', '_controller' => 'App\\Controller\\user\\LiveController::setSavedToProfile'], ['id'], ['POST' => 0], null, false, false, null]],
        2166 => [[['_route' => 'blog_live_join', '_controller' => 'App\\Controller\\user\\LiveController::join'], ['id'], ['POST' => 0], null, false, false, null]],
        2186 => [[['_route' => 'blog_live_leave', '_controller' => 'App\\Controller\\user\\LiveController::leave'], ['id'], ['POST' => 0], null, false, false, null]],
        2208 => [[['_route' => 'blog_live_comment', '_controller' => 'App\\Controller\\user\\LiveController::comment'], ['id'], ['POST' => 0], null, false, false, null]],
        2237 => [[['_route' => 'blog_live_react', '_controller' => 'App\\Controller\\user\\LiveController::react'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        2257 => [[['_route' => 'blog_live_state', '_controller' => 'App\\Controller\\user\\LiveController::state'], ['id'], ['GET' => 0], null, false, false, null]],
        2277 => [[['_route' => 'blog_live_token', '_controller' => 'App\\Controller\\user\\LiveController::token'], ['id'], ['GET' => 0], null, false, false, null]],
        2301 => [[['_route' => 'blog_live_recording_upload', '_controller' => 'App\\Controller\\user\\LiveController::uploadRecording'], ['id'], ['POST' => 0], null, false, false, null]],
        2322 => [[['_route' => 'blog_live_delete', '_controller' => 'App\\Controller\\user\\LiveController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        2353 => [[['_route' => 'blog_live_dismiss_removed', '_controller' => 'App\\Controller\\user\\LiveController::dismissRemoved'], ['id'], ['POST' => 0], null, false, false, null]],
        2386 => [[['_route' => 'legacy_blog_user_profile', '_controller' => 'App\\Controller\\user\\ProfileController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2408 => [[['_route' => 'legacy_blog_user_archive', '_controller' => 'App\\Controller\\user\\ProfileController::archive'], ['id'], ['GET' => 0], null, false, false, null]],
        2447 => [[['_route' => 'comment_create', '_controller' => 'App\\Controller\\user\\CommentController::create'], ['id'], ['POST' => 0], null, false, true, null]],
        2472 => [[['_route' => 'comment_edit', '_controller' => 'App\\Controller\\user\\CommentController::edit'], ['id'], ['POST' => 0], null, false, false, null]],
        2487 => [[['_route' => 'comment_delete', '_controller' => 'App\\Controller\\user\\CommentController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        2510 => [[['_route' => 'comment_react', '_controller' => 'App\\Controller\\user\\ReactionController::reactToComment'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        2565 => [[['_route' => 'travel_story_comment_create', '_controller' => 'App\\Controller\\user\\CommentController::createForTravelStory'], ['id'], ['POST' => 0], null, false, true, null]],
        2597 => [[['_route' => 'travel_story_react', '_controller' => 'App\\Controller\\user\\ReactionController::reactToTravelStory'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        2625 => [[['_route' => 'travel_story_show', '_controller' => 'App\\Controller\\user\\TravelStoryController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        2642 => [[['_route' => 'travel_story_edit', '_controller' => 'App\\Controller\\user\\TravelStoryController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2660 => [[['_route' => 'travel_story_delete', '_controller' => 'App\\Controller\\user\\TravelStoryController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        2684 => [[['_route' => 'travel_story_dismiss_removed', '_controller' => 'App\\Controller\\user\\TravelStoryController::dismissRemoved'], ['id'], ['POST' => 0], null, false, false, null]],
        2706 => [[['_route' => 'travel_story_ai_assist', '_controller' => 'App\\Controller\\user\\TravelStoryController::aiAssist'], [], ['POST' => 0], null, false, false, null]],
        2739 => [[['_route' => 'destination_detail', '_controller' => 'App\\Controller\\user\\DestinationsController::detail'], ['id'], null, null, false, true, null]],
        2758 => [[['_route' => 'booking_form', '_controller' => 'App\\Controller\\user\\DestinationsController::bookingForm'], ['destinationId'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        2787 => [[['_route' => 'follow_toggle', '_controller' => 'App\\Controller\\user\\FollowController::toggle'], ['id'], ['POST' => 0], null, false, true, null]],
        2811 => [[['_route' => 'follow_accept', '_controller' => 'App\\Controller\\user\\FollowController::acceptRequest'], ['id'], ['POST' => 0], null, false, true, null]],
        2835 => [[['_route' => 'follow_reject', '_controller' => 'App\\Controller\\user\\FollowController::rejectRequest'], ['id'], ['POST' => 0], null, false, true, null]],
        2859 => [[['_route' => 'follow_status', '_controller' => 'App\\Controller\\user\\FollowController::status'], ['id'], ['GET' => 0], null, false, false, null]],
        2890 => [[['_route' => 'user_pack_details', '_controller' => 'App\\Controller\\user\\FrontPacksController::packDetails'], ['id'], null, null, false, true, null]],
        2925 => [[['_route' => 'user_pack_booking_cancel', '_controller' => 'App\\Controller\\user\\FrontPacksController::cancelBooking'], ['id'], null, null, false, true, null]],
        2947 => [[['_route' => 'post_show', '_controller' => 'App\\Controller\\user\\PostController::show'], ['id'], null, null, false, true, null]],
        2966 => [[['_route' => 'post_edit', '_controller' => 'App\\Controller\\user\\PostController::edit'], ['id'], null, null, false, false, null]],
        2987 => [[['_route' => 'post_delete', '_controller' => 'App\\Controller\\user\\PostController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        3018 => [[['_route' => 'post_dismiss_removed', '_controller' => 'App\\Controller\\user\\PostController::dismissRemoved'], ['id'], ['POST' => 0], null, false, false, null]],
        3053 => [[['_route' => 'post_react', '_controller' => 'App\\Controller\\user\\ReactionController::reactToPost'], ['id', 'type'], ['POST' => 0], null, false, true, null]],
        3066 => [[['_route' => 'post_save_toggle', '_controller' => 'App\\Controller\\user\\SavedPostController::toggle'], ['id'], ['POST' => 0], null, false, false, null]],
        3100 => [[['_route' => 'story_user_list', '_controller' => 'App\\Controller\\user\\StoryController::listByUser'], ['id'], ['GET' => 0], null, false, true, null]],
        3121 => [[['_route' => 'story_delete', '_controller' => 'App\\Controller\\user\\StoryController::delete'], ['id'], ['POST' => 0], null, false, false, null]],
        3140 => [[['_route' => 'story_seen_mark', '_controller' => 'App\\Controller\\user\\StoryController::markSeen'], ['id'], ['POST' => 0], null, false, false, null]],
        3162 => [[['_route' => 'story_viewers_list', '_controller' => 'App\\Controller\\user\\StoryController::viewers'], ['id'], ['GET' => 0], null, false, false, null]],
        3193 => [[['_route' => 'story_dismiss_removed', '_controller' => 'App\\Controller\\user\\StoryController::dismissRemoved'], ['id'], ['POST' => 0], null, false, false, null]],
        3244 => [[['_route' => 'user_transport_detail', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::transportDetail'], ['id'], null, null, false, true, null]],
        3284 => [[['_route' => 'user_booking_cancel', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::cancelBooking'], ['id'], ['POST' => 0], null, false, true, null]],
        3315 => [[['_route' => 'user_booking_add_schedule', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::addScheduleToBooking'], ['bookingId'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        3340 => [
            [['_route' => 'user_booking_receipt_pdf', '_controller' => 'App\\Controller\\user\\TransportUserInterfaceController::exportReceiptPdf'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
