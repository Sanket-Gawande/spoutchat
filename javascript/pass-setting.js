
     form = document.querySelector('.password-form');
     form.onsubmit = e =>{
         e.preventDefault();
          a = '<i class="fa fa-spinner fa-pulse"></i>';
         let button = document.querySelector('.update-button')
         button.innerHTML = a;
         const obj = new XMLHttpRequest();
         data = new FormData(form);
         obj.open("post" , "password-setting.php" , true);
         obj.send(data);
         obj.onload = function (){
            const {status , msg} = JSON.parse(obj.responseText);
             button.innerHTML = "Update"

            if(status == "success"){
                form.reset();
            }

            alert(msg);
         }
     }


     console.log(87)