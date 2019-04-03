<?php

namespace Cleanse\WorldCup\Models;

use Model;

/**
 * Class Recruit
 * @package Cleanse\WorldCup\Models
 * @property integer id
 * @property string  name
 * @property string  region
 * @property string  roles
 * @property string  availability
 * @property string  contact_method
 * @property boolean recruited
 */
class Recruit extends Model
{
    protected $table = 'cleanse_cup_recruits';

    protected $jsonable = ['roles'];

    protected $casts = [
        'roles' => 'array',
    ];
}
