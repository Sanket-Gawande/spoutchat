 function confirmLeave(id) {
                
            if (confirm("Are you sure to leave this chat room\n\nRoom name: My room")) {
                alert(id);
            }
        }

        //preview chosen profile  image
        /*I have added some validations  while choosing file . it must be image file in given format and also there are some size limitations.*/

        let file = document.querySelector("#file");
        file.onchange = function () {
            let name = this.files[0].name
            let size = this.files[0].size
            let arr = name.split(".")
            let ext = arr[arr.length - 1];

            validExt = ["jpg",
                "png",
                "jpeg",
                "svg",
                "webp"];
            if (validExt.includes(ext)) {
                if (size <= 500000) {
                    obj = new FileReader;
                    obj.readAsDataURL(file.files[0])
                    obj.onload = function () {

                        //	console.log(this.result)
                        document.querySelector(".profile-img-preview").src = this.result;

                    }
                } else {
                    alert("File size is too big , please upload  file under 500kb\n\nFile size : "+size/1000+"kb")
                    file.value = "";
                }
            } else {
                alert("Invalid file type , Please upload jpg/jpeg/png/svg")
                file.value = "";
            }

        }

// loading animation in button 
  let b = document.querySelector(".password-setting-button");
        b.onclick = () => {
            a = '<i class="fa fa-spinner fa-pulse"></i>';
            b.innerHTML = a;
            b.style.opacity = ".8"
        }

        