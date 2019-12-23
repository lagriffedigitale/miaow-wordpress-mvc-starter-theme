<?php
use Miaow\Controllers\BasicController;

// Load Basic Controller to override WordPress Hierarchy
$basicController = new BasicController();

// Init Theme
$basicController->initTheme();
