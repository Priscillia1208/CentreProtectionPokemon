
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Centre de protection des pokemon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

</head>


<body>
<section class="h-100 bg-dark">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <div class="card card-registration my-4">
                    <div class="row g-0">
                        <div class="col-xl-6">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-5 text-uppercase">Formulaire enregistrement</h3>

                                <form action="confirmationCreationCpte.php" method="post">

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="form3Example1m" class="form-control form-control-lg" name="prenom"/>
                                                <label class="form-label" for="form3Example1m">Prénom</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <div class="form-outline">
                                                <input type="text" id="form3Example1n" class="form-control form-control-lg" name="nom"/>
                                                <label class="form-label" for="form3Example1n">Nom</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example8" class="form-control form-control-lg" name="adresse" />
                                        <label class="form-label" for="form3Example8">Adresse</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example8" class="form-control form-control-lg" name="telephone"/>
                                        <label class="form-label" for="form3Example8">Téléphone</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example97" class="form-control form-control-lg" name="email" />
                                        <label class="form-label" for="form3Example97">Email</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="text" id="form3Example97" class="form-control form-control-lg" name="motDePasse"/>
                                        <label class="form-label" for="form3Example97">Mot de passe</label>
                                    </div>

                                    <div class="d-flex justify-content-end pt-3">
                                        <button type="button" class="btn btn-light btn-lg">Vider le formulaire</button>
                                        <!-- attention ne pas mettre de a avec lien de redirection sur le button submit car le submit référe déjà au document pointé dans le action du form-->
                                        <button type="submit" class="btn btn-warning btn-lg ms-2" name="submit">Soumettre le formulaire</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

