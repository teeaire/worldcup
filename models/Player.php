<?php

namespace Cleanse\WorldCup\Models;

use Model;

/**
 * Class Player
 * @package Cleanse\WorldCup\Models
 * @property integer id
 * @property integer team_id
 * @property string  name
 * @property string  server
 * @property integer rank   (1 team lead, 2 sub-lead, 3 member)
 * @property integer active (1 default, 0 inactive)
 *
 * Add to backend so Phil can add data
 */
class Player extends Model
{
    protected $table = 'cleanse_cup_players';
}
