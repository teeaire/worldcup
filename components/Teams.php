<?php

namespace Cleanse\WorldCup\Components;

use Cookie;
use Redirect;
use Cms\Classes\ComponentBase;

use Cleanse\WorldCup\Models\Team;

class Teams extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'            => 'Feast World Cup Teams',
            'description'     => 'Displays the list of teams for The Feast World Cup.'
        ];
    }

    public function onRun()
    {
        $this->page['lang'] = $this->getLanguage();
        $this->page['teams'] = $this->getTeams();
        $this->page['full_names'] = $this->regionNames();
    }

    private function getLanguage()
    {
        $lang = Cookie::get('lang');

        if (isset($lang)) {
            $language = $lang;
        } else {
            $language = 'en';
        }

        return $language;
    }

    public function onSetLanguage()
    {
        $language = post('lang');
        $languages = ['en', 'jp'];

        if (in_array($language, $languages)) {
            return redirect('/world-cup/teams')
                ->withCookie(Cookie::forever('lang', $language));
        }

        return Redirect::to('/');
    }

    private function getTeams()
    {
        $teamList = Team::all()->keyBy('region')->groupBy('region');
        return $teamList;
    }

    private function regionNames()
    {
        return [
            'eu' => 'European',
            'jp' => 'Japanese',
            'na' => 'North American'
        ];
    }
}
