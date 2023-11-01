<?php

namespace Robbie\Component\Helloworld\Site\View\Approvals;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ContentHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarFactoryInterface;
use Joomla\CMS\Toolbar\ToolbarHelper;

class HtmlView extends BaseHtmlView {
    
    /**
     * Display the main user work hour list view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     * @return  void
     */
    function display($tpl = null) {
        // Get data from the model
		$this->items		= $this->get('Items');

        // What Access Permissions does this user have? What can (s)he do?
		$this->canDo = ContentHelper::getActions('com_helloworld');
        
        if (\count($errors = $this->get('Errors'))) {
            throw new GenericDataException(implode("\n", $errors), 500);
        }

        // Display the layout
		parent::display($tpl);
        
        $this->setDocument();
    }
    
    public function setDocument()
	{
		//$document = Factory::getApplication()->getDocument();
		$this->document->setTitle('Approvals list');
	}

}