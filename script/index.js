document.addEventListener("DOMContentLoaded", () => {
  let xhr = new XMLHttpRequest();

  xhr.open("POST", "./backend/response.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onload = () => {
    if (xhr.status == 200) {


        let response = JSON.parse(xhr.responseText);

        const productWrapper = document.getElementById("product_wrapper");

        for (let respo of response) {
          let div = document.createElement("div");
          div.className = "product_div";

          div.innerHTML = `
        <h2 style="width: 20rem" class="name" data-value="${respo.id}">${respo.name}</h2>
        <p class="pro_des">
          ${respo.sec_description}
        </p>
        <button class="order_button order">Place Order</button><br />
        <img src="${
          respo.images[0] ? respo.images[0] : "images/default.png"
        }" alt="${respo.name}" />

        
    `;
        console.log(respo.images[0])
          productWrapper.appendChild(div);
        }

        const order = document.getElementsByClassName("order");

        for (const button of order) {
          button.addEventListener("click", () => {
            const parent = button.parentElement;
            const id = parent.querySelector(".name").dataset.value;
            location.href = "./product.html?id=" + id;
          });
        }



    } else {
      console.log("Error: " + xhr.statusText);
    }
  };

  let data = "data=hello";

  xhr.send(data);
});
