<?php

namespace Cleanse\WorldCup\Components;

use Cookie;
use Redirect;
use Cms\Classes\ComponentBase;

class Rules extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'            => 'Feast World Cup Rules',
            'description'     => 'Displays rules page for The Feast World Cup.'
        ];
    }

    public function onRun()
    {
        $this->page['lang'] = $this->getLanguage();
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
            return redirect('/world-cup/rules')
                ->withCookie(Cookie::forever('lang', $language));
        }

        return Redirect::to('/');
    }
}
