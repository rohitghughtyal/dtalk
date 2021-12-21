const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");

searchIcon.onclick = ()=>{
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if(searchBar.classList.contains("active")){
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
  
}, 0);





// const searchBar = document.querySelector(".search input"),
//     searchIcon = document.querySelector(".search button"),
//     usersList = document.querySelector(".users-list");

// searchIcon.onclick = () => {
//     searchBar.classList.toggle("show");
//     searchIcon.classList.toggle("active");
//     searchBar.focus();
//     if (searchBar.classList.contains("active")) {
//         searchBar.value = "";
//         searchBar.classList.remove("active");
//     }
// }

// setTimeout(() => {

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

// }, 0);



