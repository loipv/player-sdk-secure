# Player sdk secure

## Install sdk

> composer require loipv/player-sdk-secure

## Use sdk

```php
<?php

use SecureSDK/SecureSDK;

// Init sdk
$appkey = 'appkey';
$secretkey = 'secretkey';
$playerId = 'pid';
$secure = new SecureSDK(appkey, secretkey, playerId);

// If you change token expire time, default: 60s

$expiresIn = 3600; // 1h
$secure.setExpiresIn($expiresIn);

// Or generate token not expired
$secure.setIngnoreExpiration(true);

// Get secure token
$sToken = secure.getSecureToken();

```
