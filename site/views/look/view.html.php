<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.3
	@build			8th February, 2021
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

/**
 * Look View class
 */
class DemoViewLook extends JViewLegacy
{
	/**
	 * display method of View
	 * @return void
	 */
	public function display($tpl = null)
	{
		// set params
		$this->params = JComponentHelper::getParams('com_demo');
		// Assign the variables
		$this->form = $this->get('Form');
		$this->item = $this->get('Item');
		$this->script = $this->get('Script');
		$this->state = $this->get('State');
		// get action permissions
		$this->canDo = DemoHelper::getActions('look', $this->item);
		// get input
		$jinput = JFactory::getApplication()->input;
		$this->ref = $jinput->get('ref', 0, 'word');
		$this->refid = $jinput->get('refid', 0, 'int');
		$return = $jinput->get('return', null, 'base64');
		// set the referral string
		$this->referral = '';
		if ($this->refid && $this->ref)
		{
			// return to the item that referred to this item
			$this->referral = '&ref=' . (string)$this->ref . '&refid=' . (int)$this->refid;
		}
		elseif($this->ref)
		{
			// return to the list view that referred to this item
			$this->referral = '&ref=' . (string)$this->ref;
		}
		// check return value
		if (!is_null($return))
		{
			// add the return value
			$this->referral .= '&return=' . (string)$return;
		}

		// Set the toolbar
		$this->addToolBar();
		
		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors), 500);
		}

		// Display the template
		parent::display($tpl);

		// Set the document
		$this->setDocument();
	}


	/**
	 * Setting the toolbar
	 */
	protected function addToolBar()
	{JFactory::getApplication()->input->set('hidemainmenu', true);
		$user = JFactory::getUser();
		$userId	= $user->id;
		$isNew = $this->item->id == 0;

		JToolbarHelper::title( JText::_($isNew ? 'COM_DEMO_LOOK_NEW' : 'COM_DEMO_LOOK_EDIT'), 'pencil-2 article-add');
		// Built the actions for new and existing records.
		if (DemoHelper::checkString($this->referral))
		{
			if ($this->canDo->get('look.create') && $isNew)
			{
				// We can create the record.
				JToolBarHelper::save('look.save', 'JTOOLBAR_SAVE');
			}
			elseif ($this->canDo->get('look.edit'))
			{
				// We can save the record.
				JToolBarHelper::save('look.save', 'JTOOLBAR_SAVE');
			}
			if ($isNew)
			{
				// Do not creat but cancel.
				JToolBarHelper::cancel('look.cancel', 'JTOOLBAR_CANCEL');
			}
			else
			{
				// We can close it.
				JToolBarHelper::cancel('look.cancel', 'JTOOLBAR_CLOSE');
			}
		}
		else
		{
			if ($isNew)
			{
				// For new records, check the create permission.
				if ($this->canDo->get('look.create'))
				{
					JToolBarHelper::apply('look.apply', 'JTOOLBAR_APPLY');
					JToolBarHelper::save('look.save', 'JTOOLBAR_SAVE');
					JToolBarHelper::custom('look.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
				};
				JToolBarHelper::cancel('look.cancel', 'JTOOLBAR_CANCEL');
			}
			else
			{
				if ($this->canDo->get('look.edit'))
				{
					// We can save the new record
					JToolBarHelper::apply('look.apply', 'JTOOLBAR_APPLY');
					JToolBarHelper::save('look.save', 'JTOOLBAR_SAVE');
					// We can save this record, but check the create permission to see
					// if we can return to make a new one.
					if ($this->canDo->get('look.create'))
					{
						JToolBarHelper::custom('look.save2new', 'save-new.png', 'save-new_f2.png', 'JTOOLBAR_SAVE_AND_NEW', false);
					}
				}
				$canVersion = ($this->canDo->get('core.version') && $this->canDo->get('look.version'));
				if ($this->state->params->get('save_history', 1) && $this->canDo->get('look.edit') && $canVersion)
				{
					JToolbarHelper::versions('com_demo.look', $this->item->id);
				}
				if ($this->canDo->get('look.create'))
				{
					JToolBarHelper::custom('look.save2copy', 'save-copy.png', 'save-copy_f2.png', 'JTOOLBAR_SAVE_AS_COPY', false);
				}
				JToolBarHelper::cancel('look.cancel', 'JTOOLBAR_CLOSE');
			}
		}
		JToolbarHelper::divider();
		// set help url for this view if found
		$help_url = DemoHelper::getHelpUrl('look');
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
	public function escape($var)
	{
		if(strlen($var) > 30)
		{
    			// use the helper htmlEscape method instead and shorten the string
			return DemoHelper::htmlEscape($var, $this->_charset, true, 30);
		}
		// use the helper htmlEscape method instead.
		return DemoHelper::htmlEscape($var, $this->_charset);
	}

	/**
	 * Method to set up the document properties
	 *
	 * @return void
	 */
	protected function setDocument()
	{
		$isNew = ($this->item->id < 1);
		if (!isset($this->document))
		{
			$this->document = JFactory::getDocument();
		}
		$this->document->setTitle(JText::_($isNew ? 'COM_DEMO_LOOK_NEW' : 'COM_DEMO_LOOK_EDIT'));
		// only add the ISIS template css & js if needed (default is 1 = true)
		// you can override this in the global component options
		// just add a (radio yes/no field) with a name called add_isis_template
		// to your components config area
		if ($this->params->get('add_isis_template', 1))
		{
			// we need this to fix the form display (TODO)
			$this->document->addStyleSheet(JURI::root() . "administrator/templates/isis/css/template.css", (DemoHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
			$this->document->addScript(JURI::root() . "administrator/templates/isis/js/template.js", (DemoHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		}
		// the default style of this view
		$this->document->addStyleSheet(JURI::root()."components/com_demo/assets/css/look.css", (DemoHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/css');
		// default javascript of this view
		$this->document->addScript(JURI::root(). $this->script, (DemoHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript');
		$this->document->addScript(JURI::root(). "components/com_demo/views/look/submitbutton.js", (DemoHelper::jVersion()->isCompatible('3.8.0')) ? array('version' => 'auto') : 'text/javascript'); 
		JText::script('view not acceptable. Error');
	}
}
