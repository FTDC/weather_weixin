<?php
namespace Weixin\Controller;

use Common\Controller\AdminBase;

class SendingMsgController extends AdminBase
{

    var $model;


    function _initialize ()
    {
        $this->model = M('sending_msg');
        parent::_initialize();
    }
    
    // 通用插件的列表模型
    public function lists ()
    {
        // $map ['token'] = get_token ();
        $map = array();
        
        $page = I('p', 1, 'intval');
        $row = 20;
        
        $data = M('sending_msg')->where($map)
            ->order('id DESC')
            ->page($page, $row)
            ->select();
        $count = M('sending_msg')->where($map)->count();
        unset($map);
        $Obj = M('custom_reply_news');
        foreach ($data as $k => $v) {
            $map[id] = array('in',$v['mult_ids']);
            $v['mult_ids'] = $Obj->where($map)->select();
        }
        ;
        $this->assign('list', $data);
        $this->display();
    }
    
    // 通用插件的编辑模型
    public function edit ()
    {
        if (IS_POST) {
            $ids = array_filter($_POST['ids']);
            if (count($ids) < 2) {
                $this->error('图文数不能少于2条');
            }
            
            $map['id'] = intval($_GET['id']);
            $save['mult_ids'] = implode(',', $ids);
            $save[''] = $_GET['type'];
            M('sending_msg')->where($map)->save($save);
            
            $model = $this->getModel('sending_msg');
            $this->_saveKeyword($model, $map['id'], 'sending_msg');
            
            $this->success('操作成功', U('lists'));
            exit();
        }
        
        $map['id'] = intval($_GET['id']);
        $info = M('sending_msg')->where($map)->find();
        
        $this->assign('mult', $info);
        
        $token = get_token();
        if (isset($info['token']) && $token != $info['token'] && defined('ADDON_PUBLIC_PATH')) {
            $this->error('非法访问！');
        }
        
        $map['id'] = array('in',$info['mult_ids']);
        $list = M('custom_reply_news')->where($map)->select();
        $this->assign('select_news', $list);
        
        $this->add();
    }
    
    // 通用插件的增加模型
    public function add ()
    {
        if (IS_POST) {
            $ids = array_filter($_POST['ids']);
            /*
             * if (count ( $ids ) < 2) { $this->error ( '图文数不能少于2条' ); }
             */
            $save['mult_ids'] = implode(',', $ids);
            $save['token'] = get_token();
            $save['type'] = $_POST['type'];
            $map['id'] = M('sending_msg')->add($save);
            $model = $this->getModel('sending_msg');
            // $this->_saveKeyword ( $model, $map ['id'], 'sending_msg' );
            $this->success('操作成功', U('lists'));
            exit();
        }
        // 使用提示
        /*
         * $normal_tips = '使用说明：请先在左边通过分类或者搜索出你需要的图文，然后点击“选择“把它增加到右边的列表。';
         * $this->assign ( 'normal_tips', $normal_tips );
         */
        $map['token'] = $cate_map['token'] = get_token();
        if (! empty($_REQUEST['cate_id'])) {
            $map['cate_id'] = intval($_REQUEST['cate_id']);
        }
        if (isset($_REQUEST['title'])) {
            $map['title'] = array('like','%' . htmlspecialchars($_REQUEST['title']) . '%');
        }
        
        $page = I('p', 1, 'intval'); // 默认显示第一页数据
        $row = 20;
        
        $data = M('custom_reply_news')->where($map)
            ->order('id DESC')
            ->page($page, $row)
            ->select();
        
        $text_data = M('custom_reply_text')->where($map)
            ->order('id DESC')
            ->page($page, $row)
            ->select();
        $this->assign('text_data', $text_data);
        
        /* 查询记录总数 */
        $count = M('custom_reply_news')->where($map)->count();
        $list_data['list_data'] = $data;
        
        // 分页
        if ($count > $row) {
            $page = new \Think\Page($count, $row);
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $list_data['_page'] = $page->show();
        }
        
        // 分类数据
        $cate_map['is_show'] = 1;
        $list = M('weisite_category')->where($cate_map)
            ->field('id,title')
            ->select();
        $this->assign('weisite_category', $list);
        
        unset($list_data['list_grids']);
        $girds['field'][0] = 'title';
        $girds['title'] = '标题';
        $list_data['list_grids'][] = $girds;
        
        $girds['field'][0] = 'id';
        $girds['title'] = '操作';
        $girds['href'] = '';
        $list_data['list_grids'][] = $girds;
        
        $this->assign($list_data);
        
        $this->display(T('Addons://' . _ADDONS . '@' . _CONTROLLER . '/add'));
    }
    
