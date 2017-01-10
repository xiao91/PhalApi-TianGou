<?php

class Domain_Contents {

	public function content($type) {
		$model = new Model_Contents();
		$res = $model->content($type);

		return $res;
	}

	public function getMore($type, $currentCount) {
		$model = new Model_Contents();
		$res = $model->getMore($type, $currentCount);

		return $res;
	}

	public function updateGoodCount($contentsId) {
		$model = new Model_Contents();
		$row = $model->updateGoodCount($contentsId);

		return $row;
	}

	public function updateBadCount($contentsId) {
		$model = new Model_Contents();
		$row = $model->updateBadCount($contentsId);

		return $row;
	}
}