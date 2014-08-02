<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * KISS Persistent Login
 *
    Copyright (C) <2012-2013>  <KISS Persistent Login>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
 * 
 *
 *
 * @package		KISS Persistent Login
 * @author		Kyle Coots
 * @copyright	Copyright (c) 2014, KISS Persistent Login
 * @license		https://github.com/snowballrandom/kiss_persistent_login
 * @link		https://github.com/snowballrandom/kiss_persistent_login
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * KISS Persistent Login
 *
 * This class object is the Welcome Controller.
 *
 * @package		KISS Persistent Login
 * @subpackage	Controller
 * @category	Controller
 * @author		Kyle Coots
 * @link		https://github.com/snowballrandom/kiss_persistent_login
 */ 

 
class Welcome extends CI_Controller {

	private $username = '';
	private $password = '';
	private $persistent = FALSE;
	
	public function __construct(){
		parent::__construct();		
		$this->load->model('login_model');
		$this->load->model('register_model');
		
		if($this->login_model->is_logged_in()){
			redirect(base_url().'index.php/login/index');
		}
	}
	
	public function index()
	{
		$this->load->view('welcome_message');
	}
	
	public function login(){
		
	  $this->username = $this->input->post('username');
	  $this->password = $this->input->post('password');
	  $this->persistent = $this->input->post('persistent');

	  $this->form_validation->set_rules('username','Username','required');

	  $this->form_validation->set_rules(
	    'password', 'Password', 'trim|required|min_length[6]|max_lenght[16]'
	  );
	  
	  if($this->form_validation->run() == FALSE){
		//redirect
		$this->session->set_flashdata('username', $this->username);
		$this->session->set_flashdata('username_error', form_error('username'));
		$this->session->set_flashdata('password_error', form_error('password'));
		redirect(base_url());
		
	  }else{
		
		$return_data = $this->login_model->login($this->username, $this->password, $this->persistent);
		$this->__validate_redirect($return_data);

	  }		

	}
	/**
	 * Login Validate Redirect
	 */
	private function __validate_redirect($return_data){
		if($return_data){	
		  redirect(base_url().'index.php/login/index');
		}else{
		  redirect(base_url());	
		}
	}

	public function register(){
		
	  $this->username = $this->input->post('reg_username');
	  $this->password = $this->input->post('reg_password');

	  $this->form_validation->set_rules('reg_username','Username','required');

	  $this->form_validation->set_rules(
	    'reg_password', 'Password', 'trim|required|min_length[6]|max_lenght[16]'
	  );
	  
	  if($this->form_validation->run() == FALSE){
		//redirect
		$this->session->set_flashdata('reg_username', $this->username);
		$this->session->set_flashdata('reg_username_error', form_error('reg_username'));
		$this->session->set_flashdata('reg_password_error', form_error('reg_password'));
		redirect(base_url());
		
	  }else{
		
		$return_data = $this->register_model->register($this->username, $this->password);
		$this->__validate_reg_redirect($return_data);

	  }			
	}
	/**
	 * Register Validate Redirect
	 */
	private function __validate_reg_redirect($return_data){
		if($return_data){	
		  redirect(base_url().'index.php/register/register_succ');
		}else{
		  redirect(base_url().'index.php/register/index');
		}		
	}	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */