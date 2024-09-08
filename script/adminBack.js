const side_nav = document.getElementById("side_nav");
const card = document.getElementById("card");
const bg = document.getElementById("bg");
const pop = document.getElementById("pop");
let value;

bg.onclick = () => {
  closeCard();
};

function viewPop() {
  if (pop.style.display == "none") {
    pop.style.display = "block";
  } else {
    pop.style.display = "none";
  }
}

function closeCard() {
  card.style.transform = "translateX(-103%) scale(0)";
  bg.style.transform = "translateX(-103%) scale(0)";
}

function openSide() {
  side_nav.style.transform = "translateX(-100%)";
}
function closeSide() {
  side_nav.style.transform = "translateX(0%)";
}
function formatDate(dateString) {
  const date = new Date(dateString);

  const day = date.getDate();
  const month = date.toLocaleString("default", { month: "long" });
  const year = date.getFullYear();

  // Determine the suffix for the day
  let suffix = "th";
  if (day % 10 === 1 && day !== 11) suffix = "st";
  else if (day % 10 === 2 && day !== 12) suffix = "nd";
  else if (day % 10 === 3 && day !== 13) suffix = "rd";

  // Return the formatted date
  return `${day}${suffix} ${month}, ${year}`;
}

document.addEventListener("DOMContentLoaded", () => {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../backend/admin.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  const message = "data=hello";
  const summaryList = document.querySelectorAll(".o_summary");

  xhr.onload = () => {
    if (xhr.status == 200) {
      const response = JSON.parse(xhr.response);
      console.log(response);
      if (response.error) {
        console.log("It is an error");
      } else {
        const orderList = document.getElementById("order_list");
        function updateList(list) {
          orderList.innerHTML += `<li class="list-group-item">
          <div class="order">
            <p class="plus" data-value="${list.order_id}">+</p>
            <div class="customer">
              <span>${list.customer_name}</span><br />
              <span class="number">${list.c_contact}</span>
            </div>
          </div>
          <p class="stat"  >${list.status}</p>
        </li>`;

          //Setting up the status numbers
          const statNumber = document.querySelectorAll(".status_num");
          statNumber[0].textContent = response.status.pending_count;
          statNumber[1].textContent = response.status.delivered_count;
          statNumber[2].textContent = response.status.cancelled_count;

          const plus = document.querySelectorAll(".plus");
          const stat = document.querySelectorAll(".stat");

          for (let sta of stat) {
            if (sta.textContent == "pending") {
              sta.style.backgroundColor = "orange";
            } else if (sta.textContent == "cancelled") {
              sta.style.backgroundColor = "red";
            } else {
              sta.style.backgroundColor = "green";
            }
          }
          //Setting up the order pop up card
          for (let open of plus) {
            open.addEventListener("click", () => {
              value = open.dataset.value;
              const filter = response.data.find((obj) => obj.order_id == value);
              if (filter) {
                const sec = document.querySelectorAll(".sec");
                sec[0].textContent = `#${filter.order_id}`;
                const unparsedDate = filter.order_date;

                sec[1].textContent = formatDate(unparsedDate);
                sec[2].textContent = filter.customer_name;
                sec[3].textContent = filter.c_contact;
                sec[4].textContent = `X ${filter.quantity}`;
                sec[5].textContent = `GHC ${filter.price}.00`;
                sec[6].textContent = filter.status;

                //  sec[6].textContent == "pending"
                //    ? (sec[6].style.backgroundColor = "orange")
                //    : (sec[6].style.backgroundColor = "green");

                if (sec[6].textContent == "pending") {
                  sec[6].style.backgroundColor = "orange";
                } else if (sec[6].textContent == "cancelled") {
                  sec[6].style.backgroundColor = "red";
                } else {
                  sec[6].style.backgroundColor = "green";
                }

                // console.log(filter)
              }

              card.style.transform = "translateX(-103%) scale(1)";
              bg.style.transform = "translateX(-50%) translateY(-50%) scale(1)";
            });
          }
        }

        response.data.forEach((orders, index) => {
          updateList(orders);

          //Creating filters for search, pending, completed and cancelled orders

          const searchTF = document.getElementById("search_tf");

          //Filtering based on search
          searchTF.addEventListener("keyup", () => {
            const subString = searchTF.value;
            const regex = new RegExp(subString, "i");
            const fil = response.data.filter((obj) =>
              regex.test(obj.customer_name)
            );
            if (subString != "") {
              orderList.innerHTML = "";

              for (let filter of fil) {
                updateList(filter);
              }
            } else {
              orderList.innerHTML = "";

              response.data.forEach((res) => {
                updateList(res);
              });
            }
          });
        });
        //Filtering based on status
        function filterStat(status) {
          const subString = status;
          const regex = new RegExp(subString, "i");
          const fil = response.data.filter((obj) => regex.test(obj.status));
          orderList.innerText = "";
          for (let filter of fil) {
            updateList(filter);
            // console.log(filter);
          }
        }
        for (let i = 0; i < summaryList.length; i++) {
          summaryList[i].addEventListener("click", () => {
            switch (i) {
              case 0:
                filterStat("pending");
                break;
              case 1:
                filterStat("delivered");
                break;
              case 2:
                filterStat("cancelled");
                break;
              default:
                console.log("Cant't find filter");
            }
          });
        }
      }
    } else {
      console.log("Err: " + xhr.statusText);
    }
  };
  xhr.send(message);
});

//Changing status of the orders
const statList = document.querySelectorAll(".status");

for (let i = 0; i < statList.length; i++) {
  statList[i].addEventListener("click", () => {
    const sxhr = new XMLHttpRequest();
    sxhr.open("POST", "../backend/admin.php", true);
    sxhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    const statusIndex = "index=" + i + "&id=" + value;
    sxhr.onload = () => {
      if (sxhr.status == 200) {
        console.log(sxhr.responseText);
        location.reload();
      } else {
        console.log("Error: " + sxhr.statusText);
      }
    };
    sxhr.send(statusIndex);
    // console.log(value)
  });
}
