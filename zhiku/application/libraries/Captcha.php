<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Captcha {

    //验证码的session的下标  
    private $_verify_session_key = 'verify_haoqiao';
    private static $expire = 3000;    // 验证码过期时间（s）    
    //验证码中使用的字符，01IO容易混淆，不用  
    private static $code_round = '3456789abcdefghigklmnpqrtuvwxyABCDEFGHJKLMNPQRTUVWXY';
    private static $font_size = 26;    // 验证码字体大小(px)   
    private static $image_height = 0;  // 验证码图片高
    private static $image_width = 0;   // 验证码图片宽  
    private static $length = 4;        //验证码位数   
    private static $bg = array(243, 251, 254);  //背景
        
    protected static $_image = null;   //验证码图片实例   
    protected static $_color = null;   //验证码字体颜色

    private $code = array();

    public function __construct(){
        $this->CI = & get_instance();

        isset($_SESSION) || session_start();

        $this->use_curve = FALSE;
        $this->use_noise = TRUE;
    }

    /**
     * 设置session名
     */
    public function set_session_key($key) {
        $this->_verify_session_key = $key;
    }

    /**
     * 设置验证码图片宽
     */
    public function set_img_width($width){
        self::$image_width = $width;
    }

    /**
     * 设置验证码图片高
     */
    public function set_img_height($height){
        self::$image_height = $height;
    }

    /**
     * 设置字体大小
     */
    public function set_font_size($size){
        self::$font_size = $size;
    }

    /**
     * 设置验证码长度
     */
    public function set_code_length($len){
        self::$length = $len;
    }

    /**
     * 获取验证码
     */
    public function get_code(){
        return $this->code;
    }

    /**  
     * 输出验证码图片
     */
    public function create_code_img(){
        //图片宽(px)
        self::$image_width || self::$image_width = self::$length * self::$font_size * 1.5 + self::$font_size*1.5;    
        //图片高(px)   
        self::$image_height || self::$image_height = self::$font_size * 2;   

        self::$_image = imagecreate(self::$image_width, self::$image_height);    
        // 设置背景         
        imagecolorallocate(self::$_image, self::$bg[0], self::$bg[1], self::$bg[2]);   
  
        if ($this->use_noise) {   
            // 绘杂点   
            self::_write_noise();   
        }    
        if ($this->use_curve) {   
            // 绘干扰线   
            self::_write_curve();   
        }   

        $this->code = array();
        $code_NX = 0;
        for ($i = 0; $i<self::$length; $i++) {   
            $this->code[$i] = self::$code_round[mt_rand(0, 51)];   
            $code_NX += mt_rand(self::$font_size*1.2, self::$font_size*1.6);   
            // 验证码使用随机字体，保证目录下有这些字体集
            $font = mt_rand(1, 3);
            $ttf = './ttfs/t' . $font . '.ttf';
            //验证码字体随机颜色
            self::$_color = imagecolorallocate(self::$_image, mt_rand(1,120), mt_rand(1,120), mt_rand(1,120));

            imagettftext(self::$_image, self::$font_size, mt_rand(-30, 30), $code_NX, self::$font_size*1.5, self::$_color, $ttf, $this->code[$i]);   
        }

        $this->_set_session();

        return self::$_image;
       
    }

    /**
     * 生成session
     */
    private function _set_session(){
        //二维码转字符串
        $code = implode("", $this->code);
        $code = strtolower($code);

        $_SESSION[$this->_verify_session_key] = $code;

        setcookie(session_name(), session_id(), time() + 600, '/', ".haoqiao.cn");
    }

    /**
     * 验证session
     */
    public function verify_session($code){
        $code = strtolower($code);

        if(trim($code) == ""){
            return FALSE;
        }

        if(!isset($_SESSION[$this->_verify_session_key]) || $_SESSION[$this->_verify_session_key] == ""){
            return FALSE;
        }

        if($_SESSION[$this->_verify_session_key] === $code){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /**
     * 清除验证码session
     */
    public function clear_session(){
        unset($_SESSION[$this->_verify_session_key]);
    }
       
    /**   
     * 画一条由两条连在一起构成的随机正弦函数曲线作干扰线(你可以改成更帅的曲线函数)   
     *      正弦型函数解析式：y=Asin(ωx+φ)+b  
     *      各常数值对函数图像的影响：  
     *        A：决定峰值（即纵向拉伸压缩的倍数）  
     *        b：表示波形在Y轴的位置关系或纵向移动距离（上加下减）  
     *        φ：决定波形与X轴位置关系或横向移动距离（左加右减）  
     *        ω：决定周期（最小正周期T=2π/∣ω∣）  
     */  
    protected static function _write_curve() {   
        $A = mt_rand(1, self::$image_height/2);                  // 振幅   
        $b = mt_rand(-self::$image_height/4, self::$image_height/4);   // Y轴方向偏移量   
        $f = mt_rand(-self::$image_height/4, self::$image_height/4);   // X轴方向偏移量   
        $T = mt_rand(self::$image_height*1.5, self::$image_width*2);  // 周期   
        $w = (2* M_PI)/$T;   
                           
        $px1 = 0;  // 曲线横坐标起始位置   
        $px2 = mt_rand(self::$image_width/2, self::$image_width * 0.667);  // 曲线横坐标结束位置              
        for ($px=$px1; $px<=$px2; $px=$px+ 0.9) {   
            if ($w!=0) {   
                $py = $A * sin($w*$px + $f)+ $b + self::$image_height/2;  // y = Asin(ωx+φ) + b   
                $i = (int) ((self::$font_size - 6)/4);   
                while ($i > 0) {    
                    imagesetpixel(self::$_image, $px + $i, $py + $i, self::$_color);  
					//这里画像素点比imagettftext和imagestring性能要好很多                     
                    $i--;   
                }   
            }   
        }   
           
        $A = mt_rand(1, self::$image_height/2);                  // 振幅           
        $f = mt_rand(-self::$image_height/4, self::$image_height/4);   // X轴方向偏移量   
        $T = mt_rand(self::$image_height*1.5, self::$image_width*2);  // 周期   
        $w = (2* M_PI)/$T;         
        $b = $py - $A * sin($w*$px + $f) - self::$image_height/2;   
        $px1 = $px2;   
        $px2 = self::$image_width;   
        for ($px=$px1; $px<=$px2; $px=$px+ 0.9) {   
            if ($w!=0) {   
                $py = $A * sin($w*$px + $f)+ $b + self::$image_height/2;  // y = Asin(ωx+φ) + b   
                $i = (int) ((self::$font_size - 8)/4);   
                while ($i > 0) {            
                    imagesetpixel(self::$_image, $px + $i, $py + $i, self::$_color); 
					//这里(while)循环画像素点比imagettftext和imagestring用字体大小一次画出
					//的（不用while循环）性能要好很多       
                    $i--;   
                }   
            }   
        }   
    }
       
    /**  
     * 画杂点  
     * 往图片上写不同颜色的字母或数字  
     */  
    protected static function _write_noise() {   
        for($i = 0; $i < 10; $i++){   
            //杂点颜色   
            $noise_color = imagecolorallocate(   
                              self::$_image,    
                              mt_rand(150,225),    
                              mt_rand(150,225),    
                              mt_rand(150,225)   
                          );   
            for($j = 0; $j < 5; $j++) {   
                // 绘杂点   
                imagestring(   
                    self::$_image,   
                    5,    
                    mt_rand(-10, self::$image_width),    
                    mt_rand(-10, self::$image_height),    
                    self::$code_round[mt_rand(0, 51)], // 杂点文本为随机的字母或数字   
                    $noise_color  
                );   
            }   
        }   
    }   
}   
  
//$captcha = new Captcha();
//$captcha->create_code_img();

?>
