<?php

namespace App\Actions;

use Illuminate\Support\Facades\Log;
use TCG\Voyager\Actions\AbstractAction;

class ApproveAanmelding extends AbstractAction
{
    public function getTitle()
    {
        return trans('aanmeldingen.approve');
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
        return route('aanmelding.approve', $this->data->{$this->data->getKeyName()});
    }

    /*
     * Determines in what datatypes this action should be present
     */
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug === 'aanmeldingen';
    }

    /*
     * Determines in which rows this action should be present
     */
    public function shouldActionDisplayOnRow($row)
    {
        Log::debug($row);
        return $row->status === "PENDING";
    }
}
