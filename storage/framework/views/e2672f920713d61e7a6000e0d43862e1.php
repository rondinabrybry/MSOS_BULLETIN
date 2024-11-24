<?php
$pageTitle = $user->name;
?>

<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pageTitle)]); ?>
    <main class="container mx-auto mt-8">
        <!-- Author Profile Section -->
        <div class="bg-white px-6 py-6 rounded-lg shadow-md">
            <div class="flex items-center mb-4">
                <img alt="Author Image" class="w-16 h-16 rounded-full"
                    src="<?php echo e(asset('storage/' . $user->profile_image)); ?>" />
                <div class="ml-4">
                    <h1 class="text-2xl font-bold"><?php echo e($user->name); ?></h1>
                    <p class="text-sm text-gray-600">Joined <?php echo e($user->created_at->format('F j, Y')); ?></p>
                    <p class="text-sm text-gray-600">Total Articles: <?php echo e($posts->count()); ?></p>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-xl font-bold mb-4">Articles by <?php echo e($user->name); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-gray-200 rounded-lg shadow-md p-4">
                        <a href="<?php echo e(route('article', ['post' => $post->id])); ?>">
                            <img alt="Article Image" class="rounded-lg w-full h-48 object-cover mb-2"
                                src="<?php echo e(asset('storage/' . $post->cover_photo)); ?>" />
                            <h3 class="text-lg font-bold"><?php echo e($post->title); ?></h3>
                        </a>
                        <p class="text-sm text-gray-600"><?php echo e($post->created_at->format('F j, Y')); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        
        </div>
        
        </div>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\LARAVEL\MSOS_BULLETIN\resources\views/author.blade.php ENDPATH**/ ?>