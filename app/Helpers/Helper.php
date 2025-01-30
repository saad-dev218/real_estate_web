<?php
if (!function_exists('getUser')) {
    function getUser()
    {
        if (session()->has('user')) {
            return (object) session()->get('user');
        }
    }
}
