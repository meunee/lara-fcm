# Laravel FCM API HTTP v1 package


## Installation

Install this package with Composer:

```bash
composer require meunee/lara-fcm
```

### Laravel

Register the provider directly in your app configuration file config/app.php `config/app.php`:

Laravel >= 5.5 provides package auto-discovery

```php
'providers' => [
	// ...

	Meunee\LaraFcm\FCMServiceProvider::class,
]
```

Add the facade aliases in the same file:

```php
'aliases' => [
	...
	'FCM'      => Meunee\LaraFcm\Facades\FCM::class,
	'FCMGroup' => Meunee\LaraFcm\Facades\FCMGroup::class, // Deprecated
]
```

> Note: The `FCMGroup` facade is deprecated.

Publish the package config file using the following command:


    $ php artisan vendor:publish --provider="Meunee\LaraFcm\FCMServiceProvider"


### Package Configuration

In your `.env` file, add the server key and the secret key for the Firebase Cloud Messaging:

```php
FCM_PROJECT_ID="my_project_id"
FCM_JSON="path_to_json_file"
FCM_API_SERVER_KEY="my_api_server_key"
```
