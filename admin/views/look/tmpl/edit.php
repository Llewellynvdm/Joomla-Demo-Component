<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			21st February, 2016
	@created		5th August, 2015
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
$componentParams = JComponentHelper::getParams('com_demo');
?>

<form action="<?php echo JRoute::_('index.php?option=com_demo&layout=edit&id='.(int) $this->item->id.$this->referral); ?>" method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">

	<?php echo JLayoutHelper::render('look.details_above', $this); ?><div class="form-horizontal">

	<?php echo JHtml::_('bootstrap.startTabSet', 'lookTab', array('active' => 'details')); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'lookTab', 'details', JText::_('COM_DEMO_LOOK_DETAILS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('look.details_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('look.details_right', $this); ?>
			</div>
		</div>
	<?php echo JHtml::_('bootstrap.endTab'); ?>

	<?php echo JHtml::_('bootstrap.addTab', 'lookTab', 'repetable_numbers', JText::_('COM_DEMO_LOOK_REPETABLE_NUMBERS', true)); ?>
		<div class="row-fluid form-horizontal-desktop">
			<div class="span6">
				<?php echo JLayoutHelper::render('look.repetable_numbers_left', $this); ?>
			</div>
			<div class="span6">
				<?php echo JLayoutHelper::render('look.repetable_numbers_right', $this); ?>
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

<div class="clearfix"></div>
<?php echo JLayoutHelper::render('look.details_under', $this); ?>
</form>

<script type="text/javascript">

// #jform_name listeners for name_RVGpnBy function
jQuery('#jform_name').on('keyup',function()
{
	var name_RVGpnBy = jQuery("#jform_name").val();
	RVGpnBy(name_RVGpnBy);

});
jQuery('#adminForm').on('change', '#jform_name',function (e)
{
	e.preventDefault();
	var name_RVGpnBy = jQuery("#jform_name").val();
	RVGpnBy(name_RVGpnBy);

});

// #jform_add listeners for add_guPoHoa function
jQuery('#jform_add').on('keyup',function()
{
	var add_guPoHoa = jQuery("#jform_add input[type='radio']:checked").val();
	guPoHoa(add_guPoHoa);

});
jQuery('#adminForm').on('change', '#jform_add',function (e)
{
	e.preventDefault();
	var add_guPoHoa = jQuery("#jform_add input[type='radio']:checked").val();
	guPoHoa(add_guPoHoa);

});


jQuery('input.form-field-repeatable').on('value-update', function(e, value){
	if (value)
	{
		buildTable(value,e.currentTarget.id);
	}
});

jQuery('input.form-field-repeatable').on('row-add', function(e, row) {
	if ("jform_male" == e.currentTarget.id)
	{
		setSelection('male');
		updateSelection(row);
	}
	else if("jform_female" == e.currentTarget.id)
	{
		setSelection('female');
		updateSelection(row);
	}
});

var AgeGroup = new Array;
function setSelection(gender)
{
	AgeGroup.length = 0;
	<?php $fieldNrs = range(1,9,1); ?>
	<?php foreach($fieldNrs as $fieldNr): ?>
		// get options
		var age_<?php echo $fieldNr ?> = jQuery("#jform_"+gender+"_fields_age-<?php echo $fieldNr ?> option:selected").val();
		if (age_<?php echo $fieldNr ?>)
		{
			AgeGroup.push(age_<?php echo $fieldNr ?>);
		}
	<?php endforeach; ?>
}

</script>
