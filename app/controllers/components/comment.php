<?php
class CommentComponent extends Object {

	//called before Controller::beforeFilter()
	function initialize(&$controller, $settings = array()) {
		// saving the controller reference for later use
		$this->controller =& $controller;
	}

	//called after Controller::beforeFilter()
	function startup(&$controller) {
		if(!empty($controller->data)
			&& $controller->data['Comment']) {
			$url = '/' . $controller->params['url']['url'];
			$controller->data['Comment']['url'] = $url;
			$model = $controller->data['Comment']['model'];
			if(in_array($model, $controller->modelNames)) {
				if($controller->{$model}->saveComment($controller->data)) {
					$controller->redirect($url);
				} else {
					$controller->Session->setFlash(__('Si è verificato un errore.', true));
				}
			}
			else {
				$controller->Session->setFlash(__('Non cercare di imbrogliarmi.', true));
			}
		}
	}

	//called after Controller::beforeRender()
	function beforeRender(&$controller) {
	}

	//called after Controller::render()
	function shutdown(&$controller) {
	}

	//called before Controller::redirect()
	function beforeRedirect(&$controller, $url, $status=null, $exit=true) {
	}

	function redirectSomewhere($value) {
		// utilizing a controller method
		$this->controller->redirect($value);
	}

}