import create from './utils.js'

let anchor = document.querySelectorAll("article a")

// It'll be better if the data was store in ... localstorage ? 
for(let x=0; x<anchor.length; x++){
    anchor[x].addEventListener("click", (e) => {
        e.preventDefault()
        if(e.target.dataset.do == "false"){
            getCom(e.target.href, e.target.parentElement, e.target.dataset.val)
            e.target.dataset.do = "true"
            e.target.textContent = "Masquer les commentaires"
        }else{
           let val = document.getElementById(e.target.dataset.val)
           val.parentElement.removeChild(val)
           e.target.dataset.do = "false"
           e.target.textContent = "Voir les commentaires"
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

// Faut pas trop appuyé sur voir et masquer les commentaires hein, sinon ca déclenche de drole de chose ..