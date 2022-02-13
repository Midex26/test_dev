let selectedBrand = null;
let selectedFamilly= null;
(function () {
    let selectBrand = document.getElementById("brand");
    let selectFamilly = document.getElementById("familly");


    selectBrand.addEventListener( "change", function (){
        selectedBrand = this.value
        updateTable()
    })

    selectFamilly.addEventListener( "change", function (){
        selectedFamilly = this.value
        updateTable()
    })

})();

function updateTable(){
    let formdata = new FormData();
    let params = "?";
    if(selectedBrand !== null){
       params += "marque=" + selectedBrand + "&"
    }

    if(selectedFamilly !== null){
        params += "famille=" + selectedFamilly + "&"
    }

    fetch(`http://127.0.0.1:8000/filter${params}`, {
        method: 'GET',
    }).then((data) => {
        return data.json()
    }).then(function(data) {
        console.log(data)
    });
}