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

 
class Register_model extends CI_Model{
	
	// Password Crypted
	private $crypted_password 		= '';
	private $is_password_crypted 	= '';
	private $password_hash_options	= array('cost' => 12);

	public function __construct(){
		parent::__construct();
	}
	
	public function register($username, $password){
			
		// Create Encrypted password	
		$this->set_encrypt_password($password);
	  
	  // Check if the password is encrypted	
	  if($this->is_password_crypted){
	  	
		// Insert Data
		$insert_data = array(
			'username' => $username,
			'password' => $this->crypted_password
		);
		$this->db->insert('Users', $insert_data);
		if($this->db->affected_rows() == 1){
			return TRUE;
		}else{
			return FALSE;
		}
	  }
	  	  
	}
	/**
	 * Create a secures password using php5 password_hash
	 * @param string [password]
	 * @property-is_password_crypted bool|false
	 * @property-crypted_password string|null
	 * @return void
	 */
	protected function set_encrypt_password($password){
		
	  $password_hash = password_hash($password, PASSWORD_DEFAULT, $this->password_hash_options);
	  $is_encrypted = password_verify($password, $password_hash);
		
	  $this->is_password_crypted = $is_encrypted;
		
	  if($is_encrypted){
		$this->crypted_password = $password_hash;
	  }
	}
	
	/**
	 * Returns the encrypted password
	 * @return string
	 */
	protected function get_encrypt_password(){
	  return $this->crypted_password;
	}
	
	/**
	 * Returns if the password has been encrypted
	 * @return bool
	 */
	protected function is_password_crypted(){
		return $this->is_password_crypted;
	}		
	
}