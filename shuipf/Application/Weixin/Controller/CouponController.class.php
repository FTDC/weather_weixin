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

class CouponController extends AdminBase
{
    private $Config = null;
    private $model = null;

    protected function _initialize()
    {
        parent::_initialize();
        $this->Config = D('Common/Config');
        $configList = $this->Config->getField("varname,value");
        $this->assign('Site', $configList);
        $this->model = D('Weixin/WpCoupon');
    }

    public function index()
    {
        $this->display();
    }

    //列表显示
    public function couponlists()
    {
        $where['token'] = array('eq', TOKEN);  //后期根据token查询
        if (!empty($_REQUEST ['keyword'])) {
            $where['keyword'] = array(
                'like',
                '%' . htmlspecialchars($_REQUEST ['keyword']) . '%'
            );
        }
        $count = $this->model->count();
        $page = $this->page($count, 20);
        $list = $this->model->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('cTime' => 'DESC'))->select();
        $this->assign("Page", $page->show());
        $this->assign("list", $list);
        $this->display();
    }

    //增加
    public function add()
    {
        if (IS_POST) {
            $_POST['token'] = TOKEN;
            if (!empty($_FILES['cover']['name'])) {
                $_POST['cover'] = uplodes($_FILES['cover']);
            }
            if (!empty($_FILES['end_img']['name'])) {
                $_POST['end_img'] = uplodes($_FILES['end_img']);
            }
            if ($this->model->createCoupon($_POST)) {
                $this->success("添加成功！", U('Coupon/couponlists'));
            } else {
                $error = $this->model->getError();
                $this->error($error ? $error : '添加失败！');
            }
        } else {
            $this->display();
        }
    }

    //编辑信息
    public function edit()
    {
        $id = I('request.id', 0, 'intval');
        if (empty($id)) {
            $this->error("请选择需要编辑的信息！");
        }
        if (IS_POST) {
            if (!empty($_FILES['cover']['name'])) {
                $_POST['cover'] = uplodes($_FILES['cover']);
            }
            if (!empty($_FILES['end_img']['name'])) {
                $_POST['end_img'] = uplodes($_FILES['end_img']);
            }
            if (false !== $this->model->amendCoupon($_POST)) {
                $this->success("更新成功！", U('Coupon/couponLists'));
            } else {
                $error = $this->model->getError();
                $this->error($error ? $error : '修改失败！');
            }
        } else {
            $data = $this->model->where(array("id" => $id))->find();
            if (empty($data)) {
                $this->error('该信息不存在！');
            }
            $this->assign("data", $data);
            $this->display();
        }
    }

    //删除
    public function del()
    {
        $id = $_REQUEST ['id'];
        if (empty($id)) {
            $this->error("没有指定删除对象！");
        }
        $where['id'] = array('in', $id);
        //执行删除
        if ($this->model->where($where)->delete($id)) {
            $this->success("删除成功！");
        } else {
            $this->error($this->model->getError() ?: '删除失败！');
        }
    }


    // 开始领取页面
    public function preview()
    {
        $this->_detail();
        $this->display();
    }

    // 过期提示页面
    public function over()
    {
        $this->_detail();
        $this->display();
    }

    public function show()
    {
        $sn_id = I('sn_id', 0, 'intval');
        $map2 ['target_id'] = I('id', 0, 'intval');
        $map2 ['uid'] = $_SESSION['jbr_admin_id'];
        $list = M('wp_sn_code')->where($map2)->select();
        foreach ($list as $vo) {
            $my_count += 1;
            $vo ['id'] == $sn_id && $sn = $vo;
        }
        if (empty ($sn_id) || empty ($sn)) {
            //$this->error ( '非法访问' );
            //exit ();
        }
        $this->assign('sn', $sn);
        // dump($sn);

        $this->_detail($my_count);

        $this->display('show');
    }

    function _detail($my_count = false)
    {
        $id = I('id', 0, 'intval');
        $data = $this->model->find($id);
        $this->assign('data', $data);

        // 领取条件提示
        $follower_condtion [1] = '关注后才能领取';
        $follower_condtion [2] = '用户绑定后才能领取';
        $follower_condtion [3] = '领取会员卡后才能领取';
        $tips = $this->condition_tips($data ['addon_condition']);

        $condition = array();
        $data ['max_num'] > 0 && $condition [] = '每人最多可领取' . $data ['max_num'] . '张';
        $data ['credit_conditon'] > 0 && $condition [] = '积分中财富值达到' . $data ['credit_conditon'] . '分才能领取';
        $data ['credit_bug'] > 0 && $condition [] = '领取后需扣除财富值' . $data ['credit_bug'] . '分';
        isset ($follower_condtion [$data ['follower_condtion']]) && $condition [] = $follower_condtion [$data ['follower_condtion']];

        empty ($tips) || $condition [] = $tips;
        $this->assign('condition', $condition);
        // dump ( $condition );

        $this->_get_error($data, $my_count);
    }


    protected function _get_error($data, $my_count = false)
    {
        $error = '';

        // 抽奖记录
        if ($my_count === false) {
            $map2 ['target_id'] = $data ['id'];
            $map2 ['uid'] = $_SESSION['jbr_admin_id'];
            $my_count = M('wp_sn_code')->where($map2)->count();
        }

        // 权限判断
        $map ['token'] = TOKEN;
        //$map ['openid'] = get_openid ();//后期写活
        $follow = M('wp_follow')->where($map)->find();

        if ($data ['end_time'] <= time()) {
            $error = '您来晚啦';
        } else if ($data ['max_num'] > 0 && $data ['max_num'] <= $my_count) {
            $error = '您的领取名额已用完啦';
        } else if ($data ['follower_condtion'] > intval($follow ['status'])) {
            switch ($data ['follower_condtion']) {
                case 1 :
                    $error = '关注后才能领取';
                    break;
                case 2 :
                    $error = '用户绑定后才能领取';
                    break;
                case 3 :
                    $error = '领取会员卡后才能领取';
                    break;
            }
        } else if ($data ['credit_conditon'] > intval($follow ['score']) && !$is_admin) {
            $error = '您的财富值不足';
        } else if ($data ['credit_bug'] > intval($follow ['score']) && !$is_admin) {
            $error = '您的财富值不够扣除';
        } else if (!empty ($data ['addon_condition'])) {
            $this->addon_condition_check($data ['addon_condition']) || $error = '权限不足';
        }
        $this->assign('error', $error);
        // dump ( $error );

        return $error;
    }

    // 记录中奖数据到数据库
    function set_sn_code()
    {
        $id = I('id', 0, 'intval');
        $data = M('wp_coupon')->find($id);

        $error = $this->_get_error($data);
        if (!empty ($error)) {
            $this->display('over');
            exit ();
        }
        $data ['sn'] = uniqid();


        $data ['prize_id'] = 0;
        $data ['prize_title'] = '';

        $data_sn['sn'] = $data ['sn'];
        $data_sn['uid'] = $_SESSION['jbr_admin_id'];
        $data_sn['cTime'] = time();
        $data_sn['addon'] = 'Coupon';
        $data_sn ['target_id'] = $id;
        $data_sn ['prize_id'] = 0;
        $data_sn ['prize_title'] = '';


        $res = M('wp_sn_code')->add($data_sn);
        if ($res) {
            /*
            // 扣除积分
            if (! empty ( $data ['credit_bug'] )) {
                $credit ['score'] = $data ['credit_bug'];
                $credit ['experience'] = 0;
                add_credit ( 'coupon_credit_bug', 5, $credit );
            }*/

            $param ['id'] = $id;
            $param ['sn_id'] = $res;
            redirect(U('show', $param));
        } else {
            $this->error('领取失败，请稍后再试');
        }
    }

    // 抽奖或者优惠券领取的插件条件判断
    protected function addon_condition_check($addon_condition)
    {
        preg_match_all("/\[([\s\S]*):([\*,\d]*)\]/i", $addon_condition, $match);
        if (empty ($match [1] [0]) || empty ($match [2] [0])) {
            return true;
        }
        $conditon ['token'] = TOKEN;
        $conditon ['uid'] = $_SESSION['jbr_admin_id'];

        switch ($match [1] [0]) {
            case '投票' :
                $match [2] [0] != '*' && $match [2] [0] > 0 && $conditon ['vote_id'] = $match [2] [0];
                $conditon ['user_id'] = $_SESSION['jbr_admin_id'];
                unset ($conditon ['uid']);
                $res = M('vote_log')->where($conditon)->find();
                break;
            case '通用表单' :
                $match [2] [0] != '*' && $match [2] [0] > 0 && $conditon ['forms_id'] = $match [2] [0];
                $res = M('forms_value')->where($conditon)->find();
                break;
            case '微考试' :
                $match [2] [0] != '*' && $match [2] [0] > 0 && $conditon ['exam_id'] = $match [2] [0];
                $res = M('exam_answer')->where($conditon)->find();
                break;
            case '微测试' :
                $match [2] [0] != '*' && $match [2] [0] > 0 && $conditon ['test_id'] = $match [2] [0];
                $res = M('test_answer')->where($conditon)->find();
                break;
            case '微调研' :
                $match [2] [0] != '*' && $match [2] [0] > 0 && $conditon ['survey_id'] = $match [2] [0];
                $res = M('survey_answer')->where($conditon)->find();
                break;
            default :
                $match [2] [0] != '*' && $match [2] [0] > 0 && $conditon ['id'] = $match [2] [0];
                $res = M($match [1] [0])->where($conditon)->find();
        }
        // dump ( $res );
        // dump ( M ()->getLastSql () );

        return !empty ($res);
    }

    // 抽奖或者优惠券领取的插件条件提示
    protected function condition_tips($addon_condition)
    {
        if (empty ($addon_condition))
            return '';

        preg_match_all("/\[([\s\S]*):([\*,\d]*)\]/i", $addon_condition, $match);
        if (empty ($match [1] [0]) || empty ($match [2] [0])) {
            return '';
        }

        $conditon ['token'] = TOKEN;
        $conditon ['id'] = $match [2] [0];
        $title = '';
        $has_title = $conditon ['id'] != '*' && $conditon ['id'] > 0;

        switch ($match [1] [0]) {
            case '投票' :
                $has_title && $title = M('vote')->where($conditon)->getField('title');
                break;
            case '通用表单' :
                $has_title && $title = M('forms')->where($conditon)->getField('title');
                break;
            case '微考试' :
                $has_title && $title = M('exam')->where($conditon)->getField('title');
                break;
            case '微测试' :
                $has_title && $title = M('test')->where($conditon)->getField('title');
                break;
            case '微调研' :
                $has_title && $title = M('survey')->where($conditon)->getField('title');
                break;
            default :
                $has_title && $title = M($match [1] [0])->where($conditon)->getField('title');
        }
        $result = '需要参与' . $title . $match [1] [0] . '后才能领取';

        return $result;
    }

}