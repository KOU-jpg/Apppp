<!-- 共通レイアウト -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $__env->yieldContent('title'); ?></title>
  <link rel="stylesheet" href="<?php echo e(asset('css/sanitize.css')); ?>" />
  <link rel="stylesheet" href="<?php echo e(asset('css/common.css')); ?>" />
  <?php echo $__env->yieldContent('css'); ?>
</head>

<body>
  <header class="header">
    <div class="header__inner">
      <?php echo $__env->yieldContent('header'); ?>
        <a href="<?php echo e(route('items.index')); ?>">
          <img src="<?php echo e(asset('images/logo.svg')); ?>" class="header__image" alt="coachtechロゴ"></a>
        <?php if(Auth::check() && Auth::user()->hasVerifiedEmail()): ?>
        <form class="header-search" method="GET"
        action="<?php echo e(($page ?? '') === 'mylist' ? url('/?page=mylist') : route('items.index')); ?>">
          <input type="text" name="keyword" placeholder="なにをお探しですか？" value="<?php echo e(request('keyword')); ?>">
        </form>
        <nav class="header-nav">
        <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline;">
          <?php echo csrf_field(); ?>
          <button type="submit" class="nav-link" style="background:none;border:none;padding:0;cursor:pointer;">
          ログアウト
          </button>
        </form>
          <a href="<?php echo e(route('mypage')); ?>" class="nav-link">マイページ</a>
          <a href="<?php echo e(route('sell.form')); ?>" class="nav-link exhibit-btn">出品</a>
        <?php else: ?>
          <a href="<?php echo e(route('login')); ?>" class="nav-link">ログイン</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <main>
    <?php echo $__env->yieldContent('content'); ?>
  </main>
</body>

</html><?php /**PATH /var/www/resources/views/layouts/app.blade.php ENDPATH**/ ?>