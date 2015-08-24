/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.3 - 24th August, 2015
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
jform_yZpGWZMghB_required = false;
jform_CGEclrjDuN_required = false;
jform_IlNsWahRYM_required = false;
jform_UqLidJhNMm_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_kWBkVYH = jQuery("#jform_location input[type='radio']:checked").val();
	kWBkVYH(location_kWBkVYH);

	var location_HqKSXxe = jQuery("#jform_location input[type='radio']:checked").val();
	HqKSXxe(location_HqKSXxe);

	var type_yZpGWZM = jQuery("#jform_type").val();
	yZpGWZM(type_yZpGWZM);

	var type_CGEclrj = jQuery("#jform_type").val();
	CGEclrj(type_CGEclrj);

	var type_IlNsWah = jQuery("#jform_type").val();
	IlNsWah(type_IlNsWah);

	var target_UqLidJh = jQuery("#jform_target input[type='radio']:checked").val();
	UqLidJh(target_UqLidJh);
});

// the kWBkVYH function
function kWBkVYH(location_kWBkVYH)
{
	// set the function logic
	if (location_kWBkVYH == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the HqKSXxe function
function HqKSXxe(location_HqKSXxe)
{
	// set the function logic
	if (location_HqKSXxe == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the yZpGWZM function
function yZpGWZM(type_yZpGWZM)
{
	if (isSet(type_yZpGWZM) && type_yZpGWZM.constructor !== Array)
	{
		var temp_yZpGWZM = type_yZpGWZM;
		var type_yZpGWZM = [];
		type_yZpGWZM.push(temp_yZpGWZM);
	}
	else if (!isSet(type_yZpGWZM))
	{
		var type_yZpGWZM = [];
	}
	var type = type_yZpGWZM.some(type_yZpGWZM_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_yZpGWZMghB_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_yZpGWZMghB_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_yZpGWZMghB_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_yZpGWZMghB_required = true;
		}
	}
}

// the yZpGWZM Some function
function type_yZpGWZM_SomeFunc(type_yZpGWZM)
{
	// set the function logic
	if (type_yZpGWZM == 3)
	{
		return true;
	}
	return false;
}

// the CGEclrj function
function CGEclrj(type_CGEclrj)
{
	if (isSet(type_CGEclrj) && type_CGEclrj.constructor !== Array)
	{
		var temp_CGEclrj = type_CGEclrj;
		var type_CGEclrj = [];
		type_CGEclrj.push(temp_CGEclrj);
	}
	else if (!isSet(type_CGEclrj))
	{
		var type_CGEclrj = [];
	}
	var type = type_CGEclrj.some(type_CGEclrj_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_CGEclrjDuN_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_CGEclrjDuN_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_CGEclrjDuN_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_CGEclrjDuN_required = true;
		}
	}
}

// the CGEclrj Some function
function type_CGEclrj_SomeFunc(type_CGEclrj)
{
	// set the function logic
	if (type_CGEclrj == 1)
	{
		return true;
	}
	return false;
}

// the IlNsWah function
function IlNsWah(type_IlNsWah)
{
	if (isSet(type_IlNsWah) && type_IlNsWah.constructor !== Array)
	{
		var temp_IlNsWah = type_IlNsWah;
		var type_IlNsWah = [];
		type_IlNsWah.push(temp_IlNsWah);
	}
	else if (!isSet(type_IlNsWah))
	{
		var type_IlNsWah = [];
	}
	var type = type_IlNsWah.some(type_IlNsWah_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_IlNsWahRYM_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_IlNsWahRYM_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_IlNsWahRYM_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_IlNsWahRYM_required = true;
		}
	}
}

// the IlNsWah Some function
function type_IlNsWah_SomeFunc(type_IlNsWah)
{
	// set the function logic
	if (type_IlNsWah == 2)
	{
		return true;
	}
	return false;
}

// the UqLidJh function
function UqLidJh(target_UqLidJh)
{
	// set the function logic
	if (target_UqLidJh == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_UqLidJhNMm_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_UqLidJhNMm_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_UqLidJhNMm_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_UqLidJhNMm_required = true;
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
