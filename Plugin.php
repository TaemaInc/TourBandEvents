<?php namespace Taema\BandTourEvents;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public $require = ['raviraj.rjgallery'];

    public function pluginDetails()
    {
        return [
            'name' => 'Band Tour Events',
            'description' => 'Provides a list of upcoming and past tour dates for a band',
            'author' => 'Taema Inc.',
            'icon' => 'icon-calendar'
        ];
    }

    public function registerComponents()
    {
        return [
            'Taema\Bandtourevents\Components\EventList' => 'eventList',
            'Taema\Bandtourevents\Components\EventSingle' => 'eventSingle'
        ];
    }
}
