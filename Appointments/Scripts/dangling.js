class DanglingPointers {
    async listDanglingPointersTables() {
        let tabela_dpd = document.getElementById("tabela_dp");
        try {
            const res = await fetch('http://localhost:8082/backend/controller/list-dangling-pointers-tables.php');
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let opt = document.createElement("option");
                    opt.innerText = data[i]['tabela'];
                    opt.value = data[i]['tabela'];
                    tabela_dpd.appendChild(opt);
                }
            }
            if (res.status == 406) {
                Auth.logout();

            }
        } catch (error) {
            console.log("nu exista coloane");
        }
    }
    async cautaColoane(numeTabela) {
        let dbtable = document.getElementById("dbtable");
        dbtable.innerHTML = "";
        let coloana_dpd = document.getElementById("coloana_dp");
        coloana_dpd.innerHTML = '';
        let opt = document.createElement("option");
        opt.innerText = 'Selectati';
        opt.value = '';
        coloana_dpd.appendChild(opt);
        try {
            const res = await fetch('http://localhost:8082/backend/controller/list-dangling-pointers-columns.php?tabela=' + numeTabela);
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let opt = document.createElement("option");
                    opt.innerText = data[i]['coloana'];
                    opt.value = data[i]['coloana'];
                    coloana_dpd.appendChild(opt);
                }
            }
            if (res.status == 406) {
            }
        } catch (error) {

        }

    }

    async listareDanglingPointers(numeColoana) {
        let dbtable = document.getElementById("dbtable");
        dbtable.innerHTML = "";
        let numeTabela = document.getElementById("tabela_dp");
        let a = [];
        try {
            const res = await fetch('http://localhost:8082/backend/controller/list-dangling-pointers.php?tabela=' + numeTabela.value + '&coloana=' + numeColoana);
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let b = [data[i]['id'], data[i]['date'], data[i]['tabela'], data[i]['coloana'], data[i]['coloana_id']];
                    a.push(b);
                }
            }
            if (res.status == 406) {
                Auth.logout();

            }
            if (res.status == 453) {
                let nu_ex = "Nu exista dangling pointers! in tabela " + tabela_dp.value + " pe coloana " + coloana_dp.value + ".";

                let b = ["", nu_ex, "", "", ""];
                a.push(b);
            }
        } catch (error) {
            console.log("nu exista coloane");
        }
        this.creareTd(a);
    }
    creareTd(b) {
        let numeColoana = document.getElementById("coloana_dp");
        let numeTabela = document.getElementById("tabela_dp");
        let a = b;
        if (a.length > 0) {

            let dbtable = document.getElementById("dbtable");
            dbtable.innerHTML = "";
            for (let j = 0; j < a.length; j++) {
                if (a[j][0] === "") {
                    numeColoana.value = "";
                    numeTabela.value = "";
                }
                let otr = document.createElement("tr");

                let baza_de_date = document.createElement("td");
                baza_de_date.className = "align-middle";
                baza_de_date.innerText = a[j][1];
                otr.appendChild(baza_de_date);

                let bd_coloana = document.createElement("td");
                bd_coloana.className = "align-middle";
                bd_coloana.innerText = numeTabela.value;
                otr.appendChild(bd_coloana);

                let bd_tabela = document.createElement("td");
                bd_tabela.className = "align-middle";
                bd_tabela.innerText = numeColoana.value;
                otr.appendChild(bd_tabela);

                let bd_coloana_referita = document.createElement("td");
                bd_coloana_referita.className = "align-middle";
                bd_coloana_referita.innerText = a[j][2];
                otr.appendChild(bd_coloana_referita);

                let bd_tabela_referita = document.createElement("td");
                bd_tabela_referita.className = "align-middle";
                bd_tabela_referita.innerText = a[j][3];
                otr.appendChild(bd_tabela_referita);
                otr.setAttribute("onclick", "danglingPointers.openModl('" + a[j][0] + "','" + a[j][1] + "','" + numeTabela.value + "','" + numeColoana.value + "','" + a[j][2] + "','" + a[j][3] + "','" + a[j][4] +"')");
                // otr.className = "nav-link active";
                otr.setAttribute("data-toggle", "modal");
                otr.setAttribute("data-target", "#exampleModal");
                dbtable.appendChild(otr);
            }
        }
    }
    async openModl(idRand, rand, tabela, coloana, tabela_referita, coloana_referita, coloana_nume) {
       // console.log(idRand + ', ' + rand + ', ' + coloana + ', ' + tabela + ', ' + tabela_referita + ', ' + coloana_referita + ', ' + coloana_nume);
        let s_idRand = document.getElementById("f_idRand");
        let s_colRand = document.getElementById("f_colRand");
        let s_rand = document.getElementById("f_rand");
        let s_tabela = document.getElementById("f_tabela");
        let s_coloana = document.getElementById("f_coloana");
        let s_referinta = document.getElementById("f_referinta");
        s_idRand.value = idRand;
        s_rand.value = rand;
        s_tabela.value = tabela;
        s_coloana.value = coloana;
        s_colRand.value = coloana_nume;
        s_referinta.innerHTML = tabela_referita + " (" + coloana_referita + ")";
        let s_randReferinta = document.getElementById("randReferinta");
        s_randReferinta.innerHTML = "";
        let opt = document.createElement("option");
        opt.innerText = 'Selectati';
        opt.value = '';
        s_randReferinta.appendChild(opt);
        try {
            const res = await fetch('http://localhost:8082/backend/controller/list-dangling-pointers-referenced-tables.php?tabela=' + tabela_referita + '&coloana=' + coloana_referita );
            if (res.status == 200) {
                const data = await res.json();
                for (let i = 0; i < data.length; i++) {
                    let opt = document.createElement("option");
                    opt.innerText = data[i]['date'];
                    opt.value = data[i]['id'];
                    s_randReferinta.appendChild(opt);
                }
            }
            
            if (res.status == 406) {
              //  Auth.logout();

            }
        } catch (error) {
            console.log("nu exista coloane");
        }

    }

    async ActualizareDP() {
        let s_id = document.getElementById("f_idRand");
        let s_ref = document.getElementById("randReferinta");
        let s_tab = document.getElementById("f_tabela");
        let s_col = document.getElementById("f_coloana");
        let s_colRand = document.getElementById("f_colRand");
        let mdl_span_idcoloana = document.getElementById("mdl_span_idcoloana");
        mdl_span_idcoloana.innerHTML = "";
        mdl_span_idcoloana.className = "";
        if (s_ref.value == "") {
            mdl_span_idcoloana.className = "alert alert-danger";
            mdl_span_idcoloana.innerHTML = "Selectati o tabela!";
            return (false);
        }
        let params = {
            rand_id: s_id.value,
            referinta: s_ref.value,
            tabela: s_tab.value,
            coloana: s_col.value,
            coloana_nume: s_colRand.value
        }
       let  url = 'http://localhost:8082/backend/controller/actualizare-dangling-pointers.php';
   
        this.fetchAsync(url, params).then(resp => {
            if (resp[0]['cod'] == 200) {
                statusmodif.className = "alert alert-success";
                statusmodif.innerHTML = resp[0]['mesaj'];
                setTimeout(function () {
                    window.location.replace("danglindp.html");
                }, 4000);
            } else {
                statusmodif.className = "alert alert-danger";
                statusmodif.innerHTML = resp[0]['mesaj'];
                return (false);
            }
        }).catch(error => {
            statusmodif.className = "alert alert-danger";
            statusmodif.innerHTML = "A aparut o eroare in baza de date.";
            return (false);
        });
    }

    showButton(id) {
        let buttonAct = document.getElementById("btnActualizare");
        if (id === "") {
            buttonAct.classList.add("group-hide");
        }
        else {
            buttonAct.classList.remove("group-hide");
        }

    }
    async fetchAsync(url,params) {
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