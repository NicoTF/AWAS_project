<?php

function buildPost($post) {
    ?>
    <div class="post">
        <h3>@<?php echo $post['username']; ?></h3>
        <img src="/content/get_secured_picture.php?name=<?php echo base64_encode($post['image_path']); ?>"/>
        <p><?php echo $post['description']; ?></p>
    </div>
    <?php
}