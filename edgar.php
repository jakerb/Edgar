<?php
/**
 * Plugin Name:       Edgar
 * Description:       Lightweight Template Engine
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           0.1.0
 * Author:            Jake Bown
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       edgar
 *
 */

namespace Edgar;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/*
 * Constants
 */

define('EDGAR_ROOT_PATH', __FILE__);
define('EDGAR_ROOT_DIR', __DIR__);
define('EDGAR_TEXT_NAME', 'Edgar');
define('EDGAR_TEXT_DOMAIN', 'edgar');


 /*
  * Classes
  */
require 'core/classes/metaBoxClass.php';
require 'core/classes/postTypeClass.php';
require 'core/classes/optionsPageClass.php';
require 'core/classes/fieldClass.php';
require 'core/classes/fieldTypeClass.php';
require 'core/classes/fieldTypeCategoriesClass.php';

/*
 * Field Types
 */
require 'core/fields/text.php';
require 'core/fields/select.php';
require 'core/fields/boolean.php';

 /* 
  * Loader
  */
require 'core/EdgarLoader.php';

$edgar = (new EdgarLoader());