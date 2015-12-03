/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.4
	@build			3rd December, 2015
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
jform_CLxRiyFDWv_required = false;
jform_zgwHidMmGR_required = false;
jform_dapwGJswww_required = false;
jform_KfchXiEDHv_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_gvgNtFm = jQuery("#jform_location input[type='radio']:checked").val();
	gvgNtFm(location_gvgNtFm);

	var location_GxWLKer = jQuery("#jform_location input[type='radio']:checked").val();
	GxWLKer(location_GxWLKer);

	var type_CLxRiyF = jQuery("#jform_type").val();
	CLxRiyF(type_CLxRiyF);

	var type_zgwHidM = jQuery("#jform_type").val();
	zgwHidM(type_zgwHidM);

	var type_dapwGJs = jQuery("#jform_type").val();
	dapwGJs(type_dapwGJs);

	var target_KfchXiE = jQuery("#jform_target input[type='radio']:checked").val();
	KfchXiE(target_KfchXiE);
});

// the gvgNtFm function
function gvgNtFm(location_gvgNtFm)
{
	// set the function logic
	if (location_gvgNtFm == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the GxWLKer function
function GxWLKer(location_GxWLKer)
{
	// set the function logic
	if (location_GxWLKer == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the CLxRiyF function
function CLxRiyF(type_CLxRiyF)
{
	if (isSet(type_CLxRiyF) && type_CLxRiyF.constructor !== Array)
	{
		var temp_CLxRiyF = type_CLxRiyF;
		var type_CLxRiyF = [];
		type_CLxRiyF.push(temp_CLxRiyF);
	}
	else if (!isSet(type_CLxRiyF))
	{
		var type_CLxRiyF = [];
	}
	var type = type_CLxRiyF.some(type_CLxRiyF_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_CLxRiyFDWv_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_CLxRiyFDWv_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_CLxRiyFDWv_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_CLxRiyFDWv_required = true;
		}
	}
}

// the CLxRiyF Some function
function type_CLxRiyF_SomeFunc(type_CLxRiyF)
{
	// set the function logic
	if (type_CLxRiyF == 3)
	{
		return true;
	}
	return false;
}

// the zgwHidM function
function zgwHidM(type_zgwHidM)
{
	if (isSet(type_zgwHidM) && type_zgwHidM.constructor !== Array)
	{
		var temp_zgwHidM = type_zgwHidM;
		var type_zgwHidM = [];
		type_zgwHidM.push(temp_zgwHidM);
	}
	else if (!isSet(type_zgwHidM))
	{
		var type_zgwHidM = [];
	}
	var type = type_zgwHidM.some(type_zgwHidM_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_zgwHidMmGR_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_zgwHidMmGR_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_zgwHidMmGR_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_zgwHidMmGR_required = true;
		}
	}
}

// the zgwHidM Some function
function type_zgwHidM_SomeFunc(type_zgwHidM)
{
	// set the function logic
	if (type_zgwHidM == 1)
	{
		return true;
	}
	return false;
}

// the dapwGJs function
function dapwGJs(type_dapwGJs)
{
	if (isSet(type_dapwGJs) && type_dapwGJs.constructor !== Array)
	{
		var temp_dapwGJs = type_dapwGJs;
		var type_dapwGJs = [];
		type_dapwGJs.push(temp_dapwGJs);
	}
	else if (!isSet(type_dapwGJs))
	{
		var type_dapwGJs = [];
	}
	var type = type_dapwGJs.some(type_dapwGJs_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_dapwGJswww_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_dapwGJswww_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_dapwGJswww_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_dapwGJswww_required = true;
		}
	}
}

// the dapwGJs Some function
function type_dapwGJs_SomeFunc(type_dapwGJs)
{
	// set the function logic
	if (type_dapwGJs == 2)
	{
		return true;
	}
	return false;
}

// the KfchXiE function
function KfchXiE(target_KfchXiE)
{
	// set the function logic
	if (target_KfchXiE == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_KfchXiEDHv_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_KfchXiEDHv_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_KfchXiEDHv_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_KfchXiEDHv_required = true;
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
