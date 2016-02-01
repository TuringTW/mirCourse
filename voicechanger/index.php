
<html>
<head>
	<title>變聲領結</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
</head>
<body>
<div class="container" style="width:300px">
	<p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
	  <span class="ui-icon ui-icon-volume-on" style="float:left; margin:-2px 5px 0 0;"></span>
	  Master volume:<span id="mvalue">1</span>
	</p>
	<div class="row" style="width:100%">
		<div class="col-md-8">
			<div id="master" style="width:100%; margin:15px;"></div>
		</div>

	</div>
	<p class="ui-state-default ui-corner-all ui-helper-clearfix" style="padding:4px;">
	  <span class="ui-icon ui-icon-volume-on" style="float:left; margin:-2px 5px 0 0;"></span>
	  Shift semitone:<span id="svalue">0</span>
	</p>
	<div class="row" style="width:100%">
		<div class="col-md-8">
			<div id="shift" style="width:100%; margin:15px;"></div>
		</div>

	</div>
	<a  class="btn btn-success" onclick="start()" style="width:49%">Start!</a>
	<a  class="btn btn-danger" onclick="stop()" style="width:49%">Stop!</a>
	
</div>

 

 

 

 
</body>
<script type="text/javascript">
	function start () {
		var master = $('#master').slider( "values", 0 );
		var shift = $('#shift').slider( "values", 0 );
		if (window.XMLHttpRequest) { // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject) { // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}  
		var data = "master=" + master + "&shift=" + shift;  
		xhr.open("POST", "start.php", true);   
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
		xhr.send(data);  
		xhr.onreadystatechange = display_data;  
		function display_data() {  
			if (xhr.readyState == 4) {  
				if (xhr.status == 200) {  
					//alert(xhr.responseText);        
					alert(xhr.responseText);  
				} else {  
					alert('There was a problem with the request.');  
				}  
			}  
		}  
	}
	function stop () {

		if (window.XMLHttpRequest) { // Mozilla, Safari, ...  
			xhr = new XMLHttpRequest();  
		} else if (window.ActiveXObject) { // IE 8 and older  
			xhr = new ActiveXObject("Microsoft.XMLHTTP");  
		}  
		var data = "stop=0";  
		xhr.open("POST", "stop.php", true);   
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                    
		xhr.send(data);  
		xhr.onreadystatechange = display_data;  
		function display_data() {  
			if (xhr.readyState == 4) {  
				if (xhr.status == 200) {  
					//alert(xhr.responseText);        
					alert(xhr.responseText);  
				} else {  
					alert('There was a problem with the request.');  
				}  
			}  
		}  
	}
</script>
  <script>
  $(function() {
    // setup master volume
    $( "#master" ).slider({
      value: 1,
      orientation: "horizontal",
      max:3,
      step:0.1,
      min:0.5,
      animate: true,

    });
    $( "#master" ).on( "slide", function( event, ui ) {
		var m = $( "#master" ).slider( "values", 0 );
		document.getElementById('mvalue').innerHTML = m;
	} );
    // setup graphic EQ
   	$( "#shift" ).slider({
      value: 0,
      orientation: "horizontal",
      max:5,
      step:0.1,
      min:-5,
      animate: true
    });
    $( "#shift" ).on( "slide", function( event, ui ) {
		var m = $( "#shift" ).slider( "values", 0 );
		document.getElementById('svalue').innerHTML = m;
	} );
  });
  </script>
</html>