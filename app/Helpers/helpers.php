<?php

/**
 * Custom helper functions for the application
 */

if (!function_exists('formatDate')) {
    /**
     * Format date to Indonesian format
     */
    function formatDate($date, $format = 'd F Y')
    {
        return \Carbon\Carbon::parse($date)->translatedFormat($format);
    }
}

if (!function_exists('formatCurrency')) {
    /**
     * Format currency to Indonesian format
     */
    function formatCurrency($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
