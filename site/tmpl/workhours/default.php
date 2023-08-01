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
?>

<table class="table table-striped table-hover">
    <thead>
    <tr>
        <th width="30%">Work Description</th>
        <th width="20%">Director Email</th>
        <th width="10%">Hours</th>
        <th width="10%">Status</th>
        <th width="30%">Comment</th>
    </tr>
    </thead>
    <tbody>
        <?php if (!empty($this->items)) : ?>
            <?php foreach ($this->items as $i => $row) :?>
                <tr>
                    <td><?php echo $row->work_desc; ?></td>
                    <td><?php echo $row->director_email; ?></td>
                    <td><?php echo $row->hours_submitted; ?></td>
                    <td><?php echo $row->approved; ?></td>
                    <td><?php echo $row->approve_comment; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
