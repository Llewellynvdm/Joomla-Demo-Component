<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.0
	@build			5th May, 2018
	@created		18th October, 2016
	@package		Demo
	@subpackage		controller.php
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

// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * Demo Component Controller
 */
class DemoController extends JControllerLegacy
{
	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached.
	 * @param   boolean  $urlparams  An array of safe URL parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  JController  This object to support chaining.
	 *
	 */
	function display($cachable = false, $urlparams = false)
	{
		// set default view if not set
		$view		= $this->input->getCmd('view', 'looks');
		$this->input->set('view', $view);
		$isEdit		= $this->checkEditView($view);
		$layout		= $this->input->get('layout', null, 'WORD');
		$id			= $this->input->getInt('id');
		// $cachable	= true; (TODO) working on a fix [gh-238](https://github.com/vdm-io/Joomla-Component-Builder/issues/238)
		
		// insure that the view is not cashable if edit view or if user is logged in
		$user = JFactory::getUser();
		if ($user->get('id') || $isEdit)
		{
			$cachable = false;
		}
		
		// Check for edit form.
		if($isEdit)
		{
			if ($layout == 'edit' && !$this->checkEditId('com_demo.edit.'.$view, $id))
			{
				// Somehow the person just went to the form - we don't allow that.
				$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
				$this->setMessage($this->getError(), 'error');
				// check if item was opend from other then its own list view
				$ref 	= $this->input->getCmd('ref', 0);
				$refid 	= $this->input->getInt('refid', 0);
				// set redirect
				if ($refid > 0 && DemoHelper::checkString($ref))
				{
					// redirect to item of ref
					$this->setRedirect(JRoute::_('index.php?option=com_demo&view='.(string)$ref.'&layout=edit&id='.(int)$refid, false));
				}
				elseif (DemoHelper::checkString($ref))
				{
					// redirect to ref
					 $this->setRedirect(JRoute::_('index.php?option=com_demo&view='.(string)$ref, false));
				}
				else
				{
					// normal redirect back to the list default site view
					$this->setRedirect(JRoute::_('index.php?option=com_demo&view=looks', false));
				}
				return false;
			}
		}
		
		// we may need to make this more dynamic in the future. (TODO)
		$safeurlparams = array(
			'catid' => 'INT',
			'id' => 'INT',
			'cid' => 'ARRAY',
			'year' => 'INT',
			'month' => 'INT',
			'limit' => 'UINT',
			'limitstart' => 'UINT',
			'showall' => 'INT',
			'return' => 'BASE64',
			'filter' => 'STRING',
			'filter_order' => 'CMD',
			'filter_order_Dir' => 'CMD',
			'filter-search' => 'STRING',
			'print' => 'BOOLEAN',
			'lang' => 'CMD',
			'Itemid' => 'INT');

		// should these not merge?
		if (DemoHelper::checkArray($urlparams))
		{
			$safeurlparams = DemoHelper::mergeArrays(array($urlparams, $safeurlparams));
		}

		return parent::display($cachable, $safeurlparams);
	}

	protected function checkEditView($view)
	{
		if (DemoHelper::checkString($view))
		{
			$views = array(
				'look'
				);
			// check if this is a edit view
			if (in_array($view,$views))
			{
				return true;
			}
		}
		return false;
	}
}
