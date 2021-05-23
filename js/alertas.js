(function(){

    var $alertErro = document.getElementById('cepNull');
    
    $alertErro.style.display = 'block';
    setTimeout(function(){                
        $alertErro.style.display='none'   
    }, 2000);
          
})();