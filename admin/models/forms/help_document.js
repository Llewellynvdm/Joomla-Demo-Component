/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			20th February, 2016
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
jform_KBdlcVRWwj_required = false;
jform_dweMHUwWAb_required = false;
jform_pnuDTOlQhG_required = false;
jform_dObkcfdSaH_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_uyLnUzq = jQuery("#jform_location input[type='radio']:checked").val();
	uyLnUzq(location_uyLnUzq);

	var location_ywPZpnl = jQuery("#jform_location input[type='radio']:checked").val();
	ywPZpnl(location_ywPZpnl);

	var type_KBdlcVR = jQuery("#jform_type").val();
	KBdlcVR(type_KBdlcVR);

	var type_dweMHUw = jQuery("#jform_type").val();
	dweMHUw(type_dweMHUw);

	var type_pnuDTOl = jQuery("#jform_type").val();
	pnuDTOl(type_pnuDTOl);

	var target_dObkcfd = jQuery("#jform_target input[type='radio']:checked").val();
	dObkcfd(target_dObkcfd);
});

// the uyLnUzq function
function uyLnUzq(location_uyLnUzq)
{
	// set the function logic
	if (location_uyLnUzq == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the ywPZpnl function
function ywPZpnl(location_ywPZpnl)
{
	// set the function logic
	if (location_ywPZpnl == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the KBdlcVR function
function KBdlcVR(type_KBdlcVR)
{
	if (isSet(type_KBdlcVR) && type_KBdlcVR.constructor !== Array)
	{
		var temp_KBdlcVR = type_KBdlcVR;
		var type_KBdlcVR = [];
		type_KBdlcVR.push(temp_KBdlcVR);
	}
	else if (!isSet(type_KBdlcVR))
	{
		var type_KBdlcVR = [];
	}
	var type = type_KBdlcVR.some(type_KBdlcVR_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_KBdlcVRWwj_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_KBdlcVRWwj_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_KBdlcVRWwj_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_KBdlcVRWwj_required = true;
		}
	}
}

// the KBdlcVR Some function
function type_KBdlcVR_SomeFunc(type_KBdlcVR)
{
	// set the function logic
	if (type_KBdlcVR == 3)
	{
		return true;
	}
	return false;
}

// the dweMHUw function
function dweMHUw(type_dweMHUw)
{
	if (isSet(type_dweMHUw) && type_dweMHUw.constructor !== Array)
	{
		var temp_dweMHUw = type_dweMHUw;
		var type_dweMHUw = [];
		type_dweMHUw.push(temp_dweMHUw);
	}
	else if (!isSet(type_dweMHUw))
	{
		var type_dweMHUw = [];
	}
	var type = type_dweMHUw.some(type_dweMHUw_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_dweMHUwWAb_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_dweMHUwWAb_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_dweMHUwWAb_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_dweMHUwWAb_required = true;
		}
	}
}

// the dweMHUw Some function
function type_dweMHUw_SomeFunc(type_dweMHUw)
{
	// set the function logic
	if (type_dweMHUw == 1)
	{
		return true;
	}
	return false;
}

// the pnuDTOl function
function pnuDTOl(type_pnuDTOl)
{
	if (isSet(type_pnuDTOl) && type_pnuDTOl.constructor !== Array)
	{
		var temp_pnuDTOl = type_pnuDTOl;
		var type_pnuDTOl = [];
		type_pnuDTOl.push(temp_pnuDTOl);
	}
	else if (!isSet(type_pnuDTOl))
	{
		var type_pnuDTOl = [];
	}
	var type = type_pnuDTOl.some(type_pnuDTOl_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_pnuDTOlQhG_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_pnuDTOlQhG_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_pnuDTOlQhG_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_pnuDTOlQhG_required = true;
		}
	}
}

// the pnuDTOl Some function
function type_pnuDTOl_SomeFunc(type_pnuDTOl)
{
	// set the function logic
	if (type_pnuDTOl == 2)
	{
		return true;
	}
	return false;
}

// the dObkcfd function
function dObkcfd(target_dObkcfd)
{
	// set the function logic
	if (target_dObkcfd == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_dObkcfdSaH_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_dObkcfdSaH_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_dObkcfdSaH_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_dObkcfdSaH_required = true;
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
