<?php

$config = array(

	/*
	 * Global blacklist: entityIDs that should be excluded from ALL sets.
	 */
	#'blacklist' = array(
	#	'http://my.own.uni/idp'
	#),
	
	/*
	 * Conditional GET requests
	 * Efficient downloading so polling can be done more frequently.
	 * Works for sources that send 'Last-Modified' or 'Etag' headers.
	 * Note that the 'data' directory needs to be writable for this to work.
	 */
	#'conditionalGET'	=> TRUE,

	'sets' => array(
		     'euvt' => array(
        'cron' => array('hourly'),
        'sources' => array(
                array(
                                  'src'=> 'https://login.e-uvt.ro/aai/saml2/idp/metadata.php',
                ),
        ),
        'expireAfter'  => 60*60*1, // 1 hour
        'outputDir'    => 'metadata/euvt',
        'outputFormat' => 'flatfile',
      ),

		'kalmar' => array(
			'cron'		=> array('hourly'),
			'sources'	=> array(
				array(
					/*
					 * entityIDs that should be excluded from this src.
					 */
					#'blacklist' => array(
					#	'http://some.other.uni/idp',
					#),

					/*
					 * Whitelist: only keep these EntityIDs.
					 */
					#'whitelist' => array(
					#	'http://some.uni/idp',
					#	'http://some.other.uni/idp',
					#),

					#'conditionalGET' => TRUE,
					'src' => 'https://kalmar2.org/simplesaml/module.php/aggregator/?id=kalmarcentral&set=saml2&exclude=norway',
					'validateFingerprint' => '59:1D:4B:46:70:46:3E:ED:A9:1F:CC:81:6D:C0:AF:2A:09:2A:A8:01',
					'template' => array(
						'tags'	=> array('kalmar'),
						'authproc' => array(
							51 => array('class' => 'core:AttributeMap', 'oid2name'),
						),
					),
				),
			),
			'expireAfter' 		=> 60*60*24*4, // Maximum 4 days cache time.
			'outputDir' 	=> 'metadata/metadata-kalmar-consuming/',

			/*
			 * Which output format the metadata should be saved as.
			 * Can be 'flatfile' or 'serialize'. 'flatfile' is the default.
			 */
			'outputFormat' => 'flatfile',
		),
	),
);



