<?php

// +----------------------------------------------------------------------
// | ShuipFCMS
// +----------------------------------------------------------------------
// | Copyright (c) 2012-2014 http://www.shuipfcms.com, All rights reserved.
// +----------------------------------------------------------------------
// | Author: 水平凡 <admin@abc3210.com>
// +----------------------------------------------------------------------
namespace Api\Controller;

use Common\Controller\ShuipFCMS;
use Weixin\Model\WpCouponModel;

class IndexController extends ShuipFCMS
{

    private $_weather_dir;

    private $_share_path = '/usr/local/nginx/html/weixin/weatherdata/';

    //FTP 连接资源
    private $handler;

    public function __construct()
    {
//        Date_default_timezone_set("PRC");
        $this->_weather_dir = SITE_PATH . 'weatherdata';
    }

//    private $_share_path = SITE_PATH;
    /**
     * 天气预报 预报三天气象的天气 预报最新的一次 接口数据更新频率 每天多次， 不定时
     */
    // public function getWeather()
    public function index($localfile, $publish_time)
    {
//        $name = date('ymdH');
        $name = $publish_time;
        header("Content-type: text/html; charset=utf-8");
        $data = array();
        $file = $localfile;
        // 判断文件是否存在
        if (file_exists($file)) {

            // 如果存在， 判断数据库是否采集
            $model = D('province_weather');
            $count = $model->where(array('publish_time' => $publish_time))->count();

            //echo $model->getLastSql(); exit;//

            if ($count < 1) {
                $f = fopen($file, "r");

                while (!feof($f)) {
                    $line = fgets($f);

                    if ($line !== FALSE)
                        $data[] = iconv("gb2312", "UTF-8", trim($line));
                }
                fclose($f);

                // $publish_time = preg_replace('/\s/', '-', $data['1']);
                //$publish_time = $this->_convDateTotitle($data['1']);
                if ($data['0'] == '武汉中心气象台短期天气预报') {

                    $content = $data[0] . "(" . $data[1] . "):@";
                    $content .= implode('@', array_slice($data, 19, 15));

                    $model = D('province_weather');
                    // 省气象数据
                    $province_data = array("title" => $data['1'], "content" => $content, "publish_time" => $publish_time, "addtime" => time());


                    $res = $model->add($province_data);
                }
            }
        }
        // echo __FUNCTION__;
//        exit();
    }


    /**
     * 空气质量 接口数据 ， 每天更新一次
     */
    public function aqi($localfile, $publish_time)
    {
        header("Content-type: text/html; charset=utf-8");

        $data = array();
        $file = $localfile;
//        echo $localfile; exit;
//        echo $publish_time; exit;

        // 判断文件是否存在
        if (file_exists($file)) {

            // 如果存在， 判断数据库是否采集
            $model = D('aqi_weather');
            $info = $model->where(array('publish_time ' => $publish_time))->find();

//            echo $model->getLastSql();
//            exit;//

            if (empty($info)) {

                if ($fp = fopen($file, "r")) {
                    // 读取文件
                    $conn = fread($fp, filesize($file));

//                    $datas = htmlspecialchars($conn);
                    // 替换字符串
                    // $conn=str_replace("rn","<br/>",$conn);
                    if (!empty($conn)) {
                        $data = explode("\r\n\r\n", iconv('gbk', 'utf-8', $conn));
                    }
                    fclose($fp);
                    // dump($conn); exit();
                }

                if (!empty($data)) {
                    $res = array();
                    foreach ($data as $val) {
                        $str = trim($val);
                        if (!empty($str)) {
                            $res[] = str_replace(array("\r\n", ' '), "", $val);
                        }
                    }

                    // 序列化数组内容
                    $content = serialize(array(trim($res[2]), trim($res[3]), trim($res[4])));

                    $aqi_data = array("title" => trim($res[0]) . ': ' . trim($res[1]), "content" => $content, "publish_time" => $publish_time, "addtime" => time());

                    $res = D('aqi_weather')->add($aqi_data);
                }
            }
        }
    }


