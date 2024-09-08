const form = document.getElementById("form");
const alert = document.getElementById("alert");
const number = document.getElementById("number");
const password = document.getElementById("password");

form.addEventListener("submit", (e) => {
  e.preventDefault();
  const numText = encodeURIComponent(number.value);
  const passTxt = encodeURIComponent(password.value);
    
    let xhr = new XMLHttpRequest();

    xhr.open("POST", "./backend/admin.php", true);
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded")
    const data = "number="+numText+"&"+"password="+passTxt;

    xhr.onload = ()=>{
        if(xhr.status == 200){
            const response = JSON.parse(xhr.responseText)
            if(response.failed){
                alert.style.display = 'block'
            }else{
                window.location.href = "/store/admin/dashboard.php";
            }
            
        }else{
            console.log(xhr.statusText)
        }
    }
    xhr.send(data)
  
});
