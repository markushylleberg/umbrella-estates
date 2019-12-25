// $('#saveProfileButton').click( function() {
$('#profileEditForm').submit( function(event){

    event.preventDefault();
    
        fetch( "api-save-profile-data.php", {
            method: 'POST',
            body: new FormData( document.querySelector('#profileEditForm') )
        }).then(function(response) {
            console.log(response.statusText);
            console.log(response.status);
            console.log(response);
    
            if( response.status == 200 ){
                $('#saveProfileButton').html('Saved!');
            }
    
        })
    })  

// $('#btnUploadProperty').click( function(event){
$('#newPropertyForm').submit( function(event){

    event.preventDefault();

    var newPropertyForm = $('#newPropertyForm');

    fetch( 'api-upload-property.php', {
        method: 'POST',
        body: new FormData( document.querySelector('#newPropertyForm') )
    }).then(function(response) {
        console.log(response.status);
        if( response.status == 200 ){
        
        var sNewPropertyTitle = $('#newPropertyTitle').val();
        var sNewPropertyAddress = $('#newPropertyAddress').val();
        var sNewPropertyCity = $('#newPropertyCity').val();
        var sNewPropertyZip = $('#newPropertyZip').val();
        var sNewPropertyPrice = $('#newPropertyPrice').val();

            $('.newlyUploadedProperties').append(`
                <div class="newProperty">
                    <img src="images/newProperty.png">
                    <div class="newPropetyInfo">
                        <h3>${sNewPropertyTitle}</h3>
                        <p>${sNewPropertyAddress}</p>
                        <p>${sNewPropertyCity}</p>
                        <p>${sNewPropertyZip}</p>
                    </div>
                    <div>
                    <p>Price:</p>
                    <h3>${sNewPropertyPrice}</h3>
                    </div>
                </div>
            `)

        let newPropertyForm = document.querySelectorAll("#newPropertyForm input");
        
            for(let i = 0; i < newPropertyForm.length; i++){
                newPropertyForm[i].value = '';
            }
        }
      })
})

// $('#saveProperty').click( function() {
$('#updatePropertyId').submit( function() {

    event.preventDefault();

    var propertyId = $('.single-property-container').attr('id');

    fetch( 'api-update-property.php?id='+propertyId, {
        method: 'POST',
        body: new FormData( document.querySelector('#updatePropertyId') )
    }).then(function(response) {
        console.log(response.statusText);
        console.log(response.status);

        if( response.status == 200 ){
            buttonSave();
        }

    })

})

$('#currentSearch').click( function() {

    console.log("test");

    let properties = document.getElementById('properties').children;

        for ( let i = 0; i < properties.length; i++ ){

                properties[i].style.display = "block";
            }

    document.getElementById('currentSearch').innerHTML = '';
    document.getElementById('currentSearch').style.display = 'none';

})


const txtSearch = document.querySelector('#txtSearch');
const divResults = document.querySelector('#results');

txtSearch.addEventListener('input', function(){
    

    if(txtSearch.value.length == 0){
        divResults.style.display = 'none';
    } else {
        divResults.style.display = 'block';
    }

    if( $('#txtSearch').val().length == 0){
        $('#txtSearch').removeClass('error');
        $('#results').hide();
        return;
    }

    if( $('#txtSearch').val().length < 1 ){
        $('#txtSearch').addClass('error');
        $('#results').show();
        return;
    }

    $.ajax({
        url: 'api-search.php', 
        data: $('#frmSearch').serialize(),
        dataType: "JSON"
    }).done( function( matches ){
        $('#results').empty()
        $(matches).each( function(index, zip){
            zip = zip.replace(/</g, '&lt');
            zip = zip.replace(/>/g, '&gt');
            // let divZip = `<a hef="api-search-results.php?zip=${zip.substring(0, 4)}"><div>${zip}</div></a>`;
            let divZip = `<div onclick="searchResult()">${zip}</div></a>`;
            // let divZip = `<a href="?zip=${zip.substring(0, 4)}"><div>${zip}</div></a>`
            $('#results').append(divZip);
        })

    }).fail( function(){
        console.log('Error');
    })
    
})

function buttonSave(){

    $('#saveProperty').html('Saved!');

}

function searchResult(){

    let eventTarget = event.target.textContent;
    let zipcode = eventTarget.substring(0, 4);

        $('#results').hide();
        $('#currentSearch').html(zipcode+' <b>X</b>');
        $('#currentSearch').show();
        $('#txtSearch').val('');


    $.ajax({
        url: 'api-search-results.php?zip='+zipcode,
        method: "GET",
    }).done( function( data ) {

        let properties = document.getElementById('properties').children;

        var array = data;

        for ( let i = 0; i < properties.length; i++ ){

            console.log(properties[i].id);
            console.log(array);

            if (array.includes(properties[i].id) ){
                console.log('match');
                properties[i].style.display = "block";
            } else {
                properties[i].style.display = "none";
            }
        }
    })
}

function searchResultByButton(){

    let value = document.getElementById('txtSearch').value;

    $('#results').hide();
    $('#currentSearch').html(value+' X');
    $('#currentSearch').show();
    $('#txtSearch').val('');

    $.ajax({
        url: 'api-search-results.php?zip='+value,
        method: "GET",
    }).done( function( data ) {

        let properties = document.getElementById('properties').children;

        var array = data;

        for ( let i = 0; i < properties.length; i++ ){

            console.log(properties[i].id);
            console.log(array);

            if (array.includes(properties[i].id) ){
                console.log('match');
                properties[i].style.display = "block";
            } else {
                properties[i].style.display = "none";
            }
        }
    })
}

let modal = document.getElementById('modal');

function openModal( agentId ){

    let eventTarget = event.target.parentElement.id;

    let thisAgentId = document.getElementById(eventTarget).children[0].id;
    

    console.log(eventTarget);
    console.log(thisAgentId);

    modal.style.display = 'block';

    $.ajax({
        url: 'api-get-property-info.php?id='+eventTarget+'&agent='+thisAgentId,
        method: 'GET'
    }).done( function( response ) {
        
        let property = JSON.parse(response);

        // console.log(response);
        document.querySelector('#modal h1').innerHTML = property['title'];
        document.querySelector('#modalAddress').innerHTML = property['address'];
        document.querySelector('#modalCity').innerHTML = property['zip']+' '+property['city'];
        document.querySelector('#modalImage').src = 'images/'+property['image'];
        document.querySelector('#modalDescription').innerHTML = property['description'];
        document.querySelector('#modalBeds').innerHTML = property['bedrooms'];
        document.querySelector('#modalBaths').innerHTML = property['bathrooms'];
        document.querySelector('#modalMeters').innerHTML = property['meters'];
        document.querySelector('#modalLiked').innerHTML = property['liked'];


    }).fail( function() {
        console.log('fail');
    })




}

document.getElementById('modalCloseBtn').addEventListener('click', function(){

    modal.style.display = 'none';
})

document.onkeyup = function (event) {
    if (event.keyCode == 27) {
        modal.style.display = 'none';
    }
}