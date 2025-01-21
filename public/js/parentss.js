const body = document.querySelector("body"),
      modetoggle = body.querySelector(".mode-toggle");
      siderbar = body.querySelector("nav")
      siderbartoggle = body.querySelector(".siderbar-toggle")

const  menubar = document.querySelector(".menu-bars")
const  menudown = document.querySelector(".menu-down")

const  menubar2 = document.querySelector(".menu-bars2")
const  menudown2 = document.querySelector(".menu-down2")

 


menudown.addEventListener("click" ,()=>{
    menubar.classList.toggle("show")
});

menudown2.addEventListener("click" ,()=>{
    menubar2.classList.toggle("show2")
});
modetoggle.addEventListener("click" , ()=> {
    body.classList.toggle("dark")
})

siderbartoggle.addEventListener("click" , ()=> {
    siderbar.classList.toggle("close")

    if(siderbar.classList.contains("close")){
        menubar.classList.remove("show")
        menubar2.classList.remove("show2")
    }
})

