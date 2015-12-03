/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.4
	@build			3rd December, 2015
	@created		5th August, 2015
	@package		Demo
	@subpackage		look.js
	@author			Llewellyn van der Merwe <https://www.vdm.io/>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
  ____  _____  _____  __  __  __      __       ___  _____  __  __  ____  _____  _  _  ____  _  _  ____ 
 (_  _)(  _  )(  _  )(  \/  )(  )    /__\     / __)(  _  )(  \/  )(  _ \(  _  )( \( )( ___)( \( )(_  _)
.-_)(   )(_)(  )(_)(  )    (  )(__  /(__)\   ( (__  )(_)(  )    (  )___/ )(_)(  )  (  )__)  )  (   )(  
\____) (_____)(_____)(_/\/\_)(____)(__)(__)   \___)(_____)(_/\/\_)(__)  (_____)(_)\_)(____)(_)\_) (__) 

/------------------------------------------------------------------------------------------------------*/

// Some Global Values
jform_FKWPxIhXqG_required = false;

// Initial Script
jQuery(document).ready(function()
{
	var name_CxBsGuj = jQuery("#jform_name").val();
	CxBsGuj(name_CxBsGuj);

	var add_FKWPxIh = jQuery("#jform_add input[type='radio']:checked").val();
	FKWPxIh(add_FKWPxIh);
});

// the CxBsGuj function
function CxBsGuj(name_CxBsGuj)
{
	// set the function logic
	if (isSet(name_CxBsGuj))
	{
		jQuery('#jform_alias').closest('.control-group').show();
		jQuery('#jform_description').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_alias').closest('.control-group').hide();
		jQuery('#jform_description').closest('.control-group').hide();
	}
}

// the FKWPxIh function
function FKWPxIh(add_FKWPxIh)
{
	// set the function logic
	if (add_FKWPxIh == 1)
	{
		jQuery('#jform_acronym').closest('.control-group').show();
		if (jform_FKWPxIhXqG_required)
		{
			updateFieldRequired('acronym',0);
			jQuery('#jform_acronym').prop('required','required');
			jQuery('#jform_acronym').attr('aria-required',true);
			jQuery('#jform_acronym').addClass('required');
			jform_FKWPxIhXqG_required = false;
		}

		jQuery('#jform_website').closest('.control-group').show();
	}
	else
	{
		jQuery('#jform_acronym').closest('.control-group').hide();
		if (!jform_FKWPxIhXqG_required)
		{
			updateFieldRequired('acronym',1);
			jQuery('#jform_acronym').removeAttr('required');
			jQuery('#jform_acronym').removeAttr('aria-required');
			jQuery('#jform_acronym').removeClass('required');
			jform_FKWPxIhXqG_required = true;
		}
		jQuery('#jform_website').closest('.control-group').hide();
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

jQuery(document).ready(function()
{    
    var values_a = jQuery('#jform_male').val();
	if (values_a)
	{
		values_a = jQuery.parseJSON(values_a);
		buildTable(values_a,'jform_male');
	}

    var values_b = jQuery('#jform_female').val();
    if (values_b)
	{
		values_b = jQuery.parseJSON(values_b);
    	buildTable(values_b,'jform_female');
	}
});

function buildTable(array,id){
	jQuery('#table_'+id).remove();
	jQuery('#'+id).closest('.control-group').append('<table style="margin: 5px 0 20px;" class="table" id="table_'+id+'">');
	jQuery('#table_'+id).append(tableHeader(array));
	jQuery('#table_'+id).append(tableBody(array));  
	jQuery('#table_'+id).append('</table>');
}

function tableHeader(array)
{
  var header = '<thead><tr>';
	jQuery.each(array, function(key, value) {
		 header += '<th style="padding: 10px; text-align: center; border: 1px solid rgb(221, 221, 221);">'+capitalizeFirstLetter(key)+'</th>';
	});
	header += '</tr></thead>';
  return header;
}

function tableBody(array)
{
	var body = '<tbody>';
	var rows = new Array();
	jQuery.each(array, function(key, value) {
		jQuery.each(value, function(i, line) {
      if( rows[i] === undefined ) {
        rows[i] = '<td style="padding: 10px; text-align: center; border: 1px solid rgb(221, 221, 221);">' + line + '</td>';
      }
      else
      {
        rows[i] = rows[i] + '<td style="padding: 10px; text-align: center; border: 1px solid rgb(221, 221, 221);">' + line + '</td>';
      }
		});
	});
  // now load to body the rows
  jQuery.each(rows, function(a, row) {
     body += '<tr>' + row + '</tr>';
	});
  
	body += '</tbody>';
  
  return body;
                              
}

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function updateSelection(row)
{
	var groupId = jQuery(row).find("select:first").attr("id");
	var percentValue = jQuery(row).find(".text_area:first").val();
	var arr = groupId.split('-');
	if (arr[1] != 1)
	{
		var selection = {};
		jQuery(row).find("select:first option").each(function()
		{
			// first get the values and text
			selection[jQuery(this).text()] = jQuery(this).val();
		});
		jQuery.each(AgeGroup, function(i, group){
			jQuery(row).find("select:first option[value='"+group+"']").remove();
		});
		if (percentValue)
		{
			var text = jQuery(row).find(".chzn-single:first span").text();
			jQuery(row).find("select:first").append(jQuery('<option>', {
				value: selection[text],
				text: text
			}));
		}
		jQuery(row).find("select:first").trigger("liszt:updated");	
		
		if (percentValue)
		{
			jQuery(row).find("select:first option:selected").val(selection[text]);	
			jQuery(row).find(".chzn-single:first span").text(text);
		}
	}
} 
