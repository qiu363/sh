<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*********************
*
* 数据库基本操作封装
* 
*********************/
class Rebates_model extends CI_Model {


	public function __construct(){
        parent::__construct();

        $this->load->database();
        $this->stat_db = $this->load->database("stat_167", TRUE);

    }

    /**
     * 执行sql
     * @param string $sql 需要执行sql
     */
    public function get_sql_query($sql){
        return $this->stat_db->query($sql)->result();
    }

    /**
     * select 查询封装
     * @param  string $table 数据库表名
     * @param  string $sel   搜索字段
     * @param  array  $where 检索条件
     * @param  string $order 排序
     * @param  int $limit    限制条数
     * @param  string $start 开始条数
     */
    public function get_query($table, $sel = "*", $where = array(), $limit = 20, $order_by = "", $start = 0){
        if(count($where) != 0){
            $this->stat_db->where($where);
        }
        if($order_by != ""){
            $this->stat_db->order_by($order_by);
        }
        
        if($limit != -1){
            $this->stat_db->limit($limit, $start);
        }
        
        $this->stat_db->select($sel);

        $this->query = $this->stat_db->get($table);

        return $this->query->result();
    }

    /**
     * update 封装
     * @param  string  $table  表名
     * @param  array  $data    更新字段数组
     * @param  array  $where   更新条件
     * @param  string $date    更新时间
     * @return [type]           [description]
     */
    public function update($table, $data, $where, $date = ""){
        if($date != ""){
            $this->stat_db->set($date, 'NOW()', FALSE);
        }

        return $this->stat_db->update($table, $data, $where);
    }

    /**
     * insert 封装
     * @param  string $table 表名
     * @param  array $data   插入数据数组
     * @param  string $date  更新时间
     * @return [type]        [description]
     */
    public function insert($table, $data, $date = ""){
        if($date != ""){
            $this->stat_db->set($date, 'NOW()', FALSE);
        }

        return $this->stat_db->insert($table, $data);
    }

    /**
     * delete 封装
     * @param  string $table 表名
     * @param  array $where  删除条件
     * @return [type]        [description]
     */
    public function delete($table, $where){
        return $this->stat_db->delete($table, $where);
    }

    /**
     * 获取条数
     * @param  string $table 表名
     * @param  string $sel   统计字段
     * @return int           查询条数
     */
    public function get_totle($table, $sel = "", $where = array()){
        if($sel != ""){
            $this->stat_db->select($sel);
        }
        
        $this->stat_db->from($table);
        $this->stat_db->where($where);

        return $this->stat_db->count_all_results();
    }

    /**
     * 获取最新插入数据id
     */
    public function insert_id(){
        return $this->stat_db->insert_id();
    }


}





