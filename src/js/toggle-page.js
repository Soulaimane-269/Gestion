const page1 = document.querySelector('.page1');
const page2 = document.querySelector('.page2');
const button1= document.querySelector('.button1');
const button2= $(".button2");
console.log(button2);

button2.addEventListener('click',function(){
    page1.style.display="none";
})