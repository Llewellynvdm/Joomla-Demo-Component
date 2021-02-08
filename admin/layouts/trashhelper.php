<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.3
	@build			8th February, 2021
	@created		18th October, 2016
	@package		Demo
	@subpackage		trashhelper.php
	@author			Llewellyn van der Merwe <https://www.vdm.io/>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
  ____  _____  _____  __  __  __      __       ___  _____  __  __  ____  _____  _  _  ____  _  _  ____ 
 (_  _)(  _  )(  _  )(  \/  )(  )    /__\     / __)(  _  )(  \/  )(  _ \(  _  )( \( )( ___)( \( )(_  _)
.-_)(   )(_)(  )(_)(  )    (  )(__  /(__)\   ( (__  )(_)(  )    (  )___/ )(_)(  )  (  )__)  )  (   )(  
\____) (_____)(_____)(_/\/\_)(____)(__)(__)   \___)(_____)(_/\/\_)(__)  (_____)(_)\_)(____)(_)\_) (__) 

/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('JPATH_BASE') or die('Restricted access');



?>
<?php if ($displayData->state->get('filter.published') == -2 && ($displayData->canState && $displayData->canDelete)) : ?>
	<script>
		// change the class of the delete button
		jQuery("#toolbar-delete button").toggleClass("btn-danger");
		// function to empty the trash
		function emptyTrash() {
			if (document.adminForm.boxchecked.value == 0) {
				// select all the items visable
				document.adminForm.elements['checkall-toggle'].checked=1;
				Joomla.checkAll(document.adminForm.elements['checkall-toggle']);
				// check to confirm the deletion
				if(confirm('<?= JText::_("COM_DEMO_ARE_YOU_SURE_YOU_WANT_TO_DELETE_CONFIRMING_WILL_PERMANENTLY_DELETE_THE_SELECTED_ITEMS") ?>')) {
					Joomla.submitbutton('<?= $displayData->get("name") ?>.delete');
				} else {
					document.adminForm.elements['checkall-toggle'].checked=0;
					Joomla.checkAll(document.adminForm.elements['checkall-toggle']);
				}
			} else {
				// confirm deletion of those selected
				if (confirm('<?= JText::_("COM_DEMO_ARE_YOU_SURE_YOU_WANT_TO_DELETE_CONFIRMING_WILL_PERMANENTLY_DELETE_THE_SELECTED_ITEMS") ?>')) {
					Joomla.submitbutton('<?= $displayData->get("name") ?>.delete');
				};
			}
			return false;
		}
		// function to exit the tash state
		function exitTrash() {
			document.adminForm.filter_published.selectedIndex = 0;
			document.adminForm.submit();
			return false;
		}
	</script>
	<div class="alert alert-error">
		<?php if (empty($displayData->items)): ?>
			<h4 class="alert-heading">
				<span class="icon-trash"></span>
				<?= JText::_("COM_DEMO_TRASH_AREA") ?>
			</h4>
			<p><?= JText::_("COM_DEMO_YOU_ARE_CURRENTLY_VIEWING_THE_TRASH_AREA_AND_YOU_DONT_HAVE_ANY_ITEMS_IN_TRASH_AT_THE_MOMENT") ?></p>
		<?php else: ?>
			<h4 class="alert-heading">
				<span class="icon-trash"></span>
				<?= JText::_("COM_DEMO_TRASHED_ITEMS") ?>
			</h4>
			<p><?= JText::_("COM_DEMO_YOU_ARE_CURRENTLY_VIEWING_THE_TRASHED_ITEMS") ?></p>
			<button onclick="emptyTrash();" class="btn btn-small btn-danger">
				<span class="icon-delete" aria-hidden="true"></span>
				<?= JText::_("COM_DEMO_EMPTY_TRASH") ?>
			</button>
		<?php endif; ?>
		<button onclick="exitTrash();" class="btn btn-small">
			<span class="icon-back" aria-hidden="true"></span>
			<?= JText::_("COM_DEMO_EXIT_TRASH") ?>
		</button>
	</div>
<?php endif; ?>
