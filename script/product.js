const shrink = document.querySelectorAll(".shrink");
const description = document.querySelectorAll(".description");
const head = document.querySelectorAll(".head");
const promo = document.getElementById("promo");
const minus = document.getElementById("minus");
const add = document.getElementById("add");
const number = document.getElementById("number");
const amount = document.getElementById("amount");
let paymentWrapper = document.getElementById("payment_cred_wrapper");
let price_rate = document.getElementById("price_rate");
const success = document.getElementById("success");
const form = document.getElementById("form");
const success_wrapper = document.getElementById("success_wrapper");
const buyNow = document.getElementsByClassName("amount");
const url = new URLSearchParams(window.location.search);
const id = encodeURIComponent(url.get("id"));
const wrap = document.getElementById("wrap");
    const buyButton = document.getElementById("buy_now");

wrap.onclick = () => {
  if (
    paymentWrapper.style.transform ==
    "translateX(-50%) translateY(-50%) scale(1)"
  ) {
    paymentWrapper.style.transform =
      "translateX(-50%) translateY(-50%) scale(0)";
          wrap.style.transform = "translateX(-50%) translateY(-50%) scale(0)";

  }
};

form.addEventListener("submit", (e) => {
  e.preventDefault();

  const formData = new FormData(form);
  formData.append("id", id);

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "./backend/response.php", true);
  xhr.onload = () => {
        buyButton.textContent = "Loading...";

    if (xhr.status == 200) {
      const response = JSON.parse(xhr.responseText);
      // console.log(response)
      // console.log(response.success);
      if (response.success) {
        const productName = document.getElementById("sum_product_name");
        productName.textContent = `${response.success.productName}. X${response.success.quantity}`;

        const sumPrice = document.getElementById("sum_price");
        sumPrice.textContent = `GHC ${response.success.price}.00`;

        const sumLocation = document.getElementById("sum_location");
        sumLocation.textContent = response.success.location + ".";

        const orderId = document.getElementById("order_id");
        orderId.textContent = `Order #${response.success.id}`;
        // console.log(response)
      } else {
        window.alert(response.error);
      }
    } else {
      console.log("error: " + xhr.statusText);
    }
  };
  xhr.onprogress = ()=>{
    buyButton.textContent = "Loading..."
  }

  xhr.send(formData);

  // for(const [key,value] of formData.entries()){
  //   console.log(`${key} : ${value}`)
  // }

  success_wrapper.style.transform =
    "translateX(-50%) translateY(-50%) scale(1)";
});

let counter = 1;

//Collapsing and de-collapsing descriptions
for (let i = 0; i < shrink.length; i++) {
  shrink[i].addEventListener("click", () => {
    if (shrink[i].textContent == "—") {
      description[i].style.display = "none";
      shrink[i].textContent = "+";
      shrink[i].style.fontSize = "1.4rem";
      head[i].style.marginBottom = "0rem";
    } else {
      description[i].style.display = "block";
      shrink[i].textContent = "—";
      shrink[i].style.fontSize = "1.1rem";

      head[i].style.marginBottom = "1rem";
    }
  });
}

function showPaymentWrapper(event) {
  let clicked = event.target;
  wrap.style.transform = "translateX(-50%) translateY(-50%) scale(1)";

  let color = window.getComputedStyle(clicked).backgroundColor;

  if (color == "rgb(0, 0, 0)") {
    paymentWrapper.style.transformOrigin = "right";
  } else {
    paymentWrapper.style.transformOrigin = "top";
  }
  paymentWrapper.style.transform = "translateX(-50%) translateY(-50%) scale(1)";
}
function closePayment() {
  // console.log("hello");
  wrap.style.transform = "translateX(-50%) translateY(-50%) scale(0)";

  paymentWrapper.style.transform = "translateX(-50%) translateY(-50%) scale(0)";
}

function startTimer(duration, display) {
  let timer = duration,
    hours,
    minutes,
    seconds;
  const startTime = Date.now();

  const interval = setInterval(function () {
    const elapsedTime = Math.floor((Date.now() - startTime) / 1000);
    const remainingTime = duration - elapsedTime;

    if (remainingTime < 0) {
      clearInterval(interval);
      localStorage.removeItem("remainingTime");
      localStorage.setItem("startTime", Date.now()); // Save new start time
      startTimer(duration, display); // Restart the timer
      return;
    }

    hours = Math.floor(remainingTime / 3600);
    minutes = Math.floor((remainingTime % 3600) / 60);
    seconds = Math.floor(remainingTime % 60);

    hours = hours < 10 ? "0" + hours : hours;
    minutes = minutes < 10 ? "0" + minutes : minutes;
    seconds = seconds < 10 ? "0" + seconds : seconds;

    display.textContent = hours + ":" + minutes + ":" + seconds;

    localStorage.setItem("remainingTime", remainingTime);
  }, 1000);
}

