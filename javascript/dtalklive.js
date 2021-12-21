const form = document.querySelector(".typing-area"),
    incoming_id = form.querySelector(".incoming_id").value,
    inputField = form.querySelector(".input-field"),
    sendBtn = form.querySelector("button"),
    sendBtnsec = form.querySelector("button"),
    chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/showmessages.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id=" + incoming_id);




}

// form.onsubmit = (r) => {
//     r.preventDefault();

//     let xhr = new XMLHttpRequest();
//     xhr.open("GET", "php/home.php", true);
//     xhr.onload = () => {
//         if (xhr.readyState === XMLHttpRequest.DONE) {
//             if (xhr.status === 200) {
//                 let data = xhr.response;
//                 if (!searchBar.classList.contains("active")) {
//                     usersList.innerHTML = data;
//                 }
//             }
//         }
//     }
//     // console.log("hi");
//     xhr.send();





// }


inputField.focus();
inputField.onkeyup = () => {
    if (inputField.value != "") {
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}



sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    if (document.getElementById("question").value.length != 0) {
        // console.log("empty")


        // console.log("message sent");

        xhr.open("POST", "php/sendmessages.php", true);

        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    inputField.value = "";
                    scrollToBottom();
                }
            }
        }
        let formData = new FormData(form);
        xhr.send(formData);
    }
}

// sendBtn.onclick = ()=>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "php/showmessages.php", true);

//     xhr.onload = ()=>{
//       if(xhr.readyState === XMLHttpRequest.DONE){
//           if(xhr.status === 200){
//               inputField.value = "";
//               scrollToBottom();
//           }
//       }
//     }
//     let formData = new FormData(form);
//     xhr.send(formData);
// }



chatBox.onmouseenter = () => {
    chatBox.classList.add("active");
}

chatBox.onmouseleave = () => {
    chatBox.classList.remove("active");
}

setTimeout(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/showmessages.php", true);

    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if (!chatBox.classList.contains("active")) {
                    scrollToBottom();
                }
            }
        }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id=" + incoming_id);


}, 0);

// setInterval(() =>{
//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "php/showmessages.php", true);
//     xhr.onload = ()=>{
//       if(xhr.readyState === XMLHttpRequest.DONE){
//           if(xhr.status === 200){
//             let data = xhr.response;
//             chatBox.innerHTML = data;
//             if(!chatBox.classList.contains("active")){
//                 scrollToBottom();
//               }
//           }
//       }
//     }
//     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhr.send("incoming_id="+incoming_id);
// }, 2000);
// for chat area;
function scrollToBottom() {
    chatBox.scrollTop = chatBox.scrollHeight;
}


















// for search box
const searchBar = document.querySelector(".search input"),
    searchIcon = document.querySelector(".search button"),
    usersList = document.querySelector(".users-list");

searchIcon.onclick = () => {
    searchBar.classList.toggle("show");
    searchIcon.classList.toggle("active");
    searchBar.focus();
    if (searchBar.classList.contains("active")) {
        searchBar.value = "";
        searchBar.classList.remove("active");
    }
}
var check = 1;
searchBar.onkeyup = () => {
    let searchTerm = searchBar.value;
    if (searchTerm != "") {
        searchBar.classList.add("active");
    } else {
        searchBar.classList.remove("active");
    }
    var l = document.getElementById("findbox").value.length;
    if (l > 4 ) {
        if(l%2){

        


        let xhr = new XMLHttpRequest();
        check =1;
        xhr.open("POST", "php/find.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    usersList.innerHTML = data;
                }
            }
        }
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("searchTerm=" + searchTerm);
    }}
   

    if (document.getElementById("findbox").value.length == 0 ) {
        if(check){
check =0;
let xhr = new XMLHttpRequest();
        xhr.open("GET", "php/home.php", true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    let data = xhr.response;
                    if (!searchBar.classList.contains("active")) {
                        usersList.innerHTML = data;
                    }
                }
            }
        }
        // console.log("hi");
        xhr.send();            
        }
        // console.log("hi");
        


    }
}

setTimeout(() => {

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "php/home.php", true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (!searchBar.classList.contains("active")) {
                    usersList.innerHTML = data;
                }
            }
        }
    }
    // console.log("hi");
    xhr.send();

}, 0);

setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/home.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          if(!searchBar.classList.contains("active")){
            usersList.innerHTML = data;
          }
        }
    }
  }
  // console.log("hi");
  xhr.send();
}, 30000);

// for left side of chat area


