<?php

class Domain_Content {

	public function content($type) {
		$model = new Model_Content();
		$res = $model->content($type);

		return $res;
	}

	public function getMore($type, $currentCount) {
		$model = new Model_Content();
		$res = $model->getMore($type, $currentCount);

		return $res;
	}

	public function updateGoodCount($contentId) {
		$model = new Model_Content();
		$row = $model->updateGoodCount($contentId);

		return $row;
	}

	public function updateBadCount($ContentId) {
		$model = new Model_Content();
		$row = $model->updateBadCount($ContentId);

		return $row;
	}
}