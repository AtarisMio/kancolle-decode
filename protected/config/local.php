<?php

return array(
	'name' => 'KanColle Data Center',
	'basePath' => dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'theme' => 'default',
	'defaultController' => 'decodes',
	'import'=>array(
		'application.models.*',
		'application.classes.*',
		'application.helpers.*',
	),
	'modules'=>array(
		'site'=>array(
			
		),
		'build'=>array(
			'defaultController' => 'home',
		),
		'event'=>array(
			'defaultController' => 'home',
		),
		'decodes'=>array(
			'defaultController' => 'view',
		),
		'studies'=>array(
			'defaultController' => 'home',
		),
	),
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=kancolle',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => '',
		),
        'urlManager'=>array(
            'urlFormat'=>'path',
        	'showScriptName'=>false,
            'rules'=>array(
				'events/<world:\w+>' => 'event/home/index',
				'events/<world:\w+>/<number:\d+>' => 'event/map/index',
				'build/graph/german=<german:\d+>' => 'build/graph/index',
				'decodes/add/parse/<date:.*>' => 'decodes/add/parse',
				'decodes/add/compare/<date:.*>' => 'decodes/add/compare',
				'decodes/add/purge/<date:.*>' => 'decodes/add/purge',
				'decodes/add/<req:.*>' => 'decodes/add/<req>',
				'decodes/extra' => 'decodes/extra/index',
				'decodes/extra/<action:.*>' => 'decodes/extra/<action>',
				'decodes/<date:.*>/image' => 'decodes/view/image',
				'decodes/<date:.*>/<master:\w+>' => 'decodes/record/master',
				'decodes/<date:.*>/<master:\w+>-<id:\d+>' => 'decodes/record/index',
				'decodes/<date:.*>' => 'decodes/view/index',
            ),
        ),
		'errorHandler'=>array(
            'errorAction'=>'site/error',
        ),
    ),
);
