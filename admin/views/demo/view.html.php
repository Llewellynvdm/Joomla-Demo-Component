<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			6th January, 2016
	@created		5th August, 2015
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
 * Demo View class
 */
class DemoViewDemo extends JViewLegacy
{
	/**
	 * View display method
	 * @return void
	 */
	function display($tpl = null)
	{
		// Check for errors.
		if (count($errors = $this->get('Errors')))
                {
			JError::raiseError(500, implode('<br />', $errors));
			return false;
		};
		// Assign data to the view
		$this->icons			= $this->get('Icons');
		$this->contributors		= DemoHelper::getContributors();

		// Set the toolbar
		$this->addToolBar();

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}

	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{
		$canDo = DemoHelper::getActions('demo');
		JToolBarHelper::title(JText::_('COM_DEMO_DASHBOARD'), 'grid-2');

                // set help url for this view if found
                $help_url = DemoHelper::getHelpUrl('demo');
                if (DemoHelper::checkString($help_url))
                {
			JToolbarHelper::help('COM_DEMO_HELP_MANAGER', false, $help_url);
                }

		if ($canDo->get('core.admin') || $canDo->get('core.options'))
                {
			JToolBarHelper::preferences('com_demo');
		}
	}

	/**
	 * Method to set up the document properties
	 *
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$document = JFactory::getDocument();

		$document->addStyleSheet(JURI::root() . "administrator/components/com_demo/assets/css/dashboard.css");

		$document->setTitle(JText::_('COM_DEMO_DASHBOARD'));
	}
}
