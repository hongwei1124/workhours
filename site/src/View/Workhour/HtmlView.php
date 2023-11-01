<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
namespace Robbie\Component\Helloworld\Site\View\Workhour;

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

//test if workhour/form is the correct one
	protected $form = null;
	protected $workhour = null;
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
        
        // Get the form to display
		$this->workhour = $this->get('Workhour');
		$this->form = $this->get('Form');
		
		if(empty($this->workhour)){
			LOG::add('Workhour view has form:workhour empty',LOG::ERROR,'workhour');
		}
		
		if(empty($this->form)){
			LOG::add('Workhour view has form:form empty',LOG::ERROR,'workhour');
		}
		
		LOG::add('Workhour view has view name:'.$tpl,LOG::DEBUG,'workhour');

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