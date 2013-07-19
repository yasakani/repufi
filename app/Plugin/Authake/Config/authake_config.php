<?php
$config = array (
  'Authake' => 
  array (
    'baseUrl' => '/',
    'service' => 'Usuarios',
    'loginAction' => 
    array (
      'plugin' => 'authake',
      'controller' => 'user',
      'action' => 'login',
      'named' => 
      array (
      ),
      'pass' => 
      array (
      ),
    ),
    'loggedAction' => '/',
    'sessionTimeout' => '604800',
    'defaultDeniedAction' => 
    array (
      'plugin' => 'authake',
      'controller' => 'user',
      'action' => 'denied',
      'named' => 
      array (
      ),
      'pass' => 
      array (
      ),
    ),
    'rulesCacheTimeout' => '300',
    'systemEmail' => 'noreply@example.com',
    'systemReplyTo' => 'noreply@example.com',
    'passwordVerify' => '1',
    'registration' => '1',
    'defaultGroup' => '2',
    'useDefaultLayout' => '0',
    'useEmailAsUsername' => '0',
  ),
);