<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.3
	@build			6th January, 2021
	@created		18th October, 2016
	@package		Demo
	@subpackage		demo.php
	@author			Llewellyn van der Merwe <https://www.vdm.io/>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
  ____  _____  _____  __  __  __      __       ___  _____  __  __  ____  _____  _  _  ____  _  _  ____ 
 (_  _)(  _  )(  _  )(  \/  )(  )    /__\     / __)(  _  )(  \/  )(  _ \(  _  )( \( )( ___)( \( )(_  _)
.-_)(   )(_)(  )(_)(  )    (  )(__  /(__)\   ( (__  )(_)(  )    (  )___/ )(_)(  )  (  )__)  )  (   )(  
\____) (_____)(_____)(_/\/\_)(____)(__)(__)   \___)(_____)(_/\/\_)(__)  (_____)(_)\_)(____)(_)\_) (__) 

/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

JHtml::_('behavior.tabstate');

// Set the component css/js
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_demo/assets/css/site.css');
$document->addScript('components/com_demo/assets/js/site.js');

// Require helper files
JLoader::register('DemoHelper', __DIR__ . '/helpers/demo.php');
JLoader::register('DemoHelperRoute', __DIR__ . '/helpers/route.php'); 

// Get an instance of the controller prefixed by Demo
$controller = JControllerLegacy::getInstance('Demo');

// Perform the request task
$controller->execute(JFactory::getApplication()->input->get('task'));

// Redirect if set by the controller
$controller->redirect();
