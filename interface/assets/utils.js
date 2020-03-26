export default function create(element, text = false, style = false, id = false){
    let elt = document.createElement(element)
    if(text){
        elt.textContent = text
    }
    if(style){
        elt.classList.add(style)
    }
    if(id){
        elt.id = id
    }
    return elt
}