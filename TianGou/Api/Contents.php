<?php

/**
* 首页数据
*
* xiao
*
* 2017-01-04
*
*/
class Api_Contents extends PhalApi_Api {

	public function getRules() {
		return array(
            'content' => array(
                'type' =>array('name' => 'type', 'type'=> 'int', 'require' => true, 'default' => '1', 'desc' => '类型'),
            ),

            'getMore' => array(
            	'type' => array('name' => 'type', 'type'=> 'int', 'require' => true, 'default' => '1', 'desc' => '类型'),

            	'currentCount' => array('name' => 'currentCount', 'type'=> 'int', 'require' => true, 'default' => '1', 'desc' => '当前个数'), 

            ),

            'updateGoodCount' => array(
            	'contentsId' => array('name' => 'contentsId', 'type'=> 'int', 'require' => true, 'desc' => '对应的内容id'),
            ),

            'updateBadCount' => array(
            	'contentsId' => array('name' => 'contentsId', 'type'=> 'int', 'require' => true, 'desc' => '对应的内容id'),
            ),

        );
	}

	/**
	* 获取内容
	*
	*/
	public function content() {
		$res = array('currentCount' => 0, 'contents' => array());
		$domain = new Domain_Contents();
		$arr = $domain->content($this->type);
		$res['currentCount'] = count($arr);
		$res['contents'] = $arr;
		return $res;
	}

	/**
	* 获取更多数据：分页
	*
	*/
	public function getMore() {
		$res = array('currentCount' => 0, 'contents' => array());

		$domain = new Domain_Contents();
		$contents = $domain->getMore($this->type, $this->currentCount);

		$res['currentCount'] = count($contents);
		$res['contents'] = $contents;
		
		return $res;
	}

	/**
	* 更新对应内容的次数
	* 
	* http://localhost/TianGou/Public/?service=Contents.UpdateGoodCount&contentsId=1
	*
	*/
	public function updateGoodCount() {
		$res = array('info' => '', 'contentsId' => 0);

		$domain = new Domain_Contents();
		$row = $domain->updateGoodCount($this->contentsId);

		$res['contentsId'] = $row;

		if ($row == 0) {
			$res['info'] = '数据没有更新';
		}elseif ($row > 0) {
			$res['info'] = '更新成功';
		}elseif ($row === false) {
			$res['info'] = '更新失败';
		}

		return $res;
	}

	public function updateBadCount() {
		$res = array('info' => '', 'contentsId' => 0);

		$domain = new Domain_Contents();
		$row = $domain->updateBadCount($this->contentsId);

		$res['contentsId'] = $row;

		if ($row == 0) {
			$res['info'] = '数据没有更新';
		}elseif ($row > 0) {
			$res['info'] = '更新成功';
		}elseif ($row === false) {
			$res['info'] = '更新失败';
		}

		return $res;
	}

}