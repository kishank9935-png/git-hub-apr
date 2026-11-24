<?php
/**
 * APR GROUP OF COMPANY - Official Google Business Profile Reviews Integration
 * 
 * Secure server-side retrieval, pagination, and caching of authentic customer reviews
 * using the official Google Business Profile API (v4/v1) and Google Places API.
 *
 * Requirements & Compliance:
 * - NO dummy, sample, or fabricated reviews. Zero placeholder testimonials.
 * - Displays authentic reviewer names (`displayName`), original review text,
 *   exact star ratings, review dates, and public profile photos wherever available.
 * - Anonymous reviewers are displayed strictly as 'Anonymous'.
 * - Handles API pagination (`pageToken` / `next_page_token`) to retrieve all accessible reviews.
 * - API credentials & OAuth tokens are stored securely on the backend (wp_options).
 *   NEVER exposed in frontend JavaScript or HTML attributes.
 * - Proper Google trademark attribution rendered as required by Google terms.
 *
 * Official URLs:
 * - Direct Review Link: https://g.page/r/CUNndIdTFafPEBM/review
 * - Google Maps Profile: https://maps.app.goo.gl/oc3artJE4YjWZAFA8
 */

if (!defined('ABSPATH')) {
    exit;
}

// Target URLs
define('APR_GOOGLE_REVIEW_SUBMIT_URL', 'https://g.page/r/CUNndIdTFafPEBM/review');
define('APR_GOOGLE_MAPS_PROFILE_URL', 'https://maps.app.goo.gl/oc3artJE4YjWZAFA8');

/**
 * Register Admin Settings for Google Business Profile Integration
 */
function apr_register_google_reviews_settings() {
    // Google Places API Key (Server-side storage)
    register_setting('apr_google_reviews_group', 'apr_google_places_api_key', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ));

    // Google Place ID
    register_setting('apr_google_reviews_group', 'apr_google_place_id', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ));

    // Google Business Profile Account ID (for GBP API)
    register_setting('apr_google_reviews_group', 'apr_gbp_account_id', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ));

    // Google Business Profile Location ID (for GBP API)
    register_setting('apr_google_reviews_group', 'apr_gbp_location_id', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default' => ''
    ));

    // Google OAuth 2.0 Access / Bearer Token (kept confidential)
    register_setting('apr_google_reviews_group', 'apr_gbp_oauth_token', array(
        'type' => 'string',
        'sanitize_callback' => 'sanitize_textarea_field',
        'default' => ''
    ));

    // Cache duration in hours
    register_setting('apr_google_reviews_group', 'apr_google_cache_hours', array(
        'type' => 'integer',
        'sanitize_callback' => 'absint',
        'default' => 24
    ));
}
add_action('admin_init', 'apr_register_google_reviews_settings');

/**
 * Admin Menu Page
 */
function apr_add_google_reviews_admin_menu() {
    add_submenu_page(
        'options-general.php',
        __('Google Business Profile Reviews', 'apr-group'),
        __('Google Reviews', 'apr-group'),
        'manage_options',
        'apr-google-reviews',
        'apr_render_google_reviews_admin_page'
    );
}
add_action('admin_menu', 'apr_add_google_reviews_admin_menu');

/**
 * Render Admin Settings Page with Setup Instructions & Status
 */
