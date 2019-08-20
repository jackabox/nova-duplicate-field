**Current Version: v0.2.7**

# Nova Duplicate Field

Duplication of a record through the nova admin panel along with any defined relations that are required (tested on HasMany). Creates a copy of the data in our admin panel and redirects to the view.

### Todo

- [x] Duplicate relations alongside the main post.
    - [ ] Integrate reattaching of relations, rather than needing to duplicate (i.e. belongsToMany)
- [ ] Catch errors to the end user.
- [ ] Alert for the user (confirmation possibly).
- [ ] Documentation on how to hide/show when needed.
- [ ] Documentation on how to hook into replication.
- [ ] Add a button to the resource view.
- [ ] Clean up methods for `v1`

### Installation

Duplicate Field will work with Nova v1 or v2. To get started, install the package via Composer.

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
        'relations' => ['one', 'two'] // an array of any relations to load (nullable).
    ]),
```

Duplicate field only works on the index view at the moment (plans to expand this are coming) and already passes through `onlyOnIndex()` as an option.

### Hooking Into Replication

**Duplicate Field** uses a relatively standard replicate method which is available via the Eloquent model. To modify data as you are duplicating the field use an observer on the `replicating` method.

## Issues

If there are any issues or requests feel free to open a GitHub issue or a pull request.
