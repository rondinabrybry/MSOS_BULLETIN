<?php
    $pageTitle = 'Dashboard';
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

    <main class="container mx-auto mt-8 w-full lg:w-3/4">
        <style>
            .hide-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }

            .hide-scrollbar::-webkit-scrollbar {
                display: none;
            }

            #editor {
                height: auto;
                max-height: 24rem;
                overflow-y: auto;
                word-wrap: break-word;
            }
            .ql-image-resize-handle {
                width: 16px;
                height: 16px;
                background-color: #007bff;
                border-radius: 50%;
                border: 2px solid #fff;
                cursor: pointer;
                touch-action: none;
            }
        
            .ql-image-resize-overlay {
                border: 2px solid rgba(0, 123, 255, 0.5);
            }
        </style>

        <section class="bg-white px-6 py-6 pb-2 rounded-lg shadow-md overflow-hidden">
            <div class="flex justify-between align-center">
                <h2 class="text-2xl font-bold mb-4">Latest News</h2>
                <?php if(Auth::check() && Auth::user()->isAdminandSuper()): ?>
                <div class="flex mb-4">
                    <button class="bg-blue-600 text-white py-2 px-4 rounded-lg" onclick="openModal()">Create + </button>
                </div>
                <?php endif; ?>
            </div>

            <div id="horizontalScrollContainer" class="flex space-x-4 overflow-x-auto pb-4 hide-scrollbar">
                <?php if($posts->isEmpty()): ?>
                    <div class="w-full text-center py-4 text-lg text-gray-600">
                        No posts available.
                    </div>
                <?php else: ?>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-gray-200 rounded-lg shadow-md flex-shrink-0 h-[295px] w-[300px] relative">
                            <div
                                class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-md shadow-md">
                                <?php echo e($post->category ?? 'Category'); ?>

                            </div>
            
                            <div class="absolute bottom-[115px] right-1 bg-white rounded-lg text-gray-700 font-bold px-2 py-1 shadow-md">
                                <p class="text-[10px]">Last update: <?php echo e($post->updated_at->diffForHumans()); ?></p>
                            </div>

            
                            <a href="<?php echo e(route('article', ['post' => $post->id])); ?>">
                                <img alt="News Image" class="rounded-t-lg w-full h-[185px] object-cover"
                                    src="<?php echo e(asset('storage/' . $post->cover_photo)); ?>" />
                                <div class="p-2">
                                    <h1 class="text-2xl font-bold truncate"><?php echo e($post->title); ?></h1>
                                </div>
                            </a>
            
                            <a href="<?php echo e(route('author', ['user' => $post->user->id])); ?>">
                                <div class="bg-white w-[290px] py-2 px-4 rounded-lg w-full flex mx-auto items-center">
                                    <img alt="Author Image" class="w-10 h-10 rounded-full"
                                        src="<?php echo e(asset('storage/' . $post->user->profile_image)); ?>" />
                                    <div class="ml-2">
                                        <p class="text-sm font-bold"><?php echo e($post->user->name); ?></p>
                                        <p class="text-xs text-gray-600"><?php echo e($post->created_at->format('M j, Y')); ?> · <span class="text-[10px]"><?php echo e($post->created_at->diffForHumans()); ?></span></p>
                                    </div>
                                    <i class="fas fa-arrow-right ml-auto mr-4 text-gray-600"></i>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($posts->count() >= 5): ?>
                    <div class="flex justify-center mt-4">
                        <a href="<?php echo e(route('posts.view-more')); ?>" class="bg-blue-600 text-white py-2 px-6 text-center m-auto rounded-lg w-[200px]">
                            View More
                        </a>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            

            </div>
            

        </section>
<style>
    .category-section {
    margin-bottom: 20px;
}

.category-title {
    font-size: 1.25rem;
    font-weight: bold;
}

.post-item {
    background: #f9f9f9;
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 5px;
}

.post-item {
    position: relative;
    max-width: 200px;
    height: 150px;
    overflow: hidden;
}

.below {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0));
    padding: 10px;
}
    </style>
<!-- Display banner image -->
<section class="mt-2 mb-4">
    <div class="w-full">
        <img alt="Group of people working together" class="rounded-lg w-full object-cover"
            src="<?php echo e(asset('storage/img/banner.png')); ?>" />
    </div>
</section>

