<?php
namespace workingconcept\bugsnag\services;

use Craft;
use craft\base\Component;
use Bugsnag;

class BugsnagService extends Component
{

    public static function handleException($exception)
    {
        $settings = \workingconcept\bugsnag\Plugin::getInstance()->getSettings();
        $apiKey   = $settings->apiKey ?? getenv('BUGSNAG_API_KEY') ?? null;

        if ($apiKey === null)
        {
            return;
        }

        $currentStage = CRAFT_ENVIRONMENT;

        if (in_array($currentStage, $settings->notifyRelease))
        {

            $bugsnag  = Bugsnag\Client::make($apiKey);
            $user     = Craft::$app->getUser()->getIdentity();

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

            $bugsnag->setReleaseStage($currentStage);
            $bugsnag->setBatchSending(true); // send after request to keep things fast
            $bugsnag->setAppType('Craft CMS');
            $bugsnag->setAppVersion(Craft::$app->getVersion());
            $bugsnag->notifyException($exception);
        }
    }

}
