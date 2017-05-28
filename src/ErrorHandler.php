<?php

namespace workingconcept\bugsnag;

use Craft;
use Bugsnag;

class ErrorHandler extends \craft\web\ErrorHandler
{
    public $apiKey;
    public $notifyRelease;

    public function handleException($exception)
    {
        $apiKey        = Craft::$app->components['errorHandler']['apiKey'];
        $notifyRelease = ['staging', 'production'];
        $currentStage  = CRAFT_ENVIRONMENT;

        if ( ! empty(Craft::$app->components['errorHandler']['notifyRelease']))
        {
            $notifyRelease = Craft::$app->components['errorHandler']['notifyRelease'];
        }

        if ( ! empty($apiKey) && in_array($currentStage, $notifyRelease))
        {
            $bugsnag = Bugsnag\Client::make($apiKey);
            $user    = Craft::$app->getUser()->getIdentity();

            if ( ! empty($user))
            {
                $bugsnag->registerCallback(function ($report) use ($user) {
                    $report->setUser([
                        'id'    => $user->id,
                        'name'  => $user->name,
                        'email' => $user->email
                    ]);
                });
            }

            $bugsnag->setAppType('Craft CMS');
            $bugsnag->setAppVersion(Craft::$app->getVersion());
            $bugsnag->setReleaseStage($currentStage);
            $bugsnag->setBatchSending(true); // send after request to keep things fast

            $bugsnag->notifyException($exception); // fire!
        }

        parent::handleException($exception);
    }

}