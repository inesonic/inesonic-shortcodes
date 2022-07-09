<?php
/**
 * Plugin Name: Inesonic ShortCodes
 * Plugin URI: http://www.inesonic.com
 * Description: A small proprietary plug-in that provides a number of useful WordPress shortcodes.
 * Version: 1.0.0
 * Author: Inesonic, LLC
 * Author URI: http://www.inesonic.com
 */

/***********************************************************************************************************************
 * Copyright 2022, Inesonic, LLC.
 * All Rights Reserved
 ***********************************************************************************************************************
 */

/**
 * Inesonic WordPress plug-in that provides a number of useful shortcodes.
 */
class InesonicShortcodes {
    const VERSION = '1.0.0';
    const SLUG    = 'inesonic-shortcodes';
    const NAME    = 'Inesonic Shortcodes';
    const AUTHOR  = 'Inesonic, LLC';
    const PREFIX  = 'InesonicShortcodes';

    /**
     * The singleton class instance.
     */
    private static $instance;  /* Plug-in instance */

    /**
     * Method that is called to initialize a single instance of the plug-in
     */
    public static function instance() {
        if (!isset(self::$instance)                          &&
            !(self::$instance instanceof InesonicShortcodes)    ) {
            self::$instance = new InesonicShortcodes();
        }
    }

    /**
     * Constructor
     */
    public function __construct() {
        add_action('init', array($this, 'customize_on_initialization'));
        add_action('user_register', array($this, 'user_registered'), 10, 2);
    }

    /**
     * Method that performs additional initialization on WordPress initialization.
     */
    function customize_on_initialization() {
        add_shortcode('inesonic_first_name', array($this, 'inesonic_first_name'));
        add_shortcode('inesonic_last_name', array($this, 'inesonic_last_name'));
        add_shortcode('inesonic_full_name', array($this, 'inesonic_full_name'));
        add_shortcode('inesonic_username', array($this, 'inesonic_username'));
        add_shortcode('inesonic_email_address', array($this, 'inesonic_email_address'));
        add_shortcode('inesonic_registered_datetime', array($this, 'inesonic_registered_datetime'));
    }

    /**
     * Method that is triggered when a new user is registered.
     *
     * \param[in] $user_id The ID of the newly registered data.
     *
     * \param[in] $user_data Data passed to the WordPress wp_insert_user function.
     */
    public function user_registered($user_id, $user_data) {
        add_user_meta($user_id, 'inesonic_user_registered', time());
    }
        
    /**
     * Method you can use to obtain the date/time that the user joined.
     *
     * \param[in] $user_id The ID of teh user to get the sequence number for.
     *
     * \return Returns a timestamp indicating when the user joined.  A value of 0 is returned if the value could
     *         not be determined.
     */
    public function get_user_registered($user_id) {
        $result = get_user_meta($user_id, 'inesonic_user_registered', true);
        return ($result !== false && is_numeric($result) && $result > 0) ? $result : 0;
    }

    /**
     * Function that provides a shortcode for the current user's first name.
     *
     * \param[in] $attributes The shortcode attributes.
     *
     * \return Returns the user's first name.
     */
    public function inesonic_first_name($attributes) {
        $current_user = wp_get_current_user();        
        if ($current_user !== null && $current_user !== false && $current_user->ID != 0) {
            $result = esc_html($current_user->user_firstname);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * Function that provides a shortcode for the current user's last name name.
     *
     * \param[in] $attributes The shortcode attributes.
     *
     * \return Returns the user's first name.
     */
    public function inesonic_last_name($attributes) {
        $current_user = wp_get_current_user();        
        if ($current_user !== null && $current_user !== false && $current_user->ID != 0) {
            $result = esc_html($current_user->user_lastname);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * Function that provides a shortcode for the current user's full name.
     *
     * \param[in] $attributes The shortcode attributes.
     *
     * \return Returns the user's first name.
     */
    public function inesonic_full_name($attributes) {
        $current_user = wp_get_current_user();        
        if ($current_user !== null && $current_user !== false && $current_user->ID != 0) {
            $result = esc_html($current_user->user_firstname . ' ' . $current_user->user_lastname);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * Function that provides a shortcode for the current user's login username.
     *
     * \param[in] $attributes The shortcode attributes.
     *
     * \return Returns the user's first name.
     */
    public function inesonic_username($attributes) {
        $current_user = wp_get_current_user();        
        if ($current_user !== null && $current_user !== false && $current_user->ID != 0) {
            $result = esc_html($current_user->user_login);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * Function that provides a shortcode for the current user's email address.
     *
     * \param[in] $attributes The shortcode attributes.
     *
     * \return Returns the user's first name.
     */
    public function inesonic_email_address($attributes) {
        $current_user = wp_get_current_user();        
        if ($current_user !== null && $current_user !== false && $current_user->ID != 0) {
            $result = esc_html($current_user->user_email);
        } else {
            $result = '';
        }

        return $result;
    }

    /**
     * Function that provides a shortcode for the current user's registration date/time.  You can provide a 'format'
     * attribute that specifies the date/time format.
     *
     * \param[in] $attributes The shortcode attributes.
     *
     * \return Returns the user's first name.
     */
    public function inesonic_registered_datetime($attributes) {        
        $current_user = wp_get_current_user();        
        if ($current_user !== null && $current_user !== false && $current_user->ID != 0) {
            $registered_datetime = $this->get_user_registered($current_user->ID);
            if ($registered_datetime) {
                if (array_key_exists('format', $attributes)) {
                    $format = $attributes['format'];
                } else {
                    $format = "Y-m-d H:i:s";
                }
            
                $result = esc_html(date($format, $registered_datetime));
            } else {
                $result = __('unknown', 'inesonic-shortcodes');
            }
        } else {
            $result = '';
        }

        return $result;
    }
}

/* Instatiate our plug-in. */
InesonicShortcodes::instance();
