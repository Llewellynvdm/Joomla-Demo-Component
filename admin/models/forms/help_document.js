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
jform_buUjwqCEgw_required = false;
jform_awHrEpJTCs_required = false;
jform_JHuhjDjkaI_required = false;
jform_pceolzDUXH_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_jfFNhcv = jQuery("#jform_location input[type='radio']:checked").val();
	jfFNhcv(location_jfFNhcv);

	var location_IjbbDyi = jQuery("#jform_location input[type='radio']:checked").val();
	IjbbDyi(location_IjbbDyi);

	var type_buUjwqC = jQuery("#jform_type").val();
	buUjwqC(type_buUjwqC);

	var type_awHrEpJ = jQuery("#jform_type").val();
	awHrEpJ(type_awHrEpJ);

	var type_JHuhjDj = jQuery("#jform_type").val();
	JHuhjDj(type_JHuhjDj);

	var target_pceolzD = jQuery("#jform_target input[type='radio']:checked").val();
	pceolzD(target_pceolzD);
});

// the jfFNhcv function
function jfFNhcv(location_jfFNhcv)
{
	// set the function logic
	if (location_jfFNhcv == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the IjbbDyi function
function IjbbDyi(location_IjbbDyi)
{
	// set the function logic
	if (location_IjbbDyi == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the buUjwqC function
function buUjwqC(type_buUjwqC)
{
	if (isSet(type_buUjwqC) && type_buUjwqC.constructor !== Array)
	{
		var temp_buUjwqC = type_buUjwqC;
		var type_buUjwqC = [];
		type_buUjwqC.push(temp_buUjwqC);
	}
	else if (!isSet(type_buUjwqC))
	{
		var type_buUjwqC = [];
	}
	var type = type_buUjwqC.some(type_buUjwqC_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_buUjwqCEgw_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_buUjwqCEgw_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_buUjwqCEgw_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_buUjwqCEgw_required = true;
		}
	}
}

// the buUjwqC Some function
function type_buUjwqC_SomeFunc(type_buUjwqC)
{
	// set the function logic
	if (type_buUjwqC == 3)
	{
		return true;
	}
	return false;
}

// the awHrEpJ function
function awHrEpJ(type_awHrEpJ)
{
	if (isSet(type_awHrEpJ) && type_awHrEpJ.constructor !== Array)
	{
		var temp_awHrEpJ = type_awHrEpJ;
		var type_awHrEpJ = [];
		type_awHrEpJ.push(temp_awHrEpJ);
	}
	else if (!isSet(type_awHrEpJ))
	{
		var type_awHrEpJ = [];
	}
	var type = type_awHrEpJ.some(type_awHrEpJ_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_awHrEpJTCs_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_awHrEpJTCs_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_awHrEpJTCs_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_awHrEpJTCs_required = true;
		}
	}
}

// the awHrEpJ Some function
function type_awHrEpJ_SomeFunc(type_awHrEpJ)
{
	// set the function logic
	if (type_awHrEpJ == 1)
	{
		return true;
	}
	return false;
}

// the JHuhjDj function
function JHuhjDj(type_JHuhjDj)
{
	if (isSet(type_JHuhjDj) && type_JHuhjDj.constructor !== Array)
	{
		var temp_JHuhjDj = type_JHuhjDj;
		var type_JHuhjDj = [];
		type_JHuhjDj.push(temp_JHuhjDj);
	}
	else if (!isSet(type_JHuhjDj))
	{
		var type_JHuhjDj = [];
	}
	var type = type_JHuhjDj.some(type_JHuhjDj_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_JHuhjDjkaI_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_JHuhjDjkaI_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_JHuhjDjkaI_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_JHuhjDjkaI_required = true;
		}
	}
}

// the JHuhjDj Some function
function type_JHuhjDj_SomeFunc(type_JHuhjDj)
{
	// set the function logic
	if (type_JHuhjDj == 2)
	{
		return true;
	}
	return false;
}

// the pceolzD function
function pceolzD(target_pceolzD)
{
	// set the function logic
	if (target_pceolzD == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_pceolzDUXH_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_pceolzDUXH_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_pceolzDUXH_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_pceolzDUXH_required = true;
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
