<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->load->library('captcha');
		//根地址
		$this->front_data['base_url'] = $this->base_url = $this->config->item('base_url');
		
	}

	/**
	 * 登录首页
	 * @return [type] [description]
	 */
	public function index()
	{
		$this->front_data['error_msg'] = $this->input->get('error_msg', TRUE);

		$this->load->view('login', $this->front_data);
	}

	/**
	 * 登录
	 */
	public function sign(){

		$account = $this->input->get("account");
		$paw = $this->input->get("password");
		$yzm = $this->input->get("yzm");

		if(empty($account)){
			header("Location: ". $this->base_url ."login/?error_msg=用户名不能为空");
			exit;
		}
		if(empty($paw)){
			header("Location: ". $this->base_url ."login/?error_msg=密码不能为空");
			exit;
		}
		if(empty($yzm)){
			header("Location: ". $this->base_url ."login/?error_msg=验证码不能为空");
			exit;
		}

		//验证验证码
		if(!$this->captcha->verify_session($yzm)) {
			eader("Location: ". $this->base_url ."login/?error_msg=验证码错误");
			exit;
		}
	}
}