<?php $__currentLoopData = $postsGroupedByCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category => $posts): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($posts->isNotEmpty()): ?>
        <div class="category-section px-6">
            <h3 class="category-title"><?php echo e($category); ?></h3>

            <div class="relative">
                <!-- Previous Button -->
                <button 
                    class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-black/80 text-white p-2 rounded-full z-10 prev-btn touch-manipulation"
                    aria-label="Previous posts"
                >
                    &#60;
                </button>

                <div class="overflow-x-auto no-scrollbar">
                    <div class="flex gap-4 min-w-min px-4">
                        <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('article', ['post' => $post->id])); ?>" class="post-link flex-shrink-0">
                                <div class="post-item w-[200px] h-[150px] relative">
                                    <img 
                                        src="<?php echo e(asset('storage/' . $post->cover_photo)); ?>" 
                                        alt="<?php echo e($post->user->name); ?>" 
                                        class="object-cover w-full h-full rounded-lg"
                                    >
                                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black p-2 rounded-b-lg">
                                        <div class="truncate">
                                            <h4 class="font-bold text-white truncate"><?php echo e($post->title); ?></h4>
                                            <p class="text-[10px] text-white">
                                                <?php echo e($post->user->name); ?> · 
                                                <span class="text-[8px]"><?php echo e($post->created_at->diffForHumans()); ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Next Button -->
                <button 
                    class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-black/80 text-white p-2 rounded-full z-10 next-btn touch-manipulation"
                    aria-label="Next posts"
                >
                    &#62;
                </button>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<style>
.no-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}

.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Enhanced mobile button styles */
@media (max-width: 768px) {
    .prev-btn, .next-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        background-color: rgba(0, 0, 0, 0.8);
        -webkit-tap-highlight-color: transparent;
        touch-action: manipulation;
    }

    /* Increase touch target size */
    .prev-btn::before, .next-btn::before {
        content: '';
        position: absolute;
        top: -10px;
        bottom: -10px;
        left: -10px;
        right: -10px;
    }
}

