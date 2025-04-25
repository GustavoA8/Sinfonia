function comboTipo(){
    const tipo = document.getElementById("tipo")
    const inputTipo = document.getElementById("input-tipo")
  
    if ( tipo.value == "Outra"){
      inputTipo.disabled = false;
  
    }else{
        inputTipo.disabled = true;
    }
}

function comboMarca(){
    const marca = document.getElementById("marca")
    const inputMarca = document.getElementById("input-marca")
  
    if ( marca.value == "Outra"){
      inputMarca.disabled = false;
  
    }else{
        inputMarca.disabled = true;
    }
}