$(document).ready(function(){
    function adjustSize(){

        let main = document.querySelector("main");
        let windowHeight = window.innerHeight;
        let baseHeight = main.clientHeight;

        if(baseHeight < windowHeight){
            main.style.height = windowHeight + "px";
        }

        else{
            main.style.height = "";
        }

    }

    adjustSize();


    /* CITATION MESSAGE */
    const cites = document.querySelectorAll(".cite");

    if(cites != undefined)
    {
        for(let cite of cites)
        {
            cite.addEventListener("click", function(){
                document.querySelector("#post").innerText = "\"" + this.offsetParent.offsetParent.offsetParent.childNodes[3].innerText + "\""
            })
        }
    }

    /* EDIT MESSAGE */
    let edits = document.querySelectorAll(".edit-msg")
    
    for(let edit of edits)
    {
        edit.addEventListener("click", function(){
            console.log(this.offsetParent.offsetParent.offsetParent.childNodes[3]);
            let tag = this.offsetParent.offsetParent.offsetParent.childNodes[3];
            let content = this.offsetParent.offsetParent.offsetParent.childNodes[3].innerText;
            
            let form = document.createElement("textarea");

            tag.parentNode.replaceChild(form, tag);
            form.innerText = content;
        })
    }

})


