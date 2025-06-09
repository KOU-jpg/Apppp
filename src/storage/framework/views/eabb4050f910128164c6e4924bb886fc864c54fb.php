<!-- 商品一覧画面（トップ） -->


<?php $__env->startSection('title'); ?>
    index
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/pages/index.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<nav class="pages">
    <a href="<?php echo e(url('/' . (request('keyword') ? '?keyword=' . urlencode(request('keyword')) : ''))); ?>"
        class="page <?php echo e(($page ?? 'recommend') === 'recommend' ? 'active' : ''); ?>">おすすめ</a>
    <?php if(Auth::check() && Auth::user()->hasVerifiedEmail()): ?>
        <a href="<?php echo e(url('/?page=mylist' . (request('keyword') ? '&keyword=' . urlencode(request('keyword')) : ''))); ?>"
            class="page <?php echo e(($page ?? '') === 'mylist' ? 'active' : ''); ?>">マイリスト</a>
    <?php elseif(Auth::check()): ?>
        <a href="http://localhost:8025" target="_blank" class="page" rel="noopener noreferrer">マイリスト</a>
    <?php else: ?>
        <a href="<?php echo e(route('login.form')); ?>" class="page">マイリスト</a>
    <?php endif; ?>
</nav>
<hr>
<section class="item-list" id="exhibit-list">
    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(route('items.detail', $item->id)); ?>">
            <div class="item-card">
                <div class="item-image">
                    <?php if(in_array($item->payment_status, ['pending', 'paid'])): ?>
                        <div class="sold-label">SOLD</div>
                    <?php endif; ?>
                    <?php if($item->images->count()): ?>
                        <img src="<?php echo e(asset('storage/' . $item->images->first()->path)); ?>" alt="<?php echo e($item->name); ?>">
                    <?php else: ?>
                        <img src="<?php echo e(asset('images/no-image.png')); ?>" alt="No Image">
                    <?php endif; ?>
                </div>
                <div class="item-name"><?php echo e($item->name); ?></div>
            </div>
        </a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="empty-message">
        </div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/items/index.blade.php ENDPATH**/ ?>