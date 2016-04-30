<?php
// +----------------------------------------------------------------------
// | 优惠劵
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014
// +----------------------------------------------------------------------
// | Author: zhaojie
// +----------------------------------------------------------------------
namespace Weixin\Controller;

use Common\Controller\AdminBase;

class UserCenterController extends AdminBase
{
    public $token;
    public $access_token;

    function _initialize()
    {
        parent::_initialize();
        $this->token = C('WX_TOKEN');
        $this->access_token = get_access_token();
    }

    /**
     * 显示微信用户列表数据
     */
    public function index()
    {

        $pagesize = 20;
        $page = I('page', 'intval', 0);
        $next_openid = I('next_openid');

        $url_user = 'https://api.weixin.qq.com/cgi-bin/user/get?access_token=' . $this->access_token;

        if ($page * $pagesize > 1000) $url_user .= '&next_openid=' . $next_openid;

        $list = json_decode(https_request($url_user), true);

        $userlist = array_slice($list['data']['openid'], ($page - 1) * $pagesize, $pagesize);

        foreach ($userlist as $val) {
            $info = $this->_getuserinfo($val);
            $userlists[$val] = $info;
        }

//        return $userlist;
        //echo $this->access_token;
//        dump($userlists);
//        exit;

        $page = $this->page($list['count'], $pagesize, '', array('param' => 'ggg=6'));

//        $group_list = M('Usergroup')->select();
//        $this->assign('group_list',$group_list);
//
//        $model = $this->getModel ( 'follow' );
//        $data = $this->_get_model_list ( $model );
//        $columns = $this->getListColumns($data);
//        $columnsTitle = $this->getListColumnsTitle($data);
//        $uiOptions = $this->getDataTableJsonOptions($columns,
//            addons_url('UserCenter://UserCenter/jsonData', array('model' => 'follow')));
//        $this->assign('columns', $columns);
//        $this->assign('columnsTitle', $columnsTitle);
//        $this->assign('uiOptions', json_encode($uiOptions));
//        parent::common_lists ( $model );

        $this->assign('total_count', $list['count']);
        $this->assign('next_openid', $list['next_openid']);
        $this->assign('userlists', $userlists)->assign('Page', $page->show());
        $this->display('index');
    }


    /**
     * 获取用户详细信息
     *
     * $openid  用户微信ID
     */
    private function _getuserinfo($openid)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $this->access_token . '&openid=' . $openid . '&lang=zh_CN';

        $userinfo = https_request($url);

        return json_decode($userinfo, true);
    }

}