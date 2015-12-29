/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			29th December, 2015
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
jform_hCmROoyRik_required = false;
jform_SPnilgyKTR_required = false;
jform_qYufgfpRHo_required = false;
jform_pMRKFEUXwb_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_qNsMhBK = jQuery("#jform_location input[type='radio']:checked").val();
	qNsMhBK(location_qNsMhBK);

	var location_gFpJuTv = jQuery("#jform_location input[type='radio']:checked").val();
	gFpJuTv(location_gFpJuTv);

	var type_hCmROoy = jQuery("#jform_type").val();
	hCmROoy(type_hCmROoy);

	var type_SPnilgy = jQuery("#jform_type").val();
	SPnilgy(type_SPnilgy);

	var type_qYufgfp = jQuery("#jform_type").val();
	qYufgfp(type_qYufgfp);

	var target_pMRKFEU = jQuery("#jform_target input[type='radio']:checked").val();
	pMRKFEU(target_pMRKFEU);
});

// the qNsMhBK function
function qNsMhBK(location_qNsMhBK)
{
	// set the function logic
	if (location_qNsMhBK == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the gFpJuTv function
function gFpJuTv(location_gFpJuTv)
{
	// set the function logic
	if (location_gFpJuTv == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the hCmROoy function
function hCmROoy(type_hCmROoy)
{
	if (isSet(type_hCmROoy) && type_hCmROoy.constructor !== Array)
	{
		var temp_hCmROoy = type_hCmROoy;
		var type_hCmROoy = [];
		type_hCmROoy.push(temp_hCmROoy);
	}
	else if (!isSet(type_hCmROoy))
	{
		var type_hCmROoy = [];
	}
	var type = type_hCmROoy.some(type_hCmROoy_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_hCmROoyRik_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_hCmROoyRik_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_hCmROoyRik_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_hCmROoyRik_required = true;
		}
	}
}

// the hCmROoy Some function
function type_hCmROoy_SomeFunc(type_hCmROoy)
{
	// set the function logic
	if (type_hCmROoy == 3)
	{
		return true;
	}
	return false;
}

// the SPnilgy function
function SPnilgy(type_SPnilgy)
{
	if (isSet(type_SPnilgy) && type_SPnilgy.constructor !== Array)
	{
		var temp_SPnilgy = type_SPnilgy;
		var type_SPnilgy = [];
		type_SPnilgy.push(temp_SPnilgy);
	}
	else if (!isSet(type_SPnilgy))
	{
		var type_SPnilgy = [];
	}
	var type = type_SPnilgy.some(type_SPnilgy_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_SPnilgyKTR_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_SPnilgyKTR_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_SPnilgyKTR_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_SPnilgyKTR_required = true;
		}
	}
}

// the SPnilgy Some function
function type_SPnilgy_SomeFunc(type_SPnilgy)
{
	// set the function logic
	if (type_SPnilgy == 1)
	{
		return true;
	}
	return false;
}

// the qYufgfp function
function qYufgfp(type_qYufgfp)
{
	if (isSet(type_qYufgfp) && type_qYufgfp.constructor !== Array)
	{
		var temp_qYufgfp = type_qYufgfp;
		var type_qYufgfp = [];
		type_qYufgfp.push(temp_qYufgfp);
	}
	else if (!isSet(type_qYufgfp))
	{
		var type_qYufgfp = [];
	}
	var type = type_qYufgfp.some(type_qYufgfp_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_qYufgfpRHo_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_qYufgfpRHo_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_qYufgfpRHo_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_qYufgfpRHo_required = true;
		}
	}
}

// the qYufgfp Some function
function type_qYufgfp_SomeFunc(type_qYufgfp)
{
	// set the function logic
	if (type_qYufgfp == 2)
	{
		return true;
	}
	return false;
}

// the pMRKFEU function
function pMRKFEU(target_pMRKFEU)
{
	// set the function logic
	if (target_pMRKFEU == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_pMRKFEUXwb_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_pMRKFEUXwb_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_pMRKFEUXwb_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_pMRKFEUXwb_required = true;
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
