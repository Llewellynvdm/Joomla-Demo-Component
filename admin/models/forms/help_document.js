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
jform_XvephxzImu_required = false;
jform_yFWFBjoUSy_required = false;
jform_revjpJkdku_required = false;
jform_MhQPsZtPMB_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var location_sLnxlWV = jQuery("#jform_location input[type='radio']:checked").val();
	sLnxlWV(location_sLnxlWV);

	var location_fqbSveC = jQuery("#jform_location input[type='radio']:checked").val();
	fqbSveC(location_fqbSveC);

	var type_Xvephxz = jQuery("#jform_type").val();
	Xvephxz(type_Xvephxz);

	var type_yFWFBjo = jQuery("#jform_type").val();
	yFWFBjo(type_yFWFBjo);

	var type_revjpJk = jQuery("#jform_type").val();
	revjpJk(type_revjpJk);

	var target_MhQPsZt = jQuery("#jform_target input[type='radio']:checked").val();
	MhQPsZt(target_MhQPsZt);
});

// the sLnxlWV function
function sLnxlWV(location_sLnxlWV)
{
	// set the function logic
	if (location_sLnxlWV == 1)
	{
		jQuery('#jform_admin_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_admin_view').closest('.control-group').hide();
	}
}

// the fqbSveC function
function fqbSveC(location_fqbSveC)
{
	// set the function logic
	if (location_fqbSveC == 2)
	{
		jQuery('#jform_site_view').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_site_view').closest('.control-group').hide();
	}
}

// the Xvephxz function
function Xvephxz(type_Xvephxz)
{
	if (isSet(type_Xvephxz) && type_Xvephxz.constructor !== Array)
	{
		var temp_Xvephxz = type_Xvephxz;
		var type_Xvephxz = [];
		type_Xvephxz.push(temp_Xvephxz);
	}
	else if (!isSet(type_Xvephxz))
	{
		var type_Xvephxz = [];
	}
	var type = type_Xvephxz.some(type_Xvephxz_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_url').closest('.control-group').show();
		if (jform_XvephxzImu_required)
		{
			updateFieldRequired('url',0);
			jQuery('#jform_url').prop('required','required');
			jQuery('#jform_url').attr('aria-required',true);
			jQuery('#jform_url').addClass('required');
			jform_XvephxzImu_required = false;
		}

	}
	else
	{
		jQuery('#jform_url').closest('.control-group').hide();
		if (!jform_XvephxzImu_required)
		{
			updateFieldRequired('url',1);
			jQuery('#jform_url').removeAttr('required');
			jQuery('#jform_url').removeAttr('aria-required');
			jQuery('#jform_url').removeClass('required');
			jform_XvephxzImu_required = true;
		}
	}
}

// the Xvephxz Some function
function type_Xvephxz_SomeFunc(type_Xvephxz)
{
	// set the function logic
	if (type_Xvephxz == 3)
	{
		return true;
	}
	return false;
}

// the yFWFBjo function
function yFWFBjo(type_yFWFBjo)
{
	if (isSet(type_yFWFBjo) && type_yFWFBjo.constructor !== Array)
	{
		var temp_yFWFBjo = type_yFWFBjo;
		var type_yFWFBjo = [];
		type_yFWFBjo.push(temp_yFWFBjo);
	}
	else if (!isSet(type_yFWFBjo))
	{
		var type_yFWFBjo = [];
	}
	var type = type_yFWFBjo.some(type_yFWFBjo_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_article').closest('.control-group').show();
		if (jform_yFWFBjoUSy_required)
		{
			updateFieldRequired('article',0);
			jQuery('#jform_article').prop('required','required');
			jQuery('#jform_article').attr('aria-required',true);
			jQuery('#jform_article').addClass('required');
			jform_yFWFBjoUSy_required = false;
		}

	}
	else
	{
		jQuery('#jform_article').closest('.control-group').hide();
		if (!jform_yFWFBjoUSy_required)
		{
			updateFieldRequired('article',1);
			jQuery('#jform_article').removeAttr('required');
			jQuery('#jform_article').removeAttr('aria-required');
			jQuery('#jform_article').removeClass('required');
			jform_yFWFBjoUSy_required = true;
		}
	}
}

// the yFWFBjo Some function
function type_yFWFBjo_SomeFunc(type_yFWFBjo)
{
	// set the function logic
	if (type_yFWFBjo == 1)
	{
		return true;
	}
	return false;
}

// the revjpJk function
function revjpJk(type_revjpJk)
{
	if (isSet(type_revjpJk) && type_revjpJk.constructor !== Array)
	{
		var temp_revjpJk = type_revjpJk;
		var type_revjpJk = [];
		type_revjpJk.push(temp_revjpJk);
	}
	else if (!isSet(type_revjpJk))
	{
		var type_revjpJk = [];
	}
	var type = type_revjpJk.some(type_revjpJk_SomeFunc);


	// set this function logic
	if (type)
	{
		jQuery('#jform_content-lbl').closest('.control-group').show();
		if (jform_revjpJkdku_required)
		{
			updateFieldRequired('content',0);
			jQuery('#jform_content').prop('required','required');
			jQuery('#jform_content').attr('aria-required',true);
			jQuery('#jform_content').addClass('required');
			jform_revjpJkdku_required = false;
		}

	}
	else
	{
		jQuery('#jform_content-lbl').closest('.control-group').hide();
		if (!jform_revjpJkdku_required)
		{
			updateFieldRequired('content',1);
			jQuery('#jform_content').removeAttr('required');
			jQuery('#jform_content').removeAttr('aria-required');
			jQuery('#jform_content').removeClass('required');
			jform_revjpJkdku_required = true;
		}
	}
}

// the revjpJk Some function
function type_revjpJk_SomeFunc(type_revjpJk)
{
	// set the function logic
	if (type_revjpJk == 2)
	{
		return true;
	}
	return false;
}

// the MhQPsZt function
function MhQPsZt(target_MhQPsZt)
{
	// set the function logic
	if (target_MhQPsZt == 1)
	{
		jQuery('#jform_groups').closest('.control-group').show();
		if (jform_MhQPsZtPMB_required)
		{
			updateFieldRequired('groups',0);
			jQuery('#jform_groups').prop('required','required');
			jQuery('#jform_groups').attr('aria-required',true);
			jQuery('#jform_groups').addClass('required');
			jform_MhQPsZtPMB_required = false;
		}

	}
	else
	{
		jQuery('#jform_groups').closest('.control-group').hide();
		if (!jform_MhQPsZtPMB_required)
		{
			updateFieldRequired('groups',1);
			jQuery('#jform_groups').removeAttr('required');
			jQuery('#jform_groups').removeAttr('aria-required');
			jQuery('#jform_groups').removeClass('required');
			jform_MhQPsZtPMB_required = true;
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