    /**
     * 灾害预警 接口数据 ， 分析时效性(雷电 黄色)
     */
    public function getDisaster($localfile, $publish_time)
    {
        header("Content-type: text/html; charset=utf-8");
        $name = $publish_time;

        $data = array();
        $file = $localfile;

//        dump(func_get_args()); exit;

        // 判断文件是否存在
        if (file_exists($file)) {

            // 如果存在， 判断数据库是否采集
            $model = D('warning_weather');
            $count = $model->where(array('publish_time' => $publish_time))->count();

            if ($count < 1) {

                if ($fp = fopen($file, "r")) {
                    // 读取文件
                    $conn = fread($fp, filesize($file));

                    $data[] = $conn;
                    // 替换字符串
                    $data = explode("\r\n\r\n", iconv('gbk', 'utf-8', $conn));
                    fclose($fp);
                }

                // 序列化数组内容
                $shixiao = C('WEATHER_SIGN');

                $notic_type = substr(trim($data['2']), 0, 12);
                $deadtime = $shixiao[$notic_type];

                $title_array = explode("\r\n", $data[5]);

                $disaster_data = array("disastertype" => $notic_type, "deadtime" => $deadtime, 'title' => trim($title_array[1]), "content" => trim($data['3']), "prevent" => $data['4'], "publish_time" => $publish_time, "addtime" => time());
                $res = $model->add($disaster_data);

            }
        }
    }


    /**
     * 城市预报 湖北省内
     */
    public function cityWeather()
    {
        header("Content-type: text/html; charset=utf-8");
        $data = array();

		$hours = date('H');
		if($hours < 12){
			$date = date('Ymd').'07';
		}else{
			$date = date('Ymd').'15';
		}	
        
        $file = SITE_PATH . 'weatherdata/cityweather/' . date('Y') . '/city' . $date . '.txt';

        if (file_exists($file)) {

            // 判断是否已经写入库中
            $model = D('city_weather');
            $count = $model->where('publish_time  =' . $date)->count();

            if (!$count) {

                $f = fopen($file, "r");
                while (!feof($f)) {
                    $line = fgets($f);
                    if ($line !== FALSE)
                        $data[] = iconv("gb2312", "UTF-8", trim($line));
                }
                fclose($f);

				unset($data[0]);
                $insert = array();

                $now = time();
                foreach ($data as $item) {
                    if (!empty($item)) {
                        $array = explode(']', $item);

                        $cityname = substr($array[0], 1);

                        $content = preg_replace(array('/A/', '/B/', '/C/', '/D/'), '', $array[1]);
                        $arr = preg_match_all("/(\d+日 \S* \S*)/", $content, $res);
                        $insert[] = array('cityname' => $cityname, 'addtime' => $now, 'publish_time' => $date, 'content' => implode('@', $res[0]));  
                    }
                }
                $model->addAll($insert);

            }
        }

    }


    /**
     * 转换时间为日期
     *
     * @param unknown $date
     */
    private function _convDateTotitle($date)
    {
        $publish_time = preg_replace(array('/年|月/', '/日/', '/时/'), array('-', ' ', ':00:00'), $date);
        return date(ymd, strtotime($publish_time));
    }


    /**
     * 分割字符串为数组，获取想要的数组第几个
     *
     * @param string $string
     * @param int $index
     */
    private function _explod_string($string, $index)
    {
        $arr = explode("：", $string);
        if (isset($arr[$index])) {
            return $arr[$index];
        } else {
            return null;
        }
    }

    public function weather_voice()
    {

        $ext = ".wav";
        $filename = date('Ymd');
        $localfile = SITE_PATH . 'weatherdata/voice/' . date('Y') . '/btq' . $filename . $ext;

        if (file_exists($localfile)) {

            $model = M('weather_voice');
            $count = $model->where('publish_time =' . $filename)->count();
            if (!$count) {

                $data = array(
                    'media' => '@' . realpath($localfile)
                );
                $type = "voice";
                $result = $this->uploadSource($data, $type);
				
				//var_dump($result); exit;

                $data = array(
                    'name' => date('Y年m月d日'),
                    'filepath_local' => 'weatherdata/voice/' . date('Y') . '/btq' . $filename . $ext,
                    'publish_time' => $filename,
                    'add_time' => time(),
                    'media_id' => $result['media_id']
                );
                $model->add($data);
//                echo $model->getLastSql(); exit;
            }
        }
    }


