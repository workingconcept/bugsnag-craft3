<?php

namespace workingconcept\bugsnag\models;

use craft\base\Model;

class Settings extends Model
{
    public $apiKey;
    public $notifyRelease = ['staging', 'production'];

    public function rules()
    {
        return [
            [['apiKey'], 'required'],
            [['notifyRelease'], 'required'],
        ];
    }
}
