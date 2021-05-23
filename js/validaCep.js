(function(){

    var $form = document.getElementById('form');
    var $cep = document.getElementById('cep');
    var $alertErro = document.getElementById('erroCep');    

    $form.addEventListener('submit', function(e){        

        
        $exp2 = /^([\d]{2})\.*([\d]{3})-*([\d]{3})/;
        console.log($exp2.test($cep.value));
        if(!$exp2.test($cep.value)){
            $alertErro.style.display = 'block';
            e.preventDefault();
            
            setTimeout(function(){                
                $alertErro.style.display='none'   
            }, 2000);
        }            
        
    });   

})();    
   