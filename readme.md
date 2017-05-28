# Bugsnag for Craft 3

1. `composer require workingconcept/bugsnag-craft3`.
2. Create config/app.php and add...  
```
return [
    'components' => [
        'errorHandler' => [
            'class' => workingconcept\bugsnag\ErrorHandler::class,
            'errorAction' => 'templates/render-error'
        ]
    ]
];
```
3. Edit .env to add `BUGSNAG_API_KEY="YOUR_KEY"`.