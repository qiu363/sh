<?php if ( ! defined('DEFPAY')) exit('No direct script access allowed');

require_once 'db.class.php';
require_once 'curl.class.php';
require_once 'common.func.php';

/**
 * 核心类
 */
class CORE{
	static  $instance;

	public $_wx_uid = 'wx30a541b2e271c814';
	public $_wx_secret = 'f340d6a67b60898913c9ef570f75f155';
	public $_wechat_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx30a541b2e271c814&redirect_uri=%s&response_type=code&scope=snsapi_userinfo&state=ptgg0123&connect_redirect=1#wechat_redirect';

	public $_get_token_code_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
	public $_get_userinfo_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';
	public $_refresh_token = 'https://api.weixin.qq.com/sns/oauth2/refresh_token?appid=%s&grant_type=refresh_token&refresh_token=%s';

	//禁止构造函数
	private function __construct(){}
	//禁止克隆
	private function __clone(){}

	//实例化单例
	static function get_instance(){
		if(empty(self::$instance)){
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * 微信登陆验证
	 */
	public function check_wechat_login ($url = '') {
		if (empty($url)) {
			exit('参数非法');
		}
		$wechat_url = sprintf($this->_wechat_url, $url);

		$code = input_get('code');
		$state = input_get('state');

		$rsh_token = get_cookie('REFRESH_TOKEN');
		if (!empty($rsh_token)) {
			$token = $this->refresh_token($rsh_token);

			if ($token) {
				$userinfo = $this->get_userinfo_by_token($token['access_token'], $token['openid']);

				$this->save_userinfo($userinfo );

				return $userinfo;
			}
		}

		if (!$code) {
			header('Location:'. $wechat_url);
			exit;
		}

		$code_token = $this->get_token_by_code($code);

		if ($code_token) {
			$userinfo = $this->get_userinfo_by_token($code_token['access_token'], $code_token['openid']);

			$this->save_userinfo($userinfo );

			return $userinfo;
		}

	}

	/**
	 * 存储用户申请信息
	 */
	public function save_application_userinfo ($name, $mobile, $userinfo) {
		//判断用户是否申请过
		$sql = 'SELECT au.id FROM active_user as au, wx_user as wu WHERE au.wx_id = wu.id AND wu.openid = "'. $userinfo['openid'] .'"';

		$res = $this->db->query($sql);

		$sql = 'SELECT id FROM wx_user WHERE openid = "'. $userinfo['openid'] . '"';
		$wx_id = $this->db->query($sql);

		$wx_id = $wx_id[0]['id'];

		if (count($res) == 0) {
			$sql = 'INSERT INTO active_user (wx_id, name, mobile, state, create_time, score, user_list) VALUES ("'. $wx_id .'", "'. $name .'", "'. $mobile .'", "0", NOW(), "0", "")';

			$this->db->query($sql);

			return array('code' => 1, 'msg' => '', 'id' => $wx_id);
		} else {
			return array('code' => 0, 'msg' => '您已经申请过，即将跳转到您的助力页面', 'id' => $wx_id);
		}
	}

	/**
	 * 助力页面信息获取
	 */
	public function get_active_info ($wx_id, $userinfo) {
		$sql = 'SELECT * FROM active_user WHERE wx_id = "'. $wx_id .'"';

		$res = $this->db->query($sql);

		$user_list = @json_decode($res[0]['user_list'], true);

		$sql = 'SELECT nickname FROM wx_user WHERE id = "'. $wx_id .'"';
		$zl_user = $this->db->query($sql);
		$nickname = $zl_user[0]['nickname'];

		if (!empty($user_list)) {
			$user_list_str = '';
			foreach ($user_list as $key => $value) {
				$user_list_str .= $key .",";
			}
			$user_list_str = preg_replace("/,$/", '', $user_list_str);

			$sql = 'SELECT id, nickname FROM wx_user WHERE id IN ('. $user_list_str  .')';

			$user_zl = $this->db->query($sql);
		} else {
			$user_zl = array();
		}

		$sql = 'SELECT id, nickname FROM wx_user WHERE openid = "'. $userinfo['openid'] . '"';

		$cur_user = $this->db->query($sql);
		$cur_user_id = $cur_user[0]['id'];
		$is_zl = isset($user_list[$cur_user_id]) ? TRUE : FALSE;

		if ($wx_id == $cur_user_id) {
			$is_lz = true;
		} else {
			$is_lz = false;
		}

		return array('user' => $res[0], 'user_list' => $user_list, 'user_zl' => $user_zl, 'cur_user_id' => $cur_user_id, 'is_zl' => $is_zl, 'is_lz' => $is_lz, 'nickname' => $nickname);
	}

	/**
	 * 助力功能
	 */
	public function save_zl($wx_id, $userinfo) {
		$sql = 'SELECT * FROM active_user WHERE wx_id = "'. $wx_id .'"';
		$res = $this->db->query($sql);
		$user_list = @json_decode($res[0]['user_list'], true);

		if (empty($user_list)) {
			$user_list = array();	
		}

		$sql = 'SELECT id, nickname FROM wx_user WHERE openid = "'. $userinfo['openid'] . '"';
		$cur_user = $this->db->query($sql);
		$cur_user_id = $cur_user[0]['id'];
		$nickname = $cur_user[0]['nickname'];

		if (isset($user_list[$cur_user_id])) {
			return array('code' => 0, 'msg' => '不能重复助力');
		} else if (!empty($cur_user_id)) {
			$score = rand(10, 13);

			$total_socre = $res[0]['score'] + $score;
			if ($total_socre > 100) {
				$total_socre = 100;
				$score = $total_socre - $res[0]['score'];
			}

			$user_list[$cur_user_id] = $score;

			$user_list_str = json_encode($user_list);

			$sql = 'UPDATE active_user SET user_list = \''. $user_list_str .'\', score = "'. $total_socre .'" WHERE wx_id = '. $wx_id;
			$this->db->query($sql);

			return array('code' => 1, 'msg' => '', 'score' => $score, 'nickname' => $nickname);
		} else {
			return array('code' => 0, 'msg' => '非法用户');
		}

	}

	/**
	 * 保存用户数据
	 */
	private function save_userinfo ($userinfo) {
		//判断用户是否存在
		$sql = 'SELECT id FROM wx_user WHERE openid = "'. $userinfo['openid'] . '"';

		$res = $this->db->query($sql);

		if (count($res) == 0) {
			$sql = 'INSERT INTO wx_user (openid, nickname, sex, language, city, province, country, headimgurl, create_time) VALUES ("'. $userinfo['openid'] .'", "'. $userinfo['nickname'] .'", "'. $userinfo['sex'] .'", "'. $userinfo['language'] .'", "'. $userinfo['city'] .'", "'. $userinfo['province'] .'", "'. $userinfo['country'] .'", "'. $userinfo['headimgurl'] .'",  NOW())';

			$this->db->query($sql);
		}
	}

	/**
	 * 通过code获取accesstoken
	 */
	private function get_token_by_code ($code) {
		$token_url = sprintf($this->_get_token_code_url, $this->_wx_uid, $this->_wx_secret, $code);

		$data = $this->curl->get($token_url);
		$data = @json_decode($data, TRUE);

		if (!empty($data) && !isset($data['errcode'])) {
			//设置刷新token
			set_cookie('REFRESH_TOKEN', $data['refresh_token'], 7);

			return $data;
		} else {
			return FALSE;
		}

	}

	/**
	 * 通过token拉取用户信息
	 */
	private function get_userinfo_by_token ($token, $openid) {
		$userinfo_url = sprintf($this->_get_userinfo_url, $token, $openid);

		$data = $this->curl->get($userinfo_url);
		$data = @json_decode($data, TRUE);

		if (!empty($data) && !isset($data['errcode'])) {
			return $data;
		} else {
			return FALSE;
		}
	}

	/**
	 * 刷新token
	 */
	private function refresh_token ($rsh_token) {
		$refresh_url = sprintf($this->_refresh_token, $this->_wx_uid, $rsh_token);

		$data = $this->curl->get($refresh_url);
		$data = @json_decode($data, TRUE);

		if (!empty($data) && !isset($data['errcode'])) {
			//设置刷新token
			set_cookie('REFRESH_TOKEN', $data['refresh_token'], 7);

			return $data;
		} else {
			return FALSE;
		}
	}

	//自动初始化
    function __get($name){
        switch ($name) {
            case 'curl':
                return $this->curl = new Curl;
                break;
            case 'db':
                return $this->db = new DB; 
                break;
            default:
                return false;
                break;
        }
    }
}

?>