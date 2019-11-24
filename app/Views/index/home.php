<?php
/**
 * @Author  : Created by Llyam Garcia.
 * @Nick    : Liightman
 * @Date    : 22/03/2016
 * @Time    : 10:00
 * @File    : home.php
 * @Version : 1.0
 */
?>
<?php if (!empty($_SESSION)): ?>
    <h1>Vos alertes</h1>
    <hr>
    <div class="container">
        <?php foreach($alerts as $alert):?>
            <div class="col-sm-6 col-md-6">
                <div class="alert-message alert-message-<?= $alert->type?>" id="alert-<?= $alert->id ?>">
                    <button type="button" class="close" style="margin-top: -20px;margin-right: -15px;" onclick="deleteAlert('<?= $alert->id ?>');">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4><?= $alert->title?></h4>
                    <p><?= $alert->alert?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>