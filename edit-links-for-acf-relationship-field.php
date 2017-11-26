<?php

/**
 * Plugin Name: Edit Links for ACF Relationship Field
 * Description: This plugin adds edit links to the posts in the administration of the ACF Relationship Field.
 * Author: Joi Glifberg, Triggerfish
 * Author URI: https://www.triggerfish.se/
 * Version: 1.0.0
 */

use EditLinksACFRelationshipField\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'EDIT_LINKS_ACF_RELATIONSHIP_FIELD_DIR', __DIR__ );

include_once EDIT_LINKS_ACF_RELATIONSHIP_FIELD_DIR . '/includes/class-plugin.php';

new Plugin();
