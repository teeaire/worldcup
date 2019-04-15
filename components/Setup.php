<?php

namespace Cleanse\WorldCup\Components;

use Input;
use Redirect;
use System\Models\File;
use Cms\Classes\ComponentBase;

use Cleanse\WorldCup\Models\Team;
use Cleanse\WorldCup\Models\Player;

class Setup extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'            => 'Feast World Cup Team Setup',
            'description'     => 'Manage the list of teams for The Feast World Cup.'
        ];
    }

    public function onRun()
    {
        $this->page['teams'] = $this->getTeams();
        $this->addJs('assets/js/cup.js');
    }

    public function onLoadCreation(){}

    public function onCreateTeam()
    {
        $post = post();
        $this->createTeam($post);

        return Redirect::to('/world-cup/setup');
    }

    public function onRequestTeam()
    {
        $this->page['team'] = Team::find(post('id'));
    }

    public function onUpdateTeam()
    {
        $post = post();
        $this->updateTeam($post);

        return Redirect::to('/world-cup/setup');
    }

    public function onUpdateLogo()
    {
        $post = post();
        $this->updateLogo($post);

        return Redirect::to('/world-cup/setup');
    }

    //private methods
    private function getTeams()
    {
        return Team::orderBy('name', 'asc')->get();
    }

    private function createTeam($post)
    {
        $team = $this->insertTeam($post['name'], $post['region']);

        foreach ($post['players'] as $key => $player) {
            $p = new Player;
            $p->team_id = $team;
            $p->name    = $player;
            $p->server  = $post['servers'][$key];
            $p->rank    = $key + 1;

            $p->save();
        }
    }

    private function insertTeam($name, $region)
    {
        $team = new Team;
        $team->name   = $name;
        $team->region = $region;
        $team->save();

        if (Input::hasFile('logo')) {
            $uploadedFile = Input::file('logo');

            $file = new File;
            $file->data = $uploadedFile;
            $file->is_public = true;
            $file->save();

            $team->logo()->add($file);
        } else {
            $file = (new File)->fromFile('./themes/pvpaissa/assets/images/default-paissa.jpg');

            $team->logo()->add($file);
        }

        return $team->id;
    }

    private function updateTeam($post)
    {
        $getTeam = Team::find($post['id']);
        $getTeam->name   = $post['name'];
        $getTeam->region = $post['region'];

        if (!isset($post['active'])) {
            $getTeam->active = 0;
        } else {
            $getTeam->active = 1;
        }

        $getTeam->save();
    }

    private function updateLogo($post)
    {
        $team = Team::find($post['id']);

        if (Input::hasFile('logo')) {
            $uploadedFile = Input::file('logo');

            $file = new File;
            $file->data = $uploadedFile;
            $file->is_public = true;
            $file->save();

            $team->logo()->add($file);
        }
    }
}
