# ![Laravel Nova Duplicate Model](https://github.com/jackabox/nova-duplicate-field/raw/master/title.png)

### Information

![GitHub release (latest by date)](https://img.shields.io/github/v/release/jackabox/nova-duplicate-field?style=flat-square)
![Packagist](https://img.shields.io/packagist/dt/jackabox/nova-duplicate-field?style=flat-square)
![GitHub](https://img.shields.io/github/license/jackabox/nova-duplicate-field?style=flat-square)

Allow users to duplicate a record through the Laravel Nova Admin Panel along with any relations that are required (currently works with HasMany).

### Installation

```
composer require jackabox/nova-duplicate-field
```

Reference the duplicate field at the top of your Nova resource and then include the necessary code within the fields.

```php
use Jackabox\DuplicateField\DuplicateField
```

```php
DuplicateField::make('Duplicate')
    ->withMeta([
        'resource' => 'specialisms', // resource url
        'model' => 'App\Models\Specialism', // model path
        'id' => $this->id, // id of record
        'relations' => ['one', 'two'], // an array of any relations to load (nullable).
        'except' => ['status'], // an array of fields to not replicate (nullable).
        'override' => ['status' => 'pending'] // an array of fields and values which will be set on the modal after duplicating (nullable).
    ]),
```

Duplicate field only works on the index view at the moment (plans to expand this are coming) and already passes through `onlyOnIndex()` as an option.

### Hooking Into Replication

**Duplicate Field** uses a relatively standard replicate method which is available via the Eloquent model. To modify data as you are duplicating the field use an observer on the `replicating` method.

### Issues

If there are any issues or requests feel free to open a GitHub issue or a pull request.

### Todo

- [x] Duplicate relations alongside the main post.
    - [ ] Integrate reattaching of relations, rather than needing to duplicate (i.e. belongsToMany)
- [ ] Catch errors to the end user.
- [ ] Alert for the user (confirmation possibly).
- [ ] Documentation on how to hide/show when needed.
- [ ] Documentation on how to hook into replication.
- [ ] Add a button to the resource view.
- [ ] Clean up methods for `v1`
