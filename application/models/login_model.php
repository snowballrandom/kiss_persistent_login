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
 * This class object is the Authentication model.
 *
 * @package		KISS Persistent Login
 * @subpackage	Model
 * @category	Authentication
 * @author		Kyle Coots
 * @link		https://github.com/snowballrandom/kiss_persistent_login
 */ 

 
class Login_model extends CI_Model{
	
	private $idUser 	= '';
	private $username 	= '';
	private $password 	= '';

	private $is_logged_in = FALSE;
	
	public function __construct(){
		parent::__construct();
	}

	public function login($username, $password, $persistent=false){
	  	
	  if($this->__validate($username, $password)){
	  	
		$this->db->select('idUser');
		$this->db->select('username');
		$this->db->select('email');
		$this->db->where('username', $username);
		$user_data = $this->db->get('Users');
		
		if($user_data->num_rows() == 1){
		
		  foreach ($user_data->result() as $value){
				
			$newdata = array(
	           'name' 	   => $value->username,
	           'email'     => $value->email,
	           'logged_in' => TRUE
	         );
	
			$this->session->set_userdata($newdata);
		    
		    if($this->strict_bool($persistent) === TRUE){
		  	  $this->make_persistent($value->idUser);
		    }
			return TRUE;
		  }
		}else{
			return FALSE;
		}	
	  }		
	}
	
    public function logout(){
  	  $this->session->sess_destroy();
    }
	
    /**
     * Check if user aready logged in
     */	
    public function is_logged_in(){
      	
      $this->check_login();
	 	
	  $is_logged_in = $this->session->userdata('logged_in');
	
      if(!isset($is_logged_in) || $is_logged_in !== true){
       $this->is_logged_in = FALSE;
	   return FALSE;
      }else{
	   $this->is_logged_in = TRUE;
	   return TRUE;
      }
	 
    }
  
    /**
     * Validate Username/Email and password. This pulls the password from the 
     * database and checks it against the supplied password. 
     * If no matching username/email is found it will return false.
     * 
     * @param-username mixed
     * @param-password mixed
     * @return bool 
     */	
    private function __validate($username, $password){
	
	  $account_sql = "SELECT `password` FROM `Users` WHERE `username` = ? OR `email` = ? LIMIT 1";
	  $account_data = $this->db->query($account_sql, array($username, $username));
	
	  if($account_data->num_rows() == 1){
	   foreach($account_data->result() as $row){
	    return $this->validate_user = password_verify($password, $row->password);
	    exit;
	   }
	  }else{
	    return FALSE;
	    exit;
	  }
	
    }// End Function
    
	private function make_persistent($idUser){
			
    $data = openssl_random_pseudo_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

    $hash = vsprintf('%s%s%s%s%s%s%s%s', str_split(bin2hex($data), 4));
		
		$data = array(
			'idUser' => $idUser,
			'hash' => $hash
		);
		
		$this->db->insert('pr_session', $data);
		
		$cookie = array(
		    'name'   => 'session',
		    'value'  => $hash,
		    'expire' => '31536000',
		    'domain' => '.persistent-login.local',
		    'path'   => '/',
		    'prefix' => 'pr_',
		    'secure' => FALSE
		);

		$this->input->set_cookie($cookie); 
		
	}

	public function check_login(){
		$value = $this->input->cookie('pr_session');
 		return $this->set_session($value);
	}
	
	private function set_session($hash = FALSE){
		
	  if(!$hash){
	  	return FALSE;
	  }else{
	  	
	  $query = 'SELECT Users.username, Users.email FROM Users
		  	    LEFT JOIN pr_session
				ON Users.idUser = pr_session.idUser
				WHERE pr_session.hash = ?';
	  $user_data = $this->db->query($query, array($hash));
		
  	  if($user_data->num_rows() === 1){
  	    foreach ($user_data->result() as $value) {
		  	
		  $newdata = array(
            'name'  	 => $value->username,
            'email'     => $value->email,
            'logged_in' => TRUE
          );
		  $this->session->set_userdata($newdata);
		 
		  return TRUE; 
	 	}
				
	   }else{
		return FALSE;
	   }
	   
	  }
	  
	}
		    
    /**
	 * Checks the string and returns TRUE/FALSE
	 * @param string
	 * @return bool 
	 */
    public function strict_bool($val=false){
	   return is_integer($val)?false:$val == 1;
	}	
  
}
	