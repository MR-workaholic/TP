<?php
function create_email_token()
{
	$username = I('post.username');
	$password = I('post.password');
	$regtime = time();
	
	return md5($username.$password.$regtime);
	
}

function create_email_token_exptime()
{
	return time()+24*60*60;
}

  