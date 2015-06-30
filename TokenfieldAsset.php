<?php

namespace gabteles\bootstrap\tokenfield;

use yii\web\AssetBundle;

class BootstrapTokenfieldAsset extends AssetBundle {
    //public $sourcePath = '';
    
	public $css = [
        'css/bootstrap-tokenfield.min.css',
    ];
	
	public $js = [
		'js/bootstrap-tokenfield.min.js',
	];
	
    public $depends = [
        'yii\web\JqueryAsset'
    ];
	
	/**
     * @inheritdoc
     */
    public function init() {
        $this->setSourcePath(__DIR__ . '/assets');
        parent::init();
    }
}
