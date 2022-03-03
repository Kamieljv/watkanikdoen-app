<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

class ApproveReport extends AbstractAction
{
    public function getTitle()
    {
        return trans('reports.approve');
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
        return route('report.approve', $this->data->{$this->data->getKeyName()});
    }

    /*
     * Determines in what datatypes this action should be present
     */
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug === 'reports';
    }

    /*
     * Determines in which rows this action should be present
     */
    public function shouldActionDisplayOnRow($row)
    {
        return $row->status === "PENDING";
    }
}
