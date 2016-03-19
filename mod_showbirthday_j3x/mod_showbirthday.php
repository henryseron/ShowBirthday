<?php
/**
* @title		Show Birthday
* @package		Joomla
* @website		http://www.shakingweb.com
* @copyleft             Copyleft () 2015
* @license		GNU/GPLv2, see LICENSE.txt
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

// getting parameters from the module's configuration
$format_date = $params->get('format_date');

// include the template for display
require(JModuleHelper::getLayoutPath('mod_showbirthday'));

