<?php

namespace App\Actions;


class View
{
    public function getDefaultRoute()
    {
        if ($this->dataType->slug == 'organizers') {
            return route('organizers.organizer', $this->data->slug);
        } else {
            return route('acties.actie', $this->data->slug);
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
        return $row->status === "PUBLISHED";
    }
}
