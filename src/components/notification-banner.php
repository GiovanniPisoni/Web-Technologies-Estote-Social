<div class="modal fade" id="notification-banner" data-bs-backdrop="static" tabindex="-1" aria-labelledby="notifications" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title h5" id="notification">Notifiche</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="location.reload()"></button>
            </div>
            <div class="modal-body">
                <?php
                    require("./template/show-notification.php");
                ?>
            </div>
        </div>
    </div>
</div>