<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Robbie\Component\Helloworld\Site\Model;

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\Model\AdminModel;
use Joomla\CMS\Factory;
use Joomla\CMS\Log\Log;


/**
 * HelloWorld Model
 *
 * @since  0.0.1
 */
class ApproveModel extends AdminModel
{

    protected $item;
	/**
	 * Method to get a table object, load it if necessary.
	 *
	 * @param   string  $type    The table name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  Table  A Table object
     *
     * We need to override this - otherwise it would take 'Form' as the $name
	 */

    public function getTable($name = 'Workhour', $prefix = 'administrator', $options = array())
    {
        return parent::getTable($name, $prefix, $options);
    }

    /**
	 * Method to get the record form.
	 *
	 * @param   array    $data      Data for the form.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  mixed    A JForm object on success, false on failure
	 *
	 * @since   1.6
	 */
	public function getApprove($data = array(), $loadData = true)
	{
		Log::add('Here in approve form',LOG::DEBUG,'workhour');
		
		// Get the form.
		$form = $this->loadForm(
			'com_helloworld.approve',
			'approve-form',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);

		Log::add('Here in approve after get form',LOG::DEBUG,'workhour');
		if (empty($form))
		{
			$errors = $this->getErrors();
			Log::add('Here in approve in empty form',LOG::ERROR,'workhour');
			throw new \Exception(implode("\n", $errors), 500);
		}

		return $form;
	}

    /**
     * Get the message
     * @return object The message to be displayed to the user
     */
    public function getItem($pk = NULL)
    {
        $jinput = Factory::getApplication()->input;
        $id     = $jinput->get('id', 1, 'INT');
        Log::add('Here in approve to get work id: '.$id, LOG::ERROR,'workhour');
        if (!isset($this->item) || !is_null($id))
        {
            $db    = $this->getDatabase();
            $query = $db->getQuery(true);

            $query->select('a.id as id, a.director_email as director_email, a.work_desc as work_desc, 
            a.start_datetime as start_datetime, a.complete_datetime as complete_datetime,  a.hours_submitted as hours_submitted, a.hours_submitted as hours_approved,
            1 as approved')
                ->from($db->quoteName('#__workhour', 'a'))
                ->where('a.id = '.(int)$id);


            $db->setQuery((string)$query);

            $this->item = $db->loadObject();
        }

        return $this->item;
    }


    /**
	 * Prepare a helloworld record for saving in the database
	 */
	protected function prepareTable($table)
	{
	}
    
    protected function cleanCache($group = null, $client_id = 0)
	{
		parent::cleanCache('com_helloworld');
	}
}