/* STICKY NAV BAR */

$(window).on("scroll", function(){
    if($(window).scrollTop()){
        $("nav").addClass("sticky");
    }
    else{
        $('nav').removeClass("sticky");
    }
});

/* Ajoute la class active a l'élément de la nav qui est en cours d'activation */

let url = $(location).attr("href");
let navItems = document.querySelectorAll(".navitem");
let found = false;
for(let item of navItems){

    let str = item.getAttribute("href");
    str = str.substring(15, 25);

    if(url.match(str) && str !== ""){
        item.classList.add("active");
        found = true;
    }
    else{
        item.classList.remove("active");
    }

}

if(found === false){
    document.querySelector(".home").classList.add("active");
}









