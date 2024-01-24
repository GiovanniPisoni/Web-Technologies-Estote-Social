<?php if(!empty($templateParams["notification"])): ?>
    <?php foreach($templateParams["notification"] as $notification): ?>
        <article id="<?php echo $notification["IDNotifica"]; ?>" class="notification d-flex p-2 mt-2 border">
            <div class="row">
                <div class="col-2 d-flex align-items-center">
                    <?php if($notification["Tipo"] == "follow"): ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" class="bi bi-person-fill-add" viewBox="0 0 16 16">
                            <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
                            <path d="M2 13c0 1 1 1 1 1h5.256A4.5 4.5 0 0 1 8 12.5a4.5 4.5 0 0 1 1.544-3.393Q8.844 9.002 8 9c-5 0-6 3-6 4"/>
                        </svg>
                    <?php elseif($notification["Tipo"] == "like"): ?>
                        <img src="./img/symbol_liked.png" width="15" height="15" alt="Like Symbol">
                    <?php else: ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
                            <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15"/>
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="col d-flex align-items-center">
                    <p class="mb-0 notification-text" data-id="<?php echo $notification["IDNotifica"]; ?>">
                        <?php
                            echo $notification["Username_sender"];
                            if ($notification["Tipo"] == "follow"): echo " ha cominciato a seguirti";
                            elseif ($notification["Tipo"] == "like"): echo " ha messo mi piace al tuo post";
                            else: echo " ha commentato il tuo post";
                            endif;
                        ?>
                    </p>
                </div>
                <div class="col-auto d-flex align-items-right">
                    <img src="./img/delete.png" width="15" height="15" class="delete-notification" data-id="<?php echo $notification["IDNotifica"]; ?>" alt="Delete">
                </div>
            </div>
        </article>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">Nessuna notifica per te al momento</p>
<?php endif; ?>
