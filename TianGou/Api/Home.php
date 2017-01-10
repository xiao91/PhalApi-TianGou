<?php

/**
* 首页数据
*
* xiao
*
* 2017-01-04
*
*/
class Api_Home extends PhalApi_Api {

	public function getRules() {
		return array(
            'content' => array(
                'type' =>array('name' => 'type', 'type'=> 'int', 'require' => true, 'default' => '1', 'desc' => '类型'),
            ),

            'getMore' => array(
            	'type' => array('name' => 'type', 'type'=> 'int', 'require' => true, 'default' => '1', 'desc' => '类型'),

            	'currentCount' => array('name' => 'currentCount', 'type'=> 'int', 'require' => true, 'default' => '1', 'desc' => '当前个数'), 

            ),

        );
	}

	/**
	* 获取内容
	*
	*/
	public function content() {
		$res = array('currentCount' => 0, 'contents' => array());
		$domain = new Domain_Home();
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

		$domain = new Domain_Home();
		$contents = $domain->getMore($this->type, $this->currentCount);

		$res['currentCount'] = count($contents);
		$res['contents'] = $contents;
		
		return $res;
	}



}