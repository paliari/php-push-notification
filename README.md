## php-one-signal

### Installation
	
	$ composer require paliari/php-one-signal
	
### Usage

#### Initialize with your OneSignal credentials

```php
use Paliari\OneSignal;
OneSignal::instance()->init('<your_app_id>', '<your_rest_api_key>');
```
    
#### Send notifications from anywhere in your application

```php
$player_ids = ['<player_id_01>', '<player_id_02>','<player_id_n>'];
$extra_params = ['url' => 'http://website.com'];
OneSignal::instance()->createNotification('Test message', $player_ids, $extra_params);
```
    
### Authors

- [Daniel Fernando Lourusso](http://dflourusso.com.br)