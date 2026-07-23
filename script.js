//document.getElementById("starter").focus();

function showTime()
{
	var curtain = document.getElementById("curtain");
	curtain.className = "open";
	
	var scene = document.getElementById("scene");
	scene.className = "expand";
	
	var starter = document.getElementById("starter");
	starter.className = "fade-out";
	var x = document.getElementById("bg_audio");
	x.play();
	setTimeout(function() {
        starter.style.display = 'none';
        
    }, 2000);
}