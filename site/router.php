<?php
/*----------------------------------------------------------------------------------|  www.vdm.io  |----/
				Vast Development Method 
/-------------------------------------------------------------------------------------------------------/

	@version		2.0.3
	@build			18th October, 2021
	@created		18th October, 2016
	@package		Demo
	@subpackage		router.php
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

use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\StandardRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Factory;
use Joomla\CMS\Menu\SiteMenu;

/**
 * Routing class from com_demo
 *
 * @since  3.3
 */
class DemoRouter extends RouterView
{	
	/**
	 * The database driver
	 *
	 * @var    \JDatabaseDriver
	 * @since  1.0
	 */
	protected $db;

	/**
	 * Search Component router constructor
	 *
	 * @param   CMSApplication  $app   The application object
	 * @param   SiteMenu        $menu  The menu object to work with
	 */
	public function __construct($app = null, $menu = null)
	{
		$this->db = Factory::getDbo();

		$looks = new RouterViewConfiguration('looks');
		$this->registerView($looks);

		$look = (new RouterViewConfiguration('look'))
			->setParent($looks)
			->setKey('id');
		$this->registerView($look);

		$looking = (new RouterViewConfiguration('looking'))
			->setParent($look, 'id')
			->setKey('id');

		$this->registerView($looking);

		$export = (new RouterViewConfiguration('export'))
			->setKey('cms_version');
		$this->registerView($export);

		parent::__construct($app, $menu);

		$this->attachRule(new MenuRules($this));
		$this->attachRule(new StandardRules($this));
		$this->attachRule(new NomenuRules($this));
	}

	/**
	 * Method to get the segment(s) for looks
	 *
	 * @param   string  $id     ID of the looks to retrieve the segments for
	 * @param   array   $query  The request that is built right now
	 *
	 * @return  array|string  The segments of this item
	 */
	public function getLooksSegment($id, $query)
	{
		return $this->getLookSegment($id, $query);
	}

	/**
	 * Method to get the segment(s) for  looks
	 *
	 * @param   string  $segment  Segment of the contact to retrieve the ID for
	 * @param   array   $query    The request that is parsed right now
	 *
	 * @return  mixed   The id of this item or false
	 */
	public function getLooksId($segment, $query)
	{
		return $this->getLookId($segment, $query);
	}

	/**
	 * Method to get the segment(s) for a look
	 *
	 * @param   string  $id     ID of the application to retrieve the segments for
	 * @param   array   $query  The request that is built right now
	 *
	 * @return  array|string  The segments of this item
	 */
	public function getLookSegment($id, $query)
	{
		if (!strpos($id, ':'))
		{
			$dbquery = $this->db->getQuery(true);
			$dbquery->select($this->db->quoteName('alias'))
				->from($this->db->quoteName('#__demo_look'))
				->where('id = ' . $dbquery->q((int) $id));
			$this->db->setQuery($dbquery);

			$id .= ':' . $this->db->loadResult();
		}

		list($void, $segment) = explode(':', $id, 2);

		return array($void => $segment);
	}

	/**
	 * Method to get the segment(s) for a look
	 *
	 * @param   string  $segment  Segment of the application to retrieve the ID for
	 * @param   array   $query    The request that is parsed right now
	 *
	 * @return  mixed   The id of this item or false
	 */
	public function getLookId($segment, $query)
	{
		$query = $this->db->getQuery(true);
		$query->select($this->db->quoteName('id'))
			->from($this->db->quoteName('#__demo_look'))
			->where('alias = ' . $this->db->quote($segment));
		$this->db->setQuery($query);

		return (int) $this->db->loadResult();
	}

        	/**
	 * Method to get the segment(s) for a looking
	 *
	 * @param   string  $id     ID of the looking to retrieve the segments for
	 * @param   array   $query  The request that is built right now
	 *
	 * @return  array|string  The segments of this item
	 */
	public function getLookingSegment($id, $query)
	{
		if (!strpos($id, ':'))
		{
			$dbquery = $this->db->getQuery(true);
			$dbquery->select($this->db->quoteName('alias'))
				->from($this->db->quoteName('#__demo_look'))
				->where('id = ' . $dbquery->q((int) $id));
			$this->db->setQuery($dbquery);

			$id .= ':' . $this->db->loadResult();
		}

		list($void, $segment) = explode(':', $id, 2);

		return array($void => $segment);
	}

	/**
	 * Method to get the segment(s) for a looking
	 *
	 * @param   string  $segment  Segment of the looking to retrieve the ID for
	 * @param   array   $query    The request that is parsed right now
	 *
	 * @return  mixed   The id of this item or false
	 */
	public function getLookingId($segment, $query)
	{
		$dbQuery = $this->db->getQuery(true);
		$dbQuery->select($this->db->quoteName('id'))
			->from($this->db->quoteName('#__demo_look'))
			->where(
				[
					$this->db->quoteName('alias') . ' = ' . $this->db->quote($segment),
					$this->db->quoteName('id') . ' = ' . (int) $query['id'],
				]
			);;
		$this->db->setQuery($dbQuery);

		return (int) $this->db->loadResult();
	}
}