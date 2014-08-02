<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
			$this->check_login();
		$this->load->view('welcome_message');
	}
	
	public function login(){
		
		$post_data = new stdClass;
		$post_data->uname = $this->input->post('uname');
		$post_data->pass = $this->input->post('pass');
		$post_data->mem = $this->input->post('mem');

			$this->validate($post_data);

			$this->load->view('welcome_message', $post_data);
		

	}
	
	private function validate($data){
			
		$this->db->select('idUser');
		$this->db->select('uname');
		$this->db->select('email');
		$this->db->select('pass');
		$this->db->where('uname', $data->uname);
		$qdata = $this->db->get('user');
		foreach ($qdata->result() as $value){

				
		  if($value->pass === $data->pass){
	
			$newdata = array(
	           'name' 	   => $value->uname,
	           'email'     => $value->email,
	           'logged_in' => TRUE
	         );		
	
			$this->session->set_userdata($newdata);
		    
		    if($this->strict_bool($data->mem) === TRUE){
		  	  $this->save_login($value->idUser, $data->uname);
		    }
			
		  }		   
		}	
	}
	
	private function set_session($hash){

		$query = 'SELECT user.uname, user.email FROM user
				  LEFT JOIN saved_session
				  ON user.idUser = saved_session.idUser
				  WHERE saved_session.hash = ?';
		$qdata = $this->db->query($query, array($hash));
  		if($qdata->num_rows() === 1){
  	 	foreach ($qdata->result() as $value) {
		  	
		  $newdata = array(
             'name'  	 => $value->uname,
             'email'     => $value->email,
             'logged_in' => TRUE
           );

		  $this->session->set_userdata($newdata);
	 	}
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	private function save_login($id_user, $name){
			
		$hash = md5($name);
		
		$data = array(
			'idUser' => $id_user,
			'hash' => $hash
		);
		
		$this->db->insert('saved_session', $data);
		
		$cookie = array(
		    'name'   => 'saved',
		    'value'  => $hash,
		    'expire' => '31536000',
		    'domain' => '.persistent-login.local',
		    'path'   => '/',
		    'prefix' => 'myprefix_',
		    'secure' => FALSE
		);

		$this->input->set_cookie($cookie); 
		
	}
	
	public function check_login(){
		$cookie = $this->input->cookie('myprefix_saved');
 		$this->set_session($cookie);
	}
	
	public function strict_bool($val=false){
	   return is_integer($val)?false:$val == 1;
	}		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */