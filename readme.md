
# PHP-DigiByte

A basic PHP library to talk to a digibyted daemon to get you started in your DigiByte project.

The PHP library might be buggy so contribution is welcomed!

## digibyte.conf
It is very important to create a file called **digibyte.conf** in DigiByte's core wallet data directory (usually %appdata% in Windows).

Contents of digibyte.conf:

```
server=1
rpcport=8332
rpcusername=what-ever-username-you-want
rpcpassword=what-ever-password-you-want
```

## Note!
If **digibyted** doesn't work, launch the full core wallet instead.

## Requirements

digibyted is part of the core wallet, download the DigiByte Core wallet first to also acquire digibyted.

Requires **digibyted** to already be installed and running on your local server or reachable by your server.  


Get DigiByte Core Wallet source from: https://github.com/digibyte/digibyte

Get a compiled core wallet from: https://www.digibyte.co/digibyte-downloads


## Usage:

Example usage

```
<?php

require "./digibyte.php";

$config = array(
    'user' => 'rpc-username',
    'pass' => 'rpc-password',
    'host' => '127.0.0.1',
    'port' => 'rpc-port' );

// create a client conncetion
$dgb = new DGB( $config );


// create a new address
$address = $dgb->get_address( 'jared' );
print( "Jared's address: $address \n" );

// list accounts in wallet
print_r( $dgb->list_accounts() );

// get balance in wallet
print( "Jared's balance: " . $dgb->get_balance( 'jared' ) );

// move money from accounts in wallet
// moves from 'bane' to account 'jared'
$dgb->move( 'bane', 'jared', 10000 );

// send money externally (withdraw)
// send from account to external address
$dgb->send( 'jared', 'DNYJ2ANdx1GL4sbCyikaVgYrf2GfiCtf8N', 100 );

?>
```

Default port is 8332<br>
<br>Default host is 127.0.0.1
