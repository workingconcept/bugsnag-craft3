<?php

namespace workingconcept\bugsnag;

use Craft;
use Bugsnag;

class ErrorHandler extends \craft\web\ErrorHandler
{
    public function handleException($exception)
    {
        //$settings = \workingconcept\bugsnag\Plugin::getInstance()->getSettings();
        $apiKey  = getenv('BUGSNAG_API_KEY');
        $bugsnag = Bugsnag\Client::make($apiKey);
        $user    = Craft::$app->getUser()->getIdentity();

        $bugsnag->registerCallback(function ($report) use ($user) {
            if ( ! empty($user))
            {
                $report->setUser([
                    'id'    => $user->id,
                    'name'  => $user->name,
                    'email' => $user->email
                ]);
            }
        });

        $bugsnag->setReleaseStage(getenv('CRAFT+ENVIRONMENT'));
        $bugsnag->setBatchSending(true); // send after request to keep things fast
        $bugsnag->setAppType('Craft CMS');
        $bugsnag->setAppVersion(Craft::$app->getVersion());
        $bugsnag->notifyException($exception);

        parent::handleException($exception);
    }

}