<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 验证码
 */
class Verify_code extends CI_Controller {

    private $_verify_url_ = "";

    public function __construct(){
        parent::__construct();

        $this->front_data = array();

        $this->front_data["base_url"] = $this->base_url = $this->config->item('base_url');

        $this->_verify_url_ = $this->base_url ."verify_code/verify_view";
    }

    /**
     * 验证码模块
     * @return [type] [description]
     */
    public function index(){

        header("Pragma: no-cache");
        header("content-type: image/png");

        $this->load->library("captcha");

        $image = $this->captcha->create_code_img();

        // 输出图像   
        imagePNG($image);
        imagedestroy($image);
        
    }

    /**
     * 可疑IP验证码页面
     * @return [type] [description]
     */
    public function verify_view(){
        $this->front_data["url"] = htmlspecialchars($this->input->get("url"));
        $this->front_data["msg"] = $this->input->get("msg", TRUE);

        $this->load->view("error/verify.php", $this->front_data);

    }

    /**
     * 可疑IP验证码验证
     * @return [type] [description]
     */
    public function verify_code_form(){
        //防爬后台接口
        $anti_crawl_url = $this->config->item('anti_crawl');

        $url = urldecode($this->input->get("url"));
        $code = $this->input->get("yzm");
        $code = strtolower($code);

        if($code && trim($code) != ""){
            $this->load->library("captcha");

            if(!$this->captcha->verify_session($code)){
                $this->captcha->clear_session();

                $this->_log("verify|fail");

                $uri = "/update?type=auth&status=1&ip=". $this->input->ip_address();
                //CURL
                $config = array();
                $config["timeout"] = 1;
                $this->load->library("curl", $config);
                $this->curl->get($anti_crawl_url . $uri);

                if($url){
                    $this->_verify_url_ .= "?url=". urlencode($url) ."&msg=验证码错误";
                }else{
                    $this->_verify_url_ .= "?msg=验证码错误";
                }

                header("Location: ". $this->_verify_url_);

                exit;
            }else{
                $uri = "/update?type=auth&status=0&ip=". $this->input->ip_address();
                //CURL
                $config = array();
                $config["timeout"] = 1;
                $this->load->library("curl", $config);
                $this->curl->get($anti_crawl_url . $uri);

                if($url && trim($url) != ""){
                    header("Location: ". $url);
                }else{
                    header("Location: ". $this->base_url);
                }

                $this->_log("verify|success");

                $this->captcha->clear_session();
                exit;
            }
        }else{
            $this->_log("verify|empty");

            $uri = "/update?type=auth&status=1&ip=". $this->input->ip_address();
            //CURL
            $config = array();
            $config["timeout"] = 1;
            $this->load->library("curl", $config);
            $this->curl->get($anti_crawl_url . $uri);

            if($url){
                $this->_verify_url_ .= "?url=". urlencode($url) ."&msg=验证码不能为空";
            }else{
                $this->_verify_url_ .= "?msg=验证码不能为空";
            }

            header("Location: ". $this->_verify_url_);

            exit;
        }
            
    }

    /**
     * 记录日志
     */
    private function _log($msg){
        //引入日志库
        $tj_param = array("file_name_pre" => "", "extension_name" => ".log");
        $this->load->library("tj", $tj_param);
        $this->tj->set_path("/mnt/data/logs/logs_verify/");

        //用户ID
        $uid = $this->input->cookie("_hq_");
        if(!$uid || $uid == ""){
            $uid = "-";
        }
        //user agent
        $user_agent = $this->input->user_agent();
        if(!$user_agent || trim($user_agent) == ""){
            $user_agent = "-";
        }
        //ip
        $ip = $this->input->ip_address();
        if(!$ip || trim($ip) == ""){
            $ip ="-";
        }
        //url
        $url = $this->input->get("url");
        if(!$url || trim($url) == ""){
            $url = "-";
        }

        $this->tj->write_server_log($uid ."\t". $msg  ."\t". $ip ."\t". $user_agent ."\t". urldecode($url));

    }

}

?>
