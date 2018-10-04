<?php

return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'assetManager' => [
			'bundles' => [
				'dosamigos\google\maps\MapAsset' => [
				'options' => [
					'key' => 'AIzaSyDED-fR-1jECR21jfW-GYn-ljSL-h3jDa4',// ใส่ API ตรงนี้ครับ
					'language' => 'th',
					'version' => '3.1.18'
					]
				]
			]
		], 
      ],
   

];
