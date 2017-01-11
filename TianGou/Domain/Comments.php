<?php

class Domain_Comments {

	public function getHotAndNewComment($contentsId, $userId) {
		$model = new Model_Comments();
		$res = $model->getHotAndNewComment($contentsId, $userId);

		return $res;
	}

	public function addComment($contentsId, $commentDetail, $userId) {
		$model = new Model_Comments();
		$commentId = $model->addComment($contentsId, $commentDetail, $userId);

		return $commentId;
	}

	public function updateCommentGoodCount($commentId) {
		$model = new Model_Comments();
		$row = $model->updateCommentGoodCount($commentId);

		return $row;
	}


}