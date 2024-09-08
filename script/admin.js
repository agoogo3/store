const ctx = document.getElementById("line");

new Chart(ctx, {
  type: "line",
  data: {
    labels: ["Jan", "Feb", "March", "April", "May", "June", "July"],
    datasets: [
      {
        label: "Last Month",
        data: [12, 19, 3, 5, 2, 90, 10],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const dough = document.getElementById("dougnut");

new Chart(dough, {
  type: "doughnut",
  data: {
    labels: ["Jan", "Feb", "March", "April", "May", "June", "July"],
    datasets: [
      {
        label: "Last Month",
        data: [12, 19, 3, 5, 2, 10, 10],
        borderWidth: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const bar = document.getElementById("bar");

new Chart(bar, {
  type: "bar",
  data: {
    labels: ["Jan", "Feb", "March", "April", "May", "June", "July"],
    datasets: [
      {
        label: "Expenditure",
        data: [12, 19, 3, 5, 2, 10, 10],
        borderWidth: 1,
      },
      {
        label: "Profit",
        data: [19, 13, 35, 35, 52, 30, 60],
        borderWidt: 1,
      },
    ],
  },
  options: {
    scales: {
      y: {
        beginAtZero: true,
      },
    },
  },
});

const side_nav = document.getElementById("side_nav");
function openSide(){
        side_nav.style.transform = 'translateX(-100%)';

    console.log("hello")
}
function closeSide(){
            side_nav.style.transform = "translateX(0%)";

}