    // 通用插件的删除模型
    public function del ()
    {
        parent::common_del($this->model);
    }
    
    // 获取所属分类
    function getCateData ()
    {
        $map['is_show'] = 1;
        $map['token'] = get_token();
        $list = M('weisite_category')->where($map)->select();
        foreach ($list as $v) {
            $extra .= $v['id'] . ':' . $v['title'] . "\r\n";
        }
        return $extra;
    }


    /**
     * 上传图文素材到微信端
     * 
     * @author z501727296@163.com
     * @param $type string Message Type
     */
    public function postImageSource ($data, $type = "news")
    {
        $access_token = get_access_token();
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_news?access_token=$access_token";
        if ($data) {
            switch ($type) {
                case "news":
                    $cover_media_id = $this->postThumb($data['cover']);
                    $datas[articles] = array(array("title" => urlencode($data['title']),"thumb_media_id" => $cover_media_id,"author" => urlencode($_SESSION['username']['username']), // 作者
"digest" => urlencode($data['intro']), // 摘要
"show_cover_pic" => $data['show_cover_pic'], // 是否首页显示
"content" => urlencode($data['content']), // 内容
"content_source_url" => $data['jump_url']) // 页面跳转连接
);
                break;
                case "mult":
                    foreach ($data as $k => $v) {
                        $cover_media_id[$k] = $this->postThumb($v['cover']);
                        $info_tmp[] = array("thumb_media_id" => $cover_media_id[$k],"author" => urlencode($_SESSION['username']['username']),"title" => urlencode($v['title']),"content_source_url" => $v['jump_url'],"content" => urlencode($v['content']),"digest" => urlencode($v['intro']),"show_cover_pic" => "1");
                    }
                    $datas[articles] = $info_tmp;
                break;
            }
        }
        $res = $this->https_request($url, urldecode(json_encode($datas)));
        $row = json_decode($res);
        return $row;
    }


    /**
     * Upload Thumb Image
     * 
     * @author z501727296@163.com
     * @param $cover_id int this is thumb id
     */
    public function postThumb ($cover_id)
    {
        $token = get_token();
        $access_token = get_access_token($token);
        // $url =
        // "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=$access_token&type=thumb";
        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=$access_token&type=thumb";
        $where = "id=" . $cover_id;
        $info = M('picture')->where($where)->find();
        $data = array('media' => "@" . SITE_PATH . $info['path']);
        $res = $this->https_request($url, $data);
        $row = json_decode($res, "JSON");
        return $row['media_id'];
    }


