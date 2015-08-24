<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		1.0.3 - 24th August, 2015
	@package		Demo
	@subpackage		demo.php
	@author			Llewellyn van der Merwe <https://www.vdm.io/>	
	@copyright		Copyright (C) 2015. All Rights Reserved
	@license		GNU/GPL Version 2 or later - http://www.gnu.org/licenses/gpl-2.0.html
  ____  _____  _____  __  __  __      __       ___  _____  __  __  ____  _____  _  _  ____  _  _  ____ 
 (_  _)(  _  )(  _  )(  \/  )(  )    /__\     / __)(  _  )(  \/  )(  _ \(  _  )( \( )( ___)( \( )(_  _)
.-_)(   )(_)(  )(_)(  )    (  )(__  /(__)\   ( (__  )(_)(  )    (  )___/ )(_)(  )  (  )__)  )  (   )(  
\____) (_____)(_____)(_/\/\_)(____)(__)(__)   \___)(_____)(_/\/\_)(__)  (_____)(_)\_)(____)(_)\_) (__) 

/------------------------------------------------------------------------------------------------------*/

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * Demo component helper.
 */
abstract class DemoHelper
{
	/**
	*	Load the Component xml manifest. 
	**/
    public static function manifest()
    {
        $manifestUrl = JPATH_ADMINISTRATOR."/components/com_demo/demo.xml";
        return simplexml_load_file($manifestUrl);
	}

	/**
	*	Load the Component Help URLs.
	**/
	public static function getHelpUrl($view)
	{
		$user	= JFactory::getUser();
		$groups = $user->getAuthorisedGroups();
		$db		= JFactory::getDbo();
		$query	= $db->getQuery(true);
		$query->select(array('a.id','a.groups','a.target','a.type','a.article','a.url'));
		$query->from('#__demo_help_document AS a');
		$query->where('a.admin_view = '.$db->quote($view));
		$query->where('a.location = 1');
		$query->where('a.published = 1');
		$db->setQuery($query);
		$db->execute();
		if($db->getNumRows())
		{
			$helps = $db->loadObjectList();
			if (self::checkArray($helps))
			{
				foreach ($helps as $nr => $help)
				{
					if ($help->target == 1)
					{
						$targetgroups = json_decode($help->groups, true);
						if (!array_intersect($targetgroups, $groups))
						{
							// if user not in those target groups then remove the item
							unset($helps[$nr]);
							continue;
						}
					}
					// set the return type
					switch ($help->type)
					{
						// set joomla article
						case 1:
							return self::loadArticleLink($help->article);
						break;
						// set help text
						case 2:
							return self::loadHelpTextLink($help->id);
						break;
						// set Link
						case 3:
							return $help->url;
						break;
					}
				}
			}
		}
		return false;
	}

	/**
	*	Get the Article Link.
	**/
	protected static function loadArticleLink($id)
	{
		return JURI::root().'index.php?option=com_content&view=article&id='.$id.'&tmpl=component&layout=modal';
	}

	/**
	*	Get the Help Text Link.
	**/
	protected static function loadHelpTextLink($id)
	{
		$token = JSession::getFormToken();
		return 'index.php?option=com_demo&task=help.getText&id=' . (int) $id . '&token=' . $token;
	}
	
	/**
	*	Configure the Linkbar. 
	**/
	public static function addSubmenu($submenu) 
	{
    	// load user for access menus
    	$user = JFactory::getUser();
        // load the submenus to sidebar
		JHtmlSidebar::addEntry(JText::_('COM_DEMO_SUBMENU_DASHBOARD'), 'index.php?option=com_demo&view=demo', $submenu == 'demo');
		JHtmlSidebar::addEntry(JText::_('COM_DEMO_SUBMENU_LOOKS'), 'index.php?option=com_demo&view=looks', $submenu == 'looks');
		if ($user->authorise('help_document.access', 'com_demo'))
		{
			JHtmlSidebar::addEntry(JText::_('COM_DEMO_SUBMENU_HELP_DOCUMENTS'), 'index.php?option=com_demo&view=help_documents', $submenu == 'help_documents');
		}
	}   

