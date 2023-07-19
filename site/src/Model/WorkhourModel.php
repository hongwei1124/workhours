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
class WorkhourModel extends AdminModel
{

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
	public function getWorkhour($data = array(), $loadData = true)
	{
		Log::add('Here in getWorkhour',LOG::DEBUG,'workhour');
		
		// Get the form.
		$form = $this->loadForm(
			'com_helloworld.workhour',
			'submit-form',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);

		Log::add('Here in getWorkhour after get form',LOG::DEBUG,'workhour');
		if (empty($form))
		{
			$errors = $this->getErrors();
			Log::add('Here in getWorkhour in empty form',LOG::ERROR,'workhour');
			throw new \Exception(implode("\n", $errors), 500);
		}

		return $form;
	}
	
	//not sure if getForm, or getWorkhour method
	public function getForm($data = array(), $loadData = true)
	{
		Log::add('Here in getForm',LOG::DEBUG,'workhour');
		// Get the form.
		$form = $this->loadForm(
			'com_helloworld.workhour',
			'submit-form',
			array(
				'control' => 'jform',
				'load_data' => $loadData
			)
		);
		
		Log::add('Here in getForm after form',LOG::DEBUG,'workhour');

		if (empty($form))
		{
			$errors = $this->getErrors();
			Log::add('Here in getForm of empty form',LOG::ERROR,'workhour');
			throw new \Exception(implode("\n", $errors), 500);
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 * As this form is for add, we're not prefilling the form with an existing record
	 * But if the user has previously hit submit and the validation has found an error,
	 *   then we inject what was previously entered.
	 *
	 * @return  mixed  The data for the form.
	 *
	 * @since   1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = Factory::getApplication()->getUserState(
			'com_helloworld.edit.helloworld.workhour',
			array()
		);

		return $data;
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