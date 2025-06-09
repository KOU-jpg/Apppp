<?php $__env->startComponent('mail::message'); ?>
# 【模擬案件フリマアプリ】メールアドレス認証のお願い

こんにちは！  
MyAppへご登録いただきありがとうございます。

下のボタンをクリックして、メールアドレスの認証を完了してください。  
認証が完了すると、MyAppのすべての機能をご利用いただけます。

<?php $__env->startComponent('mail::button', ['url' => $actionUrl]); ?>
メールアドレスを認証する
<?php echo $__env->renderComponent(); ?>

もしこのメールに心当たりがない場合は、こちらのメールを破棄してください。  
ご不明な点があれば、お気軽にサポートまでご連絡ください。

---

模擬案件フリマアプリ運営チーム

<?php echo $__env->renderComponent(); ?>
<?php /**PATH /var/www/resources/views/vendor/notifications/email.blade.php ENDPATH**/ ?>