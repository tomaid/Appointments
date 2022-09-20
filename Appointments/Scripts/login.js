class Login {
    verificaEmail(user) {
        let pattern = /^[\a-zA-Z0-9_\.]+@([\w-]+\.)+[\a-zA-Z-\.]{2,5}$/;
        user.classList.remove("alert-danger");
        user.classList.remove("alert-danger");

        if (!pattern.test(user.value)) {
            user.classList.add("alert-danger");
            user.value = "";
            user.placeholder = "E-mail incorect";
            return (false);
        }
        else {
            return (true);
        }
    }
    async verificareLogin(user, pass) {
    
        var user = document.getElementById(user);
        var pass = document.getElementById(pass);
        let user_error = document.getElementById("user-login-error");
        let user_error_message = document.getElementById("user-login-error-message");
            if (!this.verificaEmail(user)) {
                return (0);
            }
        if (pass.value == "") {
            pass.placeholder = "Introduceți parola";
            pass.classList.add("alert-danger");
            return (0);
        }

        let params = {
            user: user.value.toLowerCase(),
            pass: pass.value
        }
        const resc = await fetch('http://localhost:8082/backend/controller/login.php', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(params)
        }).then(resp => {
            if (resp.status == 200) {
                user_error.classList.add("card-hide");
                console.log("e logat succes");
                /*window.location.replace("appointments.html");*/
                window.location.replace("admin.html");

            }
            if (resp.status == 406) {
                user_error.classList.remove("card-hide");
                user_error_message.innerHTML = "Datele introduse nu sunt valide";
                console.log("a aparut o eroare la logare 406");
            }
        }).catch(error => {
            user_error.classList.remove("card-hide");
            user_error_message.innerHTML = "Datele introduse nu sunt valide";
            console.log("a aparut o eroare la logare catch 406");
            return (0);
        })

    }
    keypressEnter(user,pass) {
        if (event.keyCode === 13) {
            this.verificareLogin(user, pass);
        }

    }
}
