<?php

/**
 * Plugin Name: Edit Links for ACF Relationship Fields
 * Author: Joi Glifberg, Triggerfish
 * Author URI: https://www.triggerfish.se/
 * Version: 1.0.0
 */

use EditLinksACFRelationshipFields\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'EDIT_LINKS_ACF_RELATIONSHIP_FIELDS_DIR', __DIR__ );

include_once EDIT_LINKS_ACF_RELATIONSHIP_FIELDS_DIR . '/includes/class-plugin.php';

new Plugin();
