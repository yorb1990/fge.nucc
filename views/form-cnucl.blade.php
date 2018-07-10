@if(env("CLAVE")!=null)

<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<div class="card col-md-6 offset-md-3">
    <div class="card-header">
        VERIFICA NUC
    </div>
    <div class="card-body form-group">
        <label>CLAVE:</label>
        <input disabled class="form-control" value="{{env("CLAVE")}}"/>
        <label>NUC</label>
        <input class="form-control" id="nuc" placeholder="AZ09-09AZ5H-18" type="text"/>
        <label>CVV</label>
        <input class="form-control" id="cvv" placeholder="numero de comprobacion" type="text"/>
        <br>
        <input class="btn btn-default" id="singin" value="enviar" type="submit">
    </div>
</div>
<script>
    document.getElementById("singin").onclick=()=>{
        const data={
            clave:"{{env("CLAVE")}}",
            nuc:document.getElementById("nuc").value,
            cvv:document.getElementById("cvv").value};
        fetch('{{env('APP_URL')}}'+'/fge-tok/cnuc',{
            method:'post',
            headers: {
               'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(function(response) {
            console.log(response)
            if(response.ok){
                response.json()
                .then(function(json) {            
                    alert(json);
                });
            }else{
                response.json()
                .then(function(json){
                    alert(json.message)
                });
            }
        })
        .catch(function(data){
             console.log(data);
        });
    };
</script>
@endif