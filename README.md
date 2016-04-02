# updater

Provides attachment of active user ID to create/update/delete operations.

# features

- Defines authors() method in blueprint complementing the timestamps()
- Defines softDeleters() method in blueprint complementing the softDelete()

# install

## composer.json

Add a requirement for the package

```javascript
{
    "require": {
        "dmocho/updater": "dev-master"
    }
}
```

## config/app.php

Add it to the list of providers

```php
'providers' => array(
  'Dmocho\Updater\UpdaterServiceProvider'
)
```

# license

Released under the [MIT license](http://opensource.org/licenses/MIT)
