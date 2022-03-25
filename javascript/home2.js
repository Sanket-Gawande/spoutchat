
            cpw = document.querySelector(".c_pass_room")
            cpw.oninput = (function warn() {
                pw = document.querySelector(".pass_room").value
                cpw = document.querySelector(".c_pass_room").value
                if (pw != cpw) {
                    document.querySelector(".warn").style.display = "block";
                    document.querySelector(".create").disabled = true;
                    this.style.border = "1px solid tomato";
                    this.style.color = " tomato";
                } else {
                    document.querySelector(".warn").style.display = "none";
                    this.style.color = " #fff";
                    this.style.border = "1px solid #fff";
                    document.querySelector(".create").disabled = false;
                }
            })

            window.history.deleteAll();




            // room thumbnail file handling


            const file = document.querySelector(".file");
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