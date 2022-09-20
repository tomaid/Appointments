﻿class Filtru {
    filtrare() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("cautare");
        filter = input.value.toUpperCase();
        table = document.getElementById("appointment_table");
        tr = table.getElementsByTagName("tr");

        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[2];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
}