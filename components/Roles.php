<?php

namespace Cleanse\WorldCup\Components;

use Cookie;
use Redirect;
use Cms\Classes\ComponentBase;

use Cleanse\WorldCup\Models\Recruit;

class Roles extends ComponentBase
{
    private $role;

    public function componentDetails()
    {
        return [
            'name'            => 'Feast World Cup Recruits (by Role)',
            'description'     => 'Displays recruits list by role.'
        ];
    }

    public function defineProperties()
    {
        return [
            'role' => [
                'title'       => 'Role Name',
                'description' => 'Role identification.',
                'default'     => '{{ :role }}',
                'type'        => 'string',
            ]
        ];
    }

    public function onRun()
    {
        $this->role = $this->property('role');
        $roles = ['tank', 'healer', 'melee', 'ranged'];

        if (!in_array($this->role, $roles)) {
            return Redirect::to('/world-cup');
        }

        $this->page['lang']      = $this->getLanguage();
        $this->page['recruited'] = $this->getRecruitCookie();
        $this->page['recruits']  = $this->getRecruits();
        $this->page['role']      = $this->role;

        $this->addCss('/plugins/cleanse/worldcup/assets/css/world-cup.css');
    }

    public function onSetLanguage()
    {
        $language = post('lang');
        $languages = ['en', 'jp'];

        if (in_array($language, $languages)) {
            return redirect('/world-cup/recruits')
                ->withCookie(Cookie::forever('lang', $language));
        }

        return Redirect::to('/world-cup');
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

    private function getRecruits()
    {
        return Recruit::where('recruited', '=', false)
            ->where('roles', 'like', '%'.$this->role.'%')->get();
    }
}