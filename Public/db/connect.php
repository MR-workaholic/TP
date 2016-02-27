<?php
	require_once('config.php');
	
	/**
	 * \brief 连库
	 */
	if(!($con = mysqli_connect(HOST, USERNAME, PASSWORD))){
		echo mysqli_error($con);
	}
	
	/**
	 * \brief 选库
	 */	
	if(!mysqli_select_db($con, 'glproject')){
		echo mysqli_error($con);
	}
	
	/**
	 * \brief 字符集
	 */
	if(!mysqli_query($con, 'set names utf8')){
		echo mysqli_error($con);
	}
	
	
?>