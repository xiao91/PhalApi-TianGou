<?php

/**
* 评论
* 
* xiao
* 
* 2017-01-04
*
*/

class Api_Comments extends PhalApi_Api {

	public function getRules() {
        return array(
        	'getHotAndNewComment' => array(
        		'contentsId' => array('name' => 'contentsId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '评论的内容id'),
        		'userId' => array('name' => 'userId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '该条内容对应的用户id'),
        	),

            'addComment' => array(
                'contentsId' => array('name' => 'contentsId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '评论的内容id'),

                'commentDetail' => array('name' => 'commentDetail', 'require' => true, 'desc' => '评论内容'),

                'userId' => array('name' => 'userId', 'type' => 'int', 'require' => true, 'desc' => '评论用户id'),
            ),

            'updateCommentGoodCount' => array(
            	'commentId' => array('name' => 'commentId', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '评论id'),
            ),

            'getNewComment' => array(
            	'contentsId' => array('name' => 'contentsId', 'type'=> 'int', 'require' => true, 'desc' => '对应的内容id'),

            	'createTime' => array('name' => 'createTime', 'require' => true, 'desc' => '对应的评论的创建时间'),
            ),

        );
	}

	/**
	 * 获取所有评论：并分类：最热和最新、查询对应的用户信息
	 * http://localhost/TianGou/Public/?service=Comments.GetHotAndNewComment&contentsId=1&userId=1
	 * 
	 * @return string totalComment 评论总数
	 * @return string userContentsCount 用户发布内容数量
	 * @return string userFollowersCount 该用户的粉丝数量
	 * @return object hot 热门评论
	 * @return object new 最新评论
	 * 
	 */
	public function getHotAndNewComment() {
		$domain = new Domain_Comments();
		$res = $domain->getHotAndNewComment($this->contentsId, $this->userId);

		return $res;
	}
	
	/**
	*
	* 添加评论
	*
	* http://localhost/TianGou/Public/?service=Comments.AddComment&contentsId=1&commentDetail=我评价的是第1条！&userId=1
	* 
	*/
	public function addComment() {
		$domain = new Domain_Comments();
		$res = $domain->addComment($this->contentsId, $this->commentDetail, $this->userId);

        return $res;
	}

	/**
	* 
	* 该条内容对应的用户被点赞次数
	* 
	* http://localhost/TianGou/Public/?service=Comments.UpdateCommentGoodCount&commentId=1
	* 
	*/
	public function updateCommentGoodCount() {
		$rs = array('code' => 0, 'info' => '');

		$domain = new Domain_Comments();
		$row = $domain->updateCommentGoodCount($this->commentId);

		$rs['code'] = $row;

		if ($row > 0) {
            $rs['info'] = '更新成功';
        }else if ($row == 0) {
        	$rs['info'] = '数据未变化';
        }elseif ($row === false) {
        	$rs['info'] = '更新失败';
        }

        return $rs;
	}

	/**
	* 
	* 获取更多最新评论
	* 
	* http://localhost/TianGou/Public/?service=Comments.GetNewComment&contentsId=1&createTime=2017-01-13 13:38:36
	* 
	*/
	public function getNewComment() {
		$domain = new Domain_Comments();
		$res = $domain->getNewComment($this->contentsId, $this->createTime);

		return $res;
	}




}