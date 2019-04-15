<?php

namespace Cleanse\WorldCup\Models;

use Model;

/**
 * Class Team
 * @package Cleanse\WorldCup\Models
 * @property integer id
 * @property string  name
 * @property string  region
 * @property string  logo
 * @property string  active
 */
class Team extends Model
{
    protected $table = 'cleanse_cup_teams';

    public $attachOne = [
        'logo' => ['System\Models\File']
    ];

    public $hasMany = [
        'players' => 'Cleanse\WorldCup\Models\Player'
    ];

    public function getLogoThumb($size = 48, $options = null)
    {
        if (is_string($options)) {
            $options = ['default' => $options];
        } elseif (!is_array($options)) {
            $options = [];
        }

        if ($this->logo) {
            return $this->logo->getThumb($size, $size, $options);
        }
    }
}
