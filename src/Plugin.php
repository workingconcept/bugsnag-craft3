<?php

namespace workingconcept\bugsnag;

use Craft;
use Bugsnag;

/**
 * Bugsnag main plugin definition.
 *
 * @author Working Concept Inc. <hello@workingconcept.com>
 * @since  3.0
 */

class Plugin extends \craft\base\Plugin
{

    public $hasCpSettings = true;

    protected function createSettingsModel()
    {
        return new \workingconcept\bugsnag\models\Settings();
    }

    protected function settingsHtml()
    {
        return \Craft::$app->getView()->renderTemplate('bugsnag/settings', [
            'settings' => $this->getSettings()
        ]);
    }
}
