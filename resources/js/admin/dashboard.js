//////////////////// STUDENTS ////////////////////

document.addEventListener('DOMContentLoaded', function () {
    const menuIcon = document.getElementById('menuIcon');
    const menu = document.getElementById('menu');

    menuIcon.addEventListener('click', function () {
        menu.classList.toggle('hidden');
    });
});



// this is for the color of the table 
window.onload = function() {
    const table = document.getElementById("data-table");
    const rows = table.getElementsByTagName("tr");
    for (const i = 1; i < rows.length; i++) {
        const cells = rows[i].getElementsByTagName("td");
        for (const j = 0; j < cells.length; j++) {
            if (i % 2 === 0) {
                // Even row
                cells[j].classList.add("bg-even");
            } else {
                // Odd row
                cells[j].classList.add("bg-odd");
            }
        }
    }
};
