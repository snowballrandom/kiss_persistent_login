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
 * This class object is the Register Controller.
 *
 * @package		KISS Persistent Login
 * @subpackage	Controller
 * @category	Controller
 * @author		Kyle Coots
 * @link		https://github.com/snowballrandom/kiss_persistent_login
 */ 

 
class Register extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('register_model');
	}
	
	public function index()
	{
		$this->login_model->check_login();
		$this->load->view('register_fail');
	}
	
	public function register_succ(){
		$this->login_model->check_login();
		$this->load->view('register_succ');		
	}
	
}