	/**
	 * Prepares the xml document
	 */
	public static function xls($rows,$fileName = null,$title = null,$subjectTab = null,$creator = 'Vast Development Method',$description = null,$category = null,$keywords = null,$modified = null)
	{
		// set the user
		$user = JFactory::getUser();
		
		// set fieldname if not set
		if (!$fileName)
		{
			$fileName = 'exported_'.JFactory::getDate()->format('jS_F_Y');
		}
		// set modiefied if not set
		if (!$modified)
		{
			$modified = $user->name;
		}
		// set title if not set
		if (!$title)
		{
			$title = 'Book1';
		}
		// set tab name if not set
		if (!$subjectTab)
		{
			$subjectTab = 'Sheet1';
		}
		
		// make sure the file is loaded		
		JLoader::import('PHPExcel', JPATH_COMPONENT_ADMINISTRATOR . '/helpers');
		
		// Create new PHPExcel object
		$objPHPExcel = new PHPExcel();
		
		// Set document properties
		$objPHPExcel->getProperties()->setCreator($creator)
									 ->setCompany('Vast Development Method')
									 ->setLastModifiedBy($modified)
									 ->setTitle($title)
									 ->setSubject($subjectTab);
		if (!$description)
		{
			$objPHPExcel->getProperties()->setDescription($description);
		}
		if (!$keywords)
		{
			$objPHPExcel->getProperties()->setKeywords($keywords);
		}
		if (!$category)
		{
			$objPHPExcel->getProperties()->setCategory($category);
		}
		
		// Some styles
		$headerStyles = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => '1171A3'),
				'size'  => 12,
				'name'  => 'Verdana'
		));
		$sideStyles = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => '444444'),
				'size'  => 11,
				'name'  => 'Verdana'
		));
		$normalStyles = array(
			'font'  => array(
				'color' => array('rgb' => '444444'),
				'size'  => 11,
				'name'  => 'Verdana'
		));
		
		// Add some data
		if (self::checkArray($rows))
		{
			$i = 1;
			foreach ($rows as $array){
				$a = 'A';
				foreach ($array as $value){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($a.$i, $value);
					if ($i == 1){
						$objPHPExcel->getActiveSheet()->getColumnDimension($a)->setAutoSize(true);
						$objPHPExcel->getActiveSheet()->getStyle($a.$i)->applyFromArray($headerStyles);
						$objPHPExcel->getActiveSheet()->getStyle($a.$i)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
					} elseif ($a == 'A'){
						$objPHPExcel->getActiveSheet()->getStyle($a.$i)->applyFromArray($sideStyles);
					} else {
						$objPHPExcel->getActiveSheet()->getStyle($a.$i)->applyFromArray($normalStyles);
					}
					$a++;
				}
				$i++;
			}
		}
		else
		{
			return false;
		}
		
		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle($subjectTab);
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);
		
		// Redirect output to a client's web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$fileName.'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');
		
		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
		
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		jexit();
	}
	
	/**
	* Get CSV Headers
	*/
	public static function getFileHeaders($dataType)
	{		
		// make sure the file is loaded		
		JLoader::import('PHPExcel', JPATH_COMPONENT_ADMINISTRATOR . '/helpers');
		// get session object
$session 	=& JFactory::getSession();
		$package	= $session->get('package', null);
		$package	= json_decode($package, true);
		// set the headers
		if(isset($package['dir']))
		{
			$inputFileType = PHPExcel_IOFactory::identify($package['dir']);
			$excelReader = PHPExcel_IOFactory::createReader($inputFileType);
			$excelReader->setReadDataOnly(true);
			$excelObj = $excelReader->load($package['dir']);
$headers = array();
			foreach ($excelObj->getActiveSheet()->getRowIterator() as $row)
			{
				if($row->getRowIndex() == 1)
				{
					$cellIterator = $row->getCellIterator();
					$cellIterator->setIterateOnlyExistingCells(false);
					foreach ($cellIterator as $cell)
					{
						if (!is_null($cell))
						{
							$headers[$cell->getColumn()] = $cell->getValue();
						}
					}
					$excelObj->disconnectWorksheets();
					unset($excelObj);
					break;
				}
			}
			return $headers;
		}
		return false;
	}
    
	public static function jsonToString($value, $sperator = ", ")
	{
    	// check if string is JSON
        $result = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE) {
            // is JSON
			if (self::checkArray($result))
			{
				$value = '';
				$counter = 0;
				foreach ($result as $string)
				{
					if ($counter)
					{
						$value .= $sperator.$string;
					}
					else
					{
						$value .= $string;
					}
					$counter++;
				}
				return $value;
			}
        	return json_decode($value);
        }
      	return $value;
    }
	
	public static function isPublished($id,$type)
	{
		if ($type == 'raw')
        {
			$type = 'item';
		}
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);
		$query->select(array('a.published'));
		$query->from('#__demo_'.$type.' AS a');
		$query->where('a.id = '.$id);
		$query->where('a.published = 1');
		$db->setQuery($query);
		$db->execute();
		$found = $db->getNumRows();
		if($found)
        {
			return true;
		}
		return false;
	}
	
	public static function getGroupName($id)
	{
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query->select(array('a.title'));
		$query->from('#__usergroups AS a');
		$query->where('a.id = '.$id);
		$db->setQuery($query);
		$db->execute();
		$found = $db->getNumRows();
		if($found)
        {
			return $db->loadResult();
		}
		return $id;
	}
    
    /**
	*	Get the actions permissions
	**/
     public static function getActions($view,&$record = null,$views = null)
	{
		jimport('joomla.access.access');

		$user	= JFactory::getUser();
		$result	= new JObject;
		$view	= self::safeString($view);
        if (self::checkString($views))
        {
			$views = self::safeString($views);
        }
		// get all actions from component
		$actions = JAccess::getActions('com_demo', 'component');
        // set acctions only set in component settiongs
        $componentActions = array('core.admin','core.manage','core.options','core.export');
		// loop the actions and set the permissions
		foreach ($actions as $action)
        {
			// set to use component default
			$allow = true;
			if (self::checkObject($record) && isset($record->id) && $record->id > 0 && !in_array($action->name,$componentActions))
			{
				// The record has been set. Check the record permissions.
				$permission = $user->authorise($action->name, 'com_demo.'.$view.'.' . (int) $record->id);
				if (!$permission && !is_null($permission))
				{
					if ($action->name == 'core.edit' || $action->name == $view.'.edit')
					{
						if ($user->authorise('core.edit.own', 'com_demo.'.$view.'.' . (int) $record->id))
						{
							// If the owner matches 'me' then allow.
							if (isset($record->created_by) && $record->created_by > 0 && ($record->created_by == $user->id))
							{
								$result->set($action->name, true);
								// set not to use component default
								$allow = false;
							}
							else
							{
								$result->set($action->name, false);
								// set not to use component default
								$allow = false;
							}
						}
						elseif ($user->authorise($view.'edit.own', 'com_demo.'.$view.'.' . (int) $record->id))
						{
							// If the owner matches 'me' then allow.
							if (isset($record->created_by) && $record->created_by > 0 && ($record->created_by == $user->id))
							{
								$result->set($action->name, true);
								// set not to use component default
								$allow = false;
							}
							else
							{
								$result->set($action->name, false);
								// set not to use component default
								$allow = false;
							}
						}
						elseif ($user->authorise('core.edit.own', 'com_demo'))
						{
							// If the owner matches 'me' then allow.
							if (isset($record->created_by) && $record->created_by > 0 && ($record->created_by == $user->id))
							{
								$result->set($action->name, true);
								// set not to use component default
								$allow = false;
							}
							else
							{
								$result->set($action->name, false);
								// set not to use component default
								$allow = false;
							}
						}
						elseif ($user->authorise($view.'edit.own', 'com_demo'))
						{
							// If the owner matches 'me' then allow.
							if (isset($record->created_by) && $record->created_by > 0 && ($record->created_by == $user->id))
							{
								$result->set($action->name, true);
								// set not to use component default
								$allow = false;
							}
							else
							{
								$result->set($action->name, false);
								// set not to use component default
								$allow = false;
							}
						}
					}
				}
				elseif (self::checkString($views) && isset($record->catid) && $record->catid > 0)
				{
                	// make sure we use the core. action check for the categories
                    if (strpos($action->name,$view) !== false && strpos($action->name,'core.') === false ) {
                        $coreCheck		= explode('.',$action->name);
                        $coreCheck[0]	= 'core';
                        $categoryCheck	= implode('.',$coreCheck);
                    }
                    else
                    {
                    	$categoryCheck = $action->name;
                    }
                    // The record has a category. Check the category permissions.
					$catpermission = $user->authorise($categoryCheck, 'com_demo.'.$views.'.category.' . (int) $record->catid);
					if (!$catpermission && !is_null($catpermission))
					{
						if ($action->name == 'core.edit' || $action->name == $view.'.edit')
						{
							if ($user->authorise('core.edit.own', 'com_demo.'.$views.'.category.' . (int) $record->catid))
							{
								// If the owner matches 'me' then allow.
								if (isset($record->created_by) && $record->created_by > 0 && ($record->created_by == $user->id))
								{
									$result->set($action->name, true);
									// set not to use component default
									$allow = false;
								}
								else
								{
									$result->set($action->name, false);
									// set not to use component default
									$allow = false;
								}
							}
							elseif ($user->authorise($view.'edit.own', 'com_demo.'.$views.'.category.' . (int) $record->catid))
							{
								// If the owner matches 'me' then allow.
								if (isset($record->created_by) && $record->created_by > 0 && ($record->created_by == $user->id))
								{
									$result->set($action->name, true);
									// set not to use component default
									$allow = false;
								}
								else
								{
									$result->set($action->name, false);
									// set not to use component default
									$allow = false;
								}
							}
							elseif ($user->authorise('core.edit.own', 'com_demo'))
							{
								// If the owner matches 'me' then allow.
								if (isset($record->created_by) && $record->created_by > 0 && ($record->created_by == $user->id))
								{
									$result->set($action->name, true);
									// set not to use component default
									$allow = false;
								}
								else
								{
									$result->set($action->name, false);
									// set not to use component default
									$allow = false;
								}
							}
							elseif ($user->authorise($view.'edit.own', 'com_demo'))
							{
								// If the owner matches 'me' then allow.
								if (isset($record->created_by) && $record->created_by > 0 && ($record->created_by == $user->id))
								{
									$result->set($action->name, true);
									// set not to use component default
									$allow = false;
								}
								else
								{
									$result->set($action->name, false);
									// set not to use component default
									$allow = false;
								}
							}
						}
					}
				}
			}
			// if allowed then fall back on component global settings	
			if ($allow)
			{
				$result->set($action->name, $user->authorise($action->name, 'com_demo'));
			}
		}
		return $result;
	}

	/**
	*	Get any component's model
	**/
	public static function getModel($name, $path = JPATH_COMPONENT_ADMINISTRATOR, $component = 'demo')
	{
		// load some joomla helpers
		JLoader::import('joomla.application.component.model'); 
		// load the model file
		JLoader::import( $name, $path . '/models' );
		// return instance
		return JModelLegacy::getInstance( $name, $component.'Model' );
	}
	
	public static function renderBoolButton()
	{
		$args = func_get_args();
		
		// get the radio element
		$button = JFormHelper::loadFieldType('radio');
		
		// setup the properties
		$name	 	= self::htmlEscape($args[0]);
		$additional = isset($args[1]) ? (string) $args[1] : '';
		$value		= $args[2];
		$yes 	 	= isset($args[3]) ? self::htmlEscape($args[3]) : 'JYES';
		$no 	 	= isset($args[4]) ? self::htmlEscape($args[4]) : 'JNO';
		
		// prepare the xml
		$element = new SimpleXMLElement('<field name="'.$name.'" type="radio" class="btn-group"><option '.$additional.' value="0">'.$no.'</option><option '.$additional.' value="1">'.$yes.'</option></field>');
		
		// run
		$button->setup($element, $value);
		
		return $button->input;
		
	}
	
	public static function checkObject($object)
	{
		if (isset($object) && is_object($object) && count($object) > 0)
		{
			return true;		
		}
		return false;
	}
	
	public static function checkArray($array)
	{
		if (isset($array) && is_array($array) && count($array) > 0)
		{
			return true;
		}
		return false;
	}
	
	public static function checkString($string)
	{
		if (isset($string) && is_string($string) && strlen($string) > 0)
		{
			return true;
		}
		return false;
	}
    
	public static function sorten($string, $length = 40, $addTip = true)
	{
		if (self::checkString($string))
        {
			$initial = strlen($string);
			$words = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
			$words_count = count($words);
			
			$word_length = 0;
			$last_word = 0;
			for (; $last_word < $words_count; ++$last_word)
			{
				$word_length += strlen($words[$last_word]);
				if ($word_length > $length)
				{
					break;
				}
			}
			
			$newString	= implode(array_slice($words, 0, $last_word));
			$final	= strlen($newString);
			if ($initial != $final && $addTip)
			{
				$title = self::sorten($string, 400 , false);
				return '<span class="hasTip" title="'.$title.'" style="cursor:help">'.trim($newString).'...</span>';
			}
			elseif ($initial != $final && !$addTip)
			{
				return trim($newString).'...';
			}
		}
		return $string;
	}
	
	public static function safeString($string, $type = 'L', $spacer = '_')
	{
		// remove all numbers and replace with english text version (works well only up to a thousand)
        $string = self::replaceNumbers($string);
		
    	if (self::checkString($string))
        {
			// remove all other characters
			$string = trim($string);
			$string = preg_replace('/'.$spacer.'+/', ' ', $string);
			$string = preg_replace('/\s+/', ' ', $string);
			$string = preg_replace("/[^A-Za-z ]/", '', $string);
            // return a string with all first letter of each word uppercase(no undersocre)
            if ($type == 'W')
			{
                return ucwords(strtolower($string));
            }
			elseif ($type == 'w')
			{
                return strtolower($string);
            }
			elseif ($type == 'Ww')
			{
                return ucfirst(strtolower($string));
            }
			elseif ($type == 'WW')
			{
                return strtoupper($string);
            }
            elseif ($type == 'U')
			{
				// replace white space with underscore
				$string = preg_replace('/\s+/', $spacer, $string);
                // return all upper
                return strtoupper($string);
            }
			elseif ($type == 'F')
			{
				// replace white space with underscore
				$string = preg_replace('/\s+/', $spacer, $string);
                // return with first caracter to upper
                return ucfirst(strtolower($string));
           	}
			elseif ($type == 'L')
			{
				// replace white space with underscore
				$string = preg_replace('/\s+/', $spacer, $string);
                // default is to return lower
           		return strtolower($string);
           	}
            
            //	return string
            return $string;
        }
        // not a string
        return '';
	}
    
    public static function htmlEscape($var, $charset = 'UTF-8', $sorten = false, $length = 40)
	{
		if (self::checkString($var))
		{
			$filter = new JFilterInput();
			$string = $filter->clean(html_entity_decode(htmlentities($var, ENT_COMPAT, $charset)), 'HTML');
			if ($sorten)
			{
           		return self::sorten($string,$length);
			}
			return $string;
        }
		else
		{
			return '';
        }
	}
    
    public static function replaceNumbers($string)
	{
    	// remove all numbers and replace with english text version (works well only up to a thousand)
		if (strcspn($string, '0123456789') != strlen($string))
        {
			$replace = array(
				'one thousand', 'nine hundred ninety nine','nine hundred ninety eight','nine hundred ninety seven','nine hundred ninety six','nine hundred ninety five',
				'nine hundred ninety four','nine hundred ninety three','nine hundred ninety two','nine hundred ninety one','nine hundred ninety',
				'nine hundred eighty nine','nine hundred eighty eight','nine hundred eighty seven','nine hundred eighty six','nine hundred eighty five',
				'nine hundred eighty four','nine hundred eighty three','nine hundred eighty two','nine hundred eighty one','nine hundred eighty',
				'nine hundred seventy nine','nine hundred seventy eight','nine hundred seventy seven','nine hundred seventy six','nine hundred seventy five',
				'nine hundred seventy four','nine hundred seventy three','nine hundred seventy two','nine hundred seventy one','nine hundred seventy',
				'nine hundred sixty nine','nine hundred sixty eight','nine hundred sixty seven','nine hundred sixty six','nine hundred sixty five',
				'nine hundred sixty four','nine hundred sixty three','nine hundred sixty two','nine hundred sixty one','nine hundred sixty',
				'nine hundred fifty nine','nine hundred fifty eight','nine hundred fifty seven','nine hundred fifty six','nine hundred fifty five',
				'nine hundred fifty four','nine hundred fifty three','nine hundred fifty two','nine hundred fifty one','nine hundred fifty',
				'nine hundred forty nine','nine hundred forty eight','nine hundred forty seven','nine hundred forty six','nine hundred forty five',
				'nine hundred forty four','nine hundred forty three','nine hundred forty two','nine hundred forty one','nine hundred forty',
				'nine hundred thirty nine','nine hundred thirty eight','nine hundred thirty seven','nine hundred thirty six','nine hundred thirty five',
				'nine hundred thirty four','nine hundred thirty three','nine hundred thirty two','nine hundred thirty one','nine hundred thirty',
				'nine hundred twenty nine','nine hundred twenty eight','nine hundred twenty seven','nine hundred twenty six','nine hundred twenty five',
				'nine hundred twenty four','nine hundred twenty three','nine hundred twenty two','nine hundred twenty one','nine hundred twenty',
				'nine hundred nineteen','nine hundred eighteen','nine hundred seventeen','nine hundred sixteen','nine hundred fifteen',
				'nine hundred fourteen','nine hundred thirteen','nine hundred twelve','nine hundred eleven','nine hundred ten',
				'nine hundred nine','nine hundred eight','nine hundred seven','nine hundred six','nine hundred five',
				'nine hundred four','nine hundred three','nine hundred two','nine hundred one','nine hundred','eight hundred ninety nine',
				'eight hundred ninety eight','eight hundred ninety seven','eight hundred ninety six','eight hundred ninety five','eight hundred ninety four',
				'eight hundred ninety three','eight hundred ninety two','eight hundred ninety one','eight hundred ninety','eight hundred eighty nine',
				'eight hundred eighty eight','eight hundred eighty seven','eight hundred eighty six','eight hundred eighty five','eight hundred eighty four',
				'eight hundred eighty three','eight hundred eighty two','eight hundred eighty one','eight hundred eighty','eight hundred seventy nine',
				'eight hundred seventy eight','eight hundred seventy seven','eight hundred seventy six','eight hundred seventy five','eight hundred seventy four',
				'eight hundred seventy three','eight hundred seventy two','eight hundred seventy one','eight hundred seventy','eight hundred sixty nine',
				'eight hundred sixty eight','eight hundred sixty seven','eight hundred sixty six','eight hundred sixty five','eight hundred sixty four',
				'eight hundred sixty three','eight hundred sixty two','eight hundred sixty one','eight hundred sixty','eight hundred fifty nine',
				'eight hundred fifty eight','eight hundred fifty seven','eight hundred fifty six','eight hundred fifty five','eight hundred fifty four',
				'eight hundred fifty three','eight hundred fifty two','eight hundred fifty one','eight hundred fifty','eight hundred forty nine',
				'eight hundred forty eight','eight hundred forty seven','eight hundred forty six','eight hundred forty five','eight hundred forty four',
				'eight hundred forty three','eight hundred forty two','eight hundred forty one','eight hundred forty','eight hundred thirty nine',
				'eight hundred thirty eight','eight hundred thirty seven','eight hundred thirty six','eight hundred thirty five','eight hundred thirty four',
				'eight hundred thirty three','eight hundred thirty two','eight hundred thirty one','eight hundred thirty','eight hundred twenty nine',
				'eight hundred twenty eight','eight hundred twenty seven','eight hundred twenty six','eight hundred twenty five','eight hundred twenty four',
				'eight hundred twenty three','eight hundred twenty two','eight hundred twenty one','eight hundred twenty','eight hundred nineteen',
				'eight hundred eighteen','eight hundred seventeen','eight hundred sixteen','eight hundred fifteen','eight hundred fourteen',
				'eight hundred thirteen','eight hundred twelve','eight hundred eleven','eight hundred ten','eight hundred nine',
				'eight hundred eight','eight hundred seven','eight hundred six','eight hundred five','eight hundred four',
				'eight hundred three','eight hundred two','eight hundred one','eight hundred','seven hundred ninety nine','seven hundred ninety eight',
				'seven hundred ninety seven','seven hundred ninety six','seven hundred ninety five','seven hundred ninety four','seven hundred ninety three',
				'seven hundred ninety two','seven hundred ninety one','seven hundred ninety','seven hundred eighty nine','seven hundred eighty eight',
				'seven hundred eighty seven','seven hundred eighty six','seven hundred eighty five','seven hundred eighty four','seven hundred eighty three',
				'seven hundred eighty two','seven hundred eighty one','seven hundred eighty','seven hundred seventy nine','seven hundred seventy eight',
				'seven hundred seventy seven','seven hundred seventy six','seven hundred seventy five','seven hundred seventy four','seven hundred seventy three',
				'seven hundred seventy two','seven hundred seventy one','seven hundred seventy','seven hundred sixty nine','seven hundred sixty eight',
				'seven hundred sixty seven','seven hundred sixty six','seven hundred sixty five','seven hundred sixty four','seven hundred sixty three',
				'seven hundred sixty two','seven hundred sixty one','seven hundred sixty','seven hundred fifty nine','seven hundred fifty eight',
				'seven hundred fifty seven','seven hundred fifty six','seven hundred fifty five','seven hundred fifty four','seven hundred fifty three',
				'seven hundred fifty two','seven hundred fifty one','seven hundred fifty','seven hundred forty nine','seven hundred forty eight',
				'seven hundred forty seven','seven hundred forty six','seven hundred forty five','seven hundred forty four','seven hundred forty three',
				'seven hundred forty two','seven hundred forty one','seven hundred forty','seven hundred thirty nine','seven hundred thirty eight',
				'seven hundred thirty seven','seven hundred thirty six','seven hundred thirty five','seven hundred thirty four','seven hundred thirty three',
				'seven hundred thirty two','seven hundred thirty one','seven hundred thirty','seven hundred twenty nine','seven hundred twenty eight',
				'seven hundred twenty seven','seven hundred twenty six','seven hundred twenty five','seven hundred twenty four','seven hundred twenty three',
				'seven hundred twenty two','seven hundred twenty one','seven hundred twenty','seven hundred nineteen','seven hundred eighteen',
				'seven hundred seventeen','seven hundred sixteen','seven hundred fifteen','seven hundred fourteen','seven hundred thirteen',
				'seven hundred twelve','seven hundred eleven','seven hundred ten','seven hundred nine','seven hundred eight',
				'seven hundred seven','seven hundred six','seven hundred five','seven hundred four','seven hundred three',
				'seven hundred two','seven hundred one','seven hundred','six hundred ninety nine','six hundred ninety eight','six hundred ninety seven',
				'six hundred ninety six','six hundred ninety five','six hundred ninety four','six hundred ninety three','six hundred ninety two',
				'six hundred ninety one','six hundred ninety','six hundred eighty nine','six hundred eighty eight','six hundred eighty seven',
				'six hundred eighty six','six hundred eighty five','six hundred eighty four','six hundred eighty three','six hundred eighty two',
				'six hundred eighty one','six hundred eighty','six hundred seventy nine','six hundred seventy eight','six hundred seventy seven',
				'six hundred seventy six','six hundred seventy five','six hundred seventy four','six hundred seventy three','six hundred seventy two',
				'six hundred seventy one','six hundred seventy','six hundred sixty nine','six hundred sixty eight','six hundred sixty seven',
				'six hundred sixty six','six hundred sixty five','six hundred sixty four','six hundred sixty three','six hundred sixty two',
				'six hundred sixty one','six hundred sixty','six hundred fifty nine','six hundred fifty eight','six hundred fifty seven',
				'six hundred fifty six','six hundred fifty five','six hundred fifty four','six hundred fifty three','six hundred fifty two',
				'six hundred fifty one','six hundred fifty','six hundred forty nine','six hundred forty eight','six hundred forty seven',
				'six hundred forty six','six hundred forty five','six hundred forty four','six hundred forty three','six hundred forty two',
				'six hundred forty one','six hundred forty','six hundred thirty nine','six hundred thirty eight','six hundred thirty seven',
				'six hundred thirty six','six hundred thirty five','six hundred thirty four','six hundred thirty three','six hundred thirty two',
				'six hundred thirty one','six hundred thirty','six hundred twenty nine','six hundred twenty eight','six hundred twenty seven',
				'six hundred twenty six','six hundred twenty five','six hundred twenty four','six hundred twenty three','six hundred twenty two',
				'six hundred twenty one','six hundred twenty','six hundred nineteen','six hundred eighteen','six hundred seventeen',
				'six hundred sixteen','six hundred fifteen','six hundred fourteen','six hundred thirteen','six hundred twelve',
				'six hundred eleven','six hundred ten','six hundred nine','six hundred eight','six hundred seven',
				'six hundred six','six hundred five','six hundred four','six hundred three','six hundred two',
				'six hundred one','six hundred','five hundred ninety nine','five hundred ninety eight','five hundred ninety seven','five hundred ninety six',
				'five hundred ninety five','five hundred ninety four','five hundred ninety three','five hundred ninety two','five hundred ninety one',
				'five hundred ninety','five hundred eighty nine','five hundred eighty eight','five hundred eighty seven','five hundred eighty six',
				'five hundred eighty five','five hundred eighty four','five hundred eighty three','five hundred eighty two','five hundred eighty one',
				'five hundred eighty','five hundred seventy nine','five hundred seventy eight','five hundred seventy seven','five hundred seventy six',
				'five hundred seventy five','five hundred seventy four','five hundred seventy three','five hundred seventy two','five hundred seventy one',
				'five hundred seventy','five hundred sixty nine','five hundred sixty eight','five hundred sixty seven','five hundred sixty six',
				'five hundred sixty five','five hundred sixty four','five hundred sixty three','five hundred sixty two','five hundred sixty one',
				'five hundred sixty','five hundred fifty nine','five hundred fifty eight','five hundred fifty seven','five hundred fifty six',
				'five hundred fifty five','five hundred fifty four','five hundred fifty three','five hundred fifty two','five hundred fifty one',
				'five hundred fifty','five hundred forty nine','five hundred forty eight','five hundred forty seven','five hundred forty six',
				'five hundred forty five','five hundred forty four','five hundred forty three','five hundred forty two','five hundred forty one',
				'five hundred forty','five hundred thirty nine','five hundred thirty eight','five hundred thirty seven','five hundred thirty six',
				'five hundred thirty five','five hundred thirty four','five hundred thirty three','five hundred thirty two','five hundred thirty one',
				'five hundred thirty','five hundred twenty nine','five hundred twenty eight','five hundred twenty seven','five hundred twenty six',
				'five hundred twenty five','five hundred twenty four','five hundred twenty three','five hundred twenty two','five hundred twenty one',
				'five hundred twenty','five hundred nineteen','five hundred eighteen','five hundred seventeen','five hundred sixteen',
				'five hundred fifteen','five hundred fourteen','five hundred thirteen','five hundred twelve','five hundred eleven',
				'five hundred ten','five hundred nine','five hundred eight','five hundred seven','five hundred six',
				'five hundred five','five hundred four','five hundred three','five hundred two','five hundred one','five hundred',
				'four hundred ninety nine','four hundred ninety eight','four hundred ninety seven','four hundred ninety six','four hundred ninety five',
				'four hundred ninety four','four hundred ninety three','four hundred ninety two','four hundred ninety one','four hundred ninety',
				'four hundred eighty nine','four hundred eighty eight','four hundred eighty seven','four hundred eighty six','four hundred eighty five',
				'four hundred eighty four','four hundred eighty three','four hundred eighty two','four hundred eighty one','four hundred eighty',
				'four hundred seventy nine','four hundred seventy eight','four hundred seventy seven','four hundred seventy six','four hundred seventy five',
				'four hundred seventy four','four hundred seventy three','four hundred seventy two','four hundred seventy one','four hundred seventy',
				'four hundred sixty nine','four hundred sixty eight','four hundred sixty seven','four hundred sixty six','four hundred sixty five',
				'four hundred sixty four','four hundred sixty three','four hundred sixty two','four hundred sixty one','four hundred sixty',
				'four hundred fifty nine','four hundred fifty eight','four hundred fifty seven','four hundred fifty six','four hundred fifty five',
				'four hundred fifty four','four hundred fifty three','four hundred fifty two','four hundred fifty one','four hundred fifty',
				'four hundred forty nine','four hundred forty eight','four hundred forty seven','four hundred forty six','four hundred forty five',
				'four hundred forty four','four hundred forty three','four hundred forty two','four hundred forty one','four hundred forty',
				'four hundred thirty nine','four hundred thirty eight','four hundred thirty seven','four hundred thirty six','four hundred thirty five',
				'four hundred thirty four','four hundred thirty three','four hundred thirty two','four hundred thirty one','four hundred thirty',
				'four hundred twenty nine','four hundred twenty eight','four hundred twenty seven','four hundred twenty six','four hundred twenty five',
				'four hundred twenty four','four hundred twenty three','four hundred twenty two','four hundred twenty one','four hundred twenty',
				'four hundred nineteen','four hundred eighteen','four hundred seventeen','four hundred sixteen','four hundred fifteen',
				'four hundred fourteen','four hundred thirteen','four hundred twelve','four hundred eleven','four hundred ten',
				'four hundred nine','four hundred eight','four hundred seven','four hundred six','four hundred five',
				'four hundred four','four hundred three','four hundred two','four hundred one','four hundred','three hundred ninety nine',
				'three hundred ninety eight','three hundred ninety seven','three hundred ninety six','three hundred ninety five','three hundred ninety four',
				'three hundred ninety three','three hundred ninety two','three hundred ninety one','three hundred ninety','three hundred eighty nine',
				'three hundred eighty eight','three hundred eighty seven','three hundred eighty six','three hundred eighty five','three hundred eighty four',
				'three hundred eighty three','three hundred eighty two','three hundred eighty one','three hundred eighty','three hundred seventy nine',
				'three hundred seventy eight','three hundred seventy seven','three hundred seventy six','three hundred seventy five','three hundred seventy four',
				'three hundred seventy three','three hundred seventy two','three hundred seventy one','three hundred seventy','three hundred sixty nine',
				'three hundred sixty eight','three hundred sixty seven','three hundred sixty six','three hundred sixty five','three hundred sixty four',
				'three hundred sixty three','three hundred sixty two','three hundred sixty one','three hundred sixty','three hundred fifty nine',
				'three hundred fifty eight','three hundred fifty seven','three hundred fifty six','three hundred fifty five','three hundred fifty four',
				'three hundred fifty three','three hundred fifty two','three hundred fifty one','three hundred fifty','three hundred forty nine',
				'three hundred forty eight','three hundred forty seven','three hundred forty six','three hundred forty five','three hundred forty four',
				'three hundred forty three','three hundred forty two','three hundred forty one','three hundred forty','three hundred thirty nine',
				'three hundred thirty eight','three hundred thirty seven','three hundred thirty six','three hundred thirty five','three hundred thirty four',
				'three hundred thirty three','three hundred thirty two','three hundred thirty one','three hundred thirty','three hundred twenty nine',
				'three hundred twenty eight','three hundred twenty seven','three hundred twenty six','three hundred twenty five','three hundred twenty four',
				'three hundred twenty three','three hundred twenty two','three hundred twenty one','three hundred twenty','three hundred nineteen',
				'three hundred eighteen','three hundred seventeen','three hundred sixteen','three hundred fifteen','three hundred fourteen',
				'three hundred thirteen','three hundred twelve','three hundred eleven','three hundred ten','three hundred nine',
				'three hundred eight','three hundred seven','three hundred six','three hundred five','three hundred four',
				'three hundred three','three hundred two','three hundred one','three hundred','two hundred ninety nine','two hundred ninety eight',
				'two hundred ninety seven','two hundred ninety six','two hundred ninety five','two hundred ninety four','two hundred ninety three',
				'two hundred ninety two','two hundred ninety one','two hundred ninety','two hundred eighty nine','two hundred eighty eight',
				'two hundred eighty seven','two hundred eighty six','two hundred eighty five','two hundred eighty four','two hundred eighty three',
				'two hundred eighty two','two hundred eighty one','two hundred eighty','two hundred seventy nine','two hundred seventy eight',
				'two hundred seventy seven','two hundred seventy six','two hundred seventy five','two hundred seventy four','two hundred seventy three',
				'two hundred seventy two','two hundred seventy one','two hundred seventy','two hundred sixty nine','two hundred sixty eight',
				'two hundred sixty seven','two hundred sixty six','two hundred sixty five','two hundred sixty four','two hundred sixty three',
				'two hundred sixty two','two hundred sixty one','two hundred sixty','two hundred fifty nine','two hundred fifty eight',
				'two hundred fifty seven','two hundred fifty six','two hundred fifty five','two hundred fifty four','two hundred fifty three',
				'two hundred fifty two','two hundred fifty one','two hundred fifty','two hundred forty nine','two hundred forty eight',
				'two hundred forty seven','two hundred forty six','two hundred forty five','two hundred forty four','two hundred forty three',
				'two hundred forty two','two hundred forty one','two hundred forty','two hundred thirty nine','two hundred thirty eight',
				'two hundred thirty seven','two hundred thirty six','two hundred thirty five','two hundred thirty four','two hundred thirty three',
				'two hundred thirty two','two hundred thirty one','two hundred thirty','two hundred twenty nine','two hundred twenty eight',
				'two hundred twenty seven','two hundred twenty six','two hundred twenty five','two hundred twenty four','two hundred twenty three',
				'two hundred twenty two','two hundred twenty one','two hundred twenty','two hundred nineteen','two hundred eighteen',
				'two hundred seventeen','two hundred sixteen','two hundred fifteen','two hundred fourteen','two hundred thirteen',
				'two hundred twelve','two hundred eleven','two hundred ten','two hundred nine','two hundred eight',
				'two hundred seven','two hundred six','two hundred five','two hundred four','two hundred three',
				'two hundred two','two hundred one','two hundred','one hundred ninety nine','one hundred ninety eight','one hundred ninety seven',
				'one hundred ninety six','one hundred ninety five','one hundred ninety four','one hundred ninety three','one hundred ninety two',
				'one hundred ninety one','one hundred ninety','one hundred eighty nine','one hundred eighty eight','one hundred eighty seven',
				'one hundred eighty six','one hundred eighty five','one hundred eighty four','one hundred eighty three','one hundred eighty two',
				'one hundred eighty one','one hundred eighty','one hundred seventy nine','one hundred seventy eight','one hundred seventy seven',
				'one hundred seventy six','one hundred seventy five','one hundred seventy four','one hundred seventy three','one hundred seventy two',
				'one hundred seventy one','one hundred seventy','one hundred sixty nine','one hundred sixty eight','one hundred sixty seven',
				'one hundred sixty six','one hundred sixty five','one hundred sixty four','one hundred sixty three','one hundred sixty two',
				'one hundred sixty one','one hundred sixty','one hundred fifty nine','one hundred fifty eight','one hundred fifty seven',
				'one hundred fifty six','one hundred fifty five','one hundred fifty four','one hundred fifty three','one hundred fifty two',
				'one hundred fifty one','one hundred fifty','one hundred forty nine','one hundred forty eight','one hundred forty seven',
				'one hundred forty six','one hundred forty five','one hundred forty four','one hundred forty three','one hundred forty two',
				'one hundred forty one','one hundred forty','one hundred thirty nine','one hundred thirty eight','one hundred thirty seven',
				'one hundred thirty six','one hundred thirty five','one hundred thirty four','one hundred thirty three','one hundred thirty two',
				'one hundred thirty one','one hundred thirty','one hundred twenty nine','one hundred twenty eight','one hundred twenty seven',
				'one hundred twenty six','one hundred twenty five','one hundred twenty four','one hundred twenty three','one hundred twenty two',
				'one hundred twenty one','one hundred twenty','one hundred nineteen','one hundred eighteen','one hundred seventeen',
				'one hundred sixteen','one hundred fifteen','one hundred fourteen','one hundred thirteen','one hundred twelve',
				'one hundred eleven','one hundred ten','one hundred nine','one hundred eight','one hundred seven',
				'one hundred six','one hundred five','one hundred four','one hundred three','one hundred two','one hundred one',
				'one hundred', 'ninety nine','ninety eight','ninety seven','ninety six','ninety five','ninety four','ninety three','ninety two','ninety one',
				'ninety','eighty nine','eighty eight','eighty seven','eighty six','eighty five','eighty four','eighty three','eighty two','eighty one',
				'eighty','seventy nine','seventy eight','seventy seven','seventy six','seventy five','seventy four','seventy three','seventy two','seventy one',
				'seventy','sixty nine','sixty eight','sixty seven','sixty six','sixty five','sixty four','sixty three','sixty two','sixty one',
				'sixty','fifty nine','fifty eight','fifty seven','fifty six','fifty five','fifty four','fifty three','fifty two','fifty one',
				'fifty','forty nine','forty eight','forty seven','forty six','forty five','forty four','forty three','forty two','forty one',
				'forty','thirty nine','thirty eight','thirty seven','thirty six','thirty five','thirty four','thirty three','thirty two','thirty one',
				'thirty','twenty nine','twenty eight','twenty seven','twenty six','twenty five','twenty four','twenty three','twenty two','twenty one',
				'twenty','nineteen','eighteen','seventeen','sixteen','fifteen','fourteen','thirteen','twelve','eleven',
				'ten','nine','eight','seven','six','five','four','three','two','one','zero');
		$search = array(
				'1000','999','998','997','996','995','994','993','992','991','990','989','988','987','986','985','984','983','982','981',
				'980','979','978','977','976','975','974','973','972','971','970','969','968','967','966','965','964','963','962','961',
				'960','959','958','957','956','955','954','953','952','951','950','949','948','947','946','945','944','943','942','941',
				'940','939','938','937','936','935','934','933','932','931','930','929','928','927','926','925','924','923','922','921',
				'920','919','918','917','916','915','914','913','912','911','910','909','908','907','906','905','904','903','902','901',
				'900','899','898','897','896','895','894','893','892','891','890','889','888','887','886','885','884','883','882','881',
				'880','879','878','877','876','875','874','873','872','871','870','869','868','867','866','865','864','863','862','861',
				'860','859','858','857','856','855','854','853','852','851','850','849','848','847','846','845','844','843','842','841',
				'840','839','838','837','836','835','834','833','832','831','830','829','828','827','826','825','824','823','822','821',
				'820','819','818','817','816','815','814','813','812','811','810','809','808','807','806','805','804','803','802','801',
				'800','799','798','797','796','795','794','793','792','791','790','789','788','787','786','785','784','783','782','781',
				'780','779','778','777','776','775','774','773','772','771','770','769','768','767','766','765','764','763','762','761',
				'760','759','758','757','756','755','754','753','752','751','750','749','748','747','746','745','744','743','742','741',
				'740','739','738','737','736','735','734','733','732','731','730','729','728','727','726','725','724','723','722','721',
				'720','719','718','717','716','715','714','713','712','711','710','709','708','707','706','705','704','703','702','701',
				'700','699','698','697','696','695','694','693','692','691','690','689','688','687','686','685','684','683','682','681',
				'680','679','678','677','676','675','674','673','672','671','670','669','668','667','666','665','664','663','662','661',
				'660','659','658','657','656','655','654','653','652','651','650','649','648','647','646','645','644','643','642','641',
				'640','639','638','637','636','635','634','633','632','631','630','629','628','627','626','625','624','623','622','621',
				'620','619','618','617','616','615','614','613','612','611','610','609','608','607','606','605','604','603','602','601',
				'600','599','598','597','596','595','594','593','592','591','590','589','588','587','586','585','584','583','582','581',
				'580','579','578','577','576','575','574','573','572','571','570','569','568','567','566','565','564','563','562','561',
				'560','559','558','557','556','555','554','553','552','551','550','549','548','547','546','545','544','543','542','541',
				'540','539','538','537','536','535','534','533','532','531','530','529','528','527','526','525','524','523','522','521',
				'520','519','518','517','516','515','514','513','512','511','510','509','508','507','506','505','504','503','502','501',
				'500','499','498','497','496','495','494','493','492','491','490','489','488','487','486','485','484','483','482','481',
				'480','479','478','477','476','475','474','473','472','471','470','469','468','467','466','465','464','463','462','461',
				'460','459','458','457','456','455','454','453','452','451','450','449','448','447','446','445','444','443','442','441',
				'440','439','438','437','436','435','434','433','432','431','430','429','428','427','426','425','424','423','422','421',
				'420','419','418','417','416','415','414','413','412','411','410','409','408','407','406','405','404','403','402','401',
				'400','399','398','397','396','395','394','393','392','391','390','389','388','387','386','385','384','383','382','381',
				'380','379','378','377','376','375','374','373','372','371','370','369','368','367','366','365','364','363','362','361',
				'360','359','358','357','356','355','354','353','352','351','350','349','348','347','346','345','344','343','342','341',
				'340','339','338','337','336','335','334','333','332','331','330','329','328','327','326','325','324','323','322','321',
				'320','319','318','317','316','315','314','313','312','311','310','309','308','307','306','305','304','303','302','301',
				'300','299','298','297','296','295','294','293','292','291','290','289','288','287','286','285','284','283','282','281',
				'280','279','278','277','276','275','274','273','272','271','270','269','268','267','266','265','264','263','262','261',
				'260','259','258','257','256','255','254','253','252','251','250','249','248','247','246','245','244','243','242','241',
				'240','239','238','237','236','235','234','233','232','231','230','229','228','227','226','225','224','223','222','221',
				'220','219','218','217','216','215','214','213','212','211','210','209','208','207','206','205','204','203','202','201',
				'200','199','198','197','196','195','194','193','192','191','190','189','188','187','186','185','184','183','182','181',
				'180','179','178','177','176','175','174','173','172','171','170','169','168','167','166','165','164','163','162','161',
				'160','159','158','157','156','155','154','153','152','151','150','149','148','147','146','145','144','143','142','141',
				'140','139','138','137','136','135','134','133','132','131','130','129','128','127','126','125','124','123','122','121',
				'120','119','118','117','116','115','114','113','112','111','110','109','108','107','106','105','104','103','102','101',
				'100','99','98','97','96','95','94','93','92','91','90','89','88','87','86','85','84','83','82','81',
				'80','79','78','77','76','75','74','73','72','71','70','69','68','67','66','65','64','63','62','61',
				'60','59','58','57','56','55','54','53','52','51','50','49','48','47','46','45','44','43','42','41',
				'40','39','38','37','36','35','34','33','32','31','30','29','28','27','26','25','24','23','22','21',
				'20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1','0');
			return str_replace($search,$replace,$string);
		}
		return $string;		
	}
	
	/**
	*	Random Key
	*
	*	@returns a string
	**/
	public static function randomkey($size)
	{
		$bag = "abcefghijknopqrstuwxyzABCDDEFGHIJKLLMMNOPQRSTUVVWXYZabcddefghijkllmmnopqrstuvvwxyzABCEFGHIJKNOPQRSTUWXYZ";
		$key = array();
		$bagsize = strlen($bag) - 1;
		for ($i = 0; $i < $size; $i++)
		{
			$get = rand(0, $bagsize);
			$key[] = $bag[$get];
		}
		return implode($key);
	}
}
