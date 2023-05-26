<?php

function buildPost($post)
{
    ?>
    <div class="post">
        <?php if (isset($post['username'])) { ?>
            <a href="/users/user_page.php?uid=<?php echo $post['user_id']; ?>">
                <h3>@<?php echo $post['username']; ?></h3>
            </a>
        <?php } ?>
        <img src="/content/get_secured_picture.php?name=<?php echo base64_encode($post['image_path']); ?>"/>
        <p><?php echo $post['description']; ?></p>
    </div>
    <?php
}

function HTMLError($error)
{
    ?>
    <div class="error">

        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <?php echo $error; ?>
    </div>
    <?php
}