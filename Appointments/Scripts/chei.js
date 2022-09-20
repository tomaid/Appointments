class CheiStraine {
    async listCheiStraine() {
        let a = [];
        try {
            const res = await fetch('http://localhost:8082/backend/controller/cheis-text.php');
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let b = [data[i]['baza_de_date'], data[i]['tabela'], data[i]['coloana'], data[i]['constrangere'], data[i]['tabela_referita'], data[i]['coloana_referita'], data[i]['tip_coloana']];
                    a.push(b);
                }
            }
            if (res.status == 406) {
                Auth.logout();

            }
        } catch (error) {
            console.log("nu exista coloane");
        }
        this.creareTd(a);
    }
    creareTd(b) {
        let a = b;
        if (a.length > 0) {

            let dbtable = document.getElementById("dbtable");
            dbtable.innerHTML = "";
            for (let j = 0; j < a.length; j++) {
                let otr = document.createElement("tr");

                let baza_de_date = document.createElement("td");
                baza_de_date.className = "align-middle";
                baza_de_date.innerText = a[j][0];
                otr.appendChild(baza_de_date);

                let bd_coloana = document.createElement("td");
                bd_coloana.className = "align-middle";
                bd_coloana.innerText = a[j][2];
                otr.appendChild(bd_coloana);

                let bd_tabela = document.createElement("td");
                bd_tabela.className = "align-middle";
                bd_tabela.innerText = a[j][1];
                otr.appendChild(bd_tabela);

                let bd_coloana_referita = document.createElement("td");
                bd_coloana_referita.className = "align-middle";
                bd_coloana_referita.innerText = a[j][5] + " (" + a[j][6] + ")";
                otr.appendChild(bd_coloana_referita);

                let bd_tabela_referita = document.createElement("td");
                bd_tabela_referita.className = "align-middle";
                bd_tabela_referita.innerText = a[j][4];
                otr.appendChild(bd_tabela_referita);

                let bd_constrangere = document.createElement("td");
                bd_constrangere.className = "align-middle";
                bd_constrangere.innerText = a[j][3];
                otr.appendChild(bd_constrangere);
                otr.setAttribute("onclick", "Chei.openModl('" + a[j][0] + "','" + a[j][1] + "','" + a[j][2] + "','" + a[j][3] + "','" + a[j][4] + "','" + a[j][5] + "')");
                // otr.className = "nav-link active";
                otr.setAttribute("data-toggle", "modal");
                otr.setAttribute("data-target", "#exampleModal");

                dbtable.appendChild(otr);

            }
        }
    }
    async openModl(bd, tabela, coloana, nume_constrangere, tabela_referita, coloana_referita) {
        document.getElementById("modificarecheiestraina").classList.add("group-hide");
        document.getElementById("mdl_span_idtabela").innerHTML = "";
        let mdl_span_idtabela = document.getElementById("mdl_span_idtabela");
        let mdl_span_idcoloana = document.getElementById("mdl_span_idcoloana");
        mdl_span_idcoloana.innerHTML = "";
        mdl_span_idcoloana.className = "";
        mdl_span_idtabela.innerHTML = "";
        mdl_span_idtabela.className = "";
        let mdl_baza_de_date = document.getElementById("mdl_baza_de_date");
        let mdl_coloana = document.getElementById("mdl_coloana");
        let mdl_tabela = document.getElementById("mdl_tabela");
        let mdl_nume_constrangere = document.getElementById("mdl_nume_constrangere");
        let statusmodif = document.getElementById("statusmodif");
        statusmodif.className = "";
        statusmodif.innerHTML = "";
        mdl_nume_constrangere.value = nume_constrangere;
        mdl_baza_de_date.value = bd;
        mdl_tabela.value = tabela;
        mdl_coloana.value = coloana;

        let mdl_coloana_ref = document.getElementById("mdl_coloana_referinta");
        mdl_coloana_ref.innerHTML = "";
        let optc = document.createElement("option");
        optc.innerText = 'Selectati';
        optc.value = '';
        mdl_coloana_ref.appendChild(optc);

        let mdl_tabela_referinta = document.getElementById("mdl_tabela_referinta");
        mdl_tabela_referinta.innerHTML = "";
        let opt = document.createElement("option");
        opt.innerText = 'Selectati';
        opt.value = '';
        mdl_tabela_referinta.appendChild(opt);
        try {
            const res = await fetch('http://localhost:8082/backend/controller/list-tables.php?bd=' + bd);
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let opt = document.createElement("option");
                    opt.innerText = data[i]['nume'];
                    opt.value = data[i]['nume'];
                    mdl_tabela_referinta.appendChild(opt);
                }
            }
            if (res.status == 406) {
                Auth.logout();
            }
        } catch (error) {
            mdl_span_idtabela.className = "alert alert-danger";
            mdl_span_idtabela.innerHTML = "Nu exista tabele in aceasta baza de date.";
        }
    }
    async cautaColoane(tabela) {
        let mdl_span_idcoloana = document.getElementById("mdl_span_idcoloana");
        mdl_span_idcoloana.className = "";
        mdl_span_idcoloana.innerHTML = "";
        let mdl_span_idtabela = document.getElementById("mdl_span_idtabela");
        mdl_span_idtabela.className = "";
        mdl_span_idtabela.innerHTML = "";
        let mdl_baza_de_date = document.getElementById("mdl_baza_de_date");
        let mdl_coloana_ref = document.getElementById("mdl_coloana_referinta");
        mdl_coloana_ref.innerHTML = "";
        let opt = document.createElement("option");
        opt.innerText = 'Selectati';
        opt.value = '';
        mdl_coloana_ref.appendChild(opt);
        try {
            const res = await fetch('http://localhost:8082/backend/controller/list-columns.php?tabela=' + tabela + '&bd=' + mdl_baza_de_date.value);
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let opt = document.createElement("option");
                    opt.innerText = data[i]['nume'];
                    opt.value = data[i]['nume'];
                    mdl_coloana_ref.appendChild(opt);
                }
            }
            document.getElementById("modificarecheiestraina").classList.remove("group-hide");
            if (res.status == 406) {
                mdl_span_idtabela.className = "alert alert-danger";
                mdl_span_idtabela.innerHTML = "Alegetei o tabela";
            }
        } catch (error) {
            mdl_span_idcoloana.className = "alert alert-danger";
            mdl_span_idcoloana.innerHTML = "Nu exista coloane in aceasta tabela";
        }

    }

    async modificareModl() {
        let mdl_span_idtabela = document.getElementById("mdl_span_idtabela");
        let mdl_tabela_referinta = document.getElementById("mdl_tabela_referinta");
        let mdl_coloana_referinta = document.getElementById("mdl_coloana_referinta");
        mdl_span_idtabela.className = "";
        mdl_span_idtabela.innerHTML = "";
        let mdl_span_idcoloana = document.getElementById("mdl_span_idcoloana");
        mdl_span_idcoloana.innerHTML = "";
        mdl_span_idcoloana.className = "";
        if (mdl_tabela_referinta.value == "") {
            mdl_span_idtabela.className = "alert alert-danger";
            mdl_span_idtabela.innerHTML = "Selectati o tabela!";
            return (false);
        }
        if (mdl_coloana_referinta.value == "") {
            mdl_span_idcoloana.className = "alert alert-danger";
            mdl_span_idcoloana.innerHTML = "Selectati o coloana";
            return (false);
        }
        let mdl_baza_de_date = document.getElementById("mdl_baza_de_date");
        let mdl_coloana = document.getElementById("mdl_coloana");
        let mdl_tabela = document.getElementById("mdl_tabela");
        let mdl_nume_constrangere = document.getElementById("mdl_nume_constrangere");
        let statusmodif = document.getElementById("statusmodif");
        console.log(mdl_baza_de_date.value + ", " + mdl_tabela.value + ", " + mdl_coloana.value + ", " + mdl_tabela_referinta.value + ", " + mdl_coloana_referinta.value + ", " + mdl_nume_constrangere.value);
        let params = {
            mdl_baza_de_date: mdl_baza_de_date.value,
            mdl_coloana: mdl_coloana.value,
            mdl_tabela: mdl_tabela.value,
            mdl_tabela_referinta: mdl_tabela_referinta.value,
            mdl_coloana_referinta: mdl_coloana_referinta.value,
            mdl_nume_constrangere: mdl_nume_constrangere.value
        }
        let url = "http://localhost:8082/backend/controller/actualizare-cheistraine.php";
        this.fetchAsync(url, params).then(resp => {
            if (resp[0]['cod'] == 200) {
                statusmodif.className = "alert alert-success";
                statusmodif.innerHTML = "Tabela a fost actualizata!";
                                setTimeout(function () {
                                    window.location.replace("admin.html");
                                }, 4000);
            } else {
                if (resp[0]['cod'] == 452) {
                    statusmodif.className = "alert alert-danger";

                    statusmodif.innerHTML = 'Exista randuri in coloana "' + mdl_coloana.value + '" din tabela de date "' + mdl_tabela.value +

                        '" care nu au referinta in coloana "' + mdl_coloana_referinta.value + '" din tabela de date "'
                        + mdl_tabela_referinta.value + '". Cautati dangling pointers pentru constrangerea ' + mdl_nume_constrangere.value + ', rezolvati eroarea si incercati din nou sau alegeti alta tabela.<br>Error code: 1452.';
                    //statusmodif.innerHTML = resp.message;
                    // console.log(resp.message + " " + resp.text);
                } else {
                    statusmodif.className = "alert alert-danger";

                    statusmodif.innerHTML = resp[0]['mesaj'];
                }
                   return (false);
            }
        }).catch(error => {
           statusmodif.className = "alert alert-danger";
           // statusmodif.innerHTML = "A aparut o eroare in baza de date";
            statusmodif.innerHTML = error.message;
            // console.log(error.message);
            return (false);
        });
    }
    async fetchAsync(url, params) {
        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(params)
        });
        return await response.json();
    }
}