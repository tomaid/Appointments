class Appointments {
    async creareProgramare() {
        let medic = document.getElementById("lista_medici");
        let data_programarii = document.getElementById("datepicker");
        let ora_programare = document.getElementById("ora_prog");
        let data_mod = data_programarii.value.replaceAll("/", "-");
        let params = {
            medicid: medic.value,
            data: data_mod,
            ora: ora_programare.value,
        }
        const resc = await fetch('http://localhost:8082/backend/controller/insert-appointment.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(params)
        }).then(resp => {
            if (resp.status == 200) {
                console.log("salvat cu succes");
                window.location.replace("appointments.html");
            }
            if (resp.status == 406) {
                console.log("a aparut o eroare la logare 406");
                Auth.logout();
            }
        }).catch(error => {
            console.log("a aparut o eroare la logare catch 406");
            Auth.logout();
        });

    }
	async getDoctors() {
        let doctori = document.getElementById("lista_medici");
        doctori.innerHTML = "";
        try {
            const res = await fetch('http://localhost:8082/backend/controller/list-doctors.php');
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let opt = document.createElement("option");
                    opt.innerText = data[i]['nume'] + " " + data[i]['prenume'];
                    opt.value = data[i]['id'];
                    doctori.appendChild(opt);
                }
            }
            if (res.status == 406) {
                Auth.logout();
            }
        } catch (error) {
            Auth.logout();
        }

    }


    async getOre(date) {
        let doctori = document.getElementById("lista_medici");
        let datepicker = document.getElementById("datepicker");
        let data_mod = date.replaceAll("/", "-");
        let groupore = document.getElementById("gropore");
        groupore.classList.remove("group-hide");
        for (let k = 8; k < 17; k++) {
            document.getElementById("programare" + k).classList.remove("group-hide");

        }
        try {
            const res = await fetch('http://localhost:8082/backend/controller/check-appointments.php?medicid=' + doctori.value.trim() + '&data=' + data_mod.trim());
            if (res.status == 200) {
                const data = await res.json();
                for (let k = 8; k < 17; k++) {
                    let button = document.getElementById("programare" + k);
                    button.classList.remove("btn-danger");
                   // button.setAttribute("disabled", "disabled");

                }
                for (let i = 0; i < data.length; i++) {
                    let button = document.getElementById("programare" + data[i])
                    button.classList.add("btn-danger");
                    button.setAttribute("disabled", "disabled");

                }
            }
            if (res.status == 406) {
              //  Auth.logout();
            }
        } catch (error) {
            Auth.logout();
        }
    }
    setOra(ora) {
        let ora_prog = document.getElementById("ora_prog");
        if (ora_prog.value == ora) {
            ora_prog.value = "";
        }
        else {
            ora_prog.value = ora;
        }
        
        document.getElementById("finalizareprogramare").classList.add("group-hide");
        for (let i = 8; i < 17; i++) {
            document.getElementById("programare" + i).classList.remove("btn-primary");
            document.getElementById("programare" + i).classList.add("btn-secondary");
            
        }
        if (ora_prog.value) {
            document.getElementById("programare" + ora).classList.remove("btn-secondary");
            document.getElementById("programare" + ora).classList.add("btn-primary");
            document.getElementById("finalizareprogramare").classList.remove("group-hide");
        }
        

    }

    async changeStatus(status, id) {
        try {
            const res = await fetch('http://localhost:8082/backend/controller/change-status.php?appointid=' + id + '&status=' + status);
            if (res.status == 200) {
                window.location.replace("appointments.html");
            }
            if (res.status == 406) {
                Auth.logout();
            }
        } catch (error) {
            Auth.logout();
        }
    }

}