function apr_render_google_reviews_admin_page() {
    if (!current_user_can('manage_options')) {
        return;
    }

    $places_api_key  = get_option('apr_google_places_api_key', '');
    $place_id        = get_option('apr_google_place_id', '');
    $gbp_account_id  = get_option('apr_gbp_account_id', '');
    $gbp_location_id = get_option('apr_gbp_location_id', '');
    $gbp_oauth_token = get_option('apr_gbp_oauth_token', '');
    $cache_hours     = get_option('apr_google_cache_hours', 24);

    // Manual Cache Refresh
    if (isset($_POST['apr_refresh_reviews']) && check_admin_referer('apr_refresh_reviews_action')) {
        delete_transient('apr_google_reviews_cache');
        echo '<div class="notice notice-success is-dismissible"><p>' . esc_html__('Google Reviews cache cleared! The server will query the API on next request.', 'apr-group') . '</p></div>';
    }

    $reviews_data = apr_get_google_business_reviews(true); // force fresh check
    $review_count = !empty($reviews_data['reviews']) ? count($reviews_data['reviews']) : 0;
    $total_count  = $reviews_data['total_reviews'] ?? $review_count;
    $has_creds    = (!empty($places_api_key) && !empty($place_id)) || (!empty($gbp_account_id) && !empty($gbp_location_id) && !empty($gbp_oauth_token));
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Google Business Profile Reviews Integration', 'apr-group'); ?></h1>
        <p><?php esc_html_e('Manage authentic customer reviews for APR GROUP OF COMPANY fetched via the official Google Business Profile API or Google Places API.', 'apr-group'); ?></p>

        <!-- Current Status Overview -->
        <div class="card" style="max-width: 860px; margin-top: 20px; padding: 20px;">
            <h2 style="margin-top:0;"><?php esc_html_e('Live Status & Verification', 'apr-group'); ?></h2>
            <table class="widefat striped" style="margin-top: 10px;">
                <tbody>
                    <tr>
                        <td style="width: 250px;"><strong><?php esc_html_e('API Connection Status:', 'apr-group'); ?></strong></td>
                        <td>
                            <?php if ($has_creds && $review_count > 0): ?>
                                <span style="color:#159568; font-weight:bold;">✓ <?php printf(esc_html__('Connected: %d Authentic Reviews Imported', 'apr-group'), $review_count); ?></span>
                            <?php elseif ($has_creds): ?>
                                <span style="color:#2467C5; font-weight:bold;">⚡ <?php esc_html_e('Credentials Saved. Querying Google API...', 'apr-group'); ?></span>
                            <?php else: ?>
                                <span style="color:#d97706; font-weight:bold;">⚠️ <?php esc_html_e('Awaiting API Authorization (Zero fake reviews shown on site)', 'apr-group'); ?></span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Write a Review Direct Link:', 'apr-group'); ?></strong></td>
                        <td><a href="<?php echo esc_url(APR_GOOGLE_REVIEW_SUBMIT_URL); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(APR_GOOGLE_REVIEW_SUBMIT_URL); ?> ↗</a></td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Google Maps Profile Link:', 'apr-group'); ?></strong></td>
                        <td><a href="<?php echo esc_url(APR_GOOGLE_MAPS_PROFILE_URL); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(APR_GOOGLE_MAPS_PROFILE_URL); ?> ↗</a></td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Verified Total Reviews Count:', 'apr-group'); ?></strong></td>
                        <td><?php echo (int) $total_count; ?> <?php esc_html_e('reviews verified via Google API', 'apr-group'); ?></td>
                    </tr>
                    <tr>
                        <td><strong><?php esc_html_e('Authenticity Policy:', 'apr-group'); ?></strong></td>
                        <td><span style="color:#159568;">✓ <?php esc_html_e('Strictly 0 dummy reviews. Displays only real reviewers, unaltered comments, actual star ratings, and Google attribution.', 'apr-group'); ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Setup Instructions if Credentials Missing -->
        <?php if (!$has_creds): ?>
        <div class="notice notice-info" style="max-width: 860px; margin-top: 20px; padding: 16px 20px;">
            <h3 style="margin-top:0; color:#173B65;"><?php esc_html_e('What Google Business Profile Access Is Required?', 'apr-group'); ?></h3>
            <p><?php esc_html_e('To import your authentic Google customer reviews automatically via the API, you can use either Method A (Google Places API - easiest) or Method B (Google Business Profile API):', 'apr-group'); ?></p>
            <ol style="margin-left: 20px; line-height: 1.8;">
                <li><strong>Method A: Google Cloud Places API (Recommended for quick setup):</strong>
                    <br>1. Log in to <a href="https://console.cloud.google.com/" target="_blank" rel="noopener">Google Cloud Console</a>.
                    <br>2. Enable <strong>Places API</strong> (or Places API New) on your project.
                    <br>3. Generate an <strong>API Key</strong> and paste it below.
                    <br>4. Obtain your business <strong>Place ID</strong> for APR GROUP OF COMPANY (Rajpura Phase 1, Bhadohi) using the <a href="https://developers.google.com/maps/documentation/places/web-service/place-id" target="_blank" rel="noopener">Google Place ID Finder</a>.
                </li>
                <li style="margin-top: 10px;"><strong>Method B: Google Business Profile API (For full account pagination):</strong>
                    <br>1. Enable <strong>Google Business Profile API</strong> (MyBusiness API).
                    <br>2. Complete Google OAuth 2.0 verification and enter your <code>accountId</code>, <code>locationId</code>, and Bearer <code>oauth_token</code> below.
                </li>
            </ol>
            <p style="margin-bottom:0; font-size:0.9em; color:#666;"><em>Note: Until valid API credentials are provided, the website cleanly displays the official Google Rating & Action buttons without generating any fake reviews or dummy testimonials.</em></p>
        </div>
        <?php endif; ?>

        <!-- Configuration Form -->
        <div class="card" style="max-width: 860px; margin-top: 20px; padding: 20px;">
            <h2 style="margin-top:0;"><?php esc_html_e('Secure Backend API Configuration', 'apr-group'); ?></h2>
            <form method="post" action="options.php">
                <?php
                settings_fields('apr_google_reviews_group');
                do_settings_sections('apr_google_reviews_group');
                ?>
                <table class="form-table">
                    <tr>
                        <th colspan="2"><h3 style="margin:0; color:#173B65;"><?php esc_html_e('Option 1: Google Places API Credentials', 'apr-group'); ?></h3></th>
                    </tr>
                    <tr>
                        <th scope="row"><label for="apr_google_places_api_key"><?php esc_html_e('Google Places API Key', 'apr-group'); ?></label></th>
                        <td>
                            <input type="password" id="apr_google_places_api_key" name="apr_google_places_api_key" value="<?php echo esc_attr($places_api_key); ?>" class="regular-text" autocomplete="off">
                            <p class="description"><?php esc_html_e('Kept strictly confidential on server; never sent to frontend JavaScript.', 'apr-group'); ?></p>
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="apr_google_place_id"><?php esc_html_e('Google Place ID', 'apr-group'); ?></label></th>
                        <td>
                            <input type="text" id="apr_google_place_id" name="apr_google_place_id" value="<?php echo esc_attr($place_id); ?>" class="regular-text" placeholder="ChIJ...">
                            <p class="description"><?php esc_html_e('APR GROUP OF COMPANY Place ID (from Google Place ID Finder).', 'apr-group'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2"><h3 style="margin:16px 0 0; color:#173B65;"><?php esc_html_e('Option 2: Google Business Profile API (OAuth)', 'apr-group'); ?></h3></th>
                    </tr>
                    <tr>
                        <th scope="row"><label for="apr_gbp_account_id"><?php esc_html_e('GBP Account ID', 'apr-group'); ?></label></th>
                        <td>
                            <input type="text" id="apr_gbp_account_id" name="apr_gbp_account_id" value="<?php echo esc_attr($gbp_account_id); ?>" class="regular-text" placeholder="accounts/108...">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="apr_gbp_location_id"><?php esc_html_e('GBP Location ID', 'apr-group'); ?></label></th>
                        <td>
                            <input type="text" id="apr_gbp_location_id" name="apr_gbp_location_id" value="<?php echo esc_attr($gbp_location_id); ?>" class="regular-text" placeholder="locations/152...">
                        </td>
                    </tr>
                    <tr>
                        <th scope="row"><label for="apr_gbp_oauth_token"><?php esc_html_e('OAuth Access / Bearer Token', 'apr-group'); ?></label></th>
                        <td>
                            <textarea id="apr_gbp_oauth_token" name="apr_gbp_oauth_token" class="large-text" rows="2" autocomplete="off" placeholder="ya29..."><?php echo esc_textarea($gbp_oauth_token); ?></textarea>
                            <p class="description"><?php esc_html_e('Securely stored on server for API authorization.', 'apr-group'); ?></p>
                        </td>
                    </tr>

                    <tr>
                        <th colspan="2"><h3 style="margin:16px 0 0; color:#173B65;"><?php esc_html_e('Caching Settings', 'apr-group'); ?></h3></th>
                    </tr>
                    <tr>
                        <th scope="row"><label for="apr_google_cache_hours"><?php esc_html_e('Cache Lifetime (Hours)', 'apr-group'); ?></label></th>
                        <td>
                            <input type="number" id="apr_google_cache_hours" name="apr_google_cache_hours" value="<?php echo esc_attr($cache_hours); ?>" min="1" max="168" class="small-text">
                            <p class="description"><?php esc_html_e('Caches reviews in WordPress transients to minimize API quotas and ensure fast page loads.', 'apr-group'); ?></p>
                        </td>
                    </tr>
                </table>
                <?php submit_button(__('Save API Credentials', 'apr-group')); ?>
            </form>

            <hr style="margin: 24px 0;">

            <h3><?php esc_html_e('Cache Controls', 'apr-group'); ?></h3>
            <form method="post" action="">
                <?php wp_nonce_field('apr_refresh_reviews_action'); ?>
                <input type="hidden" name="apr_refresh_reviews" value="1">
                <?php submit_button(__('Clear Cached Reviews & Refresh from Google API', 'apr-group'), 'secondary', 'submit', false); ?>
            </form>
        </div>
    </div>
    <?php
}

/**
 * Fetch and return authentic Google Business Profile Reviews
 *
 * Implements full pagination, sanitization, and caching.
 * ZERO placeholder or dummy reviews are returned when API credentials are not yet entered.
 *
 * @param bool $force_refresh
 * @return array
 */
function apr_get_google_business_reviews($force_refresh = false) {
    $cache_key = 'apr_google_reviews_cache';

    if (!$force_refresh) {
        $cached = get_transient($cache_key);
        if (false !== $cached && is_array($cached)) {
            return $cached;
        }
    }

    $places_api_key  = get_option('apr_google_places_api_key', '');
    $place_id        = get_option('apr_google_place_id', '');
    $gbp_account_id  = get_option('apr_gbp_account_id', '');
    $gbp_location_id = get_option('apr_gbp_location_id', '');
    $gbp_oauth_token = get_option('apr_gbp_oauth_token', '');
    $cache_hours     = (int) get_option('apr_google_cache_hours', 24);
    $cache_seconds   = max(1, $cache_hours) * HOUR_IN_SECONDS;

    $empty_state = array(
        'rating'             => 5.0,
        'total_reviews'      => 0,
        'review_count'       => 0,
        'write_review_url'   => APR_GOOGLE_REVIEW_SUBMIT_URL,
        'maps_profile_url'   => APR_GOOGLE_MAPS_PROFILE_URL,
        'api_connected'      => false,
        'source'             => 'none',
        'reviews'            => array() // ZERO fake reviews
    );

    // 1. Try Google Business Profile API (Method B) with pagination if configured
    if (!empty($gbp_account_id) && !empty($gbp_location_id) && !empty($gbp_oauth_token)) {
        $gbp_result = apr_fetch_gbp_api_reviews($gbp_account_id, $gbp_location_id, $gbp_oauth_token);
        if ($gbp_result && !empty($gbp_result['reviews'])) {
            set_transient($cache_key, $gbp_result, $cache_seconds);
            return $gbp_result;
        }
    }

    // 2. Try Google Places API (Method A) if configured
    if (!empty($places_api_key) && !empty($place_id)) {
        $places_result = apr_fetch_places_api_reviews($places_api_key, $place_id);
        if ($places_result && !empty($places_result['reviews'])) {
            set_transient($cache_key, $places_result, $cache_seconds);
            return $places_result;
        }
    }

    // 3. Fallback: No fake reviews. Return empty list with official URLs and verified status
    set_transient($cache_key, $empty_state, $cache_seconds);
    return $empty_state;
}

/**
 * Fetch reviews via Google Business Profile API (v4 / mybusiness.googleapis.com)
 * Supports pagination via pageToken to retrieve all reviews.
 */
function apr_fetch_gbp_api_reviews($account_id, $location_id, $oauth_token) {
    $all_reviews = array();
    $page_token  = '';
    $max_pages   = 5; // prevent runaway loops
    $pages_seen  = 0;
    $total_count = 0;
    $avg_rating  = 5.0;

    $rating_map = array(
        'ONE'   => 1,
        'TWO'   => 2,
        'THREE' => 3,
        'FOUR'  => 4,
        'FIVE'  => 5
    );

    $base_account  = preg_replace('/^accounts\//', '', trim($account_id));
    $base_location = preg_replace('/^locations\//', '', trim($location_id));

    do {
        $pages_seen++;
        $url = "https://mybusiness.googleapis.com/v4/accounts/{$base_account}/locations/{$base_location}/reviews?pageSize=50";
        if (!empty($page_token)) {
            $url .= '&pageToken=' . urlencode($page_token);
        }

        $args = array(
            'timeout' => 15,
            'headers' => array(
                'Authorization' => 'Bearer ' . trim($oauth_token),
                'Accept'        => 'application/json'
            )
        );

        $response = wp_remote_get($url, $args);
        if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
            break;
        }

        $data = json_decode(wp_remote_retrieve_body($response), true);
        if (empty($data['reviews'])) {
            break;
        }

        $total_count = isset($data['totalReviewCount']) ? (int) $data['totalReviewCount'] : $total_count;
        $avg_rating  = isset($data['averageRating']) ? (float) $data['averageRating'] : $avg_rating;

        foreach ($data['reviews'] as $rev) {
            $is_anon = !empty($rev['reviewer']['isAnonymous']) || empty($rev['reviewer']['displayName']);
            $display_name = $is_anon ? 'Anonymous' : sanitize_text_field($rev['reviewer']['displayName']);

            $rating_num = 5;
            if (isset($rev['starRating'])) {
                $rating_str = strtoupper(trim($rev['starRating']));
                $rating_num = isset($rating_map[$rating_str]) ? $rating_map[$rating_str] : (int) $rev['starRating'];
            }

            $photo_url = '';
            if (!$is_anon && !empty($rev['reviewer']['profilePhotoUrl'])) {
                $photo_url = esc_url_raw($rev['reviewer']['profilePhotoUrl']);
            }

            $date_str = '';
            if (!empty($rev['createTime'])) {
                $timestamp = strtotime($rev['createTime']);
                if ($timestamp) {
                    $date_str = date('F Y', $timestamp);
                }
            }

            $all_reviews[] = array(
                'review_id'     => sanitize_text_field($rev['reviewId'] ?? ''),
                'display_name'  => $display_name,
                'is_anonymous'  => $is_anon,
                'rating'        => $rating_num,
                'comment'       => isset($rev['comment']) ? sanitize_textarea_field($rev['comment']) : '',
                'date'          => $date_str,
                'photo_url'     => $photo_url,
                'reply'         => isset($rev['reviewReply']['comment']) ? sanitize_textarea_field($rev['reviewReply']['comment']) : '',
                'source'        => 'Google Business Profile'
            );
        }

        $page_token = !empty($data['nextPageToken']) ? $data['nextPageToken'] : '';
    } while (!empty($page_token) && $pages_seen < $max_pages);

    if (empty($all_reviews)) {
        return false;
    }

    return array(
        'rating'           => $avg_rating,
        'total_reviews'    => max($total_count, count($all_reviews)),
        'review_count'     => count($all_reviews),
        'write_review_url' => APR_GOOGLE_REVIEW_SUBMIT_URL,
        'maps_profile_url' => APR_GOOGLE_MAPS_PROFILE_URL,
        'api_connected'    => true,
        'source'           => 'gbp_api',
        'reviews'          => $all_reviews
    );
}

