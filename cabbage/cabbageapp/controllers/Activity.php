<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

	public function __construct() {
		parent::__construct();

		$this->base_url = $this->config->item('base_url');
		$this->api_url = $this->config->item('api_url');

		$this->data = array(
			'base_url' => $this->base_url,
			'api_url' => $this->api_url,
			'page' => 'activity'
		);
	}

	/**
	 * 首页
	 */
	public function index() {
		$data['header'] = $this->load->view('common/header', $this->data, TRUE);
		$data['footer'] = $this->load->view('common/footer', $this->data, TRUE);

		$this->load->view('index', $data);
	}
}
