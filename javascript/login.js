 const form = document.querySelector('form')

    form.onsubmit = e => {
      e.preventDefault();
      const data = new FormData(form);
      const req = new XMLHttpRequest();
      req.open('post' , 'process-login.php' , true)
      req.send(data)
      req.onload = ()=> {
      const {massage , status} = JSON.parse(req.responseText);

      if(status == "error"){ style = "warn"}
      else {style = "success"}
      
      const span = document.querySelector('.show-alert');
      span.classList.add(style);
      span.innerHTML = massage ;

      if(status == 'success'){
        setTimeout(() => {
          location.href = "index.php";
        }, 1500);
      }
      }

      req.onreadystatechange = () => {
        console.log(req.readyState)
      }
    }
  