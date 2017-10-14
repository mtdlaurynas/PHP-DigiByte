<?php

/**
 * Project : PHP-DigiByte library
 * Summary : A very basic PHP library for communicating with 'digibyted'
 *
 * Source  : https://github.com/stiklius/PHP-DigiByte
 *
 * Author  : stiklius
 * License : MIT
 */ 

require_once dirname(  __FILE__ ) . '/jsonRPCClient.php';

class DGB  {

    private $client;

    /** 
     * Create client to conncet on init
     * @param $config array of parameters $host, $port, $user, $pass
     */

    function __construct( $config ) {
        
        $connect_string = sprintf( 'http://%s:%s@%s:%s/', 
            $config['user'],
            $config['pass'],
            $config['host'],
            $config['port'] );

        // internal client to use for connection
        $this->client = new jsonRPCClient( $connect_string );
    }


    /**
     * Creates or Retrievs a DigiByte address for an account name
     * An account is just a string used as a key to identify an account,
     * A DigiByte address is return which can receive coins
     *
     * @param string $account some string used as key to account
     * @return string digibyte address 
     */
    function get_address( $account ) {
        return $this->client->getaccountaddress( $account );
    }


    /**
     * Given a Digibyte address returns the account name
     *
     * @param string $address digibyte addresss
     * @return string account name key
     */
    function get_account( $address ) {
        return $this->client->getaccount( $address );
    }


    /**
     * Create new address for account, recommended to include
     * account name for further API use.
     *
     * @param string $account account name
     * @return string digibyte address
     */
    function get_new_address( $account='' ) {
        return $this->client->getnewaddress( $account );
    }


    /**
     * Get list of all accounts on in this digibyted wallet
     *
     * @return array strings of account => balance
     */
    function list_accounts() {
        return $this->client->listaccounts();
    }

    /**
     * Get the details of a transaction
     *
     * @param string $txid transaction id
     * @return array describing the transaction
     */
    function get_transaction( $txid ) {
        return $this->client->gettransaction( $txid );
    }

    /**
     * Associate digibyte address to account string
     *
     * @param string $address digibyte address
     * @param string $account account string
     */
    function set_account( $address, $account ) {
        return $this->client->setaccount($address, $account);
    }


    /**
     * Get balance for given account
     *
     * @param string $account account name
     * @return float account balance
     */
    function get_balance( $account, $minconf=1 ) {
        return $this->client->getbalance( $account, $minconf );
    }


    /**
     * Move coins from one account on wallet to another
     * Both accounts are local to this digibyted instance
     *
     * @param string $account_from account moving from
     * @param string $account_to account moving to
     * @param float $amount amount of coins to move
     * @return
     */
    function move( $account_from, $account_to, $amount ) {
        return $this->client->move( $account_from, $account_to, $amount );
    }


    /**
     * Send coins to any digibyte Address
     *
     * @param string $account account sending coins from
     * @param string $to_address digibyte address sending to
     * @param float $amount amount of coins to send
     * @return string txid
     */
    function send( $account, $to_address, $amount ) {
        $txid = $this->client->sendfrom( $account, $to_address, $amount );  
        return $txid;
    }

	/**
	 * Validate a given digibyte Address
	 * @param string $address to validate
	 * @return array with the properties of the address
	 */
	function validate_address( $address ) {
		return $this->client->validateaddress($address);
	}
}

