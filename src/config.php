<?php

/**
 * Bugsnag Configuration
 */

return [
    'apiKey' => getenv('BUGSNAG_API_KEY'),
    'notifyRelease' => ['staging', 'production'],
];