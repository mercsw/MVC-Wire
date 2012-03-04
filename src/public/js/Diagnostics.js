$(function() {	    	   
	$("#devDiag").draggable({ axis: "x", containment: "#devDiagContainer" });
	$('#devDiag').dblclick(function() {
	  $('#devDiag').animate({
	    left: '0px',
	  }, 500);
	});		
});


