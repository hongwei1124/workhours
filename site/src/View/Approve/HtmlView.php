<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Robbie\Component\Helloworld\Site\View\Approve;

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Log\Log;

/**
 * HelloWorld View
 * This is the site view presenting the user with the ability to add a new Helloworld record
 * 
 */
class HtmlView extends BaseHtmlView
{
	protected $approve = null;
    protected $item = null;
    protected $work_id = null;
	protected $canDo;

	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the layout file to parse.
	 *
	 * @return  void
	 */
	public function display($tpl = null)
	{
		$app = Factory::getApplication();
        Log::add('Here in approve view to display', LOG::ERROR,'approve');
        // Get the form to display
		$this->approve = $this->get('Approve');

        //get the data
        $this->item = $this->get('Item');

        $this->work_id = $this->item->id;
		
		if(empty($this->approve)){
			LOG::add('Approve view has form:approve empty',LOG::ERROR,'workhour');
		}
		
		if(empty($this->item)){
			LOG::add('Approve view has data item:item empty',LOG::ERROR,'workhour');
		}
		
		LOG::add('Approve view has view name:'.$tpl,LOG::DEBUG,'workhour');

        //bind the data
        $this->approve->bind($this->item);

		// Call the parent display to display the layout file
		parent::display($tpl);

		// Set properties of the html document
		$this->setDocument();
	}

	/**
	 * Method to set up the html document properties
	 *
	 * @return void
	 */
	public function setDocument()
	{
        $this->document->setTitle('Submit work hour');
	}
}