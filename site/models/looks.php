<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.0
	@build			24th August, 2017
	@created		18th October, 2016
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

// import the Joomla modellist library
jimport('joomla.application.component.modellist');

/**
 * Demo Model for Looks
 */
class DemoModelLooks extends JModelList
{
	/**
	 * Model user data.
	 *
	 * @var        strings
	 */
	protected $user;
	protected $userId;
	protected $guest;
	protected $groups;
	protected $levels;
	protected $app;
	protected $input;
	protected $uikitComp;

	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  An SQL query
	 */
	protected function getListQuery()
	{
		// Get the current user for authorisation checks
		$this->user		= JFactory::getUser();
		$this->userId		= $this->user->get('id');
		$this->guest		= $this->user->get('guest');
                $this->groups		= $this->user->get('groups');
                $this->authorisedGroups	= $this->user->getAuthorisedGroups();
		$this->levels		= $this->user->getAuthorisedViewLevels();
		$this->app		= JFactory::getApplication();
		$this->input		= $this->app->input;
		$this->initSet		= true; 
		// Get a db connection.
		$db = JFactory::getDbo();

		// Create a new query object.
		$query = $db->getQuery(true);

		// Get from #__demo_look as a
		$query->select($db->quoteName(
			array('a.id','a.name','a.alias','a.description','a.add','a.email','a.mobile_phone','a.dateofbirth','a.image','a.website','a.not_required','a.published','a.hits','a.ordering'),
			array('id','name','alias','description','add','email','mobile_phone','dateofbirth','image','website','not_required','published','hits','ordering')));
		$query->from($db->quoteName('#__demo_look', 'a'));
		// Get where a.published is 1
		$query->where('a.published = 1');
		$query->order('a.name ASC');

		// return the query object
		return $query;
	}

	/**
	 * Method to get an array of data items.
	 *
	 * @return  mixed  An array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$user = JFactory::getUser();
		// check if this user has permission to access item
		if (!$user->authorise('site.looks.access', 'com_demo'))
		{
			$app = JFactory::getApplication();
			$app->enqueueMessage(JText::_('COM_DEMO_NOT_AUTHORISED_TO_VIEW_LOOKS'), 'error');
			// redirect away to the home page if no access allowed.
			$app->redirect(JURI::root());
			return false;
		}  
		// load parent items
		$items = parent::getItems();

		// Get the global params
		$globalParams = JComponentHelper::getParams('com_demo', true);

		// Convert the parameter fields into objects.
		if (DemoHelper::checkArray($items))
		{
			foreach ($items as $nr => &$item)
			{
				// Always create a slug for sef URL's
				$item->slug = (isset($item->alias) && isset($item->id)) ? $item->id.':'.$item->alias : $item->id;
				// Make sure the content prepare plugins fire on description.
				$item->description = JHtml::_('content.prepare',$item->description);
				// Checking if description has uikit components that must be loaded.
				$this->uikitComp = DemoHelper::getUikitComp($item->description,$this->uikitComp);
			}
		} 


		// do a quick build of all edit links links
		if (isset($items) && $items)
		{
			foreach ($items as $nr => &$item)
			{
				$canDo = DemoHelper::getActions('look',$item,'looks');
				if ($canDo->get('look.edit'))
				{
					$item->editLink = '<br /><br /><a class="uk-button uk-button-primary uk-width-1-1" href="';
					$item->editLink .= JRoute::_('index.php?option=com_demo&view=look&task=look.edit&id=' . $item->id);
					$item->editLink .= '"><i class="uk-icon-pencil"></i><span class="uk-hidden-small">';
					$item->editLink .= JText::_('COM_DEMO_EDIT_LOOK');
					$item->editLink .= '</span></a>';
				}
				else
				{
					$item->editLink = '';
				}
			}
		}

		// return items
		return $items;
	} 


	/**
	* Get the uikit needed components
	*
	* @return mixed  An array of objects on success.
	*
	*/
	public function getUikitComp()
	{
		if (isset($this->uikitComp) && DemoHelper::checkArray($this->uikitComp))
		{
			return $this->uikitComp;
		}
		return false;
	}  
}
