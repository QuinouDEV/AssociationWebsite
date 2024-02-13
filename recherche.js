var obj = 20;
var tablformateurs=[];
const form = document.getElementById('toto');
form.addEventListener('click', event => {
    event.preventDefault();
    data = document.getElementById('rechForm').value;

    for(let j=0;j<10;j++){
        data = data.replace(" ","-");
        data = data.replace("é","e");
        data = data.replace("è","e");
        data = data.replace("ô","o");
        data = data.replace("à","a");
        data = data.replace("'","");
    }

    let formData = new FormData();
    formData.append('depart',data);
    fetch('rechercherFormation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        if(result=="no"){
            resetHTML();
            document.getElementById("Ant").innerHTML = "/!\\ ERREUR /!\\ ";
            let p1 = document.createElement("p");
            p1.classList += 'mod';
            p1.innerHTML = "VOUS AVEZ MAL RENTRE VOTRE DEPARTEMENT DANS LA BARRE DE RECHERCHE ";
            div = document.getElementById("yes");
            div.appendChild(p1);

        }else{
            let tabl1 = result.split("|");
            for(let i=0;i<(tabl1.length-1);i++){
                let tabl2 = tabl1[i].split(";");
                tablformateurs[i]=tabl2;
            }

            if(tabl1[0]=="SPE:NULL"){
                resetHTML();
                document.getElementById("Ant").innerHTML ="PAS ENCORE D'ANTENNE";
            }else{
                let tblverif = tabl1[0].split(";");
                if(tblverif[0]=="SPE:EC"){
                    resetHTML();
                    document.getElementById("Ant").innerHTML = "Antenne " + tblverif[1];
                    let p1 = document.createElement("p");
                    p1.classList += 'mod';
                    p1.innerHTML = tblverif[2];
                    div = document.getElementById("yes");
                    div.appendChild(p1);
                }else{
                    resetHTML();
                    document.getElementById("Ant").innerHTML = "Antenne " + tablformateurs[0][0];
                    console.log(tablformateurs.length);
                    for(let x=0;x<tablformateurs.length;x++){
                        let p1 = document.createElement("p");
                        let p2 = document.createElement("p");
                        let p3 = document.createElement("p");
                        p1.classList += 'mod';
                        p2.classList += 'mod';
                        p3.classList += 'mod';
                        p1.innerHTML = tablformateurs[x][2]+" "+tablformateurs[x][1]+" - "+tablformateurs[x][4];
                        p2.innerHTML = "MAIL : "+tablformateurs[x][3];
                        p3.innerHTML = "TEL : "+tablformateurs[x][5];
                        div = document.getElementById("yes");
                        div.appendChild(p1);
                        div.appendChild(p2);
                        div.appendChild(p3);
                    }
                }
            }
        }
    })
    .catch(error => {
        console.error(error);
    });
});

function departement(valeur){
    let formData = new FormData();
    formData.append('depart',valeur);
    fetch('rechercherFormation.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(result => {
        let tabl1 = result.split("|");
        for(let i=0;i<(tabl1.length-1);i++){
            let tabl2 = tabl1[i].split(";");
            tablformateurs[i]=tabl2;
        }
        if(tabl1[0]=="SPE:NULL"){
            resetHTML();
            document.getElementById("Ant").innerHTML ="PAS ENCORE D'ANTENNE";
        }else{
            let tblverif = tabl1[0].split(";");
            if(tblverif[0]=="SPE:EC"){
                resetHTML();
                document.getElementById("Ant").innerHTML = "Antenne " + tblverif[1];
                let p1 = document.createElement("p");
                p1.classList += 'mod';
                p1.innerHTML = tblverif[2];
                div = document.getElementById("yes");
                div.appendChild(p1);
            }else{
                resetHTML();
                document.getElementById("Ant").innerHTML = "Antenne " + tablformateurs[0][0];
                console.log(tablformateurs.length);
                for(let x=0;x<tablformateurs.length;x++){
                    let p1 = document.createElement("p");
                    let p2 = document.createElement("p");
                    let p3 = document.createElement("p");
                    p1.classList += 'mod';
                    p2.classList += 'mod';
                    p3.classList += 'mod';
                    p1.innerHTML = tablformateurs[x][2]+" "+tablformateurs[x][1]+" - "+tablformateurs[x][4];
                    p2.innerHTML = "MAIL : "+tablformateurs[x][3];
                    p3.innerHTML = "TEL : "+tablformateurs[x][5];
                    div = document.getElementById("yes");
                    div.appendChild(p1);
                    div.appendChild(p2);
                    div.appendChild(p3);
                }
            }
        }
    })
    .catch(error => {
        console.error(error);
    });
}


function resetHTML(){
    document.getElementById("yes").innerHTML = "";
    document.getElementById("Ant").innerHTML = "";
}
