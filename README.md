# fb-messenger-bot-php

[![Latest Stable Version](https://poser.pugx.org/samiaraboglu/fb-messenger-bot-php/v/stable)](https://packagist.org/packages/samiaraboglu/fb-messenger-bot-php)
[![Total Downloads](https://poser.pugx.org/samiaraboglu/fb-messenger-bot-php/downloads)](https://packagist.org/packages/samiaraboglu/fb-messenger-bot-php)
[![License](https://poser.pugx.org/samiaraboglu/fb-messenger-bot-php/license)](https://packagist.org/packages/samiaraboglu/fb-messenger-bot-php)

- [Facebook Messenger Official Documentation](https://developers.facebook.com/docs/messenger-platform)
- [Bundle for Symfony](https://github.com/samiaraboglu/fb-messenger-api-bundle)

### Installing

Via composer
```
$ composer require samiaraboglu/fb-messenger-bot-php
```

Config
```php
$messenger = new \FbMessengerBot\Messenger([
    'access_token' => '<YOUR_ACCESS_TOKEN>'
]);
```

# Conversation Components

Use the message class
```php
$message = new \FbMessengerBot\Message();
```

### Text Message
```php
$message->text('<MESSAGE_TEXT>');
```

### Assets & Attachments

##### Audio
```php
$message->audio('<URL.mp3>');
```

##### Video
```php
$message->video('<URL.mp4>');
```

##### Image
```php
$message->image('<URL.jpg>');
```

##### File
```php
$message->file('<URL.pdf>');
```

### Message Templates

#### Button Template

##### URL Button
```php
// simple
$message->url('<MESSAGE_TEXT>', '<BUTTON_TITLE>', '<BUTTON_URL>');
```

```php
// multiple
$message->button('<MESSAGE_TEXT>', [
    [
        'title' => '<BUTTON_TITLE>',
        'url' => '<BUTTON_URL>'
    ],
    [
        'title' => '<BUTTON_TITLE>',
        'url' => '<BUTTON_URL>'
    ],
    [
        ...
    ],
    [...]
]);
```

##### Postback Button

```php
// simple
$message->postback('<MESSAGE_TEXT>', '<BUTTON_TITLE>', '<POSTBACK_PAYLOAD>');
```

```php
// multiple
$message->button('<MESSAGE_TEXT>', [
    [
        'type' => 'postback',
        'title' => '<BUTTON_TITLE>',
        'payload' => '<POSTBACK_PAYLOAD>'
    ],
    [
        ...
    ],
    [...]
]);
```

##### Share Button
```php
// TO DO
```

##### Buy Button
```php
// TO DO
```

##### Call Button
```php
// simple
$message->call('<MESSAGE_TEXT>', '<BUTTON_TITLE>', '+<COUNTRY_CODE><PHONE_NUMBER>');
```

```php
// multiple
$message->button('<MESSAGE_TEXT>', [
    [
        'type' => 'phone_number',
        'title' => '<BUTTON_TEXT>',
        'payload' => '<PHONE_NUMBER>'
    ],
    [
        ...
    ],
    [...]
]);
```

##### Log In Button
```php
$message->login('<MESSAGE_TEXT>', '<YOUR_LOGIN_URL>');
```

##### Log Out Button
```php
$message->logout('<MESSAGE_TEXT>');
```

##### Game Play Button
```php
// TO DO
```

### Quick Replies

##### Text
```php
// simple
$message->quickReplie('<MESSAGE_TEXT>', '<BUTTON_TITLE>', '<POSTBACK_PAYLOAD>');
```

```php
// multiple
$message->quickReplies('<MESSAGE_TEXT>', [
    [
        'title' => '<BUTTON_TITLE>',
        'payload' => '<POSTBACK_PAYLOAD>'
    ],
    [
        ...
    ],
    [...]
]);
```

##### Text With Image
```php
// simple
$message->quickReplie('<MESSAGE_TEXT>', '<BUTTON_TITLE>', '<POSTBACK_PAYLOAD>', '<URL.jpg>');
```

```php
// multiple
$message->quickReplies('<MESSAGE_TEXT>', [
    [
        'title' => '<BUTTON_TITLE>',
        'payload' => '<POSTBACK_PAYLOAD>',
        'image' => '<URL.jpg>'
    ],
    [
        ...
    ],
    [...]
]);
```

##### Location
```php
// simple
$message->location('<MESSAGE_TEXT>');
```

```php
// multiple
$message->quickReplies('<MESSAGE_TEXT>', [
    [
        'type' => 'location'
    ],
    [
        ...
    ],
    [...]
]);
```

##### Phone Number
```php
// simple
$message->phoneNumber('<MESSAGE_TEXT>');
```

```php
// multiple
$message->quickReplies('<MESSAGE_TEXT>', [
    [
        'type' => 'user_phone_number'
    ],
    [
        ...
    ],
    [...]
]);
```

##### Email
```php
// simple
$message->email('<MESSAGE_TEXT>');
```

```php
// multiple
$message->quickReplies('<MESSAGE_TEXT>', [
    [
        'type' => 'user_email'
    ],
    [
        ...
    ],
    [...]
]);
```

### Send Message
Require page-scoped ID (PSID)

```php
$response = $messenger->send(<PSID>, $message);
```

Example response
```php
// response print
Array
(
    [recipient_id] => <PSID>
    [message_id] => mid.$cAAoZdzlbwyxoOR257liB9xxxxxx
)
```

#### Saving Assets for Attachments
Send second parameter *true*. Supported asset types: `image` `audio` `video` `file`

```php
$message->image('<URL.jpg>', true);
```

Example response
```php
// response print
Array
(
    [recipient_id] => <PSID>
    [message_id] => mid.$cAAcZdzlzwkxoQ6ss8ViEmxxxxxx
    [attachment_id] => 1200933831599999
)
```

Send message with *attachment_id*

```php
$message->image(<ATTACHMENT_ID>);
```

#### Get Body

```php
$body = $messenger->getBody();

// body print
Array
(
    [recipient] => Array
        (
            [id] => ...
        )

    [message] => Array
        (
            [attachment] => Array
                (
                    [type] => image
                    [payload] => Array
                        (
                            [url] => https://...
                        )

                )

        )

    [access_token] => ...
)
```


### Sender Actions

Action types: `mark_seen` `typing_on` `typing_off`
```php
$response = $messenger->senderAction(<PSID>, '<ACTION_TYPE>');
```

### Webhooks
This for require *verify_token*

Config
```php
$messenger = new \FbMessengerBot\Messenger([
    'access_token' => '<YOUR_ACCESS_TOKEN>',
    'verify_token' => '<YOUR_VERIFY_TOKEN>'
]);
```

Listen to user messages.
```php
$response = $messenger->listen();
```