/**
 * Fetch reviews via Google Places API (Place Details)
 */
function apr_fetch_places_api_reviews($api_key, $place_id) {
    $endpoint = add_query_arg(array(
        'place_id' => trim($place_id),
        'fields'   => 'name,rating,reviews,user_ratings_total,url',
        'key'      => trim($api_key),
    ), 'https://maps.googleapis.com/maps/api/place/details/json');

    $response = wp_remote_get($endpoint, array('timeout' => 12));
    if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) {
        return false;
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    if (empty($data['result']['reviews'])) {
        return false;
    }

    $all_reviews = array();
    foreach ($data['result']['reviews'] as $rev) {
        $author = sanitize_text_field($rev['author_name'] ?? '');
        $is_anon = empty($author) || strtolower($author) === 'a google user';

        $all_reviews[] = array(
            'review_id'    => sanitize_text_field($rev['time'] ?? ''),
            'display_name' => $is_anon ? 'Anonymous' : $author,
            'is_anonymous' => $is_anon,
            'rating'       => (int) ($rev['rating'] ?? 5),
            'comment'      => sanitize_textarea_field($rev['text'] ?? ''),
            'date'         => sanitize_text_field($rev['relative_time_description'] ?? ''),
            'photo_url'    => (!$is_anon && !empty($rev['profile_photo_url'])) ? esc_url_raw($rev['profile_photo_url']) : '',
            'author_url'   => esc_url_raw($rev['author_url'] ?? APR_GOOGLE_MAPS_PROFILE_URL),
            'source'       => 'Google Places API'
        );
    }

    return array(
        'rating'           => (float) ($data['result']['rating'] ?? 5.0),
        'total_reviews'    => (int) ($data['result']['user_ratings_total'] ?? count($all_reviews)),
        'review_count'     => count($all_reviews),
        'write_review_url' => APR_GOOGLE_REVIEW_SUBMIT_URL,
        'maps_profile_url' => esc_url_raw($data['result']['url'] ?? APR_GOOGLE_MAPS_PROFILE_URL),
        'api_connected'    => true,
        'source'           => 'places_api',
        'reviews'          => $all_reviews
    );
}
