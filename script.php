<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.0
	@build			23rd April, 2019
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

JHTML::_('behavior.modal');

/**
 * Script File of Demo Component
 */
class com_demoInstallerScript
{
	/**
	 * method to install the component
	 *
	 * @return void
	 */
	function install($parent)
	{

	}

	/**
	 * method to uninstall the component
	 *
	 * @return void
	 */
	function uninstall($parent)
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
				// If succesfully remove look add queued success message.
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
				// If succesfully remove look add queued success message.
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
				// If succesfully remove look add queued success message.
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
				// If succesfully remove look add queued success message.
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
				// If succesfully remove look add queued success message.
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
				// If succesfully remove look add queued success message.
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
				// If succesfully remove Look add queued success message.
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
				// If succesfully remove Look add queued success message.
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
				// If succesfully remove Look add queued success message.
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
			// If succesfully remove demo add queued success message.
			$app->enqueueMessage(JText::_('All related items was removed from the <b>#__assets</b> table'));
		}

		// little notice as after service, in case of bad experience with component.
		echo '<h2>Did something go wrong? Are you disappointed?</h2>
		<p>Please let me know at <a href="mailto:joomla@vdm.io">joomla@vdm.io</a>.
		<br />We at Vast Development Method are committed to building extensions that performs proficiently! You can help us, really!
		<br />Send me your thoughts on improvements that is needed, trust me, I will be very grateful!
		<br />Visit us at <a href="https://www.vdm.io/" target="_blank">https://www.vdm.io/</a> today!</p>';
	}

	/**
	 * method to update the component
	 *
	 * @return void
	 */
	function update($parent)
	{
		
	}

	/**
	 * method to run before an install/update/uninstall method
	 *
	 * @return void
	 */
	function preflight($type, $parent)
	{
		// get application
		$app = JFactory::getApplication();
		// is redundant ...hmmm
		if ($type == 'uninstall')
		{
			return true;
		}
		// the default for both install and update
		$jversion = new JVersion();
		if (!$jversion->isCompatible('3.6.0'))
		{
			$app->enqueueMessage('Please upgrade to at least Joomla! 3.6.0 before continuing!', 'error');
			return false;
		}
		// do any updates needed
		if ($type == 'update')
		{
		}
		// do any install needed
		if ($type == 'install')
		{
		}
	}

	/**
	 * method to run after an install/update/uninstall method
	 *
	 * @return void
	 */
	function postflight($type, $parent)
	{
		// get application
		$app = JFactory::getApplication();
		// set the default component settings
		if ($type == 'install')
		{

			// Get The Database object
			$db = JFactory::getDbo();

			// Create the look content type object.
			$look = new stdClass();
			$look->type_title = 'Demo Look';
			$look->type_alias = 'com_demo.look';
			$look->table = '{"special": {"dbtable": "#__demo_look","key": "id","type": "Look","prefix": "demoTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$look->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","description":"description","website":"website","image":"image","dateofbirth":"dateofbirth","mobile_phone":"mobile_phone","email":"email","add":"add","not_required":"not_required","alias":"alias"}}';
			$look->router = 'DemoHelperRoute::getLookRoute';
			$look->content_history_options = '{"formFile": "administrator/components/com_demo/models/forms/look.xml","hideFields": ["asset_id","checked_out","checked_out_time","version","not_required"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","add"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

			// Set the object into the content types table.
			$look_Inserted = $db->insertObject('#__content_types', $look);


			// Install the global extenstion assets permission.
			$query = $db->getQuery(true);
			// Field to update.
			$fields = array(
				$db->quoteName('rules') . ' = ' . $db->quote('{"site.looks.access":{"1":1},"site.looking.access":{"1":1}}'),
			);
			// Condition.
			$conditions = array(
				$db->quoteName('name') . ' = ' . $db->quote('com_demo')
			);
			$query->update($db->quoteName('#__assets'))->set($fields)->where($conditions);
			$db->setQuery($query);
			$allDone = $db->execute();

			// Install the global extenstion params.
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
			echo '<a target="_blank" href="https://www.vdm.io/" title="Demo">
				<img src="components/com_demo/assets/images/vdm-component.jpg"/>
				</a>';
		}
		// do any updates needed
		if ($type == 'update')
		{

			// Get The Database object
			$db = JFactory::getDbo();

			// Create the look content type object.
			$look = new stdClass();
			$look->type_title = 'Demo Look';
			$look->type_alias = 'com_demo.look';
			$look->table = '{"special": {"dbtable": "#__demo_look","key": "id","type": "Look","prefix": "demoTable","config": "array()"},"common": {"dbtable": "#__ucm_content","key": "ucm_id","type": "Corecontent","prefix": "JTable","config": "array()"}}';
			$look->field_mappings = '{"common": {"core_content_item_id": "id","core_title": "name","core_state": "published","core_alias": "alias","core_created_time": "created","core_modified_time": "modified","core_body": "null","core_hits": "hits","core_publish_up": "null","core_publish_down": "null","core_access": "access","core_params": "params","core_featured": "null","core_metadata": "metadata","core_language": "null","core_images": "null","core_urls": "null","core_version": "version","core_ordering": "ordering","core_metakey": "metakey","core_metadesc": "metadesc","core_catid": "null","core_xreference": "null","asset_id": "asset_id"},"special": {"name":"name","description":"description","website":"website","image":"image","dateofbirth":"dateofbirth","mobile_phone":"mobile_phone","email":"email","add":"add","not_required":"not_required","alias":"alias"}}';
			$look->router = 'DemoHelperRoute::getLookRoute';
			$look->content_history_options = '{"formFile": "administrator/components/com_demo/models/forms/look.xml","hideFields": ["asset_id","checked_out","checked_out_time","version","not_required"],"ignoreChanges": ["modified_by","modified","checked_out","checked_out_time","version","hits"],"convertToInt": ["published","ordering","add"],"displayLookup": [{"sourceColumn": "created_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"},{"sourceColumn": "access","targetTable": "#__viewlevels","targetColumn": "id","displayColumn": "title"},{"sourceColumn": "modified_by","targetTable": "#__users","targetColumn": "id","displayColumn": "name"}]}';

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
				<h3>Upgrade to Version 2.0.0 Was Successful! Let us know if anything is not working as expected.</h3>';
		}
	}
}
