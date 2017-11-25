# Player sdk secure

## Install sdk

> composer require player/sdk-secure

## Use sdk

```php
<?php

use VCPlayerJWT/VCPlayer;

// Init sdk
$appkey = 'appkey';
$secretkey = 'secretkey';
$playerId = 'pid';
$vcplayer = new VCPlayer(appkey, secretkey, playerId);

// If you change token expire time, default: 60s

$expiresIn = 3600; // 1h
$vcplayer.setExpiresIn($expiresIn);

// Get secure token
$sToken = vcplayer.getSecureToken();

```
