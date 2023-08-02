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

$user = Factory::getApplication()->getIdentity();
$userId = $user->get('id');
$total_approved = 0;
?>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="5%">Work Id</th>
        <th width="30%">Work Description</th>
        <th width="15%">Director Email</th>
        <th width="5%">Hours Submitted</th>
        <th width="5%">Hours Approved</th>
        <th width="10%">Status</th>
        <th width="30%">Comment</th>
    </tr>
    </thead>
    <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) :?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->work_desc; ?></td>
                    <td><?php echo $row->director_email; ?></td>
                    <td><?php echo $row->hours_submitted; ?></td>
                    <td><?php echo $row->hours_approved;
                        $total_approved += $row->hours_approved;
                        ?>
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
                    <td><?php echo $row->approve_comment; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Total Approved:</td>
            <td><?php echo $total_approved; ?></td>
            <td></td>
        </tr>
    </tbody>
</table>
