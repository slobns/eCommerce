</div><br><br>
        
         <footer class="text-center" id="footer"> @copy 2017 Slobns </footer>  
        
        <script>
            
          function updateSizes(){
              var sizeString = '';
             for(var i=1;i<=12;i++){
               if(jQuery('#size'+i).val()!= '') {
                   sizeString += jQuery('#size'+i).val()+ ':' + jQuery('#qty'+i).val()+ ',';
               }
               jQuery('#sizes').val(sizeString);
             }
          }  
          
          function get_child_options(){
              if(typeof selected === 'underfind'){
                  var selected = '';
              }
              var parentID = jQuery('#parent').val();
              jQuery.ajax({
                  url: '/ecommerc/admin/parsers/child_categorys.php',
                  type: 'POST',
                  data: {parentID : parentID, selected : selected},
                  success:function(data){
                    jQuery('#child').html(data);  
                  },
                  error:function(){
                      alert("Nesto nije u redu sa bazom podataka");
                  }
              });
          }
          jQuery('select[name="parent"]').change(function(){
              get_child_options();
          });
      
        </script> 
    
    </body>
</html>