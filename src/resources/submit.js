document.querySelector("#main-form").addEventListener("submit", function(e){
    
    let valid = true;
    document.querySelectorAll(".script-value textarea").forEach(textarea => {
        if(!textarea.value) {
            textarea.classList.add("invalid");
            valid = false;
        } else {
            textarea.classList.remove("invalid");
        }
    });

    if(!valid) {
        e.preventDefault();
    }
});