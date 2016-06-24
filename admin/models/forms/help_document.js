/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.5
	@build			24th June, 2016
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
jform_vvvvvvzvvw_required = false;
jform_vvvvvwavvx_required = false;
jform_vvvvvwbvvy_required = false;
jform_vvvvvwcvvz_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_vvvvvvx = jQuery("#jform_location input[type='radio']:checked").val();
	vvvvvvx(location_vvvvvvx);

	var location_vvvvvvy = jQuery("#jform_location input[type='radio']:checked").val();
	vvvvvvy(location_vvvvvvy);

	var type_vvvvvvz = jQuery("#jform_type").val();
	vvvvvvz(type_vvvvvvz);

	var type_vvvvvwa = jQuery("#jform_type").val();
	vvvvvwa(type_vvvvvwa);

	var type_vvvvvwb = jQuery("#jform_type").val();
	vvvvvwb(type_vvvvvwb);

	var target_vvvvvwc = jQuery("#jform_target input[type='radio']:checked").val();
	vvvvvwc(target_vvvvvwc);
});

// the vvvvvvx function
function vvvvvvx(location_vvvvvvx)
{
	// set the function logic
	if (location_vvvvvvx == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the vvvvvvy function
function vvvvvvy(location_vvvvvvy)
{
	// set the function logic
	if (location_vvvvvvy == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the vvvvvvz function
function vvvvvvz(type_vvvvvvz)
{
	if (isSet(type_vvvvvvz) && type_vvvvvvz.constructor !== Array)
	{
		var temp_vvvvvvz = type_vvvvvvz;
		var type_vvvvvvz = [];
		type_vvvvvvz.push(temp_vvvvvvz);
	}
	else if (!isSet(type_vvvvvvz))
	{
		var type_vvvvvvz = [];
	}
	var type = type_vvvvvvz.some(type_vvvvvvz_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_vvvvvvzvvw_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_vvvvvvzvvw_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_vvvvvvzvvw_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_vvvvvvzvvw_required = true;
		}
	}
}

// the vvvvvvz Some function
function type_vvvvvvz_SomeFunc(type_vvvvvvz)
{
	// set the function logic
	if (type_vvvvvvz == 3)
	{
		return true;
	}
	return false;
}

// the vvvvvwa function
function vvvvvwa(type_vvvvvwa)
{
	if (isSet(type_vvvvvwa) && type_vvvvvwa.constructor !== Array)
	{
		var temp_vvvvvwa = type_vvvvvwa;
		var type_vvvvvwa = [];
		type_vvvvvwa.push(temp_vvvvvwa);
	}
	else if (!isSet(type_vvvvvwa))
	{
		var type_vvvvvwa = [];
	}
	var type = type_vvvvvwa.some(type_vvvvvwa_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_vvvvvwavvx_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_vvvvvwavvx_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_vvvvvwavvx_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_vvvvvwavvx_required = true;
		}
	}
}

// the vvvvvwa Some function
function type_vvvvvwa_SomeFunc(type_vvvvvwa)
{
	// set the function logic
	if (type_vvvvvwa == 1)
	{
		return true;
	}
	return false;
}

// the vvvvvwb function
function vvvvvwb(type_vvvvvwb)
{
	if (isSet(type_vvvvvwb) && type_vvvvvwb.constructor !== Array)
	{
		var temp_vvvvvwb = type_vvvvvwb;
		var type_vvvvvwb = [];
		type_vvvvvwb.push(temp_vvvvvwb);
	}
	else if (!isSet(type_vvvvvwb))
	{
		var type_vvvvvwb = [];
	}
	var type = type_vvvvvwb.some(type_vvvvvwb_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_vvvvvwbvvy_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_vvvvvwbvvy_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_vvvvvwbvvy_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_vvvvvwbvvy_required = true;
		}
	}
}

// the vvvvvwb Some function
function type_vvvvvwb_SomeFunc(type_vvvvvwb)
{
	// set the function logic
	if (type_vvvvvwb == 2)
	{
		return true;
	}
	return false;
}

// the vvvvvwc function
function vvvvvwc(target_vvvvvwc)
{
	// set the function logic
	if (target_vvvvvwc == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_vvvvvwcvvz_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_vvvvvwcvvz_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_vvvvvwcvvz_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_vvvvvwcvvz_required = true;
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
