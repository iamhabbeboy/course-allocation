/**
 * js file created by habbeboy
 */
function init() {

	var log_click = document.querySelector(".log_click");
	var reg_click = document.querySelector(".reg_click");
	var sLoginBtn = document.querySelector("#sub_log");
	var table_login = document.querySelector("#table_login");
	var table_reg = document.querySelector("#table_reg");

	reg_click.onclick = function() {
		//alert("hello world !");
		table_login.style.display = 'none';
		table_reg.style.display = 'block';

	}

	log_click.onclick = function() {
		//alert("hello world !");
		table_login.style.display = 'block';
		table_reg.style.display = 'none';
	}

	sLoginBtn.onclick = function(e) {

		var matricno = document.querySelector("#matricno");

		var pwd = document.querySelector("#pwd");

		// --------validation
		if (matricno.value == "") {
			matricno.focus();
			return false;
		} else if (pwd.value == "") {
			pwd.focus();
			return false;
		}

	}
}

function lect() {

	var log_click = document.querySelector(".click_log");
	var reg_click = document.querySelector(".click_reg1");
	var sLoginBtn = document.querySelector("#sub_login");
	var subReg = document.querySelector("#sub_register");
	var table_login = document.querySelector("#table_login");
	var table_reg = document.querySelector("#table_reg");

	reg_click.onclick = function() {
		table_reg.style.display = 'block';
		table_login.style.display = 'none';
	}

	log_click.onclick = function() {
		table_reg.style.display = 'none';
		table_login.style.display = 'block';
	}

	sLoginBtn.onclick = function() {
		var user = document.querySelector("#username");
		var pwd = document.querySelector("#pwd");

		if (user.value == '') {
			user.focus();
			return false;
		} else if (pwd.value == '') {
			pwd.focus();
			return false;
		}
	}

	subReg.onclick = function() {
		var title = document.querySelector("#lec_title");
		var fname = document.querySelector("#fname");
		var user = document.querySelector("#reg_username");
		var pwd = document.querySelector("#reg_pwd");

		if (title.value == "0") {
			title.focus();
			return false;
		} else if (fname.value == '') {
			fname.focus();
			return false;
		} else if (user.value == '') {
			user.focus();
			return false;
		} else if (pwd.value == "") {
			pwd.focus();
			return false;
		}
	}
}

function studentClass() {

	$(function() {
		$('.view').click(function(e) {
			e.preventDefault();
			var d = $(this).attr('id');

			$.post("../_eclassroom_pages/url.php?url=view_lecture", 'id=' + d, function(data) {
				$('.view_lecture' + d).slideDown('slow').html(data);
			});
		});

		$('.qtn').click(function(e) {
			e.preventDefault();
			var d = $(this).attr('id');

			$('.qtn_view' + d).css('display', 'block');

		});

		$('.sub_qtn').click(function() {
			var d = $(this).attr('id');
			var quest = $('.quest2')
			var matric = $('#matric_no').val();

			var data = 'quest=' + quest.val() + '&matric=' + matric + '&id=' + d;

			if (quest == '') {

				quest.focus()
				return false

			} else {

				$.post("../_eclassroom_pages/url.php?url=sQtn", data, function(callback) {
					$('.qtnTimes').html(callback);
					$('.quest1').val('');
					//$('.qtn_view'+d).hide();
					window.location.reload();
					//console.log(callback)
				})
			}
		});

		$('.assignment').click(function() {
			var id = $(this).attr('id');
			$('.pAssign' + id).css('display', 'block');
		})

		$('.subQ').click(function() {
			var id = $(this).attr('id');

			var quest = $('.quest1' + id).val();
			var matric = $('#matric_no').val();
			var assignID = $('#assignID').val();

			var data = 'quest=' + quest + '&matric=' + matric + '&id=' + id + '&assignID=' + assignID;

			$.post("../_eclassroom_pages/url.php?url=assignment", data, function(callback) {
				console.log(callback)
				//window.location.reload();
			});

			// alert("hello world !"+id)
		})
	});

}

$(function() {
	$('.rep_qty').click(function(e) {

		e.preventDefault()

		var id = $(this).attr('id'), txt = $('#q' + id), lectID = $('#lectID' + id), d = new Date(), dmy = d.getDate() + '-' + d.getMonth() + '-' + d.getFullYear()

		if (txt.val() == '') {

			txt.focus()
			return false

		} else {

			$.ajax({
				url : 'url.php?url=rep_qty',
				type : 'POST',
				data : 'reply=' + txt.val() + '&q_id=' + id + '&lect_id=' + lectID,
				cache : false,
				success : function(a) {

					if (a == 'saved') {

						$('#replyView' + id).fadeIn('slow', function() {
							$(this).html(' <div> ' + txt.val() + '<br/>on ' + dmy + '</div><hr/>')
						})
					} else if (a == 'exist') {

						$('#replyView' + id).fadeIn('slow', function() {
							$(this).append(' <div> Post Already Exist</div>')
						})
					}

					txt.val('')
					$('.replyBox' + id).toggle('slow', function() {

						$('#rep_' + id).html('<i class="fa fa-share" ></i>&nbsp; Click to Reply')
					})
				}
			})

			return false
		}

	})

	$('.reply_show').click(function(e) {
		e.preventDefault()
		var key = $(this).attr('key')

		$('.replyBox' + key).toggle('slow', function() {

			$('#rep_' + key).html('<i class="fa fa-share" ></i>&nbsp; Reply')
		})
	})
	
	
	
	$('.closeme').click(function(e) {
		e.preventDefault()
		var key = $(this).attr('class')
		
		$('.replyBox' + key).toggle('slow', function() {

			$('#rep_' + key).html('<i class="fa fa-share" ></i>&nbsp; Reply')
		})
	})
})
//---ajax function request ----
