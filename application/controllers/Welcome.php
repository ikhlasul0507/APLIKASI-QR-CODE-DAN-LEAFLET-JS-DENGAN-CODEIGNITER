<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct()
	{
		parent::__construct();
		$this->load->library('Ciqrcode');
	}
	public function index()
	{

		$data['rumah'] = $this->db->query('SELECT * FROM tbl_rumah')->result_array();
		$this->load->view('welcome_message',$data);
	}
	public function tambah()
	{
		$data = [
			'nama' => $this->input->post('nama'),
			'latitude' => $this->input->post('latitude'),
			'longtitude' => $this->input->post('longtitude'),
			'link' => $this->input->post('link'),
		];

		$this->db->insert('tbl_rumah',$data);
		redirect('/');
	}
	public function QR($id)
	{
		$data['rumah']= $this->db->get_where('tbl_rumah', ['id' => $id])->row_array();

		$nama = $data['rumah']['nama'];
		$isi = $data['rumah']['link'];
		
		//prameter
		$params['data'] = $isi;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'tes.png';
		$this->ciqrcode->generate($params);


		echo '<center><h4>'.$nama.'</h4>Scan Alamat : '.$isi.'<br><img src="'.base_url().'tes.png" />';
	}
}
