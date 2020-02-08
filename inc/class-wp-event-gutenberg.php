<?php

final class Event_Gutenberg {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init() {

        if (!function_exists('register_block_type'))
            return;

        add_action('init', [$this, 'load_modules']);
    }

    public function load_modules() {

        $mycred_modules = [
            'wp-events-block'
        ];


        foreach ($mycred_modules as $mycred_module) {
            require_once __DIR__ . "/blocks/$mycred_module/$mycred_module.php";
        }
    }

}

Event_Gutenberg::instance();
