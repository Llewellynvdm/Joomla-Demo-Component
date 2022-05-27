/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.1.0
	@build			27th May, 2022
	@created		18th October, 2016
	@package		Demo
	@subpackage		look.js
	@author			Llewellyn van der Merwe <https://www.vdm.io/>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
  ____  _____  _____  __  __  __      __       ___  _____  __  __  ____  _____  _  _  ____  _  _  ____ 
 (_  _)(  _  )(  _  )(  \/  )(  )    /__\     / __)(  _  )(  \/  )(  _ \(  _  )( \( )( ___)( \( )(_  _)
.-_)(   )(_)(  )(_)(  )    (  )(__  /(__)\   ( (__  )(_)(  )    (  )___/ )(_)(  )  (  )__)  )  (   )(  
\____) (_____)(_____)(_/\/\_)(____)(__)(__)   \___)(_____)(_/\/\_)(__)  (_____)(_)\_)(____)(_)\_) (__) 

/------------------------------------------------------------------------------------------------------*/

// Some Global Values
jform_vvvvvvvvvv_required = false;
jform_vvvvvvvvvw_required = false;
jform_vvvvvvvvvx_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var add_vvvvvvv = jQuery("#jform_add input[type='radio']:checked").val();
	vvvvvvv(add_vvvvvvv);
});

// the vvvvvvv function
function vvvvvvv(add_vvvvvvv)
{
	// set the function logic
	if (add_vvvvvvv == 1)
	{
		jQuery('#jform_dateofbirth').closest('.control-group').show();
		// add required attribute to dateofbirth field
		if (jform_vvvvvvvvvv_required)
		{
			updateFieldRequired('dateofbirth',0);
			jQuery('#jform_dateofbirth').prop('required','required');
			jQuery('#jform_dateofbirth').attr('aria-required',true);
			jQuery('#jform_dateofbirth').addClass('required');
			jform_vvvvvvvvvv_required = false;
		}
		jQuery('#jform_email').closest('.control-group').show();
		// add required attribute to email field
		if (jform_vvvvvvvvvw_required)
		{
			updateFieldRequired('email',0);
			jQuery('#jform_email').prop('required','required');
			jQuery('#jform_email').attr('aria-required',true);
			jQuery('#jform_email').addClass('required');
			jform_vvvvvvvvvw_required = false;
		}
		jQuery('#jform_image').closest('.control-group').show();
		jQuery('#jform_mobile_phone').closest('.control-group').show();
		// add required attribute to mobile_phone field
		if (jform_vvvvvvvvvx_required)
		{
			updateFieldRequired('mobile_phone',0);
			jQuery('#jform_mobile_phone').prop('required','required');
			jQuery('#jform_mobile_phone').attr('aria-required',true);
			jQuery('#jform_mobile_phone').addClass('required');
			jform_vvvvvvvvvx_required = false;
		}
		jQuery('#jform_website').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_dateofbirth').closest('.control-group').hide();
		// remove required attribute from dateofbirth field
		if (!jform_vvvvvvvvvv_required)
		{
			updateFieldRequired('dateofbirth',1);
			jQuery('#jform_dateofbirth').removeAttr('required');
			jQuery('#jform_dateofbirth').removeAttr('aria-required');
			jQuery('#jform_dateofbirth').removeClass('required');
			jform_vvvvvvvvvv_required = true;
		}
		jQuery('#jform_email').closest('.control-group').hide();
		// remove required attribute from email field
		if (!jform_vvvvvvvvvw_required)
		{
			updateFieldRequired('email',1);
			jQuery('#jform_email').removeAttr('required');
			jQuery('#jform_email').removeAttr('aria-required');
			jQuery('#jform_email').removeClass('required');
			jform_vvvvvvvvvw_required = true;
		}
		jQuery('#jform_image').closest('.control-group').hide();
		jQuery('#jform_mobile_phone').closest('.control-group').hide();
		// remove required attribute from mobile_phone field
		if (!jform_vvvvvvvvvx_required)
		{
			updateFieldRequired('mobile_phone',1);
			jQuery('#jform_mobile_phone').removeAttr('required');
			jQuery('#jform_mobile_phone').removeAttr('aria-required');
			jQuery('#jform_mobile_phone').removeClass('required');
			jform_vvvvvvvvvx_required = true;
		}
		jQuery('#jform_website').closest('.control-group').hide();
	}
}

// update fields required
function updateFieldRequired(name, status) {
	// check if not_required exist
	if (jQuery('#jform_not_required').length > 0) {
		var not_required = jQuery('#jform_not_required').val().split(",");

		if(status == 1)
		{
			not_required.push(name);
		}
		else
		{
			not_required = removeFieldFromNotRequired(not_required, name);
		}

		jQuery('#jform_not_required').val(fixNotRequiredArray(not_required).toString());
	}
}

// remove field from not_required
function removeFieldFromNotRequired(array, what) {
	return array.filter(function(element){
		return element !== what;
	});
}

// fix not required array
function fixNotRequiredArray(array) {
	var seen = {};
	return removeEmptyFromNotRequiredArray(array).filter(function(item) {
		return seen.hasOwnProperty(item) ? false : (seen[item] = true);
	});
}

// remove empty from not_required array
function removeEmptyFromNotRequiredArray(array) {
	return array.filter(function (el) {
		// remove ( 一_一) as well - lol
		return (el.length > 0 && '一_一' !== el);
	});
}

// the isSet function
function isSet(val)
{
	if ((val != undefined) && (val != null) && 0 !== val.length){
		return true;
	}
	return false;
} 