    /**
     * 上传语音素材到微信
     */
    public function uploadSource($data, $type)
    {
        //生成自定义菜单
        $appid = C('WX_APP_ID');
        $secret = C('WX_SECRET');
        $access_token = session('access_token');
//        $access_token = $this->getAccesstoken($appid, $secret);
        if (empty($access_token)) {
            $access_token = $this->getAccesstoken($appid, $secret);
            S('access_token', $access_token, 7200);
        }

        //S('access_token',$access_token);

        $url = "https://api.weixin.qq.com/cgi-bin/material/add_material?access_token=" . $access_token . "&type=" . $type;


        $json = https_request($url, $data);
        $result = json_decode($json, true);

        return $result;
    }

    public function getAccesstoken($appid, $secret)
    {
        $url_get = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=' . $appid . '&secret=' . $secret;
        $ch1 = curl_init();
        $timeout = 5;
        curl_setopt($ch1, CURLOPT_URL, $url_get);
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
        $accesstxt = curl_exec($ch1);
        curl_close($ch1);
        $access = json_decode($accesstxt, true);

        if (empty ($access ['access_token'])) {
            $this->error('获取access_token失败,请确认AppId和Secret配置是否正确,然后再重试。');
        }
        file_put_contents('./source.txt', var_export($access, true), FILE_APPEND);
        return $access ['access_token'];
    }


    public function shell()
    {
        set_time_limit(0);

        //  任务列表
        $model = D('crontab');
        $list = $model->where(array('status' => 1))->select();

        //  链接FTP
        $ftp_option = array(
            'ftphost' => cache('Config.caiji_ftphost'),
            'ftpuser' => cache('Config.caiji_ftpuser'),
            'ftppassword' => cache('Config.caiji_ftppasswd'),
            'ftpport' => cache('Config.caiji_ftpport'),
            'ftppasv' => true,
            'ftpssl' => false,
            'ftptimeout' => 90
        );


//        while (true) {

//            $db = new  \Think\Model();
//            $db->db(0, '', true);


            if (!empty($list)) {
                foreach ($list as $val) {

                    $this->handler = new \Ftp();

                    $ftpsta = $this->handler->connect($ftp_option['ftphost'], $ftp_option['ftpuser'], $ftp_option['ftppassword'], $ftp_option['ftpport'], $ftp_option['ftppasv'], $ftp_option['ftpssl'], $ftp_option['ftptimeout']);
//                dump($ftpsta); exit;
                    if (false == $ftpsta) {
                        E('FTP连接失败！');
                    }

                    $file_name = '';

                    $time = time();
                    if ($val['action'] == 'index') {
                        //$time = mktime(11, 0, 0, 10, 7, 2015);
                        $file_name = date($val['namerule'], $time);
                    }

                    if ($val['action'] == 'aqi') {
//                        $time = mktime(17, 0, 0, 10, 14, 2015);
                        $file_name = date($val['namerule'], $time-86400);
                    }

                    if ($val['action'] == 'getDisaster') {
                        //$time = mktime(0, 13, 0, 10, 7, 2015);
                        $file_name = date($val['namerule'], $time);
                    }

                    // 下载后的本地文件
                    $localfile = $this->_weather_dir . $val['path'] . $file_name . '.txt';

                    if ($val['action'] == 'geological') {
//                    $file_name = date($val['namerule'], time());
                        $file_name = '20150923';
                        // 下载后的本地文件
                        //$localfile = $this->_weather_dir . $val['path'] . date('Y') . '/' . $file_name . '解说' . iconv("UTF-8", "gb2312", '') . '.doc';
//                    $tmpname = iconv("UTF-8", "gb2312", '解说');
                        $localfile = $this->_weather_dir . $val['path'] . date('Y') . '/' . $file_name . '_jieshuo' . '.doc';
                    }
                    //echo $file_name;

//                file_put_contents('filename.txt', $file_name.'--'.$val['action'].'\r\n', FILE_APPEND);

                    if (!file_exists($localfile)) {

                        if ($val['action'] == 'geological') {
                            if (!is_dir($this->_weather_dir . $val['path'] . date('Y'))) {
                                mkdir($this->_weather_dir . $val['path'] . date('Y'));
                            }
                        } else {
                            if (!is_dir($this->_weather_dir . $val['path'])) {
                                mkdir($this->_weather_dir . $val['path']);
                            }
                        }

                        if ($val['action'] == 'geological') {
                            echo iconv("utf-8", "gb2312", '解说');
                            exit;
                            $remote_file = $val['path'] . $file_name . '' . '.doc';
//                        $remote_file = $val['path'] . $file_name . '解说.doc';
                        } else {
                            $remote_file = $val['path'] . $file_name . ".txt";
                        }

//                    echo $remote_file;                 exit;

                        // 判断远程文件是否存在
                        if ($this->handler->file_exist($remote_file)) {
                            $hand = fopen($localfile, "w");

                            // 下载文件到本地
                            $content = $this->handler->getcontent($hand, $remote_file);
                            $this->$val['action']($localfile, $file_name);
                            $model->where(array('id' => $val['id']))->save(array('last_run_time' => time()));
                        }
                    }
                }
            }

            sleep(60);

//        }
    }


