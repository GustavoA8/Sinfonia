const items = [{
        id: 0,
        nome: "violão",
        img: "violao.png",
        preco: 97.99
    },
    {
        id: 1,
        nome: "Violino",
        img: "violino.jpg",
        preco: 190.99
    },
    {
        id: 2,
        nome: "Piano",
        img: "piano.png",
        preco: 1700.89
    },
    {
        id: 3,
        nome: "Teste",
        img: "piano.png",
        preco: 1700.89
    },
    {
        id: 3,
        nome: "Teste",
        img: "piano.png",
        preco: 1700.89
    },
    {
        id: 3,
        nome: "Teste",
        img: "piano.png",
        preco: 1700.89
    },
    {
        id: 3,
        nome: "Teste",
        img: "piano.png",
        preco: 1700.89
    },
    {
        id: 3,
        nome: "Teste",
        img: "piano.png",
        preco: 1700.89
    }

]
inicializarLoja = () => {
    var containerProdutos = document.getElementById("produtos");
    items.map((val) => {
        console.log(val.nome);
        containerProdutos.innerHTML += `
        
  <div class="card col-xxl-4 col-sm-3 mx-auto mt-4" style="width:400px">
    <img class="card-img-top mx-auto" src="img/violino.jpg" alt="Card image" style="width:100%">
    <div class="card-body">
      <h4 class="card-title">` + val.nome + `</h4>
      <p class="card-text">R$` + val.preco + `</p>
      <a href="#" class="btn mx-auto btn-primary">Comprar</a>
    </div>
  </div>
        `


    })
}
inicializarLoja();