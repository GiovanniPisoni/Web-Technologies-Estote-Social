<?php if(!empty($templateParams["notification"])): ?>
    <?php foreach($templateParams["notification"] as $notification): ?>
        <article id="<?php echo $notification["IDNotifica"]; ?>" class="notification d-flex p-2 mt-2 border <?php echo in_array($notification, $templateParams["notificationUnread"]) ? '' : 'opacity-50'; ?>">
            <div class="row">
                <div class="col-auto d-flex align-items-left">
                    <?php if($notification["Tipo"] == "follow"): ?>
                        <img src="./img/follow.png" width="25" height="25">
                    <?php elseif($notification["Tipo"] == "like"): ?>
                        <img src="./img/symbol_liked.png" width="20" height="20" alt="Like Symbol">
                    <?php else: ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-chat-fill" viewBox="0 0 16 16">
                            <path d="M8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6-.097 1.016-.417 2.13-.771 2.966-.079.186.074.394.273.362 2.256-.37 3.597-.938 4.18-1.234A9 9 0 0 0 8 15"/>
                        </svg>
                    <?php endif; ?>
                </div>
                <div class="col d-flex align-items-center">
                    <p class="notification-text" data-id="<?php echo $notification["IDNotifica"]; ?>">
                        <?php
                            echo $notification["Username_sender"];
                            if ($notification["Tipo"] == "follow"): echo " ha cominciato a seguirti";
                            elseif ($notification["Tipo"] == "like"): echo " ha messo mi piace al tuo post";
                            elseif ($notification["Tipo"] == "commento"): echo " ha commentato il tuo post";
                            endif;
                        ?>
                    </p>
                </div>
                <div class="col-auto d-flex align-items-right">
                    <img src="./img/delete.png" width="20" height="20" class="delete-notification" data-id="<?php echo $notification["IDNotifica"]; ?>" alt="Delete">
                </div>
            </div>
        </article>
    <?php endforeach; ?>
<?php else: ?>
    <p class="text-center">Nessuna notifica per te al momento</p>
<?php endif; ?>
