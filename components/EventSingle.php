<?php namespace Taema\Bandtourevents\Components;

use Cms\Classes\ComponentBase;
use Taema\BandTourEvents\Models\Event;

class EventSingle extends ComponentBase
{
    public $event;

    public function componentDetails()
    {
        return [
            'name'        => 'EventSingle Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'id' => [
                'title' => 'Event Id'
            ]
        ];
    }

    public function onRun()
    {
        $this->event = Event::query()
            ->published()
            ->find($this->property('id'));
    }
}
