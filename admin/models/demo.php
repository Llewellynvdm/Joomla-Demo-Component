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

// import the Joomla modellist library
jimport('joomla.application.component.modellist');
jimport('joomla.application.component.helper');

/**
 * Demo Model
 */
class DemoModelDemo extends JModelList
{
	public function getIcons() 
	{
    	// load user for access menus
    	$user = JFactory::getUser();
        // reset icon array
		$icons  = array();
        // view groups array
		$viewGroups = array(
			'main' => array('png.look.add', 'png.looks', 'png.help_documents')
		);
		// view access array
		$viewAccess = array(
			'help_document.create' => 'help_document.create',
			'help_documents.access' => 'help_document.access',
			'help_document.access' => 'help_document.access');
		foreach($viewGroups as $group => $views)
        {
			$i = 0;
			if (DemoHelper::checkArray($views))
            {
				foreach($views as $view)
				{
					$add = false;
					if (strpos($view,'.') !== false)
                    {
						list($type, $name, $action) = explode('.', $view);
                        if ($action)
                        {
                        	$viewName = $name;
                            switch($action)
                            {
                                case 'add':
                                    $url 	='index.php?option=com_demo&view='.$name.'&layout=edit';
                                    $image 	= $name.'_'.$action.'.'.$type;
                                    $alt 	= $name.'&nbsp;'.$action;
                                    $name	= 'COM_DEMO_DASHBOARD_'.DemoHelper::safeString($name,'U').'_ADD';
                                    $add	= true;
                                break;
                                default:
                                    $url 	= 'index.php?option=com_categories&view=categories&extension=com_demo.'.$name;
                                    $image 	= $name.'_'.$action.'.'.$type;
                                    $alt 	= $name.'&nbsp;'.$action;
                                    $name	= 'COM_DEMO_DASHBOARD_'.DemoHelper::safeString($name,'U').'_'.DemoHelper::safeString($action,'U');
                                break;
                            }
                        }
                        else
                        {
                        	$viewName 	= $name;
                            $alt 		= $name;
                            $url 		= 'index.php?option=com_demo&view='.$name;
                            $image 		= $name.'.'.$type;
                            $name 		= 'COM_DEMO_DASHBOARD_'.DemoHelper::safeString($name,'U');
                            $hover		= false;
                        }
					}
                    else
                    {
                    	$viewName 	= $view;
						$alt 		= $view;
						$url 		= 'index.php?option=com_demo&view='.$view;
						$image 		= $view.'.png';
						$name 		= ucwords($view).'<br /><br />';
						$hover		= false;
					}
                    // first make sure the view access is set
                    if (DemoHelper::checkArray($viewAccess))
                    {
                        // acces checking start
                        $accessCreate = DemoHelper::checkString($viewAccess[$viewName.'.create']);
                        $accessAccess = DemoHelper::checkString($viewAccess[$viewName.'.access']);
                        $accessTo = '';
                        $accessAdd = '';
                        // check for adding access
                        if ($add && $accessCreate)
                        {
                            $accessAdd = $viewAccess[$viewName.'.create'];
                        }
                        elseif ($add)
                        {
                            $accessAdd = 'core.create';
                        }
                        // check if acces to view is set
                        if ($accessAccess)
                        {
                            $accessTo = $viewAccess[$viewName.'.access'];
                        }
                        if (DemoHelper::checkString($accessAdd) && DemoHelper::checkString($accessTo))
                        {
                            // check access
                            if($user->authorise($accessAdd, 'com_demo') && $user->authorise($accessTo, 'com_demo'))
                            {
                                $icons[$group][$i] = new StdClass;
                                $icons[$group][$i]->url 	= $url;
                                $icons[$group][$i]->name 	= $name;
                                $icons[$group][$i]->image 	= $image;
                                $icons[$group][$i]->alt 	= $alt;
                            }
                        }
                        elseif (DemoHelper::checkString($accessTo))
                        {
                            // check access
                            if($user->authorise($accessTo, 'com_demo'))
                            {
                                $icons[$group][$i] = new StdClass;
                                $icons[$group][$i]->url 	= $url;
                                $icons[$group][$i]->name 	= $name;
                                $icons[$group][$i]->image 	= $image;
                                $icons[$group][$i]->alt 	= $alt;
                            }
                        }
                        elseif (DemoHelper::checkString($accessAdd))
                        {
                            // check access
                            if($user->authorise($accessAdd, 'com_demo'))
                            {
                                $icons[$group][$i] = new StdClass;
                                $icons[$group][$i]->url 	= $url;
                                $icons[$group][$i]->name 	= $name;
                                $icons[$group][$i]->image 	= $image;
                                $icons[$group][$i]->alt 	= $alt;
                            }
                        }
                        else
                        {
                            $icons[$group][$i] = new StdClass;
                            $icons[$group][$i]->url 	= $url;
                            $icons[$group][$i]->name 	= $name;
                            $icons[$group][$i]->image 	= $image;
                            $icons[$group][$i]->alt 	= $alt;
                        }
                    }
                    else
                    {
                        $icons[$group][$i] = new StdClass;
                        $icons[$group][$i]->url 	= $url;
                        $icons[$group][$i]->name 	= $name;
                        $icons[$group][$i]->image 	= $image;
                        $icons[$group][$i]->alt 	= $alt;
                    }
                   	$i++;
				}
			}
            else
            {
				$icons[$group][$i] = false;
			}
		}
		return $icons;		
	}
	
	public function getContributors()
	{
		// get params
		$params	= JComponentHelper::getParams('com_demo');
		// start contributors array
		$contributors = array();
		// get all Contributors
		$searchArray = range('0','20');
		foreach($searchArray as $nr)
        {
			if ((NULL !== $params->get("showContributor".$nr)) && ($params->get("showContributor".$nr) == 1 || $params->get("showContributor".$nr) == 3))
            {
				// set link based of selected option
				if($params->get("useContributor".$nr) == 1)
                {
					$link_front = '<a href="mailto:'.$params->get("emailContributor".$nr).'" target="_blank">';
					$link_back = '</a>';
				}
                elseif($params->get("useContributor".$nr) == 2)
                {
					$link_front = '<a href="'.$params->get("linkContributor".$nr).'" target="_blank">';
					$link_back = '</a>';
				}
                else
                {
					$link_front = '';
					$link_back = '';
				}
				$contributors[$nr]['title']	= DemoHelper::htmlEscape($params->get("titleContributor".$nr));
				$contributors[$nr]['name']	= $link_front.DemoHelper::htmlEscape($params->get("nameContributor".$nr)).$link_back;
			}
		}
		return $contributors;
	}
}
