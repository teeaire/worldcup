<?php

namespace Cleanse\WorldCup\Components;

use Cookie;
use Redirect;
use Cms\Classes\ComponentBase;

use Cleanse\WorldCup\Models\Recruit;

class Recruits extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'            => 'Feast World Cup Recruits',
            'description'     => 'Displays recruits list for The Feast World Cup.'
        ];
    }

    public function onRun()
    {
        $this->page['lang']   = $this->getLanguage();
        $this->page['recruited'] = $this->getRecruitCookie();
        $this->page['recruits'] = $this->getRecruits();
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

    private function getRecruitCookie()
    {
        $recruit = Cookie::get('recruit');

        if (isset($recruit)) {
            return $recruit;
        } else {
            return false;
        }
    }

    public function onSetLanguage()
    {
        $language = post('lang');
        $languages = ['en', 'jp'];

        if (in_array($language, $languages)) {
            return redirect('/world-cup/recruits')
                ->withCookie(Cookie::forever('lang', $language));
        }

        return Redirect::to('/');
    }

    private function getRecruits()
    {
        return Recruit::where('recruited', '=', false)->get();
    }
}
