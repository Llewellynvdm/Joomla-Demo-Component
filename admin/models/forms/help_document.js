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
jform_XQcngFHlfz_required = false;
jform_HIJAxdnGdL_required = false;
jform_NfMtkmlVAg_required = false;
jform_zyWCHchiml_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_iapdbbz = jQuery("#jform_location input[type='radio']:checked").val();
	iapdbbz(location_iapdbbz);

	var location_fHWHgTv = jQuery("#jform_location input[type='radio']:checked").val();
	fHWHgTv(location_fHWHgTv);

	var type_XQcngFH = jQuery("#jform_type").val();
	XQcngFH(type_XQcngFH);

	var type_HIJAxdn = jQuery("#jform_type").val();
	HIJAxdn(type_HIJAxdn);

	var type_NfMtkml = jQuery("#jform_type").val();
	NfMtkml(type_NfMtkml);

	var target_zyWCHch = jQuery("#jform_target input[type='radio']:checked").val();
	zyWCHch(target_zyWCHch);
});

// the iapdbbz function
function iapdbbz(location_iapdbbz)
{
	// set the function logic
	if (location_iapdbbz == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the fHWHgTv function
function fHWHgTv(location_fHWHgTv)
{
	// set the function logic
	if (location_fHWHgTv == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the XQcngFH function
function XQcngFH(type_XQcngFH)
{
	if (isSet(type_XQcngFH) && type_XQcngFH.constructor !== Array)
	{
		var temp_XQcngFH = type_XQcngFH;
		var type_XQcngFH = [];
		type_XQcngFH.push(temp_XQcngFH);
	}
	else if (!isSet(type_XQcngFH))
	{
		var type_XQcngFH = [];
	}
	var type = type_XQcngFH.some(type_XQcngFH_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_XQcngFHlfz_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_XQcngFHlfz_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_XQcngFHlfz_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_XQcngFHlfz_required = true;
		}
	}
}

// the XQcngFH Some function
function type_XQcngFH_SomeFunc(type_XQcngFH)
{
	// set the function logic
	if (type_XQcngFH == 3)
	{
		return true;
	}
	return false;
}

// the HIJAxdn function
function HIJAxdn(type_HIJAxdn)
{
	if (isSet(type_HIJAxdn) && type_HIJAxdn.constructor !== Array)
	{
		var temp_HIJAxdn = type_HIJAxdn;
		var type_HIJAxdn = [];
		type_HIJAxdn.push(temp_HIJAxdn);
	}
	else if (!isSet(type_HIJAxdn))
	{
		var type_HIJAxdn = [];
	}
	var type = type_HIJAxdn.some(type_HIJAxdn_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_HIJAxdnGdL_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_HIJAxdnGdL_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_HIJAxdnGdL_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_HIJAxdnGdL_required = true;
		}
	}
}

// the HIJAxdn Some function
function type_HIJAxdn_SomeFunc(type_HIJAxdn)
{
	// set the function logic
	if (type_HIJAxdn == 1)
	{
		return true;
	}
	return false;
}

// the NfMtkml function
function NfMtkml(type_NfMtkml)
{
	if (isSet(type_NfMtkml) && type_NfMtkml.constructor !== Array)
	{
		var temp_NfMtkml = type_NfMtkml;
		var type_NfMtkml = [];
		type_NfMtkml.push(temp_NfMtkml);
	}
	else if (!isSet(type_NfMtkml))
	{
		var type_NfMtkml = [];
	}
	var type = type_NfMtkml.some(type_NfMtkml_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_NfMtkmlVAg_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_NfMtkmlVAg_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_NfMtkmlVAg_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_NfMtkmlVAg_required = true;
		}
	}
}

// the NfMtkml Some function
function type_NfMtkml_SomeFunc(type_NfMtkml)
{
	// set the function logic
	if (type_NfMtkml == 2)
	{
		return true;
	}
	return false;
}

// the zyWCHch function
function zyWCHch(target_zyWCHch)
{
	// set the function logic
	if (target_zyWCHch == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_zyWCHchiml_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_zyWCHchiml_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_zyWCHchiml_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_zyWCHchiml_required = true;
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
