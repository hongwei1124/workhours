<?php

namespace Robbie\Component\Helloworld\Administrator\Table;

use Joomla\CMS\Factory;
use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\Log\Log;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Tag\TaggableTableInterface;
use Joomla\CMS\Tag\TaggableTableTrait;
use Joomla\CMS\Versioning\VersionableTableInterface;
use Joomla\Database\DatabaseDriver;

\defined('_JEXEC') or die;

/**
 * Workhour Table class.
 *
 * @since  1.0
 **/
class WorkhourTable extends Table implements VersionableTableInterface, TaggableTableInterface
{
    use TaggableTableTrait;
    
     public function __construct(DatabaseDriver $db)
    {
        $this->typeAlias = 'com_helloworld.workhour';

        parent::__construct('#__workhour', 'id', $db);
        
        // In functions such as generateTitle() Joomla looks for the 'title' field ...
        $this->setColumnAlias('title', 'workhour');
    }
    
    public function bind($array, $ignore = '')
	{
        Log::add('check data for bind', Log::DEBUG, 'workhour');
        foreach ($array as $key => $value) {
            Log::add('check data for bind, key='.$key.' value='.$value, Log::DEBUG, 'workhour');
        }

		return parent::bind($array, $ignore);
	}
    
    public function store($updateNulls = true)
    {
        // add the 'created by' and 'created' date fields if it's a new record
        // and these fields aren't already set
        $date = date('Y-m-d h:i:s');
        $userid = Factory::getApplication()->getIdentity()->get('id');
        Log::add('check data for start_datetime:' . $this->start_datetime, Log::DEBUG, 'workhour');
        if (!$this->id) {
            // new record
            $this->user_id = $userid;
            $this->created_by = $userid;
            $this->created    = $date;

        }else{
			$this->updated_by = $userid;
            $this->last_updated    = $date;
		}
        Log::add('store data for:' . $userid, Log::DEBUG, 'workhour');
        return parent::store();
    }
    
    /**
	 * Method to compute the default name of the asset.
	 * The default name is in the form `table_name.id`
	 * where id is the value of the primary key of the table.
	 *
	 * @return	string
	 * @since	2.5
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;
		return 'com_helloworld.helloworld.'.(int) $this->$k;
	}
	/**
	 * Method to return the title to use for the asset table.
	 *
	 * @return	string
	 * @since	2.5
	 */
	protected function _getAssetTitle()
	{
		return $this->greeting;
	}
	/**
	 * Method to get the asset-parent-id of the item
	 *
	 * @return	int
	 */
	protected function _getAssetParentId(Table $table = NULL, $id = NULL)
	{
		// We will retrieve the parent-asset from the Asset-table
		$assetParent = Table::getInstance('Asset');
		// Default: if no asset-parent can be found we take the global asset
		$assetParentId = $assetParent->getRootId();

		// Find the parent-asset
		if (($this->catid)&& !empty($this->catid))
		{
			// The item has a category as asset-parent
			$assetParent->loadByName('com_helloworld.category.' . (int) $this->catid);
		}
		else
		{
			// The item has the component as asset-parent
			$assetParent->loadByName('com_helloworld');
		}

		// Return the found asset-parent-id
		if ($assetParent->id)
		{
			$assetParentId=$assetParent->id;
		}
		return $assetParentId;
	}
    
    public function check()
	{
		$this->alias = trim($this->alias);
		if (empty($this->alias))
		{
			$this->alias = $this->greeting;
		}
		$this->alias = OutputFilter::stringURLSafe($this->alias);
		return true;
	}
    
    public function delete($pk = null, $children = false)
	{
		return parent::delete($pk, $children);
	}
    
    /**
     * typeAlias is the key used to find the content_types record
     * needed for creating the history record
     */
    public function getTypeAlias()
    {
        return $this->typeAlias;
    }
}
