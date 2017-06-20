<?php

namespace workingconcept\bugsnag;

use yii\base\Event;

use Craft;
use Bugsnag;

use craft\events\ExceptionEvent;
use craft\web\ErrorHandler;
use workingconcept\bugsnag\services\BugsnagService;


/**
 * Bugsnag main plugin definition.
 *
 * @author Working Concept Inc. <hello@workingconcept.com>
 * @since  3.0
 */

class Plugin extends \craft\base\Plugin
{

    public $hasCpSettings = true;

    public function init()
    {
        parent::init();

        Event::on(
            ErrorHandler::className(),
            ErrorHandler::EVENT_BEFORE_HANDLE_EXCEPTION,
            function(ExceptionEvent $event) {
                BugsnagService::handleException($event->exception);
            }
        );
    }

    public function createSettingsModel()
    {
        return new \workingconcept\bugsnag\models\Settings();
    }

    public function settingsHtml()
    {
        return \Craft::$app->getView()->renderTemplate('bugsnag/settings', [
            'settings' => $this->getSettings()
        ]);
    }
}
