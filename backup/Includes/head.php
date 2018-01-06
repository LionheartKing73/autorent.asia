  <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>  
  <script type="text/javascript">   
            $(document).ready(function() {
             $('.Locations').hide();
             $('#Loc'+$('#country').attr('value')).show();
             $('#RetLoc'+$('#country').attr('value')).show();             
             $('#country').change( function()
                {

                   $('.Locations').hide();
                   $('#Loc'+$(this).attr('value')).show();
                   $('#RetLoc'+$(this).attr('value')).show();
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