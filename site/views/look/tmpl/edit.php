<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.0
	@build			24th April, 2018
	@created		18th October, 2016
	@package		Demo
	@subpackage		edit.php
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

JHtml::addIncludePath(JPATH_COMPONENT.'/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.tabstate');
JHtml::_('behavior.calendar');
$componentParams = JComponentHelper::getParams('com_demo');
?>
<?php echo $this->toolbar->render(); ?>
<form action="<?php echo JRoute::_('index.php?option=com_demo&layout=edit&id='.(int) $this->item->id.$this->referral); ?>" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">

	<?php echo JLayoutHelper::render('look.details_above', $this); ?>
<div class="form-horizontal">

	<?php echo JHtml::_('bootstrap.startTabSet', 'lookTab', array('active' => 'details')); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'lookTab', 'details', JText::_('COM_DEMO_LOOK_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
		</div>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<?php echo JLayoutHelper::render('look.details_fullwidth', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'lookTab', 'more', JText::_('COM_DEMO_LOOK_MORE', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('look.more_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('look.more_right', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php if ($this->canDo->get('look.delete') || $this->canDo->get('look.edit.created_by') || $this->canDo->get('look.edit.state') || $this->canDo->get('look.edit.created')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'lookTab', 'publishing', JText::_('COM_DEMO_LOOK_PUBLISHING', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('look.publishing', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('look.metadata', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php if ($this->canDo->get('core.admin')) : ?>
	<?php echo JHtml::_('bootstrap.addTab', 'lookTab', 'permissions', JText::_('COM_DEMO_LOOK_PERMISSION', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span12">
				<fieldset class="adminform">
					<div class="adminformlist">
					<?php foreach ($this->form->getFieldset('accesscontrol') as $field): ?>
						<div>
							<?php echo $field->label; echo $field->input;?>
						</div>
						<div class="clearfix"></div>
					<?php endforeach; ?>
					</div>
				</fieldset>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>
	<?php endif; ?>

	<?php echo JHtml::_('bootstrap.endTabSet'); ?>

	<div>
		<input type="hidden" name="task" value="look.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
	</div>
</div>

<div class="clearfix"></div>
<?php echo JLayoutHelper::render('look.details_under', $this); ?>
</form>

<script type="text/javascript">

// #jform_add listeners for add_vvvvvvv function
jQuery('#jform_add').on('keyup',function()
{
	var add_vvvvvvv = jQuery("#jform_add input[type='radio']:checked").val();
	vvvvvvv(add_vvvvvvv);

});
jQuery('#adminForm').on('change', '#jform_add',function (e)
{
	e.preventDefault();
	var add_vvvvvvv = jQuery("#jform_add input[type='radio']:checked").val();
	vvvvvvv(add_vvvvvvv);

});

</script>
