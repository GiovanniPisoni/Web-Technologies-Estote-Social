<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <title>EstoteSocial: <?php echo $templateParams["title"]; ?></title>
        <link rel="icon" type="image/x-icon" href="./img/miniLogo.png">
        <!--<?php
        /*if(isset($templateParams["js"])):
            foreach($templateParams["js"] as $script):*/
        ?>
            <script defer src="<?php echo $script; ?>"></script>
        <?php
            /*endforeach;
        endif;*/
        ?>-->
    </head>
    <body class="container justify-content-center py-4 bg-success-subtle">
        <nav class="nav p-1 fixed-top">
            <div class="container">
               <div class="row">
                    <div class="col text-start d-flex justify-content-center align-items-center me-3">
                        <?php
                        $templateParams["notification"]= $dbh->getNotificationsByUsername($_SESSION["username"]);
                        if (!empty($templateParams["notification"])):
                            $iconPath = "./img/backpack_notify.png";
                        ?>
                            <span class="badge bg-danger">new</span>
                        <?php else:
                            $iconPath = "./img/backpack.png";
                            endif;
                        ?>
                        <a data-bs-toggle="modal" data-bs-target="#notification-banner">
                            <svg width="35" height="35" xmlns="http://www.w3.org/2000/svg">
                                <image href="<?php echo $iconPath; ?>" height="35" width="35"/>
                            </svg>
                        </a>
                    </div>
                    <div class="col text-center pos-relative d-flex justify-content-center align-items-center">
                        <img src="./img/logo_white.png" alt="EstoteSocial" height="30">
                    </div>
                    <div class="col text-end pos-realtive d-flex justify-content-center align-items-center ms-3">
                        <svg data-bs-toggle="modal" data-bs-target="#new-post-banner" width="35" height="35" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                            <g id="SVGRepo_iconCarrier">    
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M8.26801 18.1003L5.75301 12.8133C5.41566 12.2907 5.41566 11.6189 5.75301 11.0963L8.25201 5.89229C8.63454 5.32445 9.27844 4.98876 9.96301 5.00029H13.002H16.041C16.7256 4.98876 17.3695 5.32445 17.752 5.89229L20.246 11.0923C20.5834 11.6149 20.5834 12.2867 20.246 12.8093L17.736 18.1003C17.3537 18.674 16.7053 19.0133 16.016 19.0003H9.98701C9.29805 19.013 8.65011 18.6737 8.26801 18.1003Z" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.002 11.2502C10.5878 11.2502 10.252 11.586 10.252 12.0002C10.252 12.4145 10.5878 12.7502 11.002 12.7502V11.2502ZM13.002 12.7502C13.4162 12.7502 13.752 12.4145 13.752 12.0002C13.752 11.586 13.4162 11.2502 13.002 11.2502V12.7502ZM13.002 11.2502C12.5878 11.2502 12.252 11.586 12.252 12.0002C12.252 12.4145 12.5878 12.7502 13.002 12.7502V11.2502ZM15.002 12.7502C15.4162 12.7502 15.752 12.4145 15.752 12.0002C15.752 11.586 15.4162 11.2502 15.002 11.2502V12.7502ZM13.752 12.0002C13.752 11.586 13.4162 11.2502 13.002 11.2502C12.5878 11.2502 12.252 11.586 12.252 12.0002H13.752ZM12.252 14.0002C12.252 14.4145 12.5878 14.7502 13.002 14.7502C13.4162 14.7502 13.752 14.4145 13.752 14.0002H12.252ZM12.252 12.0002C12.252 12.4145 12.5878 12.7502 13.002 12.7502C13.4162 12.7502 13.752 12.4145 13.752 12.0002H12.252ZM13.752 10.0002C13.752 9.58603 13.4162 9.25024 13.002 9.25024C12.5878 9.25024 12.252 9.58603 12.252 10.0002H13.752ZM11.002 12.7502H13.002V11.2502H11.002V12.7502ZM13.002 12.7502H15.002V11.2502H13.002V12.7502ZM12.252 12.0002V14.0002H13.752V12.0002H12.252ZM13.752 12.0002V10.0002H12.252V12.0002H13.752Z" fill="#ffffff"/>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
        </nav>
        <div class="d-flex fixed-bottom justify-content-center">
            <nav class="nav p-1 d-flex fixed-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col text-start d-flex justify-content-center align-items-center me-3">
                            <a href="search.php" class="link-underline link-underline-opacity-0">
                                <svg width="35" height="35" xmlns="http://www.w3.org/2000/svg">
                                    <image href="./img/find.png" height="35" width="35"/>
                                </svg>
                            </a>
                        </div>
                        <div class="col text-start d-flex justify-content-center align-items-center"> 
                            <a href="index.php" class="link-underline link-underline-opacity-0">
                                <svg width="35" height="35" xmlns="http://www.w3.org/2000/svg">
                                    <image href="./img/tent.png" height="35" width="35"/>
                                </svg>
                            </a>
                        </div>
                        <div class="col text-start d-flex justify-content-center align-items-center ms-3">
                            <a href="profile.php?id=<?php echo $_SESSION["username"]; ?>" class="link-underline link-underline-opacity-0">
                                <svg width="32.5" height="32.5" xmlns="http://www.w3.org/2000/svg">
                                    <image href="./img/user.png" height="32.5" width="32.5"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </nav> 
        </div>

        <!-- Modal to add: Post, Notifiacation? -->
        <?php require_once("./components/notification-banner.php"); ?>
    </body>
</html>