    public function shell2()
    {
        //  任务列表
        $model = D('crontab');
        $list = $model->where(array('status' => 1))->select();
        //  链接FTP
        $ftp_option = array(
            'ftphost' => cache('Config.caiji_ftphost'),
            'ftpuser' => cache('Config.caiji_ftpuser'),
            'ftppassword' => cache('Config.caiji_ftppasswd'),
            'ftpport' => cache('Config.caiji_ftpport'),
            'ftppasv' => true,
            'ftpssl' => false,
            'ftptimeout' => 90
        );


        //while (true) {

        if (!empty($list)) {
            foreach ($list as $val) {

                $this->handler = new \Ftp();

                $ftpsta = $this->handler->connect($ftp_option['ftphost'], $ftp_option['ftpuser'], $ftp_option['ftppassword'], $ftp_option['ftpport'], $ftp_option['ftppasv'], $ftp_option['ftpssl'], $ftp_option['ftptimeout']);
//                dump($ftpsta); exit;
                if (false == $ftpsta) {
                    E('FTP连接失败！');
                }

                $file_name = '';

                $time = time();
                if ($val['action'] == 'index') {
                    $time = mktime(11, 17, 0, 10, 16, 2015);
                    $file_name = date($val['namerule'], $time);
                }

                if ($val['action'] == 'aqi') {
                    $time = mktime(17, 0, 0, 10, 16, 2015);
                    $file_name = date($val['namerule'], $time-86400);
                }

                if ($val['action'] == 'getDisaster') {
                    //$time = mktime(0, 13, 0, 10, 7, 2015);
                    $file_name = date($val['namerule'], $time);
                }

                // 下载后的本地文件
                $localfile = $this->_weather_dir . $val['path'] . $file_name . '.txt';

                if ($val['action'] == 'geological') {
//                    $file_name = date($val['namerule'], time());
                    $file_name = '20150923';
                    // 下载后的本地文件
                    //$localfile = $this->_weather_dir . $val['path'] . date('Y') . '/' . $file_name . '解说' . iconv("UTF-8", "gb2312", '') . '.doc';
//                    $tmpname = iconv("UTF-8", "gb2312", '解说');
                    $localfile = $this->_weather_dir . $val['path'] . date('Y') . '/' . $file_name . '_jieshuo' . '.doc';
                }

//                file_put_contents('filename.txt', $file_name.'--'.$val['action'].'\r\n', FILE_APPEND);

                //if (!file_exists($localfile)) {

                if ($val['action'] == 'geological') {
                    if (!is_dir($this->_weather_dir . $val['path'] . date('Y'))) {
                        mkdir($this->_weather_dir . $val['path'] . date('Y'));
                    }
                } else {
                    if (!is_dir($this->_weather_dir . $val['path'])) {
                        mkdir($this->_weather_dir . $val['path']);
                    }
                }

                if ($val['action'] == 'geological') {
                    echo iconv("utf-8", "gb2312", '解说');
                    exit;
                    $remote_file = $val['path'] . $file_name . '' . '.doc';
//                        $remote_file = $val['path'] . $file_name . '解说.doc';
                } else {
                    $remote_file = $val['path'] . $file_name . ".txt";
                }


                // 判断远程文件是否存在
                if ($this->handler->file_exist($remote_file)) {
                    $hand = fopen($localfile, "w");

                    // 下载文件到本地
                    $content = $this->handler->getcontent($hand, $remote_file);
                    $this->$val['action']($localfile, $file_name);
                    $model->where(array('id' => $val['id']))->save(array('last_run_time' => time()));
                }
                // }
            }
        }

        //sleep(60);

        //}
    }


