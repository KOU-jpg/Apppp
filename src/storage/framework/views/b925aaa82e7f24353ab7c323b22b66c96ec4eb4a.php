<!-- メール認証画面 -->


<?php $__env->startSection('title'); ?>
  mail_verify
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('css/pages/mail_verify.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <div class="verify-container">
    <p class="verify-message">
    登録していただいたメールアドレスに認証メールを送付しました。<br>
    メール認証を完了してください。
    </p>
    <a href="http://localhost:8025" target="_blank" rel="noopener noreferrer"
    class="verify-btn">認証はこちらから
    </a>
    <form method="POST" action="<?php echo e(route('verification.send')); ?>">
    <?php echo csrf_field(); ?>
    <button type="submit" class="resend-link">認証メールを再送する</button>
    </form>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/auth/verify-email.blade.php ENDPATH**/ ?>