<?php

/**
 * 评论
 *
 * xiao
 *
 * 2017-01-04
 *
 */
class Model_Comment extends PhalApi_Model_NotORM
{
    /**
     * 添加评论，也可能是回复的评论
     *
     */
    public function addComment($content_id, $comment_detail, $from_uid = 0, $to_uid = 0)
    {
        $res = array('code' => 0, 'info' => '', 'comment' => array());

        // 查用户表中的数据
        $userORM = DI()->notorm->user;
        $user = $userORM->select('username', 'user_head')->where('user_id', $from_uid)->fetch();

        // 插入数据库中的数据
        $data = array(
            'content_id' => $content_id,
            'comment_detail' => $comment_detail,
            'from_uid' => $from_uid,
            'to_uid' => $to_uid,
            'username' => $user['username'],
            'user_head' => $user['user_head'],
            'good_count' => 0,
            'create_time' => date('Y-m-d H:i:s', time())
        );

        // 不为0说明是回复评论人
        if ($to_uid != 0) {
            $userORM2 = DI()->notorm->user;
            $user2 = $userORM2->select('username', 'user_head')->where('user_id', $to_uid)->fetch();

            // 需要插入数据库的数据
            $data['username'] = $user2['username'];
            $data['user_head'] = $user2['user_head'];
        }

        // 插入数据:只是返回要入的数据，不是表中插入行的全部数据
        $commentORM = DI()->notorm->comment;
        $comment = $commentORM->insert($data);
        $comment_id = $commentORM->insert_id();
        $res['comment'] = $comment;
        if ($comment_id == 0) {
            $res['code'] = 0;
            $res['info'] = '没有更新';
        } elseif ($comment_id > 0) {
            $res['code'] = 1;
            $res['info'] = '添加成功';
        } elseif ($comment_id === false) {
            $res['code'] = -1;
            $res['info'] = '添加失败';
        }

        return $comment;
    }

    /**
     * 评论点赞+1操作
     *
     */
    public function updateCommentGoodCount($comment_id)
    {
        $res = array('code' => 0, 'info' => '');

        $data = array(
            'good_count' => new NotORM_Literal("good_count + 1")
        );
        $commentsORM = DI()->notorm->comment;
        $row = $commentsORM->where('comment_id', $comment_id)->update($data);

        if ($row == 0) {
            $res['code'] = 0;
            $res['info'] = '没有更新';
        } elseif ($row > 0) {
            $res['code'] = 1;
            $res['info'] = '添加成功';
        } elseif ($row === false) {
            $res['code'] = -1;
            $res['info'] = '添加失败';
        }
        return $res;
    }

    /**
     * 获取最热和最新评论数据：前3个为最热（good_count值最大算起）
     *
     */
    public function getHotAndNewComment($content_id, $user_id)
    {
        $res = array('works_count' => 0, 'followers_count' => 0, 'hot_comment' => array(), 'new_comment' => array());

        $commentORM = DI()->notorm->comment;

        // 该条内容下的评论：查点赞数量排名前3个
        $sql = 'SELECT u.user_head, u.username, c.* FROM qm_user AS u LEFT JOIN qm_comment AS c ON u.user_id = c.from_uid WHERE c.content_id = :content_id ORDER BY c.good_count DESC LIMIT 3';
        $params = array(':content_id' => $content_id);
        $res['hot_comment'] = $commentORM->queryAll($sql, $params);

        // 该条内容下的评论：根据时间排序，取前10
        $sql = 'SELECT u.user_head, u.username, c.* FROM qm_user AS u LEFT JOIN qm_comment AS c ON u.user_id = c.from_uid WHERE c.content_id = :content_id ORDER BY c.create_time DESC LIMIT 10';
        $params = array(':content_id' => $content_id);
        $res['new_comment'] = $commentORM->queryAll($sql, $params);

        // 查询对应用户user_id查询该用户的发布作品数量
        $contentORM = DI()->notorm->content;
        $res['works_count'] = $contentORM->where('user_id', $user_id)->count('user_id');

        // 查询关注该用户的粉丝个数
        $followerORM = DI()->notorm->follower;
        $res['followers_count'] = $followerORM->where('from_uid', $user_id)->count('follower_id');

        return $res;
    }

    /**
     * 仅获取最新的评论数据：每次10个
     *
     */
    public function getMoreNewComment($content_id, $create_time)
    {
        $commentsORM = DI()->notorm->comment;
        // 该条内容下的评论：根据时间排序，比传入的时间小，取前10
        $sql = 'SELECT u.user_head, u.username, c.* FROM qm_user AS u LEFT JOIN qm_comment AS c ON u.user_id = c.from_uid WHERE c.content_id = :content_id AND c.create_time < :create_time ORDER BY c.create_time DESC LIMIT 10';
        $params = array(':content_id' => $content_id, ':create_time' => $create_time);
        $res = $commentsORM->queryAll($sql, $params);
        return $res;
    }


}