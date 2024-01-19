<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <title>EstoteSocial: <?php echo $templateParams["title"]; ?></title>
        <link rel="icon" type="image/x-icon" href="img/logo.png">
    </head>
    <body class="d-flex justify-content-center py-4 bg-success-subtle">
        <style>
            .bg-light-brown {background-color: #e3d2bc;}
        </style>
        <div class="mw-75 p-3 mb-2 bg-light-brown rounded">
            <header>
                <div class="d-flex justify-content-center">
                    <img src="img/logo.png" alt="EstoteSocial icon" width="250"/>
                </div>
                <h4 class=" my-0 mb-3 fw-normal m-10 text-center"><?php echo $templateParams["title"]; ?></h4>
            </header>
            <main>
                <?php require($templateParams["name"]); ?>
            </main>
        </div>
    </body>
</html>