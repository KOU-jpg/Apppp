<!-- 商品詳細画面 -->


<?php $__env->startSection('title', 'detail'); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/pages/detail.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="product-detail-container">
    <div class="product-image-area">
        <div class="product-image-box">
            <?php if(in_array($item->payment_status, ['pending', 'paid'])): ?>
                <div class="sold-label">SOLD</div>
            <?php endif; ?>
            <?php if($item->images->count()): ?>
                <img src="<?php echo e(asset('storage/' . $item->images->first()->path)); ?>" alt="<?php echo e($item->name); ?>">
            <?php else: ?>
                <span>画像なし</span>
            <?php endif; ?>
        </div>
    </div>
    <div class="product-info-area">
        <h1 class="product-title"><?php echo e($item->name); ?></h1>
        <div class="product-brand"><?php echo e($item->brand); ?></div>
        <div class="product-price">
            ¥<?php echo e(number_format($item->price)); ?>

            <span class="tax-in">（税込）</span>
        </div>
        <div class="product-icons" data-item-id="<?php echo e($item->id); ?>">
            <form action="<?php echo e(route('favorites.toggle', $item->id)); ?>" method="POST" style="display:inline;">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="icon-star <?php echo e(auth()->check() && $item->favorites()->where('user_id', auth()->id())->exists() ? 'active' : ''); ?>"
                    aria-pressed="<?php echo e(auth()->check() && $item->favorites()->where('user_id', auth()->id())->exists() ? 'true' : 'false'); ?>"
                    aria-label="お気に入り登録">
                    ☆<span class="icon-count"><?php echo e($item->favorites()->count()); ?></span>
                </button>
            </form>
            <span class="icon-comment" aria-label="コメント数">
                💬<span class="icon-count"><?php echo e($item->comments()->count()); ?></span>
            </span>
        </div>
        <div id="favorite-error-message" style="color: red; margin-top: 8px; display: none;"></div>
        <div class="product-actions">
            <?php if(in_array($item->payment_status, ['pending', 'paid'])): ?>
                <button class="purchase-btn soldout" disabled>売り切れました</button>
            <?php else: ?>
            <?php if(Auth::check() && Auth::user()->hasVerifiedEmail()): ?>
                <a href="<?php echo e(route('purchase.show', ['item_id' => $item->id])); ?>" class="purchase-btn">購入手続きへ</a>
            <?php elseif(Auth::check()): ?>
                <a href="http://localhost:8025" target="_blank" class="purchase-btn"
                    rel="noopener noreferrer">メール認証して購入手続きへ</a>
            <?php else: ?>
                <a href="<?php echo e(route('login.form')); ?>" class="purchase-btn">ログインして購入手続きへ</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <section class="product-description-section">
            <h2 class="section-title">商品説明</h2>
            <div class="product-desc">
                <?php echo e($item->condition->name); ?><br>
                <?php echo e($item->description); ?>

            </div>
        </section>
        <section class="product-info-section">
            <h2 class="section-title">商品の情報</h2>
            <div class="product-meta">
                <div class="meta-label">カテゴリー</div>
                <?php $__currentLoopData = $item->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="category-tag"><?php echo e($category->name); ?></span>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </section>
        <section class="product-comments-section">
            <h2 class="section-title">コメント (<?php echo e($comments->count()); ?>)</h2>
            <div class="comment-list">
                <?php $__currentLoopData = $comments->sortByDesc('created_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $isMine = auth()->check() && $comment->user_id === auth()->id();
                    ?>
                    <div class="comment-item <?php echo e($isMine ? 'my-comment' : 'other-comment'); ?>">
                        <div class="comment-bubble"><?php echo e($comment->comment); ?></div>
                        <div class="comment-header">
                            <span class="comment-user-icon">
                                <?php if(optional($comment->user->profile)->image_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $comment->user->profile->image_path)); ?>" alt="icon"
                                        class="profile-image">
                                <?php else: ?>
                                    <span class="profile-image-placeholder"></span>
                                <?php endif; ?>
                            </span>
                            <span class="comment-user"><?php echo e($comment->user->name); ?></span>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <form method="POST" action="<?php echo e(route('comments.store')); ?>" class="comment-form-section" novalidate>
                <?php echo csrf_field(); ?>
                <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
                <label for="comment" class="comment-label">商品へのコメント</label>
                <textarea id="comment" name="comment" class="comment-textarea" required><?php echo e(old('comment')); ?></textarea>
                <?php $__errorArgs = ['comment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <?php if(in_array($item->payment_status, ['pending', 'paid'])): ?>
                    <button class="comment-submit-btn soldout" disabled>売り切れました</button>
                <?php elseif(Auth::check() && Auth::user()->hasVerifiedEmail()): ?>
                    <button type="submit" class="comment-submit-btn">コメントを投稿する</button>
                <?php elseif(Auth::check()): ?>
                    <a href="http://localhost:8025" target="_blank" class="comment-login-btn"
                        rel="noopener noreferrer">メール認証してください</a>
                <?php else: ?>
                <a href="<?php echo e(route('login.form')); ?>" class="comment-login-btn">ログインしてコメントする</a>
                <?php endif; ?>
            </form>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/items/detail.blade.php ENDPATH**/ ?>