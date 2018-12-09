(function() {
  /*
   @virtual classroom
   created by @azeez abiodun
   */  $(function() {
    $('.log_click').click(function() {
      return $('#table_reg').fadeOut('slow', function() {
        return $('#table_login').fadeIn('slow');
      });
    });
    $('.reg_click').click(function() {
      return $('#table_login').fadeOut('slow', function() {
        return $('#table_reg').fadeIn('slow');
      });
    });
    $('#sub_log').click(function() {
      var mat, pwd;
      mat = $('#matricno');
      pwd = $('#pwd');
      if (mat.val() === '') {
        mat.focus();
        return false;
      } else if (pwd.val() === '') {
        pwd.focus();
        return false;
      } else {
        return true;
      }
    });
    return $('#sub_reg').click(function() {
      var fname, pwd, title, user;
      title = $("#lec_title");
      fname = $("#fname");
      user = $("#reg_username");
      pwd = $("#reg_pwd");
      if (title.val() === '0') {
        title.focus();
        return false;
      }
    });
  });
}).call(this);
