class TabelAppointments {
    async getAppointments() {
        let type = 0;
        try {
            const res = await fetch('http://localhost:8082/backend/controller/acces.php');
            if (res.status == 200) {
                type = await res.json();
                if (type == 3) window.location.replace("admin.html");
            }
            if (res.status == 406) {
                Auth.logout();
            }
        } catch (error) {
            Auth.logout();
        }
        let a = [];
        try {
            const res = await fetch('http://localhost:8082/backend/controller/list-appointments.php');
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let b = [data[i]['date_sort'], data[i]['aprobap'], data[i]['idap'], data[i]['date_app'], data[i]['numeap'] + " " + data[i]['prenumeap'], data[i]['emailap'], data[i]['telap']];
                    a.push(b);
                }
            }
            if (res.status == 406) {
                Auth.logout();
                
            }
        } catch (error) {
            console.log("lista goala");
        }
        /*
        a.sort(function sortFunction(a, b) {
            if (a[0] === b[0]) {
                return 0;
            }
            else {
                return (a[0] > b[0]) ? -1 : 1;
            }
        });
        */
        if (type == 2) {
            numepm.innerText = "Nume pacient";
            let appointmentstable = document.getElementById("appointmentstable");
            appointmentstable.innerHTML = "";
            for (let j = 0; j < a.length; j++) {
                
                let otr = document.createElement("tr");
                var status = "Neconfirmat";
                switch (a[j][1]) {
                    case 1:
                        status = "Neconfirmat";
                        otr.className = "table-warning";
                        break;
                    case 2:
                        status = "Aprobat";
                        otr.className = "table-success";
                        break;
                    case 3:
                        status = "Anulat de pacient";
                        otr.className = "table-secondary";
                        break;
                    case 4:
                        status = "Refuzat de medic";
                        otr.className = "table-danger";
                        break;
                    default:
                        status = "Neconfirmat";
                }
   
                let menubutton = this.createbuttondoctor(a[j][2]);
                let otds = document.createElement("td");
                otds.innerText = status;
                otr.appendChild(otds);
             
                for (let k = 3; k < a[j].length; k++) {
                    let otd = document.createElement("td");
                    otd.innerText = a[j][k];
                    otr.appendChild(otd);
                }
                let otdb = document.createElement("td");
                otdb.appendChild(menubutton);
                otr.appendChild(otdb);
                appointmentstable.appendChild(otr);
            }
          
        }
        if (type == 1) {
            numepm.innerText = "Nume doctor";
            let appointmentstable = document.getElementById("appointmentstable");
            appointmentstable.innerHTML = "";
            for (let j = 0; j < a.length; j++) {
                let otr = document.createElement("tr");
                var status = "Neconfirmat";
                let menubutton = document.createElement("a");
                menubutton.innerText = "Anulează";
                switch (a[j][1]) {
                    case 1:
                        status = "Neconfirmat";
                        otr.className = "table-warning";
                        break;
                    case 2:
                        status = "Aprobat";
                        otr.className = "table-success";
                        break;
                    case 3:
                        status = "Anulat de pacient";
                        otr.className = "table-secondary";
                        menubutton.innerText = "Anulat";
                        break;
                    case 4:
                        status = "Refuzat de medic";
                        otr.className = "table-danger";
                        menubutton.innerText = "Anulat";
                        break;
                    default:
                        status = "Neconfirmat";
                }
                menubutton.setAttribute("onClick", "Appointments.changeStatus('3','" + a[j][2] + "')");
                menubutton.className = "btn btn-danger input-xsl";
                let otds = document.createElement("td");
                otds.innerText = status;
                otr.appendChild(otds);

                for (let k = 3; k < a[j].length; k++) {
                    let otd = document.createElement("td");
                    otd.innerText = a[j][k];
                    otr.appendChild(otd);
                }
                let otdb = document.createElement("td");
                otdb.appendChild(menubutton);
                otdb.className = "align-middle";
                otr.appendChild(otdb);
                appointmentstable.appendChild(otr);
            }

        }
    }
    createbuttondoctor(id) {
        let odiv = document.createElement("select");
        odiv.setAttribute("onChange", "Appointments.changeStatus(this.value,'" + id + "')");
        odiv.className = "form-select";
        let obut = document.createElement("option");
        obut.innerText = "Opțiuni";
        obut.setAttribute("selected", "selected");
        obut.setAttribute("disabled", "disabled");
        odiv.appendChild(obut);
        let obut1 = document.createElement("option");
        obut1.innerText = "Confirmă";
        obut1.value = "2";
        odiv.appendChild(obut1);
        let obut2 = document.createElement("option");
        obut2.innerText = "Refuză";
        obut2.value = "4";
        odiv.appendChild(obut2);
        return odiv;
    }
}