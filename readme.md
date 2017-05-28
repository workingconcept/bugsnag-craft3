# Bugsnag Component for Craft 3

Send Craft exceptions to Bugsnag with this tiny extension to Craft's error handler.

## Installation

1. Install with `composer require workingconcept/bugsnag-craft3 @dev`.
2. Create config/app.php and add...  
<pre>
    return [
        'components' => [
            'errorHandler' => [
                'class' => workingconcept\bugsnag\ErrorHandler::class,
                'apiKey' => 'YOUR KEY',
                'notifyRelease' => ['staging', 'production'],
                'errorAction' => 'templates/render-error'
            ]
        ]
    ];
</pre>

## Production Use

Only if you live dangerously. I'm getting my feet wet with Craft 3 and this is my first stab at the plugin—it will probably need some revision before it's safe for your Mars mission. Please submit an issue, pull request, or [send me an email](mailto:hello@workingconcept.com) if you've found room for improvement!

