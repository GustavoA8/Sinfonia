const items = [{
    id: 0,
    nome: "violão",
    img:"violao.png",
    preco: 97.99
},
{
    id: 1,
    nome: "Violino",
    img:"violino.jpg",
    preco: 190.99
},
{
    id: 2,
    nome: "Piano",
    img:"piano.png",
    preco: 1700.89
},

]
inicializarLoja = () => {
    var containerProdutos = document.getElementById("produtos");
    items.map((val)=>{
        console.log(val.nome);
        containerProdutos.innerHTML +=`
        
        <div class="produtos-single">
            <img src="img/`+val.img+`" />
            <p>`+val.nome+`</p>
            <a key="`+val.nome+`" href="">Entrar em contato!</a>
        </div>
        `       
        
        
    })
}
inicializarLoja();