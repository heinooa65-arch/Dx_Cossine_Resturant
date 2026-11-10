<?php
require_once __DIR__ . '/includes/functions.php';
$_SESSION=[]; session_regenerate_id(true); flash('You have been signed out.'); redirect('index.php');
