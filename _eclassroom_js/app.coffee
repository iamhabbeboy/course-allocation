###
 @virtual classroom
 created by @azeez abiodun
 ###
 
$ -> 

  $('.log_click').click ->
  	$('#table_reg').fadeOut 'slow', ->
  	  $('#table_login').fadeIn 'slow'
  	
  $('.reg_click').click ->
  	$('#table_login').fadeOut 'slow', ->
  	  $('#table_reg').fadeIn 'slow'
  
  $('#sub_log').click ->
  	mat = $('#matricno')
  	pwd = $('#pwd')
  	
	  if mat.val() == ''
	  	  mat.focus()
	  	  return false  	  
	  else if pwd.val() == ''
		  pwd.focus()
		  return false
	  else 
	      return true
	  
  $('#sub_reg').click ->
    title = $("#lec_title")
    fname = $("#fname")
    user = $("#reg_username")
    pwd = $("#reg_pwd")
    
    if title.val() == '0'
	  	  title.focus()
	  	  return false  	  
	 else if fname.val() == ''
		  fname.focus()
		  return false
	else 
	      return true
