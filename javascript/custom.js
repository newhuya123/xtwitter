function checkit() {
	msg = document.getElementById('message').value;
	if(msg == '')
		return false;
	else
		return true;
}

function del(id) {
	f_twitter.tid.value = id;
	f_twitter.submit();
}

function showReply(tid) {
	tid = 'f_twitter_reply_' + tid;
	obj = document.getElementById(tid);
	obj.style.visibility = 'visible';
}

function hideReply(tid) {
	tid = 'f_twitter_reply_' + tid;
	obj = document.getElementById(tid);
	obj.style.visibility = 'hidden';
}

$(function(){
	var inputMessage = $("#message");  
	var loading = $("#loading");  
	var messageList = $("#main_left > ul");

	$('#btn1').click(function(){
		$.ajax({
		   url: "ajax_info.txt",
		   success: function(msg){
		     $('#myDiv')[0].innerHTML = msg;
		   }
   		});
	});
	$('#btn2').click(function(){
		$('#myDiv').fadeToggle('slow', function() {
    			// Animation complete.
  		});
	});

	$("#f_twitter").submit(function(){  
    		if(checkit()){  
        		var message = inputMessage.attr("value");

        		//we deactivate submit button while sending  
        		$("#btn3").attr({ disabled:true, value:"Sending..." });  
        		$("#btn3").blur();  
        		//send the post to shoutbox.php  
        		$.ajax({  
            			type: "POST", url: "update.php", data: "message=" + message,  
            			complete: function(data){  
                			messageList.html(data.responseText);  
                			//reactivate the send button  
                			$("#btn3").attr({ disabled:false, value:"Shout it!"});  
            			}  
         		});  
    		}  
    		else alert("Please fill all fields!");  
    		//we prevent the refresh of the page after submitting the form  
    		return false;  
	});  
});


