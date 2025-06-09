<!-- プロフィール編集画面 -->


<?php $__env->startSection('title'); ?>
    edit_profile
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/pages/edit.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="profile-container">
        <h2>プロフィール設定</h2>
        <form method="POST" action="<?php echo e(route('mypage.profile.update')); ?>" enctype="multipart/form-data" novalidate>
            <?php echo csrf_field(); ?>
            <!-- プロフィール画像 -->
            <div class="profile-image-area">
                <div class="profile-image-wrapper">
                    <?php if(optional($user->profile)->image_path): ?>
                        <img src="<?php echo e(asset('storage/' . $user->profile->image_path)); ?>" alt="プロフィール画像" class="profile-image">
                    <?php else: ?>
                        <div class="profile-image-placeholder"></div>
                    <?php endif; ?>
                </div>
                <div class="select-image-wrapper">
                    <label class="select-image-btn">
                        画像を選択する
                        <input type="file" name="profile_image" accept="image/*" hidden>
                    </label>
                    <div class="error-message">
                        <?php $__errorArgs = ['profile_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <?php echo e($message); ?>

                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                </div>
            </div>

            <!-- 入力欄 -->
            <div class="form-group">
                <label for="name">
                    ユーザー名
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name ?? '')); ?>">
                <label for="postal_code">
                    郵便番号
                    <?php $__errorArgs = ['postal_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <input type="text" id="postal_code" name="postal_code"
                    value="<?php echo e(old('postal_code', $user->profile->postal_code ?? '')); ?>">
                <label for="address">
                    住所
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <input type="text" id="address" name="address" value="<?php echo e(old('address', $user->profile->address ?? '')); ?>">
                <label for="building">
                    建物名
                    <?php $__errorArgs = ['building'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="error-message"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </label>
                <input type="text" id="building" name="building"
                    value="<?php echo e(old('building', $user->profile->building ?? '')); ?>">
            </div>
            <button type="submit" class="update-btn">更新する</button>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/resources/views/users/edit.blade.php ENDPATH**/ ?>