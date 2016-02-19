<?php if ( ! defined('DEFPAY')) exit('No direct script access allowed');

/**
 * CURL 类库
 */
class CURL{

	var $userragent = "Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.146 Safari/537.36"; //模拟用户浏览器

	var $header = 0; //是否输出头信息

	var $returntransfer = 1; //是否保存结果 1 结果保存 0 结果输出到屏幕

	var $is_cookie = FALSE; //是否启用cookie
	
	var $is_cookie_file = FALSE; //是否启用cookie文件
	
	var $use_cookie_file = FALSE; //是否启用cookie文件
	
	var $httpheader = array(); //设置Host

	var $cookie = ""; //COOKIE

	var $timeout = 8;//设置超时时间

	var $ssl = 0;//是否为https

	var $ca = "";//ssl证书

	var $statue_code = "";

	/**
	 * CURL 初始化类
	 * @param option arr 初始化数据
	 */
	public function __construct($option = array()){
		$this->curl = curl_init();
		//初始化参数
		$this->initialize($option);		
	}

	/**
	 * 初始化参数
	 * @param  array  $params
	 * @return void
	 */
	function initialize($params = array())
	{
		if (count($params) > 0)
		{
			foreach ($params as $key => $val)
			{
				if (isset($this->$key))
				{
					$this->$key = $val;
				}
			}
		}
	}

	/**
	 * 获取cookie
	 */
	public function get_cookie(){

	}

	/**
	 * 设置是否启用cookie
	 * @param bloon $is_cookie 是否启用cookie
	 */
	public function set_iscookie($is_cookie){
		$this->is_cookie = $is_cookie;
	}

	/**
	 * 设置cookie
	 */
	public function set_cookie($cookie){
		$this->is_cookie = TRUE;
		$this->cookie = $cookie;
	}

	/**
	 * 设置timeout
	 */
	public function set_timeout($timeout){
		$this->timeout = $timeout;
	}

	/**
	 * 设置HOST
	 */
	public function set_httpheader($httpheader){
		$this->httpheader = $httpheader;
	}

	/**
	 * 设置referer
	 */
	public function set_referer($referer){
		curl_setopt ($this->curl, CURLOPT_REFERER, $referer);
	}

	/**
	 * 是否输出头信息
	 */
	public function set_header($header){
		$this->header = $header;
	}

	/**
	 * 抓取https
	 */
	public function ssl(){
		$this->ssl = 1;
		//$this->ca = file_get_contents("http://localhost:8080/cacert.pem");
		if ($this->ssl && $this->ca) {  
	        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, true);   // 只信任CA颁布的证书  
	        curl_setopt($this->curl, CURLOPT_CAINFO, $this->ca); // CA根证书（用来验证的网站证书是否是CA颁布）  
	        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名，并且是否与提供的主机名匹配  
	    }else if($this->ssl && $this->ca == "") {
	        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查，0表示阻止对证书的合法性的检查
	        curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, 2); // 检查证书中是否设置域名  
	    } 
	}

	/**
	 * curl get
	 * @param $url str 抓取页面url
	 * @return $data str 返回抓取的结果
	 */
	public function get($url, $follow = 0){
		curl_setopt($this->curl, CURLOPT_URL, $url);

		//设置头
		curl_setopt($this->curl, CURLOPT_HEADER, $this->header);
		//要求结果保存到字符串中还是输出到屏幕上
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, $this->returntransfer);
		//设置超时时间
		curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->timeout);
		//模拟用户浏览器USERAGENT
		curl_setopt($this->curl, CURLOPT_USERAGENT, $this->userragent);
		//设置Host
	    curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->httpheader);
	    //开启gzip压缩
		curl_setopt($this->curl, CURLOPT_ENCODING, 'gzip, deflate');
		if($follow){
			curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION,1);
		}
	    //通过cookie抓取
	    if($this->is_cookie){
	    	curl_setopt($this->curl, CURLOPT_COOKIE, $this->cookie);
	    }
	    if($this->is_cookie_file){
	    	curl_setopt($this->curl, CURLOPT_COOKIEJAR, $this->cookie_file);
	    }
	    if($this->use_cookie_file){
		   curl_setopt($this->curl, CURLOPT_COOKIEFILE, $this->cookie_file);
	    }
	     
		return $this->get_curl_data();
	}

	/**
	 * curl post
	 * @param $url str post提交地址
	 * @param $param str post参数
	 * @return str 返回抓取数据
	 */
	public function post($url, $param = "", $ssl = 0){
		curl_setopt($this->curl, CURLOPT_URL, $url);

		//设置头
		curl_setopt($this->curl, CURLOPT_HEADER, $this->header);
		//要求结果保存到字符串中还是输出到屏幕上
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, $this->returntransfer);
		//模拟用户浏览器USERAGENT
		curl_setopt($this->curl, CURLOPT_USERAGENT, $this->userragent);
		//设置超时时间
		curl_setopt($this->curl, CURLOPT_TIMEOUT, $this->timeout);
		//设置Host
	    curl_setopt($this->curl, CURLOPT_HTTPHEADER, $this->httpheader);
	    //开启gzip压缩
		curl_setopt($this->curl, CURLOPT_ENCODING, 'gzip,deflate');
		if($ssl){
			curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($this->curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		}
		//通过cookie抓取
		if($this->is_cookie){
	    	curl_setopt($this->curl, CURLOPT_COOKIE, $this->cookie);
	    }
		if($this->is_cookie_file){
	    	curl_setopt($this->curl, CURLOPT_COOKIEJAR, $this->cookie_file);
	    }
	    if($this->use_cookie_file){
		   curl_setopt($this->curl, CURLOPT_COOKIEFILE, $this->cookie_file);
	    }
	    		
		//设置为post
		curl_setopt($this->curl, CURLOPT_POST, 1);
		//提交post数据
		curl_setopt($this->curl, CURLOPT_POSTFIELDS, $param);

		return $this->get_curl_data();
	}
	
	/**
	 * 设置代理IP抓取
	 * @param string $proxy_url 代理地址
	 */
	public function proxy($proxy_url){
		curl_setopt($this->curl, CURLOPT_PROXY, $proxy_url);
	}

	/**
	 * 获取curl结果
	 */
	public function get_curl_data(){
		$data = curl_exec($this->curl);

		//获取http状态码
		$this->statue_code = curl_getinfo($this->curl);

		if(curl_error($this->curl)){
			return false;
		}
		return $data;
	}

	/**
	 * 获取状态码
	 */
	public function get_http_code(){
		return $this->statue_code;
	}

	/*
	 * close curl
	 */
	public function __destruct(){
		curl_close($this->curl);
	}

}

