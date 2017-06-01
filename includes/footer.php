 </div><br><br>
        
        <footer class="text-center" id="footer"> @copy 2017 Slobns </footer>
       
        <script>
     jQuery(window).scroll(function(){
        var vscroll = jQuery(this).scrollTop();
      
        jQuery('#logotext').css({
            "transform" : "translate(0px, "+vscroll/2+"px)"
        });
        jQuery('#for-flower').css({
            "transform" : "translate("+vscroll+"px, -"+vscroll/12+"px)"
        });
        jQuery('#back-flower').css({
            "transform" : "translate(0px, -"+vscroll/2+"px)"
        });
     });
     
     function detailsmodal(id) {
        var data = {"id" : id};
        //console.log(data);
        jQuery.ajax ({
            url:'/ecommerc/includes/detailsmodal.php',
            method: "post",
            data: data,
            success: function(data){
                jQuery('body').append(data);
                jQuery('#details-modal').modal('toggle');
            },
            error: function() {
                alert('Something went wrong!!!');            }
        });
     };
    </script>
    </body>
</html>