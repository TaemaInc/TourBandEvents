<?php namespace Taema\Bandtourevents\Components;

use Cms\Classes\Page;
use Cms\Classes\ComponentBase;
use Taema\BandTourEvents\Models\Event;

class EventList extends ComponentBase
{
    public $events = [];

    public function componentDetails()
    {
        return [
            'name'        => 'EventList Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [
            'type' => [
                'title' => 'Type of event list',
                'description' => 'Whether list upcoming events or past events',
                'default' => 'upcoming',
                'type' => 'dropdown',
                'options' => [
                    'upcoming' => 'Upcoming events',
                    'past' => 'Past events'
                ]
            ],
            'eventPage' => [
                'title' => 'Event page',
                'description' => 'Page to use to show a single event',
                'type' => 'dropdown'
            ]
        ];
    }

    public function getEventPageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName','baseFileName');
    }

    public function onRun()
    {
        $this->events = Event::query()
            ->published()
            ->{$this->property('type')}()
            ->get();
    }
}
