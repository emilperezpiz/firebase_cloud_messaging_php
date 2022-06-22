# Firebase cloud messaging php
This library allows integration with Firebase Cloud Messaging

# Requirements
- PHP >=7.2

## Installation
php composer.phar require fcm/firebase_cloud_messaging:dev-main 
or
composer require fcm/firebase_cloud_messaging:dev-main

## Code Examples

```php
// Create an instance of the class PushNotification
$fcm = new PushNotification('tokenServer');

// resize image instance
$fcm->sendMessage("clientToken", "New Notification", "message", "https://amappzing.com.br/bundles/app/backend/img/favicon.png", ['body' => 'sending a message'])

// check if the client token is active
$fcm->validateClientToken('clientToken');

// serverToken ==> After the firebase account is created and configured, the token that it returns is the one that should be used here
// clientToken ==> After firebase is configured on the mobile device or the website in charge of displaying push notifications, they will return a token, this will be the one that should be used here
```
