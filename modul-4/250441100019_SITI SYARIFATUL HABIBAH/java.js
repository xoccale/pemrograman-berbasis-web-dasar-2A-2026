document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();

    let valid = true;

    if (email === "") {
        document.getElementById("errorEmail").innerText = "Email wajib diisi";
        valid = false;
    } else {
        document.getElementById("errorEmail").innerText = "";
    }

    if (password === "") {
        document.getElementById("errorPassword").innerText = "Password wajib diisi";
        valid = false;
    } else {
        document.getElementById("errorPassword").innerText = "";
    }

    if (valid) {
        window.location.href = "halaman2.html";
    }
});

darkToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {

        document.body.style.backgroundColor = '#111827';
        document.body.style.color = 'white';
        document.querySelector('nav').style.backgroundColor = '#111827';

        const home = document.querySelector('#Home');
        home.style.backgroundColor = '#1f2937';

        } else {

        document.body.style.backgroundColor = '';
        document.body.style.color = '';

        document.querySelector('nav').style.backgroundColor = '';

        const home = document.querySelector('#Home');
        home.style.backgroundColor = '' ;

        const pages = document.querySelector('#pages');
        pages.style.backgroundColor = '';

        const courses = document.querySelector('#courses');
        courses.style.backgroundColor = '';

        document.querySelectorAll('.shadow-lg').forEach(card => {
            card.style.backgroundColor = '';
            card.style.color = '';
        });
    }
});

document.getElementById("googleBtn").addEventListener("click", function() {
    alert("⚠️ Fitur Sign in with Google belum tersedia");
});