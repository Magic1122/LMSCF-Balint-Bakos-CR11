<?php
    // Simple page redirect

    function redirect($page) {
        return header('location: ' . URLROOT . '/' . $page);
    }
?>