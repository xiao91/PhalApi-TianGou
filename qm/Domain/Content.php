<?php

class Domain_Content {

	public function getContent($content_type) {
		$model = new Model_Content();
		$res = $model->getContent($content_type);
		return $res;
	}

    public function deleteContent($content_id) {
        $model = new Model_Content();
        $res = $model->deleteContent($content_id);
        return $res;
    }

	public function getMore($content_type, $current_count) {
		$model = new Model_Content();
		$res = $model->getMore($content_type, $current_count);
		return $res;
	}

	public function addTxtContent($user_id, $content_detail, $content_title, $source_url) {
		$model = new Model_Content();
		$res = $model->addTxtContent($user_id, $content_detail, $content_title, $source_url);
		return $res;
	}
}