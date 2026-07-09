<?php
/**
 * Get the client
 */
require_once __DIR__ . '/vendor/autoload.php';

/**
 * Define configuration
 */

/* Username, password and endpoint used for server to server web-service calls */
Lyra\Client::setDefaultUsername("45265748");
Lyra\Client::setDefaultPassword("prodpassword_9T7l01eOLsG0W7xxE4eojS5C2lcY3TiMRYhNCNY11JKKA");
Lyra\Client::setDefaultEndpoint("https://api.micuentaweb.pe");

/* publicKey and used by the javascript client */
Lyra\Client::setDefaultPublicKey("45265748:publickey_FHP2IFWBbaMWcxIbZbJKwCgOStYbGErFHGMW4yG7d0pp3");

/* SHA256 key */
Lyra\Client::setDefaultSHA256Key("Aa7tWZOuQQa8xhFeVrJGDaB5JZUFl7V6fPEOX3XUo1gHp");