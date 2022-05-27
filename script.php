<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.1.0
	@build			27th May, 2022
	@created		18th October, 2016
	@package		Demo
	@subpackage		script.php
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

use Joomla\CMS\Filesystem\File;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Installer\Adapter\ComponentAdapter;
JHTML::_('bootstrap.renderModal');

/**
 * Script File of Demo Component
 */
class com_demoInstallerScript
{
	/**
	 * Constructor
	 *
	 * @param   JAdapterInstance  $parent  The object responsible for running this script
	 */
	public function __construct(ComponentAdapter $parent) {}

	/**
	 * Called on installation
	 *
	 * @param   ComponentAdapter  $parent  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function install(ComponentAdapter $parent) {}

	/**
	 * Called on uninstallation
	 *
	 * @param   ComponentAdapter  $parent  The object responsible for running this script
	 */
	public function uninstall(ComponentAdapter $parent)
	{
		// Get Application object
		$app = JFactory::getApplication();

		// Get The Database object
		$db = JFactory::getDbo();

		// Create a new query object.
		$query = $db->getQuery(true);
		// Select ids from fields
		$query->select($db->quoteName('id'));
		$query->from($db->quoteName('#__fields'));
		// Where look context is found
		$query->where( $db->quoteName('context') . ' = '. $db->quote('com_demo.look') );
		$db->setQuery($query);
		// Execute query to see if context is found
		$db->execute();
		$look_found = $db->getNumRows();
		// Now check if there were any rows
		if ($look_found)
		{
			// Since there are load the needed  look field ids
			$look_field_ids = $db->loadColumn();
			// Remove look from the field table
			$look_condition = array( $db->quoteName('context') . ' = '. $db->quote('com_demo.look') );
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__fields'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove look items
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully remove look add queued success message.
				$app->enqueueMessage(JText::_('The fields with type (com_demo.look) context was removed from the <b>#__fields</b> table'));
			}
			// Also Remove look field values
			$look_condition = array( $db->quoteName('field_id') . ' IN ('. implode(',', $look_field_ids) .')');
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__fields_values'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove look field values
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully remove look add queued success message.
				$app->enqueueMessage(JText::_('The fields values for look was removed from the <b>#__fields_values</b> table'));
			}
		}

		// Create a new query object.
		$query = $db->getQuery(true);
		// Select ids from field groups
		$query->select($db->quoteName('id'));
		$query->from($db->quoteName('#__fields_groups'));
		// Where look context is found
		$query->where( $db->quoteName('context') . ' = '. $db->quote('com_demo.look') );
		$db->setQuery($query);
		// Execute query to see if context is found
		$db->execute();
		$look_found = $db->getNumRows();
		// Now check if there were any rows
		if ($look_found)
		{
			// Remove look from the field groups table
			$look_condition = array( $db->quoteName('context') . ' = '. $db->quote('com_demo.look') );
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__fields_groups'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove look items
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully remove look add queued success message.
				$app->enqueueMessage(JText::_('The field groups with type (com_demo.look) context was removed from the <b>#__fields_groups</b> table'));
			}
		}

		// Create a new query object.
		$query = $db->getQuery(true);
		// Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// Where look alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_demo.look') );
		$db->setQuery($query);
		// Execute query to see if alias is found
		$db->execute();
		$look_found = $db->getNumRows();
		// Now check if there were any rows
		if ($look_found)
		{
			// Since there are load the needed  look type ids
			$look_ids = $db->loadColumn();
			// Remove look from the content type table
			$look_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_demo.look') );
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove look items
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully remove look add queued success message.
				$app->enqueueMessage(JText::_('The (com_demo.look) type alias was removed from the <b>#__content_type</b> table'));
			}

			// Remove look items from the contentitem tag map table
			$look_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_demo.look') );
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove look items
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully remove look add queued success message.
				$app->enqueueMessage(JText::_('The (com_demo.look) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// Remove look items from the ucm content table
			$look_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_demo.look') );
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove look items
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully removed look add queued success message.
				$app->enqueueMessage(JText::_('The (com_demo.look) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// Make sure that all the look items are cleared from DB
			foreach ($look_ids as $look_id)
			{
				// Remove look items from the ucm base table
				$look_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $look_id);
				// Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($look_condition);
				$db->setQuery($query);
				// Execute the query to remove look items
				$db->execute();

				// Remove look items from the ucm history table
				$look_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $look_id);
				// Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($look_condition);
				$db->setQuery($query);
				// Execute the query to remove look items
				$db->execute();
			}
		}

		// Create a new query object.
		$query = $db->getQuery(true);
		// Select id from content type table
		$query->select($db->quoteName('type_id'));
		$query->from($db->quoteName('#__content_types'));
		// Where Look alias is found
		$query->where( $db->quoteName('type_alias') . ' = '. $db->quote('com_demo.look') );
		$db->setQuery($query);
		// Execute query to see if alias is found
		$db->execute();
		$look_found = $db->getNumRows();
		// Now check if there were any rows
		if ($look_found)
		{
			// Since there are load the needed  look type ids
			$look_ids = $db->loadColumn();
			// Remove Look from the content type table
			$look_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_demo.look') );
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__content_types'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove Look items
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully remove Look add queued success message.
				$app->enqueueMessage(JText::_('The (com_demo.look) type alias was removed from the <b>#__content_type</b> table'));
			}

			// Remove Look items from the contentitem tag map table
			$look_condition = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_demo.look') );
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__contentitem_tag_map'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove Look items
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully remove Look add queued success message.
				$app->enqueueMessage(JText::_('The (com_demo.look) type alias was removed from the <b>#__contentitem_tag_map</b> table'));
			}

			// Remove Look items from the ucm content table
			$look_condition = array( $db->quoteName('core_type_alias') . ' = ' . $db->quote('com_demo.look') );
			// Create a new query object.
			$query = $db->getQuery(true);
			$query->delete($db->quoteName('#__ucm_content'));
			$query->where($look_condition);
			$db->setQuery($query);
			// Execute the query to remove Look items
			$look_done = $db->execute();
			if ($look_done)
			{
				// If successfully removed Look add queued success message.
				$app->enqueueMessage(JText::_('The (com_demo.look) type alias was removed from the <b>#__ucm_content</b> table'));
			}

			// Make sure that all the Look items are cleared from DB
			foreach ($look_ids as $look_id)
			{
				// Remove Look items from the ucm base table
				$look_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $look_id);
				// Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_base'));
				$query->where($look_condition);
				$db->setQuery($query);
				// Execute the query to remove Look items
				$db->execute();

				// Remove Look items from the ucm history table
				$look_condition = array( $db->quoteName('ucm_type_id') . ' = ' . $look_id);
				// Create a new query object.
				$query = $db->getQuery(true);
				$query->delete($db->quoteName('#__ucm_history'));
				$query->where($look_condition);
				$db->setQuery($query);
				// Execute the query to remove Look items
				$db->execute();
			}
		}

		// If All related items was removed queued success message.
		$app->enqueueMessage(JText::_('All related items was removed from the <b>#__ucm_base</b> table'));
		$app->enqueueMessage(JText::_('All related items was removed from the <b>#__ucm_history</b> table'));

		// Remove demo assets from the assets table
		$demo_condition = array( $db->quoteName('name') . ' LIKE ' . $db->quote('com_demo%') );

		// Create a new query object.
		$query = $db->getQuery(true);
		$query->delete($db->quoteName('#__assets'));
		$query->where($demo_condition);
		$db->setQuery($query);
		$look_done = $db->execute();
		if ($look_done)
		{
			// If successfully removed demo add queued success message.
			$app->enqueueMessage(JText::_('All related items was removed from the <b>#__assets</b> table'));
		}

		// Get the biggest rule column in the assets table at this point.
		$get_rule_length = "SELECT CHAR_LENGTH(`rules`) as rule_size FROM #__assets ORDER BY rule_size DESC LIMIT 1";
		$db->setQuery($get_rule_length);
		if ($db->execute())
		{
			$rule_length = $db->loadResult();
			// Check the size of the rules column
			if ($rule_length < 5120)
			{
				// Revert the assets table rules column back to the default
				$revert_rule = "ALTER TABLE `#__assets` CHANGE `rules` `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.';";
				$db->setQuery($revert_rule);
				$db->execute();
				$app->enqueueMessage(JText::_('Reverted the <b>#__assets</b> table rules column back to its default size of varchar(5120)'));
			}
			else
			{

				$app->enqueueMessage(JText::_('Could not revert the <b>#__assets</b> table rules column back to its default size of varchar(5120), since there is still one or more components that still requires the column to be larger.'));
			}
		}

		// Set db if not set already.
		if (!isset($db))
		{
			$db = JFactory::getDbo();
		}
		// Set app if not set already.
		if (!isset($app))
		{
			$app = JFactory::getApplication();
		}
		// Remove Demo from the action_logs_extensions table
		$demo_action_logs_extensions = array( $db->quoteName('extension') . ' = ' . $db->quote('com_demo') );
		// Create a new query object.
		$query = $db->getQuery(true);
		$query->delete($db->quoteName('#__action_logs_extensions'));
		$query->where($demo_action_logs_extensions);
		$db->setQuery($query);
		// Execute the query to remove Demo
		$demo_removed_done = $db->execute();
		if ($demo_removed_done)
		{
			// If successfully remove Demo add queued success message.
			$app->enqueueMessage(JText::_('The com_demo extension was removed from the <b>#__action_logs_extensions</b> table'));
		}

		// Set db if not set already.
		if (!isset($db))
		{
			$db = JFactory::getDbo();
		}
		// Set app if not set already.
		if (!isset($app))
		{
			$app = JFactory::getApplication();
		}
		// Remove Demo Look from the action_log_config table
		$look_action_log_config = array( $db->quoteName('type_alias') . ' = '. $db->quote('com_demo.look') );
		// Create a new query object.
		$query = $db->getQuery(true);
		$query->delete($db->quoteName('#__action_log_config'));
		$query->where($look_action_log_config);
		$db->setQuery($query);
		// Execute the query to remove com_demo.look
		$look_action_log_config_done = $db->execute();
		if ($look_action_log_config_done)
		{
			// If successfully removed Demo Look add queued success message.
			$app->enqueueMessage(JText::_('The com_demo.look type alias was removed from the <b>#__action_log_config</b> table'));
		}
		// little notice as after service, in case of bad experience with component.
		echo '<h2>Did something go wrong? Are you disappointed?</h2>
		<p>Please let me know at <a href="mailto:joomla@vdm.io">joomla@vdm.io</a>.
		<br />We at Vast Development Method are committed to building extensions that performs proficiently! You can help us, really!
		<br />Send me your thoughts on improvements that is needed, trust me, I will be very grateful!
		<br />Visit us at <a href="https://www.vdm.io/" target="_blank">https://www.vdm.io/</a> today!</p>';
	}

	/**
	 * Called on update
	 *
	 * @param   ComponentAdapter  $parent  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function update(ComponentAdapter $parent){}

	/**
	 * Called before any type of action
	 *
	 * @param   string  $type  Which action is happening (install|uninstall|discover_install|update)
	 * @param   ComponentAdapter  $parent  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function preflight($type, ComponentAdapter $parent)
	{
		// get application
		$app = JFactory::getApplication();
		// is redundant or so it seems ...hmmm let me know if it works again
		if ($type === 'uninstall')
		{
			return true;
		}
		// the default for both install and update
		$jversion = new JVersion();
		if (!$jversion->isCompatible('3.8.0'))
		{
			$app->enqueueMessage('Please upgrade to at least Joomla! 3.8.0 before continuing!', 'error');
			return false;
		}
		// do any updates needed
		if ($type === 'update')
		{
		}
		// do any install needed
		if ($type === 'install')
		{
		}
		// check if the PHPExcel stuff is still around
		if (File::exists(JPATH_ADMINISTRATOR . '/components/com_demo/helpers/PHPExcel.php'))
		{
			// We need to remove this old PHPExcel folder
			$this->removeFolder(JPATH_ADMINISTRATOR . '/components/com_demo/helpers/PHPExcel');
			// We need to remove this old PHPExcel file
			File::delete(JPATH_ADMINISTRATOR . '/components/com_demo/helpers/PHPExcel.php');
		}
		return true;
	}

	/**
	 * Called after any type of action
	 *
	 * @param   string  $type  Which action is happening (install|uninstall|discover_install|update)
	 * @param   ComponentAdapter  $parent  The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function postflight($type, ComponentAdapter $parent)
	{
		// get application
		$app = JFactory::getApplication();
		// We check if we have dynamic folders to copy
		$this->setDynamicF0ld3rs($app, $parent);
		// set the default component settings
		if ($type === 'install')
		{

			// Get The Database object
			$db = JFactory::getDbo();

			// Create the look content type object.
			$look = new stdClass();
			$look->type_title = 'Demo Look';
			$look->type_alias = 'com_demo.look';
			$look->table = '{"special": {"dbtable": "#__demo_look","key": "id","type": "Look","prefix": "demoTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$look->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","description":"description","website":"website","image":"image","dateofbirth":"dateofbirth","mobile_phone":"mobile_phone","email":"email","add":"add","alias":"alias"}}';
			$look->router = 'DemoHelperRoute::getLookRoute';
			$look->content_history_options = '{"formFile": "administrator/components/com_demo/models/forms/look.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","add"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// Set the object into the content types table.
			$look_Inserted = $db->insertObject('#__content_types', $look);


			// Install the global extenstion assets permission.
			$query = $db->getQuery(true);
			// Field to update.
			$fields = array(
				$db->quoteName('rules') . ' = ' . $db->quote('{"site.looks.access":{"1":1}}'),
			);
			// Condition.
			$conditions = array(
				$db->quoteName('name') . ' = ' . $db->quote('com_demo')
			);
			$query->update($db->quoteName('#__assets'))->set($fields)->where($conditions);
			$db->setQuery($query);
			$allDone = $db->execute();

			// Install the global extension params.
			$query = $db->getQuery(true);
			// Field to update.
			$fields = array(
				$db->quoteName('params') . ' = ' . $db->quote('{"autorName":"Llewellyn van der Merwe","autorEmail":"joomla@vdm.io","check_in":"-1 day","save_history":"1","history_limit":"10","uikit_load":"1","uikit_min":"","uikit_style":""}'),
			);
			// Condition.
			$conditions = array(
				$db->quoteName('element') . ' = ' . $db->quote('com_demo')
			);
			$query->update($db->quoteName('#__extensions'))->set($fields)->where($conditions);
			$db->setQuery($query);
			$allDone = $db->execute();


		// Get Application object
		$app = JFactory::getApplication();
		$app->enqueueMessage('This is a demo component developed in <a href="http://vdm.bz/component-builder" taget="_balnk" title="Joomla Component Builder">JCB</a>! You can build more components like this with JCB, checkout our page on <a href="https://github.com/vdm-io/Joomla-Component-Builder" taget="_balnk" title="Joomla Component Builder">github</a> for more info. The future of <a href="http://vdm.bz/component-builder" taget="_balnk" title="Joomla Component Builder">Joomla Component Development</a> is Here!', 'Info');
			// Get the biggest rule column in the assets table at this point.
			$get_rule_length = "SELECT CHAR_LENGTH(`rules`) as rule_size FROM #__assets ORDER BY rule_size DESC LIMIT 1";
			$db->setQuery($get_rule_length);
			if ($db->execute())
			{
				$rule_length = $db->loadResult();
				// Check the size of the rules column
				if ($rule_length <= 5600)
				{
					// Fix the assets table rules column size
					$fix_rules_size = "ALTER TABLE `#__assets` CHANGE `rules` `rules` TEXT NOT NULL COMMENT 'JSON encoded access control. Enlarged to TEXT by JCB';";
					$db->setQuery($fix_rules_size);
					$db->execute();
					$app->enqueueMessage(JText::_('The <b>#__assets</b> table rules column was resized to the TEXT datatype for the components possible large permission rules.'));
				}
			}
			echo '<a target="_blank" href="https://www.vdm.io/" title="Demo">
				<img src="components/com_demo/assets/images/vdm-component.jpg"/>
				</a>';

			// Set db if not set already.
			if (!isset($db))
			{
				$db = JFactory::getDbo();
			}
			// Create the demo action logs extensions object.
			$demo_action_logs_extensions = new stdClass();
			$demo_action_logs_extensions->extension = 'com_demo';

			// Set the object into the action logs extensions table.
			$demo_action_logs_extensions_Inserted = $db->insertObject('#__action_logs_extensions', $demo_action_logs_extensions);

			// Set db if not set already.
			if (!isset($db))
			{
				$db = JFactory::getDbo();
			}
			// Create the look action log config object.
			$look_action_log_config = new stdClass();
			$look_action_log_config->type_title = 'LOOK';
			$look_action_log_config->type_alias = 'com_demo.look';
			$look_action_log_config->id_holder = 'id';
			$look_action_log_config->title_holder = 'name';
			$look_action_log_config->table_name = '#__demo_look';
			$look_action_log_config->text_prefix = 'COM_DEMO';

			// Set the object into the action log config table.
			$look_Inserted = $db->insertObject('#__action_log_config', $look_action_log_config);
		}
		// do any updates needed
		if ($type === 'update')
		{

			// Get The Database object
			$db = JFactory::getDbo();

			// Create the look content type object.
			$look = new stdClass();
			$look->type_title = 'Demo Look';
			$look->type_alias = 'com_demo.look';
			$look->table = '{"special": {"dbtable": "#__demo_look","key": "id","type": "Look","prefix": "demoTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$look->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","description":"description","website":"website","image":"image","dateofbirth":"dateofbirth","mobile_phone":"mobile_phone","email":"email","add":"add","alias":"alias"}}';
			$look->router = 'DemoHelperRoute::getLookRoute';
			$look->content_history_options = '{"formFile": "administrator/components/com_demo/models/forms/look.xml","hideFields": ["asset_id","checked_out","checked_out_time","version"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","add"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// Check if look type is already in content_type DB.
			$look_id = null;
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('type_id')));
			$query->from($db->quoteName('#__content_types'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($look->type_alias));
			$db->setQuery($query);
			$db->execute();

			// Set the object into the content types table.
			if ($db->getNumRows())
			{
				$look->type_id = $db->loadResult();
				$look_Updated = $db->updateObject('#__content_types', $look, 'type_id');
			}
			else
			{
				$look_Inserted = $db->insertObject('#__content_types', $look);
			}


			echo '<a target="_blank" href="https://www.vdm.io/" title="Demo">
				<img src="components/com_demo/assets/images/vdm-component.jpg"/>
				</a>
				<h3>Upgrade to Version 2.1.0 Was Successful! Let us know if anything is not working as expected.</h3>';

			// Set db if not set already.
			if (!isset($db))
			{
				$db = JFactory::getDbo();
			}
			// Create the demo action logs extensions object.
			$demo_action_logs_extensions = new stdClass();
			$demo_action_logs_extensions->extension = 'com_demo';

			// Check if demo action log extension is already in action logs extensions DB.
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('id')));
			$query->from($db->quoteName('#__action_logs_extensions'));
			$query->where($db->quoteName('extension') . ' LIKE '. $db->quote($demo_action_logs_extensions->extension));
			$db->setQuery($query);
			$db->execute();

			// Set the object into the action logs extensions table if not found.
			if (!$db->getNumRows())
			{
				$demo_action_logs_extensions_Inserted = $db->insertObject('#__action_logs_extensions', $demo_action_logs_extensions);
			}

			// Set db if not set already.
			if (!isset($db))
			{
				$db = JFactory::getDbo();
			}
			// Create the look action log config object.
			$look_action_log_config = new stdClass();
			$look_action_log_config->id = null;
			$look_action_log_config->type_title = 'LOOK';
			$look_action_log_config->type_alias = 'com_demo.look';
			$look_action_log_config->id_holder = 'id';
			$look_action_log_config->title_holder = 'name';
			$look_action_log_config->table_name = '#__demo_look';
			$look_action_log_config->text_prefix = 'COM_DEMO';

			// Check if look action log config is already in action_log_config DB.
			$query = $db->getQuery(true);
			$query->select($db->quoteName(array('id')));
			$query->from($db->quoteName('#__action_log_config'));
			$query->where($db->quoteName('type_alias') . ' LIKE '. $db->quote($look_action_log_config->type_alias));
			$db->setQuery($query);
			$db->execute();

			// Set the object into the content types table.
			if ($db->getNumRows())
			{
				$look_action_log_config->id = $db->loadResult();
				$look_action_log_config_Updated = $db->updateObject('#__action_log_config', $look_action_log_config, 'id');
			}
			else
			{
				$look_action_log_config_Inserted = $db->insertObject('#__action_log_config', $look_action_log_config);
			}
		}
		return true;
	}

	/**
	 * Remove folders with files
	 * 
	 * @param   string   $dir     The path to folder to remove
	 * @param   boolean  $ignore  The folders and files to ignore and not remove
	 *
	 * @return  boolean   True in all is removed
	 * 
	 */
	protected function removeFolder($dir, $ignore = false)
	{
		if (Folder::exists($dir))
		{
			$it = new RecursiveDirectoryIterator($dir);
			$it = new RecursiveIteratorIterator($it, RecursiveIteratorIterator::CHILD_FIRST);
			// remove ending /
			$dir = rtrim($dir, '/');
			// now loop the files & folders
			foreach ($it as $file)
			{
				if ('.' === $file->getBasename() || '..' ===  $file->getBasename()) continue;
				// set file dir
				$file_dir = $file->getPathname();
				// check if this is a dir or a file
				if ($file->isDir())
				{
					$keeper = false;
					if ($this->checkArray($ignore))
					{
						foreach ($ignore as $keep)
						{
							if (strpos($file_dir, $dir.'/'.$keep) !== false)
							{
								$keeper = true;
							}
						}
					}
					if ($keeper)
					{
						continue;
					}
					Folder::delete($file_dir);
				}
				else
				{
					$keeper = false;
					if ($this->checkArray($ignore))
					{
						foreach ($ignore as $keep)
						{
							if (strpos($file_dir, $dir.'/'.$keep) !== false)
							{
								$keeper = true;
							}
						}
					}
					if ($keeper)
					{
						continue;
					}
					File::delete($file_dir);
				}
			}
			// delete the root folder if not ignore found
			if (!$this->checkArray($ignore))
			{
				return Folder::delete($dir);
			}
			return true;
		}
		return false;
	}

	/**
	 * Check if have an array with a length
	 *
	 * @input	array   The array to check
	 *
	 * @returns bool/int  number of items in array on success
	 */
	protected function checkArray($array, $removeEmptyString = false)
	{
		if (isset($array) && is_array($array) && ($nr = count((array)$array)) > 0)
		{
			// also make sure the empty strings are removed
			if ($removeEmptyString)
			{
				foreach ($array as $key => $string)
				{
					if (empty($string))
					{
						unset($array[$key]);
					}
				}
				return $this->checkArray($array, false);
			}
			return $nr;
		}
		return false;
	}

	/**
	 * Method to set/copy dynamic folders into place (use with caution)
	 *
	 * @return void
	 */
	protected function setDynamicF0ld3rs($app, $parent)
	{
		// get the instalation path
		$installer = $parent->getParent();
		$installPath = $installer->getPath('source');
		// get all the folders
		$folders = Folder::folders($installPath);
		// check if we have folders we may want to copy
		$doNotCopy = array('media','admin','site'); // Joomla already deals with these
		if (count((array) $folders) > 1)
		{
			foreach ($folders as $folder)
			{
				// Only copy if not a standard folders
				if (!in_array($folder, $doNotCopy))
				{
					// set the source path
					$src = $installPath.'/'.$folder;
					// set the destination path
					$dest = JPATH_ROOT.'/'.$folder;
					// now try to copy the folder
					if (!Folder::copy($src, $dest, '', true))
					{
						$app->enqueueMessage('Could not copy '.$folder.' folder into place, please make sure destination is writable!', 'error');
					}
				}
			}
		}
	}
}
