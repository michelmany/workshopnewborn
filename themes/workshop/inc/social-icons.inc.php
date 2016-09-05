<li><a href="https://facebook.com/<?= $user_facebook; ?>" target="_blank"><i class="fa fa-facebook-square"></i></a></li>
<li><a href="https://instagram.com/<?= $user_instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>

<?php if(!empty($user_twitter)): ?>
    <li><a href="https://twitter.com/<?= $user_twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
<?php endif; ?>

<?php if(!empty($user_skype)): ?>
    <li><a href="skype:<?= $user_skype ?>?call"><i class="fa fa-skype"></i></a></li>
<?php endif; ?>



