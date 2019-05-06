<?php


namespace CTousignant\Admin\Modules\Dev_Tools;

if ( ! defined( 'WPINC' ) ) die;


new Page(
    "Dev Tools",
    "Dev Tools",
    "manage_options",
    "dev_tools",
    "dashicons-admin-settings",
    99
);
