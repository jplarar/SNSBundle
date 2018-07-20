# JplararSNSBundle
A simple Symfony2 bundle for the API for AWS SNS. Work in progress only SMS for now!!

## Setup

### Step 1: Download JplararSNSBundle using composer

Add SNS Bundle in your composer.json:

```js
{
    "require": {
        "jplarar/sns-bundle": "dev-master"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update "jplarar/sns-bundle"
```


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Jplarar\SNSBundle\JplararSNSBundle()
    );
}
```

### Step 3: Add configuration

``` yml
# app/config/config.yml
jplarar_sns:
        amazon_sns:
            amazon_sns_key:    %amazon_sns_key%
            amazon_sns_secret: %amazon_sns_secret%
            amazon_sns_region: %amazon_sns_region%
```

## Usage

**Using service**

``` php
<?php
        $snsClient = $this->get('amazon_sns_client');
?>
```

##Example

###Send new email to SNS
``` php
<?php 
    $service = $snsClient->sendSMS(
                'YOUR_MESSAGE', 
                'PHONE_NUMBER', 
                'SENDER_ID'
            );
            
    $result = $service->get('MessageId');
?>
```
