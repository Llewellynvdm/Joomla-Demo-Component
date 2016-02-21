/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			21st February, 2016
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
jform_rFatqiXZFW_required = false;
jform_HAWbtQeCUi_required = false;
jform_OpisjiAVIQ_required = false;
jform_dZCesMspHY_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_befnCXD = jQuery("#jform_location input[type='radio']:checked").val();
	befnCXD(location_befnCXD);

	var location_RcmOskk = jQuery("#jform_location input[type='radio']:checked").val();
	RcmOskk(location_RcmOskk);

	var type_rFatqiX = jQuery("#jform_type").val();
	rFatqiX(type_rFatqiX);

	var type_HAWbtQe = jQuery("#jform_type").val();
	HAWbtQe(type_HAWbtQe);

	var type_OpisjiA = jQuery("#jform_type").val();
	OpisjiA(type_OpisjiA);

	var target_dZCesMs = jQuery("#jform_target input[type='radio']:checked").val();
	dZCesMs(target_dZCesMs);
});

// the befnCXD function
function befnCXD(location_befnCXD)
{
	// set the function logic
	if (location_befnCXD == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the RcmOskk function
function RcmOskk(location_RcmOskk)
{
	// set the function logic
	if (location_RcmOskk == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the rFatqiX function
function rFatqiX(type_rFatqiX)
{
	if (isSet(type_rFatqiX) && type_rFatqiX.constructor !== Array)
	{
		var temp_rFatqiX = type_rFatqiX;
		var type_rFatqiX = [];
		type_rFatqiX.push(temp_rFatqiX);
	}
	else if (!isSet(type_rFatqiX))
	{
		var type_rFatqiX = [];
	}
	var type = type_rFatqiX.some(type_rFatqiX_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_rFatqiXZFW_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_rFatqiXZFW_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_rFatqiXZFW_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_rFatqiXZFW_required = true;
		}
	}
}

// the rFatqiX Some function
function type_rFatqiX_SomeFunc(type_rFatqiX)
{
	// set the function logic
	if (type_rFatqiX == 3)
	{
		return true;
	}
	return false;
}

// the HAWbtQe function
function HAWbtQe(type_HAWbtQe)
{
	if (isSet(type_HAWbtQe) && type_HAWbtQe.constructor !== Array)
	{
		var temp_HAWbtQe = type_HAWbtQe;
		var type_HAWbtQe = [];
		type_HAWbtQe.push(temp_HAWbtQe);
	}
	else if (!isSet(type_HAWbtQe))
	{
		var type_HAWbtQe = [];
	}
	var type = type_HAWbtQe.some(type_HAWbtQe_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_HAWbtQeCUi_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_HAWbtQeCUi_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_HAWbtQeCUi_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_HAWbtQeCUi_required = true;
		}
	}
}

// the HAWbtQe Some function
function type_HAWbtQe_SomeFunc(type_HAWbtQe)
{
	// set the function logic
	if (type_HAWbtQe == 1)
	{
		return true;
	}
	return false;
}

// the OpisjiA function
function OpisjiA(type_OpisjiA)
{
	if (isSet(type_OpisjiA) && type_OpisjiA.constructor !== Array)
	{
		var temp_OpisjiA = type_OpisjiA;
		var type_OpisjiA = [];
		type_OpisjiA.push(temp_OpisjiA);
	}
	else if (!isSet(type_OpisjiA))
	{
		var type_OpisjiA = [];
	}
	var type = type_OpisjiA.some(type_OpisjiA_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_OpisjiAVIQ_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_OpisjiAVIQ_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_OpisjiAVIQ_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_OpisjiAVIQ_required = true;
		}
	}
}

// the OpisjiA Some function
function type_OpisjiA_SomeFunc(type_OpisjiA)
{
	// set the function logic
	if (type_OpisjiA == 2)
	{
		return true;
	}
	return false;
}

// the dZCesMs function
function dZCesMs(target_dZCesMs)
{
	// set the function logic
	if (target_dZCesMs == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_dZCesMspHY_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_dZCesMspHY_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_dZCesMspHY_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_dZCesMspHY_required = true;
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
