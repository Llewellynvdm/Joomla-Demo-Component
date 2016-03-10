<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			10th March, 2016
	@created		5th August, 2015
	@package		Demo
	@subpackage		articles.php
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

// import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

/**
 * Articles Form Field class for the Demo component
 */
class JFormFieldArticles extends JFormFieldList
{
	/**
	 * The articles field type.
	 *
	 * @var		string
	 */
	public $type = 'articles'; 
	/**
	 * Override to add new button
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   3.2
	 */
	protected function getInput()
	{
		// see if we should add buttons
		$setButton = $this->getAttribute('button');
		// get html
		$html = parent::getInput();
		// if true set button
		if ($setButton === 'true')
		{
			$user = JFactory::getUser();
			// only add if user allowed to create article
			if ($user->authorise('core.create', 'com_demo'))
			{
				// get the input from url
				$jinput = JFactory::getApplication()->input;
				// get the view name & id
				$values = $jinput->getArray(array(
					'id' => 'int',
					'view' => 'word'
				));
				// check if new item
				$ref = '';
				if (!is_null($values['id']) && strlen($values['view']))
				{
					// only load referal if not new item.
					$ref = '&amp;ref=' . $values['view'] . '&amp;refid=' . $values['id'];
				}
				// build the button
				$button = '<a class="btn btn-small btn-success"
					href="index.php?option=com_demo&amp;view=article&amp;layout=edit'.$ref.'" >
					<span class="icon-new icon-white"></span>' . JText::_('COM_DEMO_NEW') . '</a>';
				// return the button attached to input field
				return $html . $button;
			}
		}
		return $html;
	}

	/**
	 * Method to get a list of options for a list input.
	 *
	 * @return	array		An array of JHtml options.
	 */
	public function getOptions()
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select($db->quoteName(array('a.id','a.title','a.alias'),array('id','article_title','alias')));
		$query->from($db->quoteName('#__content', 'a'));
		$query->where($db->quoteName('a.state') . ' = 1');
		$query->order('a.title ASC');
		$db->setQuery((string)$query);
		$items = $db->loadObjectList();
		$options = array();
		if ($items)
		{
			$options[] = JHtml::_('select.option', '', 'Select an Article');
			foreach($items as $item)
			{
				$options[] = JHtml::_('select.option', $item->id, $item->article_title . ' (' . $item->alias . ')');
			}
		}
		return $options;
	}
}
