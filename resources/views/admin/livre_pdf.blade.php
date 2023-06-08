@extends('base');

<html>
<head>
    <title>Livre Information</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <h1>Livre Information </h1>
            <p><b>Titre : </b>{{ $data['titre'] }} </p>
            <p><b>Autheur : </b>{{ $data['autheur'] }} </p>
            <p><b>Launge : </b>{{ $data['launge'] }} </p>
            <p><b>Categorie : </b>{{ $data['categorie'] }} </p>
            <p><b>Annee : </b>{{ $data['annee'] }} </p>
            <p><b>Description : </b>{{ $data['description'] }} </p>
        </div>
        <div class="col-lg-4">
            <img class="img-fluid" src="{{ asset('./images_Livres/'.$data['image']) }}" alt="">
        </div>
    </div>
</div>
</body>
</html>
