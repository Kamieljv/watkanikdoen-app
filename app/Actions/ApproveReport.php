<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ApproveReport extends AbstractAction
{
    public function getTitle()
    {
        return trans('general.approve');
    }

    public function getIcon()
    {
        return 'voyager-check-circle';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary btn-success pull-right approve',
        ];
    }

    public function getDefaultRoute()
    {
        if ($this->dataType->slug === 'reports') {
            return route('report.approve', $this->data->{$this->data->getKeyName()});
        } else if ($this->dataType->slug === 'organizers') {
            return route('organizer.approve', $this->data->{$this->data->getKeyName()});
        }
    }

    /*
     * Determines in what datatypes this action should be present
     */
    public function shouldActionDisplayOnDataType()
    {
        return in_array($this->dataType->slug, ['reports', 'organizers']);
    }

    /*
     * Determines in which rows this action should be present
     */
    public function shouldActionDisplayOnRow($row)
    {
        return $row->status === "PENDING";
    }
}
