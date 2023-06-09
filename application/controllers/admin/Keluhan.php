<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluhan extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if(empty($this->session->userdata('roles'))){
            redirect(base_url('index.php/auth/login'));
        }else{
            if($this->session->userdata('roles') != 'Admin'){
                redirect(base_url('index.php/auth/login'));
            }
        }
        $this->load->model('Keluhan_model','keluhan');
    }

    public function index(){
		
        $data['keluhan'] = $this->keluhan->get_all();

		$var['title'] = 'Daftar Keluhan';
		$var['content'] = $this->load->view('admin/keluhan/index',$data,true);

		$this->load->view('layouts/admin',$var);
    }
    public function show($id){
		
        $data['keluhan'] = $this->keluhan->get_by_id($id);

		$var['title'] = 'Detail Keluhan';
		$var['content'] = $this->load->view('admin/keluhan/show',$data,true);

		$this->load->view('layouts/admin',$var);
    }
	public function delete($id){
        $delete = $this->keluhan->delete($id);
        if($delete){
            $this->session->set_flashdata('message','data berhasil dihapus');
            redirect(base_url('index.php/admin/keluhan'));
        }else{
			$this->session->set_flashdata('error','data gagal dihapus');
            redirect(base_url('index.php/admin/keluhan/'));
        }
    }
}