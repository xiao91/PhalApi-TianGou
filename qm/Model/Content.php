<?php

class Model_Content extends PhalApi_Model_NotORM
{

    /**
     * 内容
     *
     */
    public function getContent($content_type)
    {
        $res = array('total' => 0, 'current_count' => 0, 'content' => array());

        if ($content_type == 0) {
            // 查询10条数据：按时间顺序；不分类;
            $contentsORM = DI()->notorm->content;
            $sql = 'SELECT u.user_head, u.username, c.*, g.* FROM qm_user AS u RIGHT JOIN (qm_content AS c LEFT JOIN qm_good AS g ON c.content_id = g.content_id) ON u.user_id = c.user_id ORDER BY c.create_time DESC LIMIT 10';
            $content = $contentsORM->queryAll($sql, array());
            $res['total'] = $contentsORM->count('content_id');
            $res['current_count'] = count($content);
            $res['content'] = $content;
        } else {
            // 查询10条数据：按时间顺序；分类
            $contentsORM = DI()->notorm->content;
            $sql = 'SELECT u.user_head, u.username, c.*, g.* FROM qm_user AS u RIGHT JOIN (qm_content AS c LEFT JOIN qm_good AS g ON c.content_id = g.content_id) ON u.user_id = c.user_id WHERE c.content_type = :content_type ORDER BY c.create_time DESC LIMIT 10';
            $params = array(':content_type' => $content_type);
            $content = $contentsORM->queryAll($sql, $params);

            $sql = 'SELECT COUNT(content_type) AS counts FROM qm_content WHERE content_type = :content_type';
            $counts = $contentsORM->queryAll($sql, array(':content_type' => $content_type));
            $res['total'] = $counts[0]['counts'];
            $res['current_count'] = count($content);
            $res['content'] = $content;
        }

        return $res;
    }

    /**
     * 获取更多数据，每次查询5条
     *
     *
     */
    public function getMore($content_type, $current_count)
    {
        $res = array('total' => 0, 'current_count' => 0, 'content' => array());
        if ($content_type == 0) {
            $contentsORM = DI()->notorm->content;
            // 查询5条数据：按时间顺序；不分类，每次查询5条
            $sql = 'SELECT u.user_head, u.username, c.*, g.* FROM qm_user AS u RIGHT JOIN (qm_content AS c LEFT JOIN qm_good AS g ON c.content_id = g.content_id) ON u.user_id = c.user_id ORDER BY c.create_time DESC LIMIT :start,:num';
            $params = array(':start' => $current_count, ':num' => 5);
            $content = $contentsORM->queryAll($sql, $params);
            $res['total'] = $contentsORM->count('content_id');
            $res['current_count'] = count($content);
            $res['content'] = $content;
        } else {
            $contentsORM = DI()->notorm->content;
            $sql = 'SELECT u.user_head, u.username, c.*, g.* FROM qm_user AS u RIGHT JOIN (qm_content AS c LEFT JOIN qm_good AS g ON c.content_id = g.content_id) ON u.user_id = c.user_id WHERE c.content_type = :content_type ORDER BY c.create_time DESC LIMIT :start,:num';
            $params = array(':type' => $content_type, ':start' => $current_count, ':num' => 5);
            $content = $contentsORM->queryAll($sql, $params);

            $sql = 'SELECT COUNT(content_type) AS counts FROM qm_content WHERE content_type = :content_type';
            $counts = $contentsORM->queryAll($sql, array(':content_type' => $content_type));
            $res['total'] = $counts[0]['counts'];
            $res['current_count'] = count($content);
            $res['content'] = $content;
        }
        return $res;
    }

    /**
     * 删除
     *
     */
    public function deleteContent($content_id)
    {
        $res = array('code' => 0, 'info' => '');

        $contentsORM = DI()->notorm->content;
        $sql = 'DELETE qm_content, qm_good FROM qm_content LEFT JOIN qm_good ON qm_content.content_id = qm_good.content_id WHERE qm_content.content_id = :content_id';
        $params = array(':content_id' => $content_id);
        // 删除后返回的数据是null的
        $content = $contentsORM->queryAll($sql, $params);

        if ($content == NULL) {
            $res['code'] = 0;
            $res['info'] = '删除成功';
        } else {
            $res['code'] = -1;
            $res['info'] = '更新失败';
        }

        return $res;
    }

    /**
     * 添加文本笑话
     *
     */
    public function addTxtContent($user_id, $content_detail, $content_title, $source_url)
    {
        $res = array('code' => 0, 'info' => '');


        $data = array(
            'user_id' => $user_id,
            'content_detail' => $content_detail,
            'content_desc' => '',
            'content_source_url' => $source_url == NULL ? '' : $source_url,
            'content_title' => $content_title,
            'content_type' => 1,
            'create_time' => date('Y-m-d H:i:s', time())
            );

        $contentsORM = DI()->notorm->content;
        $contentsORM -> insert($data);
        $id = $contentsORM -> insert_id();

        if ($id > 0) {
            $res['code'] = 1;
            $res['info'] = '上传成功';
        } elseif ($id == 0) {
            $res['code'] = 0;
            $res['info'] = '上传未更新数据';
        }else {
            $res['code'] = -1;
            $res['info'] = '上传失败';
        }

        return $res;
    }
}