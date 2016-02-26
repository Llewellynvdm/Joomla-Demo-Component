/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			26th February, 2016
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
jform_mHaLxVHYyC_required = false;
jform_aSTTcjFsgo_required = false;
jform_PiHSAiXeZa_required = false;
jform_brAbXYXLXw_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_qXGzcva = jQuery("#jform_location input[type='radio']:checked").val();
	qXGzcva(location_qXGzcva);

	var location_rBfCTdX = jQuery("#jform_location input[type='radio']:checked").val();
	rBfCTdX(location_rBfCTdX);

	var type_mHaLxVH = jQuery("#jform_type").val();
	mHaLxVH(type_mHaLxVH);

	var type_aSTTcjF = jQuery("#jform_type").val();
	aSTTcjF(type_aSTTcjF);

	var type_PiHSAiX = jQuery("#jform_type").val();
	PiHSAiX(type_PiHSAiX);

	var target_brAbXYX = jQuery("#jform_target input[type='radio']:checked").val();
	brAbXYX(target_brAbXYX);
});

// the qXGzcva function
function qXGzcva(location_qXGzcva)
{
	// set the function logic
	if (location_qXGzcva == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the rBfCTdX function
function rBfCTdX(location_rBfCTdX)
{
	// set the function logic
	if (location_rBfCTdX == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the mHaLxVH function
function mHaLxVH(type_mHaLxVH)
{
	if (isSet(type_mHaLxVH) && type_mHaLxVH.constructor !== Array)
	{
		var temp_mHaLxVH = type_mHaLxVH;
		var type_mHaLxVH = [];
		type_mHaLxVH.push(temp_mHaLxVH);
	}
	else if (!isSet(type_mHaLxVH))
	{
		var type_mHaLxVH = [];
	}
	var type = type_mHaLxVH.some(type_mHaLxVH_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_mHaLxVHYyC_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_mHaLxVHYyC_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_mHaLxVHYyC_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_mHaLxVHYyC_required = true;
		}
	}
}

// the mHaLxVH Some function
function type_mHaLxVH_SomeFunc(type_mHaLxVH)
{
	// set the function logic
	if (type_mHaLxVH == 3)
	{
		return true;
	}
	return false;
}

// the aSTTcjF function
function aSTTcjF(type_aSTTcjF)
{
	if (isSet(type_aSTTcjF) && type_aSTTcjF.constructor !== Array)
	{
		var temp_aSTTcjF = type_aSTTcjF;
		var type_aSTTcjF = [];
		type_aSTTcjF.push(temp_aSTTcjF);
	}
	else if (!isSet(type_aSTTcjF))
	{
		var type_aSTTcjF = [];
	}
	var type = type_aSTTcjF.some(type_aSTTcjF_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_aSTTcjFsgo_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_aSTTcjFsgo_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_aSTTcjFsgo_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_aSTTcjFsgo_required = true;
		}
	}
}

// the aSTTcjF Some function
function type_aSTTcjF_SomeFunc(type_aSTTcjF)
{
	// set the function logic
	if (type_aSTTcjF == 1)
	{
		return true;
	}
	return false;
}

// the PiHSAiX function
function PiHSAiX(type_PiHSAiX)
{
	if (isSet(type_PiHSAiX) && type_PiHSAiX.constructor !== Array)
	{
		var temp_PiHSAiX = type_PiHSAiX;
		var type_PiHSAiX = [];
		type_PiHSAiX.push(temp_PiHSAiX);
	}
	else if (!isSet(type_PiHSAiX))
	{
		var type_PiHSAiX = [];
	}
	var type = type_PiHSAiX.some(type_PiHSAiX_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_PiHSAiXeZa_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_PiHSAiXeZa_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_PiHSAiXeZa_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_PiHSAiXeZa_required = true;
		}
	}
}

// the PiHSAiX Some function
function type_PiHSAiX_SomeFunc(type_PiHSAiX)
{
	// set the function logic
	if (type_PiHSAiX == 2)
	{
		return true;
	}
	return false;
}

// the brAbXYX function
function brAbXYX(target_brAbXYX)
{
	// set the function logic
	if (target_brAbXYX == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_brAbXYXLXw_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_brAbXYXLXw_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_brAbXYXLXw_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_brAbXYXLXw_required = true;
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
