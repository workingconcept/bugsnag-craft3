<?php

namespace workingconcept\bugsnag\models;

use craft\base\Model;

class Settings extends Model
{
    public $apiKey;

    public function rules()
    {
        return [
            [['apiKey'], 'required'],
        ];
    }
}
