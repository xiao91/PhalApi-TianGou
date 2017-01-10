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
            'fromComment' => array(
                'topicalId' 	=> array('name' => 'topicalId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '主题id'),
                'commentDetail' => array('name' => 'commentDetail', 'require' => true, 'desc' => '评论内容'),
                'fromUid' 	=> array('name' => 'fromUid', 'require' => true, 'desc' => '评论用户id'),
            ),
        );
	}
	
	/**
	* http://api.phalapi.com/?service=Comment.fromComment&topicalId=1&commentDetail=好看啊！&fromUid=1
	*
	*
	*/
	public function fromComment() {
		$rs = array('code' => 0, 'info' => '', 'commentId' => 0);

		$domain = new Domain_Comment();
		$comment_id = $domain->fromComment($this->topicalId, $this->commentDetail, $this->fromUid);

		if ($comment_id > 0) {
			$rs['commentId'] = $comment_id;
			$rs['code'] = 10000;
            $rs['info'] = '评论成功';
        }else {
            $rs['code'] = 10001;
            $rs['info'] = '评论失败';
        }

        return $rs;
	}
}