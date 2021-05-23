(function(){

    var $form = document.getElementById('form');
    var $cep = document.getElementById('cep');
    var $alertErro = document.getElementById('erroCep');    

    $form.addEventListener('submit', function(e){        

        $exp = /\d{5}\d{3}/;

        if(!$exp.test($cep.value)){
            $alertErro.style.display = 'block';
            e.preventDefault();
            
            setTimeout(function(){                
                $alertErro.style.display='none'   
            }, 2000);
        }            
        
    });   

})();    
   