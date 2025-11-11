// ================== Show/Hide Password Section ==================
function togglePasswordSection() {
    const section = document.getElementById('password-section');
    if (section) {
        section.style.display = section.style.display === 'none' ? 'block' : 'none';
    }
}

// ================== Filter Table By Column Index ==================
function filterTable(columnIndex) {
    const input = document.getElementById("filterInput" + columnIndex);
    const filter = input.value.toUpperCase();
    const table = document.getElementById("volumeTable");
    const tr = table.getElementsByTagName("tr");

    for (let i = 1; i < tr.length; i++) {
        const td = tr[i].getElementsByTagName("td")[columnIndex];
        if (td) {
            const txtValue = td.textContent || td.innerText;
            tr[i].style.display = txtValue.toUpperCase().indexOf(filter) > -1 ? "" : "none";
        }
    }
}

document.addEventListener('DOMContentLoaded', () => {
    console.log("main.js loaded ✅");

    // ================== Password Visibility Toggle ==================
    document.querySelectorAll('.toggle-password').forEach(btn => {
        btn.addEventListener('click', function () {
            const target = document.querySelector(this.getAttribute('data-target'));
            if (target) {
                target.type = target.type === 'password' ? 'text' : 'password';
                this.innerText = target.type === 'password' ? '👁️' : '🙈';
            }
        });
    });

    // ================== Form Validation ==================
    document.querySelectorAll('form.needs-validation').forEach(form => {
        form.addEventListener('submit', function (e) {
            if (!form.checkValidity()) {
                e.preventDefault();
                e.stopPropagation();
                alert("Please fill all required fields!");
            }
            form.classList.add('was-validated');
        });
    });

    // ================== Auto-Hide Success Message ==================
    const successMsg = document.querySelector('.alert-success');
    if (successMsg) {
        setTimeout(() => {
            successMsg.style.display = 'none';
        }, 3000);
    }

    // ================== Table Live Search ==================
    document.querySelectorAll('.live-search').forEach(input => {
        input.addEventListener('keyup', function () {
            const value = this.value.toLowerCase();
            const targetTable = document.querySelector(this.getAttribute('data-target'));
            if (targetTable) {
                const rows = targetTable.querySelectorAll('tbody tr');
                rows.forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(value) ? '' : 'none';
                });
            }
        });
    });

    // ================== Confirm Before Action ==================
    document.querySelectorAll('[data-confirm]').forEach(button => {
        button.addEventListener('click', (e) => {
            if (!confirm(button.getAttribute('data-confirm'))) {
                e.preventDefault();
            }
        });
    });

    // ================== Side Menu Toggle ==================
    const menuToggle = document.getElementById('menu-toggle');
    if (menuToggle) {
        menuToggle.addEventListener('click', () => {
            document.body.classList.toggle('menu-open');
        });
    }

    // ================== Navbar Menu (Mobile) ==================
    const navbarMenu = document.querySelector(".navbar .links");
    const hamburgerBtn = document.querySelector(".hamburger-btn");
    const hideMenuBtn = navbarMenu?.querySelector(".close-btn");

    if (hamburgerBtn && navbarMenu) {
        hamburgerBtn.addEventListener("click", () => {
            navbarMenu.classList.toggle("show-menu");
        });
    }

    if (hideMenuBtn && hamburgerBtn) {
        hideMenuBtn.addEventListener("click", () => {
            hamburgerBtn.click();
        });
    }

    // ================== Login Popup ==================
    const showPopupBtn = document.querySelector(".login-btn");
    const formPopup = document.querySelector(".form-popup");
    const hidePopupBtn = formPopup?.querySelector(".close-btn");
    const signupLoginLinks = formPopup?.querySelectorAll(".bottom-link a");

    if (showPopupBtn && formPopup && hidePopupBtn) {
        showPopupBtn.addEventListener("click", () => {
            document.body.classList.toggle("show-popup");
        });

        hidePopupBtn.addEventListener("click", () => {
            showPopupBtn.click();
        });

        signupLoginLinks?.forEach(link => {
            link.addEventListener("click", (e) => {
                e.preventDefault();
                formPopup.classList[link.id === 'signup-link' ? 'add' : 'remove']("show-signup");
            });
        });
    }

    // ================== Current Time Display (Live) ==================
    const timeDisplay = document.getElementById('time-display');
    const currentTimeDisplay = document.getElementById('current-time');

    function updateTime() {
        const now = new Date();
        const options = {
            timeZone: 'Asia/Kolkata',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            year: 'numeric',
            month: 'short',
            day: '2-digit',
            hour12: true
        };
        if (currentTimeDisplay) {
            currentTimeDisplay.innerText = now.toLocaleString('en-IN', options);
        }
        if (timeDisplay) {
            timeDisplay.textContent = now.toLocaleString();
        }
    }

    setInterval(updateTime, 1000);
    updateTime();
});
window.addEventListener("beforeunload", function () {
    navigator.sendBeacon("../auth/record-session.php");
});

