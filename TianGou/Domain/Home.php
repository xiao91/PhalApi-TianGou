<?php

class Domain_Home {

	public function content($type) {
		$model = new Model_Home();
		$res = $model->content($type);

		return $res;
	}

	public function getMore($type, $currentCount) {
		$model = new Model_Home();
		$res = $model->getMore($type, $currentCount);

		return $res;
	}
}