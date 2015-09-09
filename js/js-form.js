// JavaScript Document

$(document).ready(function() {
// Форма обратной связи................................./

var regVr22 = "<div style='padding: 25px; background-color: #e3e3e3; border: 5px solid #dcab01; border-radius:5px;'><img style='margin-bottom:-4px;' src='../img/load.gif' alt='Отправка...' width='18' height='18'><span style='font: 16px Arial; color:#333; margin-left:15px;'>Сообщение обрабатывается...</span></div><br />";

$("#send").click(function(){
		$("#loadBar").html(regVr22).show();
		var name = $("#name").val();
		var email = $("#email").val();
		var subject = $("#subject").val();
		var message = $("#message").val();
		$.ajax({
			type: "POST",
			url: "../doc/send.php",
			data: {"name": name, "email": email, "subject": subject, "message": message},
			cache: false,
			success: function(response){
		var messageResp = "<p style='font: 16px Arial; color:#333; border:5px solid #080; text-align:center; padding:25px 0; margin-bottom:20px; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; background-color:#e3e3e3;'>Спасибо, <strong>";
		var resultStat = "!</strong><br /> Ваше сообщение отправлено!</p>";
		var oll = (messageResp + name + resultStat);
				if(response == 1){
				$("#loadBar").html(oll).fadeIn(3000);
				$("#name").val("");
				$("#email").val("");
				$("#subject").val("");
				$("#message").val("");
                    
                setTimeout( function() {
                $("#loadBar").hide();}, 7000 );

                    
				} else {
		$("#loadBar").html(response).fadeIn(3000); }
        setTimeout( function() {
        $("#loadBar").hide();}, 7000 );}
										
		});
		return false;
});


});