/* Add active state for better feedback */
.prev-btn:active, .next-btn:active {
    background-color: rgba(0, 0, 0, 1);
    transform: translateY(-50%) scale(0.95);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.category-section');
    
    sections.forEach(section => {
        const scrollContainer = section.querySelector('.overflow-x-auto');
        const prevBtn = section.querySelector('.prev-btn');
        const nextBtn = section.querySelector('.next-btn');
        
        if (!prevBtn || !nextBtn || !scrollContainer) return;

        // Update button visibility based on scroll position
        const updateButtonVisibility = () => {
            const isAtStart = scrollContainer.scrollLeft <= 0;
            const isAtEnd = scrollContainer.scrollLeft + scrollContainer.clientWidth >= scrollContainer.scrollWidth - 1;
            
            prevBtn.style.opacity = isAtStart ? '0.3' : '1';
            nextBtn.style.opacity = isAtEnd ? '0.3' : '1';
            prevBtn.disabled = isAtStart;
            nextBtn.disabled = isAtEnd;
        };

        // Calculate scroll distance based on viewport
        const getScrollDistance = () => {
            return window.innerWidth <= 768 ? 210 : 420; // Full card width + gap on mobile
        };

        // Improved button click handlers
        const handleButtonClick = (direction) => {
            const distance = getScrollDistance();
            const targetScroll = scrollContainer.scrollLeft + (direction * distance);
            
            scrollContainer.scrollTo({
                left: targetScroll,
                behavior: 'smooth'
            });
        };

        // Add event listeners with improved touch handling
        prevBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            if (!prevBtn.disabled) {
                handleButtonClick(-1);
            }
        });

        nextBtn.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();
            if (!nextBtn.disabled) {
                handleButtonClick(1);
            }
        });

        // Touch scroll handling
        let touchStartX = 0;
        let touchStartScrollLeft = 0;
        let isTouching = false;

        scrollContainer.addEventListener('touchstart', (e) => {
            isTouching = true;
            touchStartX = e.touches[0].pageX;
            touchStartScrollLeft = scrollContainer.scrollLeft;
        }, { passive: true });

        scrollContainer.addEventListener('touchmove', (e) => {
            if (!isTouching) return;
            const touchDelta = touchStartX - e.touches[0].pageX;
            scrollContainer.scrollLeft = touchStartScrollLeft + touchDelta;
        }, { passive: true });

        scrollContainer.addEventListener('touchend', () => {
            isTouching = false;
        }, { passive: true });

        // Update button visibility on scroll and resize
        scrollContainer.addEventListener('scroll', updateButtonVisibility);
        window.addEventListener('resize', updateButtonVisibility);
        
        // Initial visibility update
        updateButtonVisibility();
    });
});
</script>

    </main>




    <div id="createModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl h-full max-h-[90%] sm:w-[90%] sm:h-[90%] md:w-[80%] lg:h-[80%] flex flex-col overflow-auto touch-manipulation">

            <form action="" id="postForm" enctype="multipart/form-data" class="flex flex-grow flex-col lg:flex-row">
                <?php echo csrf_field(); ?>
    
                <div class="lg:w-1/3 p-4 sm:p-6 flex flex-col gap-4 border-r overflow-auto">
                    
                    <div>
                        <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'category','value' => __('Category')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'category','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Category'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                        <select id="category" name="category"
                            class="p-2 text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                            required>
                            <option value="Not Classified">Not Classified</option>
                            <option value="Merch">Merch</option>
                            <option value="Campus">Campus</option>
                            <option value="Organization">Organization</option>
                            <option value="Research">Research</option>
                            <option value="Events">Events</option>
                            <option value="Sports">Sports</option>
                            <option value="Environment">Environment</option>
                            <option value="Technology">Technology</option>
                        </select>
                    </div>
    
                    <div>
                        <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'title','value' => __('Title')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'title','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Title'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'text','id' => 'title','name' => 'title','class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','id' => 'title','name' => 'title','class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                    </div>
    
                    <div>
                        <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'cover_photo','value' => __('Cover Photo')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'cover_photo','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Cover Photo'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                        <input type="file" id="cover_photo" name="cover_photo" accept="image/*"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            onchange="displayImage(this)" required>
                            <span class="text-xs text-gray-600">Best size 500x300 px</span>
                        <img id="coverPreview" class="mt-4 hidden rounded-md shadow-md max-w-full" />
                    </div>
    
                    <div class="flex justify-between mt-auto">
                        <button type="button" onclick="closeModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-700 py-2 px-4 rounded-lg">
                            Cancel
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg">
                            Save
                        </button>
                    </div>
                </div>
    
                <div class="lg:w-2/3 p-4 sm:p-6 flex flex-col overflow-auto">
                    <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'editor','value' => __('Content')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'editor','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Content'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                    <div id="editor" class="mt-3 p-2 border rounded-lg overflow-y-auto flex-grow">
                    </div>
                    <input type="hidden" id="content" name="content">
                </div>
            </form>
        </div>
    </div>
    

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const scrollContainer = document.getElementById("horizontalScrollContainer");

            if (scrollContainer) {
                scrollContainer.addEventListener("wheel", (event) => {
                    event.preventDefault();
                    scrollContainer.scrollLeft += event.deltaY;
                });
            }
        });
    </script>

    <script>
        function displayImage(input) {
            const preview = document.getElementById('coverPreview');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            } else {
                preview.classList.add('hidden');
            }
        }

        function openModal() {
            document.getElementById('createModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('createModal').classList.add('hidden');
        }
    </script>


    <script>
        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            ['image'],
            [{'script': 'sub'}, {'script': 'super'}],
            [{'font': ['serif', 'sans-serif', 'monospace', 'poppins']}],
            ['clean']
        ];
        

        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                imageResize: {
                    modules: ['Resize', 'DisplaySize', 'Toolbar'],
                    handleStyles: {
                        backgroundColor: 'blue',
                        borderRadius: '50%',
                        width: '12px',
                        height: '12px',
                    },
                },
                toolbar: toolbarOptions,
            },
        });
        document.getElementById('postForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var content = quill.root.innerHTML;
            document.getElementById('content').value = content;

            var formData = new FormData(this);

            fetch('/posts', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    },
                })
                .then(response => {
                    if (!response.ok) {
                        console.error(`HTTP Error: ${response.status} - ${response.statusText}`);
                        throw new Error('Failed to submit the form.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.errors) {
                        console.log('Validation Errors:', data.errors);
                        alert('There were errors in your form.');
                    } else if (data.message) {
                        alert(data.message);
                        closeModal();
                    } else {
                        console.warn('Unexpected response:', data);
                        alert('An unexpected error occurred.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Check console for details.');
                });
        });

        function closeModal() {
            document.getElementById('createModal').classList.add('hidden');
        }
    </script>


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
<?php /**PATH C:\xampp\htdocs\LARAVEL\MSOS_BULLETIN\resources\views/dashboard.blade.php ENDPATH**/ ?>