window.onload = function () {
  const display = document.getElementById("timer");
  let remainingTime = localStorage.getItem("remainingTime");
  let startTime = localStorage.getItem("startTime");

  //calling tallying function
  // tallying()
  //Collapsing how to use and ingredients
  for (let i = 1; i <= 2; i++) {
    description[i].style.display = "none";
    shrink[i].textContent = "+";
    shrink[i].style.fontSize = "1.4rem";

    head[i].style.marginBottom = "0rem";
  }

  setTimeout(() => {
    promo.style.transform = "translateX(-105%)";
  }, 2000);
  if (remainingTime && startTime) {
    const elapsed = Math.floor((Date.now() - startTime) / 1000);
    remainingTime = parseInt(remainingTime, 10) - elapsed;
    remainingTime = remainingTime > 0 ? remainingTime : 0;
  } else {
    remainingTime = 10 * 60 * 60 + 23 * 60; // 10 hours and 23 minutes in seconds
    localStorage.setItem("startTime", Date.now());
  }

  startTimer(remainingTime, display);
};

// window.onload = function () {
//   setTimeout(() => {
//     promo.style.transform = "translateX(-105%)"
//   }, 3000);
//   const display = document.getElementById("timer");
//   const twentyFourHours = 10 * 60 * 60 + 23 * 60; // 24 hours in seconds
//   startTimer(twentyFourHours, display);
// };
function closePromo() {
  promo.style.transform = "translateX(0%)";
}

//Sending request and getting and handling response
document.addEventListener("DOMContentLoaded", () => {
  const xhr = new XMLHttpRequest();

  xhr.open("POST", "./backend/response.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  const data = "id=" + id;

  xhr.onload = () => {
    if (xhr.status == 200) {
      const response = JSON.parse(xhr.responseText);
      console.log(response);
      if (response.success) {
        //Assigning the name to the database
        const productName = (document.getElementById(
          "product_name"
        ).textContent = response.success.data[0].name);

        //Assigning descripton, how to use and ingredients
        description[0].textContent = response.success.data[0].main_description;
        description[1].textContent = response.success.data[0].usages;

        description[2].textContent = response.success.data[0].ingredients;

        //Creating the pricing for the promotion buy now

        buyNow[1].textContent = "GHC" + response.success.data[0].price_one;
        buyNow[2].textContent = "GHC" + response.success.data[0].price_two;
        buyNow[3].textContent = "GHC" + response.success.data[0].price_three;

        //Assigning the images to the div
        const first_image = document.getElementById("f_image");
        first_image.src = response.success.image[0][0][0];
        const image = response.success.image[0];
        const sec_image_wrapper = document.getElementById("s_image_wrapper");
        for (let i = 1; i < image.length; i++) {
          const sec_image = document.createElement("img");
          sec_image.src = response.success.image[0][i][0];
          sec_image_wrapper.appendChild(sec_image);
        }

        //Creating the pricing the item
        const options = document.querySelectorAll(".opt");
        amount.textContent = "GHC" + response.success.data[0].price_one;
        options[0].textContent =
          "Buy one: GHC" + response.success.data[0].price_one;
        options[1].textContent =
          "Buy two: GHC" + response.success.data[0].price_two;
        options[2].textContent =
          "Buy three: GHC" + response.success.data[0].price_three;

        function price() {
          if (counter == 1) {
            amount.textContent = "GHC" + response.success.data[0].price_one;
          } else if (counter == 2) {
            amount.textContent = "GHC" + response.success.data[0].price_two;
          } else {
            amount.textContent = "GHC" + response.success.data[0].price_three;
          }
        }
        //Tallying the counter with the price
        function tallying() {
          if (number.textContent == 1) {
            price_rate.selectedIndex = 0;
          } else if (number.textContent == 2) {
            price_rate.selectedIndex = 1;
          } else {
            price_rate.selectedIndex = 2;
          }
        }

        minus.addEventListener("click", () => {
          if (counter > 1) {
            counter--;
            number.textContent = counter;
            price();
            tallying();
          }
        });
        add.addEventListener("click", () => {
          if (counter < 3) {
            counter++;
            number.textContent = counter;
            price();
            tallying();
          }
        });
      } else {
        const body = document.getElementById("body");
        console.log(response.error);
        body.textContent = response.error;
      }
    } else {
      console.log("Error: " + xhr.statusText);
    }
  };
  xhr.send(data);
});
