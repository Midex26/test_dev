let selectedBrand = "";
let selectedFamilly= "";
let initData = document.getElementById("contentTable").innerHTML;
(function () {
    let selectBrand = document.getElementById("brand");
    let selectFamilly = document.getElementById("familly");
    let searchInput = document.getElementById('search');
    let syncButton = document.getElementById('sync');

    syncButton.addEventListener( "click", function (){
        $('.icon_sync').addClass('fa-spin')
        fetch(`${base_url}/update/`, {
            method: 'GET',
        }).then((data) => {
            return data.json()
        }).then(function(data) {
            $('.icon_sync').removeClass('fa-spin')
            alert('Base de données mise à jour')
        }).catch((error) => {
            $('.icon_sync').removeClass('fa-spin')
            alert('Une erreur est survenue: ' + error)
        });
    })


    selectBrand.addEventListener( "change", function (){
        selectedBrand = this.value

        updateTable()
    })

    selectFamilly.addEventListener( "change", function (){
        selectedFamilly = this.value

        updateTable()
    })

    searchInput.addEventListener("input", function(){
        search(this.value);
    })

})();

function search(value){
    if(value.length >= 3){
        fetch(`${base_url}/search/${value}`, {
            method: 'GET',
        }).then((data) => {
            return data.json()
        }).then(function(data) {
            let table = document.getElementById("contentTable");
            table.innerHTML = "";

            data.forEach(elem => {
                $("#contentTable").append(`    
                <tr>
                    <th scope="row">${elem.id}</th>
                    <td>${elem.nom_court}</td>
                    <td>${elem.marque}</td>
                    <td>${elem.prix_public}</td>
                    <td>${elem.reference_fabricant}</td>
                    <td>${elem.famille}</td>
                    <td>${elem.nom}</td>
                </tr>`)
            })

        });
    }else{
        let table = document.getElementById("contentTable");
        table.innerHTML = initData;
    }
}

function updateTable(){

    $('#contentTable').html('' +
        '<div class="spinner-border text-light" role="status">\n' +
        '  <span class="visually-hidden">Loading...</span>\n' +
        '</div>')

    if(selectedBrand !== "" || selectedFamilly !== ""){
        let params = "?";
        if(selectedBrand !== ""){
            params += "marque=" + selectedBrand + "&"
        }

        if(selectedFamilly !== ""){
            params += "famille=" + selectedFamilly + "&"
        }

        fetch(`${base_url}/filter${params}`, {
            method: 'GET',
        }).then((data) => {
            return data.json()
        }).then(function(data) {
            let table = document.getElementById("contentTable");

            $('.paginations').hide();

            table.innerHTML = "";

            data.forEach(elem => {
                $("#contentTable").append(`    
                <tr>
                    <th scope="row">${elem.id}</th>
                    <td>${elem.nom_court}</td>
                    <td>${elem.marque}</td>
                    <td>${elem.prix_public}</td>
                    <td>${elem.reference_fabricant}</td>
                    <td>${elem.famille}</td>
                    <td>${elem.nom}</td>
                </tr>`)
            })

        });
    }else{
        document.getElementById("contentTable").innerHTML = initData;
        $('.paginations').show();
    }

}