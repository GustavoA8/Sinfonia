document.addEventListener("DOMContentLoaded", () => {
    fetch("get_items.php?estado=seminovo") // aqui você define o tipo
        .then(res => res.json())
        .then(data => {
            const container = document.getElementById("produtos");
            if (data.length === 0) {
                container.innerHTML = "<p class='text-center'>Nenhum produto encontrado.</p>";
                return;
            }
            

            data.forEach(item => {
                console.log(item)

                item.preco = item.preco.toString().split(".");
                let real = item.preco[0];
                let cent = item.preco[1] || "00"; // segurança caso não tenha centavos

                const col = document.createElement("div");
                col.className = "col-md-3 mb-4";
                col.innerHTML = `
                    <div class="card mx-auto mt-3 mb-5">
        <div class="imgbx">
          <img src="${item.img}" alt="${item.nome}">
        </div>
        <div class="contentBox">
          <h3>${item.nome}</h3>
          <h5>${item.marca}</h5>
          <h2 class="price">R$ ${real}.<small>${cent}</small></h2>
          <a href="#" class="buy">Buy Now</a>
        </div>
      </div>
    `;
                container.appendChild(col);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar produtos:", error);
        });
});
