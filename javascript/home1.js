   join = document.querySelector(".create_room");
            join.onclick = function () {
                document.querySelector(".room_form").classList.add("room_form_open");
            }

            function closeRoom() {
                document.querySelector(".room_form").classList.remove("room_form_open");
            }

            function closeRoom2() {
              
                document.querySelector(".join_room").classList.remove("room_form_open");

            }
            function openJoinForm() {
                document.querySelector(".join_room").classList.add("room_form_open");
           
            }