# Nova Duplicate Field

Currently only duplicates the main record and no relations but this is on the todo list. Meta needs passing through to ensure the right models are replicated and redirection to the new entry happens.

### Todo

- [ ] Duplicate relations alongside the main post.
- [ ] Catch errors properly
- [ ] Give a clearer notification to end users.

### Installation

Install the duplicate field.

```
composer install jackabox/nova-duplicate-field
```

Reference the duplicate field at the top of your Nova resource and then include the necessary code within the fields.

```php
use Jackabox/DuplicateField/DuplicateField
```

```php
DuplicateField::make('Duplicate')
    ->withMeta([
        'resource' => 'specialisms', // resource url
        'model' => 'App\Models\Specialism', // model path
        'id' => $this->id // id of record
    ]),
```

Duplicate field only works on the index view and already passes through `onlyOnIndex()` as an option.

### Demo

![Duplicate Field Image](./img/nova-duplicate-field-small.gif)
