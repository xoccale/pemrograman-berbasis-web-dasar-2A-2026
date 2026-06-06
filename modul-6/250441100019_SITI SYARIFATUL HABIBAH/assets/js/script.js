function toggleDarkMode(){

    document.documentElement.classList.toggle("dark");

    if(document.documentElement.classList.contains("dark")){
        localStorage.setItem("theme", "dark");
    } else {
        localStorage.setItem("theme", "light");
    }
}

window.onload = function(){

    let theme = localStorage.getItem("theme");

    if(theme === "dark"){
        document.documentElement.classList.add("dark");
    }
}

function confirmDelete(){
    return confirm("Yakin ingin menghapus task ini?");
}

function formSubmitMessage(){
    alert("Data sedang diproses...");
}

function validateTaskForm(){

    let deadline = document.getElementById("deadline");

    if(deadline){

        let today = new Date().toISOString().split("T")[0];

        if(deadline.value < today){
            alert("Deadline tidak boleh tanggal yang sudah lewat!");
            return false;
        }
    }

    return true;
}