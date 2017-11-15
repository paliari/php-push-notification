## php-push-notification

### Installation
	
	$ composer require paliari/php-push-notification
	
### Usage

#### Initialize with your credentials

```php
use Paliari\PushFacade;
$configs = [
 'one_signal' => [
   '<yor app name>' => [
     'app_id'       => '<yor app_id>',
     'rest_api_key' => '<yor rest_api_key>',
   ],
   '<yor app name 2>' => [
     'app_id'       => '<yor app_id 2>',
     'rest_api_key' => '<yor rest_api_key 2>',
   ],
 ],
 'expo'       => [...],
];

PushFacade::setUp($configs);
```
    
#### Send notifications from anywhere in your application

```php
use Paliari\PushFacade;

$tokens = ['<token_01>', '<token_02>','<token_n>'];
$extra_params = [
  'title' => '<your title message>', // optional
  'url' => 'http://website.com', // optional for web
  'data' => [
    '<your custom param>' => '<your custom value>',
    // ... any ...
  ],
]; 
$provider = PushFacade::ONE_SIGNAL;
$app_name = '<your-app-name>';
$message = '<your message content.>';
PushFacade::provider($provider, $app_name)->send($message, $tokens, $extra_params);
```

### See

- [OneSignal](https://documentation.onesignal.com/reference#create-notification)

- [Expo Push Notifications](https://docs.expo.io/versions/latest/guides/push-notifications.html)

### Authors

- [Marcos A Paliari](marcos@paliari.com.br)
- [Daniel Fernando Lourusso](daniel@paliari.com.br)
