<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['pageTitle' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('All Posts')]); ?>
    <main class="container mx-auto mt-8 w-full lg:w-3/4">
        <section class="bg-white px-6 py-6 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">All Posts</h2>

            <!-- Grid Container -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <!-- Post Card -->
                    <div class="bg-gray-200 rounded-lg shadow-md flex-shrink-0 h-[310px] w-full relative">
                        <!-- Category Badge -->
                        <div
                            class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md shadow-md">
                            <?php echo e($post->category ?? 'Category'); ?>

                        </div>

                        <!-- Timestamp -->
                        <div
                            class="absolute bottom-[130px] right-2 bg-white rounded-lg text-gray-900 text-xs font-bold px-2 py-1 shadow-md">
                            <?php echo e($post->created_at->diffForHumans()); ?>

                        </div>

                        <!-- Post Image and Title -->
                        <a href="<?php echo e(route('article', ['post' => $post->id])); ?>">
                            <img alt="Post Image" class="rounded-t-lg w-full h-[185px] object-cover"
                                src="<?php echo e(asset('storage/' . $post->cover_photo)); ?>" />
                            <div class="p-2">
                                <h1 class="text-xl font-bold truncate"><?php echo e($post->title); ?></h1>
                            </div>
                        </a>

                        <!-- Author Section -->
                        <a href="<?php echo e(route('author', ['user' => $post->user->id])); ?>">
                            <div class="bg-white w-full py-2 px-4 rounded-lg flex items-center mt-4">
                                <img alt="Author Image" class="w-10 h-10 rounded-full"
                                    src="<?php echo e(asset('storage/' . $post->user->profile_image)); ?>" />
                                <div class="ml-2">
                                    <p class="text-sm font-bold"><?php echo e($post->user->name); ?></p>
                                    <p class="text-xs text-gray-600"><?php echo e($post->created_at->format('F j, Y')); ?></p>
                                </div>
                                <i class="fas fa-arrow-right ml-auto mr-4 text-gray-600"></i>
                            </div>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination Links -->
            <div class="mt-8 flex justify-center">
                <?php echo e($posts->links('pagination::tailwind')); ?>

            </div>
            
        </section>
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
<?php /**PATH C:\xampp\htdocs\LARAVEL\MSOS_BULLETIN\resources\views/view_more.blade.php ENDPATH**/ ?>