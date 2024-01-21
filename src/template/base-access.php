<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <title>EstoteSocial: <?php echo $templateParams["title"]; ?></title>
        <link rel="icon" type="image/x-icon" href="img/miniLogo.png">
    </head>
    <body class="d-flex justify-content-center py-4 bg-success-subtle">
        <div class="border border-dark-subtle rounded-4 mw-75 p-3 m-2 text-center">
            <header>
                <img src="img/Logo.png" alt="EstoteSocial icon" width="250"/>
                <h1 class="h4 my-0 mb-3 fst-italic"><?php echo $templateParams["title"]; ?></h1>
            </header>
            <main>
                <?php require($templateParams["name"]); ?>
            </main>
        </div>
    </body>
</html>