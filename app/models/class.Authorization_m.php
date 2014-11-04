<?php
/*
 * $Id: class.Authorization_m.php, v 1.0
 * The Simple Lottery Checker
 * Copyright (c) 2014 Andrzej Kałowski
 * http://lotek.kalowski.com
 */

class Authorization_m {
	
	private $key = 'qAe12tYi&#';

	function __construct(){
    }
	
	function logGuard($user, $pass){
        global $database;
        if($stmt = $database->prepare("SELECT username, password FROM users WHERE username = ? AND password = ?")){
			$stmt->bind_param("ss", $user, $this->encrypt($pass));
            $stmt->execute();
            $stmt->store_result(); 
            if($stmt->num_rows > 0){
                $stmt->close();
                return TRUE;
            } else {
                $stmt->close();
                return FALSE;
            }
        } else {
            die();
        }
    }
	 
	function filter($user){
	  	global $database;
		 	if($stmt = $database->prepare("SELECT username FROM users WHERE username = ?")){
				$stmt->bind_param("s", $user);
				$stmt->execute();
				$stmt->store_result();
				if($stmt->num_rows == 0){	
					$stmt->close();
	                return TRUE;
					} else {
					$stmt->close();
					return FALSE;	
					}
			} else {
			die();
			}
	 }
	   
	function register($user, $pass){
	  	global $database;
			if($stmt = $database->prepare("INSERT INTO users (username, password) VALUES (?, ?)")){
				$stmt->bind_param("ss", $user, $this->encrypt($pass));
				$stmt->execute(); 
				$stmt->close();
                return TRUE;
            	} else {
                $stmt->close();
                return FALSE;
				}
	  }
											
	function logStatus(){
        if(isset($_SESSION['login'])){
            return TRUE;
        } else {
            return FALSE;
        }
    }
	
	function logoff(){
        session_destroy();
        session_start();
    }
    
    function encrypt($pass){
		return sha1($pass.$this->key);
    }
		
}
