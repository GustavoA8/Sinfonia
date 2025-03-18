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
}

]
inicializarLoja = () => {
var containerProdutos = document.getElementById("produtos");
items.map((val) => {
    console.log(val.nome);
    val.preco = val.preco.toString().split(".")
    let real = val.preco[0]
    let cent = val.preco[1]

    containerProdutos.innerHTML += `
    
      <div class="card mx-auto mt-3 mb-5">
        <div class="imgbx">
          <img src="img/Piano.png" alt="">
        </div>
        <div class="contentBox">
          <h3>` + val.nome + `</h3>
          <h2 class="price">R$ ` + real + `.<small>` + cent + `</small></h2>
          <a href="#" class="buy">Buy Now</a>
        </div>
      </div>
    `


})
}
inicializarLoja();