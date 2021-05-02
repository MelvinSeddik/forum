const labels = document.querySelectorAll(".form-container label");

for(let label of labels){
    label.addEventListener("click", function(){
        console.log(this);
        this.control.style.height = "45px";
        this.style.transform = "translateY(-45px)";
        this.control.classList.add("my-style");
        this.control.removeAttribute("disabled");
    })

}