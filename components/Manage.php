<?php

namespace Cleanse\WorldCup\Components;

use Redirect;
use Cms\Classes\ComponentBase;

use Cleanse\WorldCup\Models\Recruit;

class Manage extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'            => 'Manage Feast World Cup Recruits',
            'description'     => 'Displays manageable recruits list for The Feast World Cup.'
        ];
    }

    public function onRun()
    {
        $this->page['recruits'] = $this->getRecruits();
    }

    public function onRecruited()
    {
        $recruit = Recruit::find(post('id'));

        if ($recruit->recruited === 0) {
            $recruit->recruited = 1;
            $recruit->save();
        } else {
            $recruit->recruited = 0;
            $recruit->save();
        }

        return Redirect::to('/world-cup/recruits/manage');
    }

    public function onDeleted()
    {
        $recruit = Recruit::find(post('id'));

        $recruit->delete();

        return Redirect::to('/world-cup/recruits/manage');
    }

    private function getRecruits()
    {
        return Recruit::orderBy('name', 'asc')->get();
    }
}
