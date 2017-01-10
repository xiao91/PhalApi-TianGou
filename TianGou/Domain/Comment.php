<?php

class Domain_Comment {

	public function addComment($contentsId, $commentDetail, $userId) {
		$model = new Model_Comment();
		$commentId = $model->addComment($contentsId, $commentDetail, $userId);

		return $commentId;
	}
}