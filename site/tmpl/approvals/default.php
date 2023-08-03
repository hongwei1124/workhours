<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
use Joomla\CMS\User\UserFactoryInterface;

$user = Factory::getApplication()->getIdentity();
$userId = $user->get('id');

$container = Factory::getContainer();
$userFactory = $container->get(UserFactoryInterface::class);
?>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="5%">Work Id</th>
        <th width="15%">Director Email</th>
        <th width="10%">Name</th>
        <th width="30%">Work Description</th>
        <th width="5%">Hours Submitted</th>
        <th width="10%">Start Time</th>
        <th width="10%">Complete Time</th>
        <th width="10%">Status</th>
        <th width="5%"></th>
    </tr>
    </thead>
    <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) :?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->director_email; ?></td>
                    <td><?php
                        $worker = $userFactory->loadUserById($row->user_id);
                        echo $worker->get('name');
                        ?>
                    </td>
                    <td><?php echo $row->work_desc; ?></td>
                    <td><?php echo $row->hours_submitted; ?></td>
                    <td><?php echo $row->start_datetime; ?>
                    <td><?php echo $row->complete_datetime; ?>
                    </td>
                    <td><?php
                        if ($row->approved == 0){
                            echo "Submitted";
                        }else if ($row->approved == 1){
                            echo "Approved";
                        }else if($row->approved == 2){
                            echo "Rejected";
                        }else{
                            echo "Unknown";
                        } ?>
                    </td>
                    <?php $url = Route::_('index.php?option=com_helloworld&view=approve&id=' . $row->id); ?>
                    <td><a href="<?php echo $url; ?>">Go to approve</a></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
