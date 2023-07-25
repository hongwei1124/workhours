<?php

namespace Robbie\Component\Helloworld\Site\Model;

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseInterface;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Date\Date;
use Joomla\CMS\Log\Log;

class WorkhoursModel extends ListModel
{
    public function __construct($config = array())
	{
		parent::__construct($config);
	}
    
	/**
	 * Method to build an SQL query to load the list data.
	 *
	 * @return      string  A SQL query
	 */
	protected function getListQuery()
	{
        // Initialize variables.
        $db = $this->getDatabase();
        $query = $db->getQuery(true);
        $user = Factory::getApplication()->getIdentity();
        $user_id = $user->get("id");
        $today = Date::getInstance();

        $month = $this->getMonth($today);
        $year = $this->getYear($today);

        if ($month < 11) {
            $year = $year -1;
        }

        $dateCondition = ' and a.start_datetime > \''.$year.'-10-31\'';
        Log::add('Date condition: ' . $dateCondition, Log::DEBUG, 'workhour');

        // Create the base select statement.
        $query->select('a.id as id, a.director_email as director_email, a.work_desc as work_desc, 
        a.approve_comment as approve_comment, a.hours_submitted as hours_submitted, a.hours_approved as hours_approved,
        a.approved as approved')
			->from($db->quoteName('#__workhour', 'a'))
            ->where('a.user_id = '.$user_id.$dateCondition);

		return $query;
	}

    private function getYear($pdate) {
        $date = DateTime::createFromFormat('Y-m-d', $pdate);
        return $date->format('Y');
    }

    private function getMonth($pdate) {
        $date = DateTime::createFromFormat('Y-m-d', $pdate);
        return $date->format('m');
    }
}