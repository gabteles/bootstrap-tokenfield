<?php

namespace gabteles\bootstrap\tokenfield;
use yii\helpers\Html;
use yii\widgets\InputWidget;
use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * Implements Tokenfield for Bootstrap in Yii2.
 */
class Tokenfield extends InputWidget {
	/**
     * @var array widget plugin options
     */
    public $pluginOptions = [];
	
	/**
	 * @var string selector used by jQuery
	 */
	protected $_selector = '';
	
	/**
     * @inheritdoc
     */
    public function init() {
        parent::init();
		$this->registerAssets();
	}
	
	/**
     * @inheritdoc
     */
    public function run() {
		// Generate an selector which will be used by jQuery
		if (isset($this->options['id'])) {
			$this->_selector = '#' . $this->options['id'];
		} elseif (!isset($this->options['data-tokenfield-id'])) {
			$id = uniqid('tokenfield_');
			$this->options['data-tokenfield-id'] = $id;
			$this->_selector = "[data-tokenfield-id={$id}]";
		}
		
		// Input
        if ($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
			if (is_array($this->value)) {
				echo Html::textInput($this->name, implode(',', $this->value), $this->options);
			} else {
				echo Html::textInput($this->name, $this->value, $this->options);
			}
        }
		
		// Register the bootstrap-tokenfield script
		$this->registerClientScript();
    }
	
	/**
     * Registers the needed client script and options.
     */
    public function registerClientScript() {
		$selector = $this->_selector;
		$options = $this->pluginOptions;
		$clientScript = JsExpression("$('{$selector}]').tokenfield($options);");
		echo Json::htmlEncode($clientScript);
	}
	
	/**
     * Registers the asset bundle
     */
    private function registerAssets() {
        $view = $this->getView();
        TokenfieldAsset::register($view);
	}
}
