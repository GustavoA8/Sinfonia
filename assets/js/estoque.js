function comboTipo(){
    const tipo = document.getElementById("tipo")
    const inputTipo = document.getElementById("input-tipo")
  
    if ( tipo.value == "Outra"){
      inputTipo.disabled = false;

      inputTipo.required = true;
  
    }else{
        inputTipo.disabled = true;
        inputTipo.required = false;
    }

    const tipo2 = document.getElementById("tipoE")
    const inputTipo2 = document.getElementById("input-tipoE")
  
    if ( tipo2.value == "Outra"){
      inputTipo2.disabled = false;

      inputTipo2.required = true;
  
    }else{
        inputTipo2.disabled = true;
        inputTipo2.required = false;
    }
}

function comboMarca(){
    const marca = document.getElementById("marca")
    const inputMarca = document.getElementById("input-marca")
  
    if ( marca.value == "Outra"){
      inputMarca.disabled = false;
      inputMarca.required = true;
  
    }else{
        inputMarca.disabled = true;
        inputMarca.required = false;
    }
    
    const marca2 = document.getElementById("marcaE")
    const inputMarca2 = document.getElementById("input-marcaE")
  
    if ( marca2.value == "Outra"){
      inputMarca2.disabled = false;
      inputMarca2.required = true;
  
    }else{
        inputMarca2.disabled = true;
        inputMarca2.required = false;
    }
}

function carregarDadosEditar(id) {
  console.log("ID recebido para edição:", id); // ← DEBUG

  fetch('../buscar_item.php?id=' + id)
      .then(response => response.json())
      .then(dados => {
          console.log("Dados recebidos:", dados); // ← DEBUG

          if (dados.erro) {
              alert(dados.erro);
              return;
          }

          document.getElementById('nomeE').value = dados.item_nome;
          document.getElementById('estadoE').value = dados.item_estado;
          document.getElementById('precoE').value = dados.item_preco;
          document.getElementById('imagem-preview').src = "../" + dados.item_img;
          document.getElementById('tipoE').value = dados.item_tipo_fk;
          document.getElementById('marcaE').value = dados.item_marca_fk;
        

          // Campo hidden com ID
          let hiddenInput = document.getElementById('item-id');
          if (!hiddenInput) {
              hiddenInput = document.createElement('input');
              hiddenInput.type = 'hidden';
              hiddenInput.name = 'item_id';
              hiddenInput.id = 'item-id';
              document.querySelector('#myModal2 form').appendChild(hiddenInput);
          }
          hiddenInput.value = dados.item_id;
      })
      .catch(error => {
          console.error('Erro ao buscar dados:', error);
      });
}


