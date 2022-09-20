class Auth{
    async verifyAuth() {
        try {
            const res = await fetch('http://localhost:8082/backend/controller/authenticated.php');
            if (res.status == 200) {
                const data = await res.json();
                this.nume = data['nume'];
                this.prenume = data['prenume'];
                this.user = data['user'];
                this.acces = data['acces'];
                var path = window.location.pathname;
                var page = path.split("/").pop();
                
                if (page !== "appointments.html") {
                    window.location.replace("/Appointments/appointments.html");
                } else {
                    let idpersoana = document.getElementById("id");
                    idpersoana.value = this.user;
                    let numecomplet = document.getElementById("numecomplet");
                    let numepacient = document.getElementById("nume_pacient");
                    numecomplet.innerHTML = this.prenume + " " + this.nume;
                    numepacient.value = this.prenume + " " + this.nume;
                }
            }
            if (res.status == 406) {
                this.logout();
            }
        } catch (error) {
            this.logout();
        }
    }
    async verifyAuthAdmin() {
        try {
            const res = await fetch('http://localhost:8082/backend/controller/authenticated.php');
            if (res.status == 200) {
                const data = await res.json();
                this.nume = data['nume'];
                this.prenume = data['prenume'];
                this.user = data['user'];
                this.acces = data['acces'];
                if (this.acces != 3) {
                    window.location.replace("/Appointments/index.html");
                } else {

                }
                var path = window.location.pathname;
                var page = path.split("/").pop();
                if (page !== "admin.html") {
                   // window.location.replace("/Appointments/admin.html");
                } else {
                    let idpersoana = document.getElementById("id");
                    idpersoana.value = this.user;
                    let numecomplet = document.getElementById("numecomplet");
                    let numepacient = document.getElementById("nume_pacient");
                    numecomplet.innerHTML = this.prenume + " " + this.nume;
                }
            }
            if (res.status == 406) {
                this.logout();
            }
        } catch (error) {
            this.logout();
        }
    }
    async logout() {
        await fetch('http://localhost:8082/backend/controller/logout.php');
        var path = window.location.pathname;
        var page = path.split("/").pop();
       if(page!=="login.html")
         window.location.replace("/Appointments/login.html");
        
    }

}