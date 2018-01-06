	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>  
	<script type="text/javascript" src="js/jquery.carouFredSel-6.1.0.js"></script>
	<script type="text/javascript">   
		$(document).ready(function() {
			$('#country').change( function(){
				$('.district').hide();  
				$('#DIVFr'+$(this).attr('value')).show();
				$('#DIVTo'+$(this).attr('value')).show();
				$('#DIVFr'+$(this).attr('value')+' select:nth-child(1)').change();
			});  
			$('.districtFr').change( function(){
				ctry= $(this).attr('id');
				$('.locFr').filter(':visible').hide();  
				$('#locFr'+$(this).attr('value')).show();

			});    
			$('.districtTo').change( function(){
				ctry= $(this).attr('id');
				$('.locTo').filter(':visible').hide();  
				$('#locTo'+$(this).attr('value')).show();
			});                                           
			$('#foo2').carouFredSel({
				auto: false,
				prev: '#prevBing',
				next: '#next2',
				pagination: "#pager2",
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
			$(".districtFr").change(function() {
				$(".districtTo").filter(':visible').val($(this).val()).change();
			});
			$(".locFr").change(function() {
				$(".locTo").filter(':visible').val($(this).val()).change();
			});
		});

		function ShowLoc(){
			document.getElementById('RetLocTD').style.display = "block";
			document.getElementById('DiffLoc').style.display = "block";
			document.getElementById('DiffLocChoose').style.display = "none";
			document.getElementById('DiffLocChecked').value = "1";
		}
	</script>
