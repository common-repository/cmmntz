<?php
/**
  * @package Cmmntz
  */
/*
Plugin Name: Cmmntz
Plugin URI: https://github.com/Classibridge/plugins
Description: CMMNTZ is an easy to use commenting widget that delivers instant engagement with powerful voting tools and valuable metrics on what users think.
Version: 1.04
Author: Classibridge
Author URI: http://www.cmmntz.com
License: GPLv2 or later
Text Domain: cmmntz-plugin
*/
/*
Copyright (C) 2019  Classibridge

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


include_once(plugin_dir_path( __FILE__ ) . 'admin/cmmntz-options-page.php');
include_once(plugin_dir_path( __FILE__ ) . 'admin/cmmntz-admin-functions.php');

class CmmntzPlugin {
  function __construct() {
		add_action( 'init', array( $this, 'replace_comments_section' ) );
		add_action( 'wp_before_admin_bar_render', array( $this, 'remove_comments_admin_bar' ) );
		add_action('admin_menu', array( $this, 'replace_comment_admin_pages' ));
		add_action('admin_init', 'cmmntz_admin_init');
  }

  function replace_comments_section() {
    add_filter ('comments_template', array( $this, 'cmmntz_template' ), 100);
		add_filter( 'comments_number', array($this, 'cmmntz_link'), 10, 2 );
  }


	function cmmntz_link( $text, $number ) {
	    if ( $number > -1 )
	    { return _x( 'cmmntz', 'cmmntz', 'cmmntz' ); }
	    return $text;
	}

  function cmmntz_template($theme_template) {
		// Path to our new comment template file
		$new_theme_template = plugin_dir_path( __FILE__ ) . 'views/cmmntz-template.php';

		// Override if it exsits
		if( file_exists( $new_theme_template ) )
				$theme_template = $new_theme_template;

		return $theme_template;
  }


	function remove_comments_admin_bar() {
		global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments'); // admin_bar
	}

	function replace_comment_admin_pages() {
		remove_menu_page( 'edit-comments.php' ); //admin_menu
		add_menu_page(
                'CMMNTZ '.__( 'Settings', 'cmmntz' ),
                'CMMNTZ',
                'manage_options',
                'cmmntz',
                'cmmntz_options_page',
                'dashicons-format-chat',
                25
            );
	}

}

if ( class_exists( 'CmmntzPlugin' ) ) {
  $cmmntzPlugin = new CmmntzPlugin();
}
