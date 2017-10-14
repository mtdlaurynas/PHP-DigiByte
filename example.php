<?php

## Simple command-line script to show examples

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


