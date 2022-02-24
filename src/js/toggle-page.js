const page1 = document.querySelector(".page1");
const page2 = document.querySelector(".page2");
const button1= document.querySelector(".button1");
const button2 = document.querySelector('.button2');
console.log(button2);

button2.addEventListener("click",function(){
    page1.classList.add("hidden" );
    button2.classList.add("activeBtn" );
    page2.classList.remove("hidden");
    button1.classList.remove("activeBtn");
});

button1.addEventListener("click",function(){
    page2.classList.add("hidden");
    page1.classList.remove("hidden");
    button1.classList.add("activeBtn" );
    button2.classList.remove("activeBtn");


});