  <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>  
  <script type="text/javascript" src="js/jquery.carouFredSel-6.1.0.js"></script>
  <script type="text/javascript">   
$(function() {



                //    Scrolled by user interaction
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

 });
$(document).ready(function() {

             $('#country').change( function()
                {

                   $('.district').hide();  
                   $('#DIVFr'+$(this).attr('value')).show();
                   $('#DIVTo'+$(this).attr('value')).show();


                } )  ;  
             $('.districtFr').change( function()
                {
                   ctry= $(this).attr('id');

                   $('.locFr'+ctry.substr( 6)).hide();  
                   $('#locFr'+$(this).attr('value')).show();

                } )  ;    
             $('.districtTo').change( function()
                {

                   ctry= $(this).attr('id');

                   $('.locTo'+ctry.substr( 6)).hide();  

                   $('#locTo'+$(this).attr('value')).show();


                } )  ;                                           

              });
            function ShowLoc()
            {
                document.getElementById('RetLocTD').style.display = "block";
                document.getElementById('DiffLoc').style.display = "block";
                document.getElementById('DiffLocChoose').style.display = "none";
                document.getElementById('DiffLocChecked').value = "1";
            }
     
</script> 
  
