<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * This layout file is for displaying the front end form for capturing a new helloworld message
 *
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Log\Log;

if(empty($this->workhour)){
			LOG::add('Workhour tmpl has form:workhour empty',LOG::ERROR,'workhour');
}
		
if(empty($this->form)){
	LOG::add('Workhour tmpl has form:form empty',LOG::ERROR,'workhour');
}

$this->document->getWebAssetManager()->useScript('com_helloworld.validate-greeting');

?>
<form action="<?php echo Route::_('index.php?option=com_helloworld&view=workhour'); ?>"
    method="post" name="adminForm" id="adminForm" class="form-validate" enctype="multipart/form-data">

	<div class="form-horizontal">
		<fieldset class="adminform">
			<legend><?php echo 'Submit work hour' ?></legend>
			<div class="row-fluid">
				<div class="span6">
					<?php echo $this->workhour->renderFieldset('details');  ?>
				</div>
			</div>
		</fieldset>
	</div>
    
	<div class="btn-toolbar">
		<div class="btn-group">
			<button type="button" class="btn btn-primary" onclick="Joomla.submitbutton('helloworld.submit')">
				<span class="icon-ok"></span><?php echo Text::_('JSAVE') ?>
			</button>
		</div>
		<div class="btn-group">
			<button type="button" class="btn" onclick="Joomla.submitbutton('helloworld.cancel')">
				<span class="icon-cancel"></span><?php echo Text::_('JCANCEL') ?>
			</button>
		</div>
	</div>

	<input type="hidden" name="task" />
    <input type="hidden" name="modelname" value="workhour"/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>