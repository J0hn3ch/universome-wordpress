<?php
/*
Plugin Name: Spreaker Shortcode
Plugin URI: https://wordpress.org/plugins/spreaker-shortcode/
Description: A simple and easy way to embed Spreaker widgets into your WordPress blog. A simple example: "[spreaker type=player resource="episode_id=3331356"]". More options in the plugin page. If you need further help, please contact us at <a href="http://help.spreaker.com">help.spreaker.com</a>.
Author: Spreaker
Version: 1.8.0
Author URI: https://www.spreaker.com
*/
load_plugin_textdomain('spreaker_shortcode', false, basename( dirname( __FILE__ ) ) . '/languages' );


function spreaker_get_error($message) {
    return '<p>' . __('Error', 'spreaker_shortcode') . ': ' . $message . '</p>';
}

function spreaker_get_dimension($input, $default = '100%') {
    if (empty($input)) {
        return $default;
    }

    // Cleanup
    $input = strtolower(trim($input));

    // Accept a value without unit (px by default)
    if (preg_match('/^\d+$/', $input)) {
        return $input . 'px';
    } elseif (!preg_match('/^\d+(%|px)$/', $input)) {
        return $default;
    } else {
        return $input;
    }
}

function spreaker_get_url($base_url, $params = array()) {
    // Filter out empty params
    foreach ($params as $key => $value) {
        if ($value === null || $value === '') {
            unset($params[$key]);
        }
    }

    // Covert boolean to strings
    foreach ($params as $key => $value) {
        if (is_bool($value)) {
            $params[$key] = $value ? 'true' : 'false';
        }
    }

    return $base_url . '?' . http_build_query($params);
}

function spreaker_get_player($attributes) {
    // Get shortcode params
    $params = shortcode_atts(array(
        'resource'                   => null,
        'width'                      => '100%',
        'height'                     => '200px',
        'theme'                      => null,
        'color'                      => null,
        'cover'                      => null,
        'playlist'                   => null,
        'playlist-continuous'        => null,
        'playlist-loop'              => null,
        'playlist-autoupdate'        => null,
        'chapters-image'             => null,
        'episode-image-position'     => null,
        'hide-likes'                 => null,
        'hide-comments'              => null,
        'hide-sharing'               => null,
        'hide-logo'                  => null,
        'hide-episode-description'   => null,
        'hide-playlist-descriptions' => null,
        'hide-playlist-images'       => null,
        'hide-download'              => null,
    ), $attributes);

    // Ensure the resource has been provided
    if (empty($params['resource'])) {
        return spreaker_get_error(__('The resource attribute is missing from the embed code.', 'spreaker_shortcode'));
    }

    // Validate the resource
    $valid = preg_match('/^(user_id|show_id|episode_id|episode_key|show_key)=([a-zA-Z0-9\-]+)$/i', trim($params['resource']), $matches);
    if (!$matches) {
        return spreaker_get_error(__('The resource attribute is invalid.', 'spreaker_shortcode'));
    }

    $resource_type = strtolower($matches[1]);
    $resource_id   = $matches[2];

    if (
        $resource_type !== 'episode_key' &&
        $resource_type !== 'show_key' &&
        !is_numeric($resource_id)
    ) {
        return spreaker_get_error(__('The resource attribute is invalid.', 'spreaker_shortcode'));
    }

    // Get player size
    $width  = spreaker_get_dimension($params['width'], '100%');
    $height = spreaker_get_dimension($params['height'], '200px');

    // Build the url
    $player_url = spreaker_get_url('https://widget.spreaker.com/player', array(
        "$resource_type"             => $resource_id,
        'theme'                      => $params['theme'],
        'color'                      => $params['color'],
        'cover_image_url'            => $params['cover'],
        'playlist'                   => $params['playlist'],
        'playlist-continuous'        => $params['playlist-continuous'],
        'playlist-loop'              => $params['playlist-loop'],
        'playlist-autoupdate'        => $params['playlist-autoupdate'],
        'chapters-image'             => $params['chapters-image'],
        'episode_image_position'     => $params['episode-image-position'],
        'hide-likes'                 => $params['hide-likes'],
        'hide-comments'              => $params['hide-comments'],
        'hide-sharing'               => $params['hide-sharing'],
        'hide-logo'                  => $params['hide-logo'],
        'hide-episode-description'   => $params['hide-episode-description'],
        'hide-playlist-descriptions' => $params['hide-playlist-descriptions'],
        'hide-playlist-images'       => $params['hide-playlist-images'],
        'hide-download'              => $params['hide-download'],
    ));

    return '<iframe src="' . esc_attr($player_url) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" frameborder="0"></iframe>';
}

function spreaker_get_player_by_legacy_config($attributes) {
    // Get shortcode params
    $params = shortcode_atts(array(
        'type'        => 'mini',
        'width'       => '100%',
        'episode_key' => null,
        'episode_id'  => null,
        'show_id'     => null,
        'user_id'     => null
    ), $attributes);

    // Ensure the resource id has been provided
    if (empty($params['user_id']) && empty($params['episode_id']) && empty($params['episode_key']) && empty($params['show_id'])) {
        return spreaker_get_error(__('The resource attribute (user_id, show_id, episode_key or episode_id) is missing from the embed code.', 'spreaker_shortcode'));
    }

    // Generate the resource value
    $resource = '';

    if (!empty($params['user_id'])) {
        $resource = 'user_id=' . $params['user_id'];
    } else if (!empty($params['show_id'])) {
        $resource = 'show_id=' . $params['show_id'];
    } else if (!empty($params['episode_id'])) {
        $resource = 'episode_id=' . $params['episode_id'];
    } else if (!empty($params['episode_key'])) {
        $resource = 'episode_key=' . $params['episode_key'];
    }

    // Convert attributes to new ones
    $config = array(
        'resource' => $resource,
        'width'    => $params['width'],
        'height'   => $params['type'] === 'mini' ? '140px' : '200px',
        'theme'    => 'dark'
    );

    return spreaker_get_player($config);
}

function spreaker_shortcode( $attributes ) {
    // Get the shortcode type
    $type = !empty($attributes['type']) ? $attributes['type'] : null;
    if (!$type) {
        // Backward compatibility (previous versions of the plugin didn't require the type attribute)
        return spreaker_get_player_by_legacy_config($attributes);
    }

    switch($type) {
        case 'mini':
        case 'standard':
            return spreaker_get_player_by_legacy_config($attributes);

        case 'player':
            return spreaker_get_player($attributes);

        default:
            return spreaker_get_error(__('The widget type is unsupported.', 'spreaker_shortcode'));
    }
}

add_shortcode('spreaker', 'spreaker_shortcode');

?>
