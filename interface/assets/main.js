import create from './utils.js'

let anchor = document.querySelectorAll("article a")

// It'll be better if the data was store in ... localstorage ? 
for(let x=0; x<anchor.length; x++){
    anchor[x].addEventListener("click", (e) => {
        e.preventDefault()
        if(anchor[x].dataset.do == "false"){
            getCom(e.target.href, anchor[x].parentElement, anchor[x].dataset.val)
            anchor[x].dataset.do = "true"
            anchor[x].textContent = "Masquer les commentaires"
        }else{
           let val = document.getElementById(anchor[x].dataset.val)
           val.parentElement.removeChild(val)
            anchor[x].dataset.do = "false"
            anchor[x].textContent = "Voir les commentaires"
        }
    })
}

function getCom(link, elt, id){
    fetch(link)
    .then(rep => rep.json())
    .then(rep => {
       
        let div = create("div", "" , "commentaires", id)
        let com = rep[0].commentaires

        for(let x=0;x<com.length;x++){
            let title = create("h3", com[x].titre)
            let content = create("p", com[x].content)
            let jump = create("div", "", "jump")
            div.appendChild(title)
            div.appendChild(content)
            div.appendChild(jump)
       }
        elt.appendChild(div)
    })
}