<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.0
	@build			24th August, 2017
	@created		18th October, 2016
	@package		Demo
	@subpackage		view.html.php
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

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * Demo View class for the Looks
 */
class DemoViewLooks extends JViewLegacy
{
	// Overwriting JView display method
	function display($tpl = null)
	{
		// get combined params of both component and menu
		$this->app = JFactory::getApplication();
		$this->params = $this->app->getParams();
		$this->menu = $this->app->getMenu()->getActive();
		// get the user object
		$this->user = JFactory::getUser();
		// Initialise variables.
		$this->items	= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			JError::raiseError(500, implode(PHP_EOL, $errors));
			return false;
		}

		// Set the toolbar
		$this->addToolBar();

		// set the document
		$this->_prepareDocument();

		parent::display($tpl);
	}

        /**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{

		// always make sure jquery is loaded.
		JHtml::_('jquery.framework');
		// Load the header checker class.
		require_once( JPATH_COMPONENT_SITE.'/helpers/headercheck.php' );
		// Initialize the header checker.
		$HeaderCheck = new demoHeaderCheck;

		// Load uikit options.
		$uikit = $this->params->get('uikit_load');
		// Set script size.
		$size = $this->params->get('uikit_min');
		// Set css style.
		$style = $this->params->get('uikit_style');

		// The uikit css.
		if ((!$HeaderCheck->css_loaded('uikit.min') || $uikit == 1) && $uikit != 2 && $uikit != 3)
		{
			$this->document->addStyleSheet(JURI::root(true) .'/media/com_demo/uikit/css/uikit'.$style.$size.'.css');
		}
		// The uikit js.
		if ((!$HeaderCheck->js_loaded('uikit.min') || $uikit == 1) && $uikit != 2 && $uikit != 3)
		{
			$this->document->addScript(JURI::root(true) .'/media/com_demo/uikit/js/uikit'.$size.'.js');
		}

		// Load the needed uikit components in this view.
		$uikitComp = $this->get('UikitComp');
		if ($uikit != 2 && isset($uikitComp) && DemoHelper::checkArray($uikitComp))
		{
			// load just in case.
			jimport('joomla.filesystem.file');
			// loading...
			foreach ($uikitComp as $class)
			{
				foreach (DemoHelper::$uk_components[$class] as $name)
				{
					// check if the CSS file exists.
					if (JFile::exists(JPATH_ROOT.'/media/com_demo/uikit/css/components/'.$name.$style.$size.'.css'))
					{
						// load the css.
						$this->document->addStyleSheet(JURI::root(true) .'/media/com_demo/uikit/css/components/'.$name.$style.$size.'.css');
					}
					// check if the JavaScript file exists.
					if (JFile::exists(JPATH_ROOT.'/media/com_demo/uikit/js/components/'.$name.$size.'.js'))
					{
						// load the js.
						$this->document->addScript(JURI::root(true) .'/media/com_demo/uikit/js/components/'.$name.$size.'.js', 'text/javascript', true);
					}
				}
			}
		}   
		// load the meta description
		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}
		// load the key words if set
		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}
		// check the robot params
		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		} 
		// add the document default css file
		$this->document->addStyleSheet(JURI::root(true) .'/components/com_demo/assets/css/looks.css'); 
        }

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		// adding the joomla toolbar to the front
		JLoader::register('JToolbarHelper', JPATH_ADMINISTRATOR.'/includes/toolbar.php');
		
		// set help url for this view if found
		$help_url = DemoHelper::getHelpUrl('looks');
		if (DemoHelper::checkString($help_url))
		{
			JToolbarHelper::help('COM_DEMO_HELP_MANAGER', false, $help_url);
		}
		// now initiate the toolbar
		$this->toolbar = JToolbar::getInstance();
	}

        /**
	 * Escapes a value for output in a view script.
	 *
	 * @param   mixed  $var  The output to escape.
	 *
	 * @return  mixed  The escaped value.
	 */
	public function escape($var, $sorten = false, $length = 40)
	{
                // use the helper htmlEscape method instead.
		return DemoHelper::htmlEscape($var, $this->_charset, $sorten, $length);
	}
}
