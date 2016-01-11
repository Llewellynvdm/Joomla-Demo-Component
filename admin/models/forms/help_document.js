/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			6th January, 2016
	@created		5th August, 2015
	@package		Demo
	@subpackage		help_document.js
	@author			Llewellyn van der Merwe <https://www.vdm.io/>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
  ____  _____  _____  __  __  __      __       ___  _____  __  __  ____  _____  _  _  ____  _  _  ____ 
 (_  _)(  _  )(  _  )(  \/  )(  )    /__\     / __)(  _  )(  \/  )(  _ \(  _  )( \( )( ___)( \( )(_  _)
.-_)(   )(_)(  )(_)(  )    (  )(__  /(__)\   ( (__  )(_)(  )    (  )___/ )(_)(  )  (  )__)  )  (   )(  
\____) (_____)(_____)(_/\/\_)(____)(__)(__)   \___)(_____)(_/\/\_)(__)  (_____)(_)\_)(____)(_)\_) (__) 

/------------------------------------------------------------------------------------------------------*/

// Some Global Values
jform_UwWDUibNSG_required = false;
jform_OhjWnCSlYt_required = false;
jform_TfDWyOuWhA_required = false;
jform_vceyFYEzKq_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_doyJedc = jQuery("#jform_location input[type='radio']:checked").val();
	doyJedc(location_doyJedc);

	var location_smDxuix = jQuery("#jform_location input[type='radio']:checked").val();
	smDxuix(location_smDxuix);

	var type_UwWDUib = jQuery("#jform_type").val();
	UwWDUib(type_UwWDUib);

	var type_OhjWnCS = jQuery("#jform_type").val();
	OhjWnCS(type_OhjWnCS);

	var type_TfDWyOu = jQuery("#jform_type").val();
	TfDWyOu(type_TfDWyOu);

	var target_vceyFYE = jQuery("#jform_target input[type='radio']:checked").val();
	vceyFYE(target_vceyFYE);
});

// the doyJedc function
function doyJedc(location_doyJedc)
{
	// set the function logic
	if (location_doyJedc == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the smDxuix function
function smDxuix(location_smDxuix)
{
	// set the function logic
	if (location_smDxuix == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the UwWDUib function
function UwWDUib(type_UwWDUib)
{
	if (isSet(type_UwWDUib) && type_UwWDUib.constructor !== Array)
	{
		var temp_UwWDUib = type_UwWDUib;
		var type_UwWDUib = [];
		type_UwWDUib.push(temp_UwWDUib);
	}
	else if (!isSet(type_UwWDUib))
	{
		var type_UwWDUib = [];
	}
	var type = type_UwWDUib.some(type_UwWDUib_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_UwWDUibNSG_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_UwWDUibNSG_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_UwWDUibNSG_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_UwWDUibNSG_required = true;
		}
	}
}

// the UwWDUib Some function
function type_UwWDUib_SomeFunc(type_UwWDUib)
{
	// set the function logic
	if (type_UwWDUib == 3)
	{
		return true;
	}
	return false;
}

// the OhjWnCS function
function OhjWnCS(type_OhjWnCS)
{
	if (isSet(type_OhjWnCS) && type_OhjWnCS.constructor !== Array)
	{
		var temp_OhjWnCS = type_OhjWnCS;
		var type_OhjWnCS = [];
		type_OhjWnCS.push(temp_OhjWnCS);
	}
	else if (!isSet(type_OhjWnCS))
	{
		var type_OhjWnCS = [];
	}
	var type = type_OhjWnCS.some(type_OhjWnCS_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_OhjWnCSlYt_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_OhjWnCSlYt_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_OhjWnCSlYt_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_OhjWnCSlYt_required = true;
		}
	}
}

// the OhjWnCS Some function
function type_OhjWnCS_SomeFunc(type_OhjWnCS)
{
	// set the function logic
	if (type_OhjWnCS == 1)
	{
		return true;
	}
	return false;
}

// the TfDWyOu function
function TfDWyOu(type_TfDWyOu)
{
	if (isSet(type_TfDWyOu) && type_TfDWyOu.constructor !== Array)
	{
		var temp_TfDWyOu = type_TfDWyOu;
		var type_TfDWyOu = [];
		type_TfDWyOu.push(temp_TfDWyOu);
	}
	else if (!isSet(type_TfDWyOu))
	{
		var type_TfDWyOu = [];
	}
	var type = type_TfDWyOu.some(type_TfDWyOu_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_TfDWyOuWhA_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_TfDWyOuWhA_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_TfDWyOuWhA_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_TfDWyOuWhA_required = true;
		}
	}
}

// the TfDWyOu Some function
function type_TfDWyOu_SomeFunc(type_TfDWyOu)
{
	// set the function logic
	if (type_TfDWyOu == 2)
	{
		return true;
	}
	return false;
}

// the vceyFYE function
function vceyFYE(target_vceyFYE)
{
	// set the function logic
	if (target_vceyFYE == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_vceyFYEzKq_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_vceyFYEzKq_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_vceyFYEzKq_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_vceyFYEzKq_required = true;
		}
	}
}

// update required fields
function updateFieldRequired(name,status)
{
	var not_required = jQuery('#jform_not_required').val();

	if(status == 1)
	{
		if (isSet(not_required) && not_required != 0)
		{
			not_required = not_required+','+name;
		}
		else
		{
			not_required = ','+name;
		}
	}
	else
	{
		if (isSet(not_required) && not_required != 0)
		{
			not_required = not_required.replace(','+name,'');
		}
	}

	jQuery('#jform_not_required').val(not_required);
}

// the isSet function
function isSet(val)
{
	if ((val != undefined) && (val != null) && 0 !== val.length){
		return true;
	}
	return false;
} 
