<?php
/**
 * 天气吐槽
 *
 * @author  zhaojie <z510727296@163.com>
 */
namespace Weixin\Controller;

use Common\Controller\AdminBase;

class WeatherController extends AdminBase{

	protected function _initialize() {
		parent::_initialize();
	}

 	/**
 	 * 吐槽天气列表
 	 */
 	public function tucao(){
		
		header('Content-type: audio/amr');
		
		 $start_time = I('start_time');
        $end_time = I('end_time');
		
 		$Obj = M('voice_msg');

 		$count = $Obj->count();
		$page = $this->page($count, 20);
		
		
		$where = array();
		
	
		if (!empty($start_time) && !empty($end_time)) {
            $start_time = strtotime($start_time);
            $end_time = strtotime($end_time) + 86399;
            $where['crdate'] = array(array('GT', $start_time), array('LT', $end_time), 'AND');
        }

		
		$list = $Obj->where($where)->limit($page->firstRow . ',' . $page->listRows)->order(array('crdate' => 'DESC'))->select();

		foreach ($list as $key => $val){
			if(empty($val['local_path'])){
				$data['local_path'] = $this->saveMedia($val['media_id']);
				// $data['username'] = $this->saveMedia($val['media_id']);
				$user = $this->_getuserinfo($val['openid']);
				
				
				$data['nickname']= $user['nickname'];
				//dump($data); exit;
				
				$Obj->where('id='.$val['id'])->save($data);
				$list[$key]['local_path'] = $data['local_path'];
				$list[$key]['user'] = $user['nickname'];
				
			}
		}

		$this->assign("Page", $page->show());
		$this->assign("list", $list);
 		$this->display();
 	}

    /**
     * 获取用户详细信息
     *
     * $openid  用户微信ID
     */
    private function _getuserinfo($openid)
    {
        $url = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . get_access_token() . '&openid=' . $openid . '&lang=zh_CN';

        $userinfo = https_request($url);

        return json_decode($userinfo, true);
    }


    /**
 	 * 吐槽消息删除
 	 */
 	public function del(){
 		$Obj = M('voice_msg');
 		$id = $_REQUEST ['id'];
		if (empty($id)) {
			$this->error("没有指定删除对象！");
		}
		$where['id'] =array('in',$id);
		//执行删除
		if ($Obj->where($where)->delete($id)) {
			$this->success("删除成功！");
		} else {
			$this->error($Obj->getError()? : '删除失败！');
		}
 	}
 	
 	/**
 	 * media_id 下载微信文件
 	 */
 	function saveMedia($media_id){
 		//$murl = "https://api.weixin.qq.com/cgi-bin/material/get_material?access_token=".get_access_token();
 		$murl = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".get_access_token().'&media_id='.$media_id;
 		$data = array(
 			"media_id" => $media_id
 		);
 		// $info = https_request($murl,$data);
 		
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $murl);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);

        curl_setopt($curl, CURLOPT_HTTPGET);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_NOBODY, 0);    //对body进行输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $package = curl_exec($curl);
        $httpinfo = curl_getinfo($curl);	

        curl_close($curl);
        $media = array_merge(array('mediaBody' => $package), $httpinfo);

        //求出文件格式
        preg_match('/\w\/(\w+)/i', $media["content_type"], $extmatches);
        $fileExt = $extmatches[1];
        $filename = time() . rand(100, 999) . ".{$fileExt}";
        $dirname = "./d/voice/" . date('Ymd', time()) . "/";
        if (!file_exists($dirname)) {
            mkdir($dirname, 0777, true);
        }
        file_put_contents($dirname . $filename, $media['mediaBody']);
		
        return $dirname . $filename;
    }
 	
 }