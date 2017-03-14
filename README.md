# wp-nonce-wrapper
A class to wrap Wordpress' nonce functionality.

This library will allow you to use Wordpress' nonce functionality in an object-oriented style.

## Usage

There is a class for each type of nonce. To generate just a nonce, without attaching it to a URL or form, then use this:

```php
$nonce = Devbanana\WPNonceWrapper\Nonce::generate( 'nonce-action' );
```

To print out the nonce, just do:

```php
echo $nonce;
```

If you'd rather have a URL with the nonce, do this:

```php
$nonce = Devbanana\WPNonceWrapper\WPNonceURL::generate( get_site_url( null, 'test' ), 'nonce-action' );
```

Then when you print it, it will print the given URL including the nonce.

The same goes for a form:

```php
$nonce = Devbanana\WPNonceWrapper\WPNonceField::generate( 'nonce-action' );
```

When you print `$nonce`, it will print out the form field(s).

To verify a nonce on the appropriate page, you'll first want to import it:

```php
$nonce = Devbanana\WPNonceWrapper\WPNonce::import( 'nonce-action' );
```

Next, you can verify:

```php
if ( $nonce->verify() ) {
    // Action here
}
else {
    // Not valid
}
```

Or if you're on an admin page, just do this:

```php
if ( $nonce->verifyAdmin() ) {
    // Action here
}
else {
    // Not valid
}
```

And finally, in an ajax request:

```php
$nonce->verifyAjax();
```

If you'd rather get the return value, then:

```php
if ( $nonce->verifyAjax( false ) ) {
    // Action here
}
else {
    // Not valid
}
```

The `false` is to tell it not to die when invalid.
