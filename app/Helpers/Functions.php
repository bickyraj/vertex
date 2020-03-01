<?php

use Illuminate\Support\Str;

if (!function_exists('truncate')) {
    function truncate ($data) {
    	return Str::limit($data, 150, '...');
    }
}

if (!function_exists('formatDate')) {
    function formatDate($date) {
    	return date('jS M, Y', strtotime($date));
    }
}

if (!function_exists('breadCrumbTitle')) {
    function breadCrumbTitle($title) {
    	$temp = ucwords(str_replace('-', ' ', $title));

    	return $temp;
    }
}