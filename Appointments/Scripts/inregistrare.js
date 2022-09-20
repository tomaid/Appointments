class Inregistrare {
    afiseazaInregistrare(verifc) {
        let loginc = document.getElementById("logincard");
        let inregc = document.getElementById("registercard");
        if (verifc == "1") {
            loginc.classList.add("card-hide");
            inregc.classList.remove("card-hide");
            document.title = "Înregistrare";
        }
        else {
            loginc.classList.remove("card-hide");
            inregc.classList.add("card-hide");
            document.title = "Login";
        }
    }
    async verificaEmail(user) {
        let pattern = /^[\a-zA-Z0-9_\.]+@([\w-]+\.)+[\a-zA-Z-\.]{2,5}$/;
        let userid = document.getElementById(user);
        let user_error = document.getElementById(user + "-error");
        let user_error_message = document.getElementById(user + "-error-message");
        user_error.classList.add("card-hide");
        userid.classList.remove("alert-danger");
        
        if (!pattern.test(userid.value)) {
            userid.classList.add("alert-danger");
            user_error.classList.remove("card-hide");
            user_error_message.innerHTML = "Email-ul nu este valid";
            return (false);
        }
        const res = await fetch('http://localhost:8082/backend/controller/verifyEmail.php?email=' + userid.value);
        if (res.status==406) {
            userid.classList.add("alert-danger");
            user_error.classList.remove("card-hide");
            user_error_message.innerHTML = "Există un cont înregistrat cu acest e-mail!";
            return (false);
        }
        return (true);
        
    }
    verificaTel(tel) {

        let pattern = /^[0-9]{10,14}$/;
        let tel_error = document.getElementById(tel + "-error");
        let telid = document.getElementById(tel);
        telid.classList.remove("alert-danger");
        tel_error.classList.add("card-hide");
        if (!pattern.test(telid.value)) {
            telid.classList.add("alert-danger");
            tel_error.classList.remove("card-hide");
            return (false);
        }
        else {
            return (true);
        }

    }
    
    async insertUser(user, pass, type, tel, nume, prenume) {


        let pass_error = document.getElementById(pass + "-error");
        let type_error = document.getElementById(type + "-error");
        let type_error_message = document.getElementById(type + "-error-message");
        let passid = document.getElementById(pass);
        let numeid = document.getElementById(nume);
        let prenumeid = document.getElementById(prenume);
        let typeid = document.getElementById(type);
        let userid = document.getElementById(user);
        let telid = document.getElementById(tel);
        passid.classList.remove("alert-danger");
        typeid.classList.remove("alert-danger");
        pass_error.classList.add("card-hide");
        type_error.classList.add("card-hide");
        if (!numeid.value) {
            numeid.classList.add("alert-danger");
            return (0);
        } else {
            numeid.classList.remove("alert-danger");
        }
        if (!prenumeid.value) {
            prenumeid.classList.add("alert-danger");
            return (0);
        } else {
            prenumeid.classList.remove("alert-danger");
        }
        let verifmail = await this.verificaEmail(user);
        if (!verifmail) {
            return (0);
        }
      
        if (!passid.value) {
            passid.classList.add("alert-danger");
            pass_error.classList.remove("card-hide");
            return (0);
        }
        if (!this.verificaTel(tel)) {
            return (0);
        }
        if (!typeid.value) {
            typeid.classList.add("alert-danger");
            type_error.classList.remove("card-hide");
            return (0);
        }
        let numefinal = numeid.value.charAt(0).toUpperCase() + numeid.value.slice(1);
        let prenumefinal = prenumeid.value.charAt(0).toUpperCase() + prenumeid.value.slice(1);
        let userfinal = userid.value.toLowerCase();
        let params = {
            nume: numefinal,
            prenume: prenumefinal,
            user: userfinal,
            pass: passid.value,
            tel: telid.value,
            type: typeid.value

        }
        const resc = await fetch('http://localhost:8082/backend/controller/register.php', {
        
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(params)
        }).then(response => {
            if (response.status == 200) {
                type_error.classList.add("card-hide");
                console.log("datele au fost introduse cu succes");
                window.location.replace("appointments.html");
            }
            if (response.status == 406) {
                type_error.classList.remove("card-hide");
                type_error_message.innerHTML = "Datele introduse nu sunt valide";
                console.log("a aparut o eroare la inregistrare 406");
            }
        }).catch (err => {
            type_error.classList.remove("card-hide");
            type_error_message.innerHTML = "Datele introduse nu sunt valide";
            console.log("a aparut o eroare la inregistrare");
        });
      
    }
    insertUserEnter(user, pass, type,tel, nume, prenume) {
        if (event.keyCode === 13) {
            this.insertUser(user, pass, type,tel, nume, prenume);
        }

    }
}
