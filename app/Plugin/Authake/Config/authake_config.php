<?php
$config = array (
  'Authake' => 
  array (
    'baseUrl' => 'http://repufi.dev',
    'service' => 'authake',
    'loginAction' => 
    array (
      'plugin' => 'authake',
      'controller' => 'user',
      'action' => 'login',
      'named' => 
      array (
        'named' => 
        array (
          'named' => 
          array (
            'admin' => '0',
          ),
        ),
      ),
      'pass' => 
      array (
      ),
    ),
    'loggedAction' => 'http://repufi.dev',
    'sessionTimeout' => '10000',
    'defaultDeniedAction' => 
    array (
      'plugin' => 'authake',
      'controller' => 'user',
      'action' => 'denied',
      'named' => 
      array (
        'named' => 
        array (
          'named' => 
          array (
            'admin' => '0',
          ),
        ),
      ),
      'pass' => 
      array (
      ),
    ),
    'rulesCacheTimeout' => '300',
    'systemEmail' => 'noreply@example.com',
    'systemReplyTo' => 'noreply@example.com',
    'passwordVerify' => '1',
    'registration' => '0',
    'defaultGroup' => '2',
    'useDefaultLayout' => '0',
    'useEmailAsUsername' => '0',
  ),
);