    /**
     * 群发消息
     * 
     * @author z501727296@163.com
     */
    public function sending ()
    {
        $id = I('id');
        $Obj = M('sending_msg');
        $where = "`id` = " . $id;
        $sending_info = $Obj->where($where)->find();
        switch ($sending_info['type']) {
            case "news":
                $news_info = M('custom_reply_news')->where('id=' . $sending_info['mult_ids'])->find();
                if (empty($sending_info['media_id'])) {
                    $media_id = $this->postImageSource($news_info, 'news');
                    if ($media_id) {
                        $data = array("media_id" => $media_id->media_id);
                        M('sending_msg')->where($where)->save($data);
                    }
                } else {
                    $media_id = $sending_info['media_id'];
                }
                if ($sending_info['is_to_all'] == 0) {
                    $send_type = "0";
                    $tmp = array("is_to_all" => true);
                    $msg = array("filter" => $tmp,"mpnews" => array("media_id" => $media_id),"msgtype" => "mpnews");
                } elseif ($sending_info['is_to_all'] == 1) {
                    $send_type = "0";
                    $tmp = array("is_to_all" => false,"group_id" => "0");
                    $msg = array("filter" => $tmp,"mpnews" => array("media_id" => $media_id),"msgtype" => "mpnews");
                } else {
                    $send_type = "1";
                    $tmp = array("","");
                    $msg = array("touser" => $tmp,"mpnews" => array("media_id" => $media_id),"msgtype" => "mpnews");
                }
            break;
            case "mult":
                $ids = explode(',', $sending_info['mult_ids']);
                $wheres['id'] = array('in',$ids);
                $mult_info = M('custom_reply_news')->where($wheres)->select();
                if (empty($sending_info['media_id'])) {
                    $media_id = $this->postImageSource($mult_info, 'mult');
                    if ($media_id) {
                        $data = array("media_id" => $media_id->media_id);
                        M('sending_msg')->where($where)->save($data);
                    }
                } else {
                    $media_id = $news_info['media_id'];
                }
                if ($sending_info['is_to_all'] == 0) {
                    $send_type = "0";
                    $tmp = array("is_to_all" => true);
                    $msg = array("filter" => $tmp,"mpnews" => array("media_id" => $media_id),"msgtype" => "mpnews");
                } elseif ($sending_info['is_to_all'] == 1) {
                    $send_type = "0";
                    $tmp = array("is_to_all" => false,"group_id" => "0");
                    $msg = array("filter" => $tmp,"mpnews" => array("media_id" => $media_id),"msgtype" => "mpnews");
                } else {
                    $send_type = "1";
                    $tmp = array("","");
                    $msg = array("touser" => $tmp,"mpnews" => array("media_id" => $media_id),"msgtype" => "mpnews");
                }
            break;
            case "text":
                $news_info = M('custom_reply_text')->where('id=' . $sending_info['mult_ids'])->find();
                if ($sending_info['is_to_all'] == 0) {
                    $send_type = "0";
                    $tmp = array("is_to_all" => true,"group_id" => "0");
                    $msg = array("filter" => $tmp,"text" => array("content" => $news_info['content']),"msgtype" => "text");
                } elseif ($sending_info['is_to_all'] == 1) {
                    $send_type = "0";
                    $tmp = array("is_to_all" => false,"group_id" => "0");
                    $msg = array("filter" => $tmp,"text" => array("content" => $news_info['content']),"msgtype" => "text");
                } else {
                    $send_type = "1";
                    $tmp = array("","");
                    $msg = array("touser" => $tmp,"text" => array("content" => $news_info['content']),"msgtype" => "text");
                }
            break;
            case "image":
                $msg = array();
            break;
        }
        $result = $this->setSending($msg, $send_type);
        var_dump($result);
        $res = json_decode($result);
        if ($res['errcode'] == "0") {
            $data = array("msg_id" => $res['msg_id']);
            M('sending_msg')->where($where)->save($data);
            $this->success('群发成功', U('lists'));
        } else {
            $this->success('群发失败', U('lists'));
        }
    }


    /**
     * 群发消息
     * 
     * @author z510727296@163.com
     * @param $msg array wechat sending message
     * @param $send_type string sending type
     */
    private function setSending ($msg, $send_type = "0")
    {
        $token = get_token();
        $access_token = get_access_token($token);
        $json = json_encode($msg);
        /* echo $json . "<br />"; */
        if ($send_type === "0") {
            $url = "https://api.weixin.qq.com/cgi-bin/message/mass/sendall?access_token=$access_token";
        } else {
            $url = "https://api.weixin.qq.com/cgi-bin/message/mass/send?access_token=$access_token";
        }
        die();
        $result = $this->https_request($url, $json);
        return $result;
    }
}
