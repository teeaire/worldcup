<?php

namespace Cleanse\WorldCup\Components;

use Cookie;
use Redirect;
use Request;
use Cms\Classes\ComponentBase;

use Cleanse\WorldCup\Models\Recruit as Character;

class Recruit extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'            => 'Feast World Cup Recruit',
            'description'     => 'Displays recruit form for The Feast World Cup.'
        ];
    }

    public function onRun()
    {
        $this->page['lang'] = $this->getLanguage();
        $this->page['recruit'] = $this->getRecruit();

        $this->addCss('/plugins/cleanse/worldcup/assets/css/world-cup.css');
    }

    public function onSetLanguage()
    {
        $language = post('lang');
        $languages = ['en', 'jp'];

        if (in_array($language, $languages)) {
            return redirect('/world-cup/recruit')
                ->withCookie(Cookie::forever('lang', $language));
        }

        return Redirect::to('/');
    }

    public function onAddRecruit()
    {
        if (post('email')) {
            return Redirect::to('/world-cup/thanks');
        }

        $post = post();
        $newRecruit = $this->createRecruit($post);

        $recruitId = $newRecruit->id;

        return redirect('/world-cup/recruits')->withCookie(Cookie::forever('recruit', $recruitId));
    }

    public function onUpdateRecruit()
    {
        $post = post();
        $this->updateRecruit($post);

        return redirect('/world-cup/recruits');
    }

    private function createRecruit($form)
    {
        $newRecruit = new Character;

        $newRecruit->name           = $form['name'];
        $newRecruit->region         = $form['region'];
        $newRecruit->roles          = $form['roles'];
        $newRecruit->availability   = $form['availability'];
        $newRecruit->contact_method = $form['contact'];

        $newRecruit->save();

        return $newRecruit;
    }

    private function updateRecruit($form)
    {
        $recruit = Character::find($form['id']);

        $recruit->name           = $form['name'];
        $recruit->region         = $form['region'];
        $recruit->roles          = $form['roles'];
        $recruit->availability   = $form['availability'];
        $recruit->contact_method = $form['contact'];

        $recruit->save();
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

    private function getRecruit()
    {
        $recruit = Cookie::get('recruit');

        if (isset($recruit)) {
            $this->page['cookie'] = $recruit;
            return Character::find($recruit);
        } else {
            $this->page['cookie'] = false;
            return;
        }
    }
}
