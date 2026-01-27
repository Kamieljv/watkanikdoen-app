<?php

namespace App\Actions;


class Publish
{
    public function getTitle()
    {
        return trans('general.publish');
    }

    public function getIcon()
    {
        return 'voyager-upload';
    }

    public function getPolicy()
    {
        return 'edit';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-primary pull-right publish',
        ];
    }

    public function getDefaultRoute()
    {
        if ($this->dataType->slug === 'acties') {
            return route('actie.publish', $this->data->{$this->data->getKeyName()});
        } else if ($this->dataType->slug === 'organizers') {
            return route('organizer.publish', $this->data->{$this->data->getKeyName()});
        }
    }

    /*
     * Determines in what datatypes this action should be present
     */
    public function shouldActionDisplayOnDataType()
    {
        return in_array($this->dataType->slug, ['acties', 'organizers']);
    }

    /*
     * Determines in which rows this action should be present
     */
    public function shouldActionDisplayOnRow($row)
    {
        // in case of organizers "APPROVED", in case of acties "DRAFT"
        return $row->status === "APPROVED" || $row->status === "DRAFT";
    }
}
