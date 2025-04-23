fetch('get_items.php')
  .then(response => response.json())
  .then(items => {
    console.log(items); // Aqui está seu array com objetos

    // Agora sim, inicializa com os dados prontos
    inicializarLoja(items);
  })
  .catch(error => {
    console.error('Erro ao buscar os itens:', error);
  });


// A função agora recebe items como parâmetro
const inicializarLoja = (items) => {
  var containerProdutos = document.getElementById("produtos");

  items.map((val) => {
    console.log(val.nome);
    
    val.preco = val.preco.toString().split(".");
    let real = val.preco[0];
    let cent = val.preco[1] || "00"; // segurança caso não tenha centavos

    containerProdutos.innerHTML += `
      <div class="card mx-auto mt-3 mb-5">
        <div class="imgbx">
          <img src="img/${val.img}" alt="${val.nome}">
        </div>
        <div class="contentBox">
          <h3>${val.nome}</h3>
          <h2 class="price">R$ ${real}.<small>${cent}</small></h2>
          <a href="#" class="buy">Buy Now</a>
        </div>
      </div>
    `;
  });
}

function logar(){
  const usuario = document.getElementById("usuario").value;
  const senha = document.getElementById("senha").value;

  if (usuario == "biaefifo02" && senha == "123"){
    window.alert("logado com sucesso")
    window.location.href = "teste.html";
  }else{
    window.alert("usuario ou senha invalida")
  }
}
