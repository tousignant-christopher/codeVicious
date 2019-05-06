<?php

namespace CTousignant;


/**
 * Register SPL Autoload function
 */
require_once get_template_directory() . "/App_Code/Autoloader.php";
new Autoloader();


/**
 * Setup Admin
 */
new Admin\Setup();