    /**
     * FTP链接
     */
    public function test()
    {

        $ftp_option = array(
            'ftphost' => cache('Config.caiji_ftphost'),
            'ftpuser' => cache('Config.caiji_ftpuser'),
            'ftppassword' => cache('Config.caiji_ftppasswd'),
            'ftpport' => cache('Config.caiji_ftpport'),
            'ftppasv' => true,
            'ftpssl' => false,
            'ftptimeout' => 30
        );

        $this->handler = new \Ftp();

        $ftpsta = $this->handler->connect($ftp_option['ftphost'], $ftp_option['ftpuser'], $ftp_option['ftppassword'], $ftp_option['ftpport'], $ftp_option['ftppasv'], $ftp_option['ftpssl'], $ftp_option['ftptimeout']);

        if (false == $ftpsta) {
            E('FTP连接失败！');
        }

        $list = $this->handler->nlist('/lb');
        dump($list);
        exit;

        $path = '/jiedai/www/';
        $localfile = date('YmdH') . '.txt';

//        $source = "source.txt";
//        $target = fopen("target.txt", "w");

        $hand = fopen($localfile, "w");
        $remote_file = "test.txt";

        // $this->handler->chdir($path);
//        $list = $this->handler->nlist($path);
        $content = $this->handler->getcontent($hand, $remote_file);
        dump($content);
        exit;
    }


    /**
     * 地质灾害预警
     */
    public function  geological()
    {
        header("Content-type: text/html; charset=utf-8");
        $data = array();
        $dir = date('md');
        //$file = SITE_PATH . $dir.'/weatherdata/city.txt';
        $file = SITE_PATH . 'weatherdata/dzzh/0818/20150818' . iconv("UTF-8", "gb2312", '解说') . '.doc';
//        $file = SITE_PATH . 'weatherdata/dzzh/0818/20150818' .'解说'. '.doc';


//        echo $file;
//        exit;

//        $word = new WpCouponModel("word.application") or die("Can't start Word!");
//        $word->Documents->Opne($file);
//        $word->Documents[1]->SaveAs(dirname(__FILE__)."/test.html",8);
//        $test= $word->ActiveDocument->content->Text;

//        $content = file_get_contents(test.html);

        header("Pragma: public");
        header('Expires: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Cache-Control: private", false);
        header("Content-Type: application/msword");
        header("Content-Transfer-Encoding: binary");
        set_time_limit(0);

        $content = readfile($file);


//
//        $data = iconv("gb2312", "UTF-8", $content);

        dump($content);
        exit;
        $f = fopen($file, "r");

        while (!feof($f)) {
            $line = fgets($f);
            if ($line !== FALSE)
                $data[] = iconv("gb2312", "UTF-8", trim($line));
        }
        fclose($f);

        dump($content);
        exit;

        $insert = array();
        unset($data[0]);

        $now = time();
        foreach ($data as $item) {
            if (!empty($item)) {
                $array = explode(']', $item);
                $cityname = substr($array[0], 1);

                $content = preg_replace(array('/A/', '/B/', '/C/', '/D/'), '', $array[1]);
                $arr = preg_match_all("/(\d+日 \S* \S*)/", $content, $res);
                $insert[] = array('cityname' => $cityname, 'addtime' => $now, 'content' => implode('@', $res[0]));
            }
        }

//        dump($insert); exit;
        $model = D('city_weather');
        $model->addAll($insert);
    }


    public function cityandvoice()
    {
        set_time_limit(0);
        //while (true) {

            //$db = new  \Think\Model();
           // $db->db(0, '', true);

            // 语音播报天气
            $this->weather_voice();

            // 城市天气
            $this->cityWeather();
			
			//exit;

            //sleep(60);
       // }
    }
}
