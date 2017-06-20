# Bugsnag Component for Craft 3

Send Craft exceptions to Bugsnag with this tiny extension to Craft's error handler.

## Installation

1. `composer require workingconcept/bugsnag-craft3`.
2. In the control panel, visit _Settings_ → _Plugins_, and install Bugsnag.
3. Add the Bugsnag API key for your project in the plugin's settings.

## Customizing Release Stage Notifications

By default, the plugin will report when `CRAFT_ENVIRONMENT` is set to `staging` and `production`. You can override this by supplying your own config/bugsnag.php:

```
return [
    'notifyRelease' => ['local', 'staging', 'production']
];
```

## Production Use

Only if you live dangerously. I'm getting my feet wet with Craft 3 and this is my first plugin. This thing will probably need revision before it's safe for your Mars mission. I'll gladly accept issues, pull requests, and [emails](mailto:hello@workingconcept.com) if you've found room for improvement!