(function(){

    var $alertErro = document.getElementById('cepNull');
    
    if($alertErro !== null){
        $alertErro.style.display = 'block';
        setTimeout(function(){                
            $alertErro.style.display='none'   
        }, 2000);
    }
          
})();