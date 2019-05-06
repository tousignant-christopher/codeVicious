<?php


namespace CTousignant\Admin\Modules\Post_Types;

if ( ! defined( 'WPINC' ) ) die;


new Page(
    "dev_tools",
    "Post Types",
    "Post Types",
    "manage_options",
    "dev_tools__post_types"
);
