<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Design_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function error($text) {
        return '<div class="error">' . $text . '</div>';
    }

    function info($text) {
        return '<div class="info">' . $text . '</div>';
    }

    function success($text) {
        return '<div class="success">' . $text . '</div>';
    }

    function warning($text) {
        return '<div class="warning">' . $text . '</div>';
    }

    function validation($text) {
        return '<div class="validation">' . $text . '</div>';
    }

}

?>