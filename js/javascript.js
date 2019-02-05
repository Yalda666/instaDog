function $(param) {
    return document.querySelector(param);
}

function change(e) {
    console.log(e.files[0].name);
    $('#image').setAttribute('src', "images/" + e.files[0].name);

}


