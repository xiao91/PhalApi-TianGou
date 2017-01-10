<?php

/**
* 评论
* 
* xiao
* 
* 2017-01-04
*
*/

class Api_Comment extends PhalApi_Api {

	public function getRules() {
        return array(
            'addComment' => array(
                'contentsId' 	=> array('name' => 'contentsId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '评论的内容id'),

                'commentDetail' => array('name' => 'commentDetail', 'require' => true, 'desc' => '评论内容'),

                'userId' 	=> array('name' => 'userId', 'require' => true, 'desc' => '评论用户id'),
            ),
        );
	}
	
	/**
	* http://localhost/TianGou/Public/?service=Comment.AddComment&contentsId=1&commentDetail=好看啊！&userId=1
	* 
	* 添加评论
	*
	*/
	public function addComment() {
		$rs = array('code' => 0, 'info' => '');

		$domain = new Domain_Comment();
		$commentId = $domain->addComment($this->contentsId, $this->commentDetail, $this->userId);

		$rs['code'] = $commentId;

		if ($commentId > 0) {
            $rs['info'] = '评论成功';
        }else {
            $rs['info'] = '评论失败';
        }

        return $rs;
	}
}