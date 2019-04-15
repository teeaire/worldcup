<?php

namespace Cleanse\WorldCup;

use System\Classes\PluginBase;

/**
 * World Cup Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Feast World Cup',
            'description' => 'Adds the Feast World Cup content to website.',
            'author'      => 'Paul Lovato',
            'icon'        => 'icon-video-camera'
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Cleanse\WorldCup\Components\Home'         => 'cleanseCupHome',
            'Cleanse\WorldCup\Components\Rules'        => 'cleanseCupRules',
            'Cleanse\WorldCup\Components\Registration' => 'cleanseCupRegister',
            'Cleanse\WorldCup\Components\FAQ'          => 'cleanseCupFAQ',
            'Cleanse\WorldCup\Components\Results'      => 'cleanseCupResults',
            'Cleanse\WorldCup\Components\Contribute'   => 'cleanseCupContribute',
            'Cleanse\WorldCup\Components\Thanks'       => 'cleanseCupThanks',

            //Temp
            'Cleanse\WorldCup\Components\Teams'        => 'cleanseCupTeams',
            'Cleanse\WorldCup\Components\Setup'        => 'cleanseCupSetup',

            //Recruit App
            'Cleanse\WorldCup\Components\Recruits'     => 'cleanseCupRecruits',
            'Cleanse\WorldCup\Components\Roles'        => 'cleanseCupRecruitsRoles',
            'Cleanse\WorldCup\Components\Recruit'      => 'cleanseCupRecruit',
            'Cleanse\WorldCup\Components\Manage'       => 'cleanseCupManageRecruits'
        ];
    }
}
