@extends('layout.app')

@section('title', 'Crear Tabla')

@section('content-header')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Nueva base de datos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Tablas</a></li>
                        <li class="breadcrumb-item active">Nueva Tabla</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    
@endsection

@section('content')

<select id="membership-members" onchange="updateItems(this)">
    <option value="0" disabled selected>Select</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
  </select>
  <br>
  <br>
  <div id="results"></div>
    
@endsection

<script>
    function updateItems(_this) {
  var ItemCount = +_this.value //get the value
  var results = document.querySelector('#results') //append results
  results.innerHTML = '' //clear the results on each update
  for (var i = 1; i <= ItemCount; i++) {
    var input = document.createElement('input') //create input
    var label = document.createElement("label"); //create label
    label.innerText = 'Input ' + i
    input.type = "text";
    input.placeholder = "Type text here"; //add a placeholder
    input.className = "my-inputs"; // set the CSS class
    results.appendChild(label); //append label
    results.appendChild(document.createElement("br"));
    results.appendChild(input); //append input
    results.appendChild(document.createElement("br"));
  }
}
</script>