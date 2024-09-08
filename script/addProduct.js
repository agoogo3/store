const form = document.getElementById("form");
const imageInput = document.getElementById("image_input");
const image_wrapper = document.getElementById("image_wrapper");

let fileArray = []


imageInput.addEventListener("change", (e) => {
  const files = e.target.files;

  for (let i = 0; i < files.length; i++) {
    if (files[i]) {
      const file = files[i];
      fileArray.push(file)
                  console.log(fileArray);

      const reader = new FileReader();

      reader.onload = (e) => {
        const imageUrl = e.target.result;
        image_wrapper.style.gridTemplateColumns = "repeat(2,1fr)";
        const child = ` <div class="images_wrap">
                                <span class="close">&cross;</span>
                                <img src="${imageUrl}" class="img-thumbnail" alt="...">
                            </div>`;
        image_wrapper.insertAdjacentHTML("beforeend", child);
         const close = document.querySelectorAll(".close");

         ;
         

         close.forEach((div) => {
          div.addEventListener("click", (e) => {
            const target = e.target.parentElement;
            const index = Array.from(close).indexOf(div)
            fileArray.splice(index,1)
            console.log(fileArray)
            target.remove();
          });
         })
        //  for (let div of close) {
        //    div.addEventListener("click", (e) => {
        //     const target = e.target.parentElement;
        //     target.remove()
        //    });
        //  }
      };
     
      reader.readAsDataURL(file);
    }
    
  }
 
  //   console.log(imageArray[0])
});

form.addEventListener("submit", (e) => {
  e.preventDefault();
let formData = new FormData(form);


  for (let file of imageInput.files) {
    formData.append("images[]", file);
  }

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "../backend/admin.php", true);
  xhr.onload = () => {
    if(xhr.status == 200){
        const response = xhr.response
        console.log(response)
    }else{
        console.log(xhr.statusText)
    }
  };

  xhr.send(formData)

  for (const [key, value] of formData) {
    console.log(`${key}: ${value}`);
  }
});
