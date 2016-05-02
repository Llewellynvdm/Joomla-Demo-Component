<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			2nd May, 2016
	@created		5th August, 2015
	@package		Demo
	@subpackage		looks.php
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

// import Joomla controlleradmin library
jimport('joomla.application.component.controlleradmin');

/**
 * Looks Controller
 */
class DemoControllerLooks extends JControllerAdmin
{
	protected $text_prefix = 'COM_DEMO_LOOKS';
	/**
	 * Proxy for getModel.
	 * @since	2.5
	 */
	public function getModel($name = 'Look', $prefix = 'DemoModel', $config = array())
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		
		return $model;
	}

	public function exportData()
	{
		// Check for request forgeries
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		// check if export is allowed for this user.
		$user = JFactory::getUser();
		if ($user->authorise('look.export', 'com_demo') && $user->authorise('core.export', 'com_demo'))
		{
			// Get the input
			$input = JFactory::getApplication()->input;
			$pks = $input->post->get('cid', array(), 'array');
			// Sanitize the input
			JArrayHelper::toInteger($pks);
			// Get the model
			$model = $this->getModel('Looks');
			// get the data to export
			$data = $model->getExportData($pks);
			if (DemoHelper::checkArray($data))
			{
				// now set the data to the spreadsheet
				$date = JFactory::getDate();
				DemoHelper::xls($data,'Looks_'.$date->format('jS_F_Y'),'Looks exported ('.$date->format('jS F, Y').')','looks');
			}
		}
		// Redirect to the list screen with error.
		$message = JText::_('COM_DEMO_EXPORT_FAILED');
		$this->setRedirect(JRoute::_('index.php?option=com_demo&view=looks', false), $message, 'error');
		return;
	}


	public function importData()
	{
		// Check for request forgeries
		JSession::checkToken() or die(JText::_('JINVALID_TOKEN'));
		// check if import is allowed for this user.
		$user = JFactory::getUser();
		if ($user->authorise('look.import', 'com_demo') && $user->authorise('core.import', 'com_demo'))
		{
			// Get the import model
			$model = $this->getModel('Looks');
			// get the headers to import
			$headers = $model->getExImPortHeaders();
			if (DemoHelper::checkObject($headers))
			{
				// Load headers to session.
				$session = JFactory::getSession();
				$headers = json_encode($headers);
				$session->set('look_VDM_IMPORTHEADERS', $headers);
				$session->set('backto_VDM_IMPORT', 'looks');
				$session->set('dataType_VDM_IMPORTINTO', 'look');
				// Redirect to import view.
				$message = JText::_('COM_DEMO_IMPORT_SELECT_FILE_FOR_LOOKS');
				$this->setRedirect(JRoute::_('index.php?option=com_demo&view=import', false), $message);
				return;
			}
		}
		// Redirect to the list screen with error.
		$message = JText::_('COM_DEMO_IMPORT_FAILED');
		$this->setRedirect(JRoute::_('index.php?option=com_demo&view=looks', false), $message, 'error');
		return;
	} 
}
