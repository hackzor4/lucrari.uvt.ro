<?php

$config = array(

    // This is a authentication source which handles admin authentication.
    'admin' => array(
        // The default is to use core:AdminPassword, but it can be replaced with
        // any authentication source.

        'core:AdminPassword',
    ),


    // An authentication source which can authenticate against both SAML 2.0
    // and Shibboleth 1.3 IdPs.

	  'default-sp' => array(
        'saml:SP',
        'idp' => 'https://login.e-uvt.ro/aai/saml2/idp/metadata.php',
    ),

);
