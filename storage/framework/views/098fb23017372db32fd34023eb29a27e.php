<?php
    $pageTitle = $post->title;
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
        <article class="bg-white px-6 py-6 mx-auto rounded-lg shadow-md max-w-5xl">
            <div class="flex justify-between mb-4">
            <h1 class="text-xl font-bold">
                <span class="text-red-500 font-bold"><?php echo e($post->category ?? 'Category'); ?></span>
            </h1>
            
            <div class="flex items-center justify-center gap-2">
                <button 
                    id="reactButton" 
                    onclick="toggleReaction(<?php echo e($post->id); ?>)"
                    class="flex items-center gap-2 px-4 py-2 rounded-full border transition-all duration-200 ease-in-out text-xs
                    <?php echo e(auth()->check() && $post->reactions && $post->reactions->where('user_id', auth()->id())->count() > 0
                        ? 'bg-red-50 border-red-200 text-red-500' 
                        : 'bg-gray-50 border-gray-200 hover:bg-red-50 hover:border-red-200 hover:text-red-500'); ?>"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" 
                        class="h-4 w-4 transition-transform duration-200 ease-in-out <?php echo e(auth()->check() && $post->reactions && $post->reactions->where('user_id', auth()->id())->count() > 0 ? 'scale-110' : 'scale-100'); ?>" 
                        fill="<?php echo e(auth()->check() && $post->reactions && $post->reactions->where('user_id', auth()->id())->count() > 0 ? 'currentColor' : 'none'); ?>" 
                        viewBox="0 0 24 24" 
                        stroke="currentColor"
                    >
                        <path stroke-linecap="round" 
                            stroke-linejoin="round" 
                            stroke-width="2" 
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" 
                        />
                    </svg>
                    <span id="reactionCount" class="font-medium"><?php echo e($post->reactions ? $post->reactions->count() : 0); ?></span>
                </button>

                <button 
                onclick="openShareModal(<?php echo e($post->id); ?>)"
                class="flex items-center text-xs gap-2 px-4 py-2 rounded-full border transition-all duration-200 ease-in-out bg-gray-50 border-gray-200 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-500"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                </svg>
                <span class="font-medium">Share</span>
            </button>
            
            </div>
        </div>

            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <a href="<?php echo e(route('author', ['user' => $post->user->id])); ?>">
                        <img alt="Author Image" class="w-12 h-12 rounded-full"
                            src="<?php echo e(asset('storage/' . $post->user->profile_image)); ?>" />
                    </a>
                    <div class="ml-3">
                        <p class="text-sm font-bold"><?php echo e($post->user->name); ?></p>
                        <p class="text-xs text-gray-600">Published on <?php echo e($post->created_at->format('F j, Y')); ?></p>
                    </div>
                </div>
                <div class="action-btn">
                    <?php if(auth()->check() && auth()->user()->id == $post->user->id): ?>
                        <button onclick="openEditModal()"
                            class="text-white bg-blue-600 rounded-lg px-4 py-1 hover:bg-blue-900 text-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                    <?php endif; ?>
                    <?php if(auth()->check() && auth()->user()->usertype === 'super'): ?>
                        <button onclick="openDeleteModal(<?php echo e($post->id); ?>)"
                            class="text-white bg-red-600 rounded-lg px-4 py-1 hover:bg-red-900 text-sm">
                            <i class="fa fa-trash"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>

            <style>
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
                .ql-align-center {
                    text-align: center;
                }
                .ql-align-right {
                    float: right;
                }
                .ql-align-justify {
                    text-align: justify;
                    text-justify: inter-word;
                }
                .post-content a {
                    color: #007bff;
                }
                .post-content h1 {
                    font-size: 34px;
                }
                .post-content h2 {
                    font-size: 30px;
                }
                .post-content ol {
                    list-style-type: number;
                }

                .post-content ul {
                    list-style-type: disc;
                }
            </style>
            <div class="whole-content px-4">
                <h1 class="text-3xl font-bold mt-6 mb-4">
                    <span class="text-black font-bold"><?php echo e($post->title); ?></span>
                </h1>

                <hr>

                <div class="post-content">
                    <link href="https://cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
                    <?php echo $post->content; ?>

                </div>
            </div>
        </article>
        
        <div id="shareModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-lg w-96 p-6">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z" />
                        </svg>
                    </div>
                    
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Share this post</h3>
                    <div class="flex items-center justify-between bg-gray-100 p-3 rounded-lg mb-4">
                        <input type="text" id="shareUrl" class="bg-transparent flex-1 border-none focus:ring-0" readonly>
                        <button onclick="copyShareUrl()" class="ml-2 text-blue-600 hover:text-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                            </svg>
                        </button>
                    </div>
        
                    <button onclick="closeShareModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">
                        Close
                    </button>
                </div>
            </div>
        </div>
        
        <script>
        function openShareModal(postId) {
            const shareUrl = `https://bulletin.msoshub.com/posts/${postId}`;
            document.getElementById('shareUrl').value = shareUrl;
            document.getElementById('shareModal').classList.remove('hidden');
        }
        
        function closeShareModal() {
            document.getElementById('shareModal').classList.add('hidden');
        }
        
        function copyShareUrl() {
            const shareUrl = document.getElementById('shareUrl');
            shareUrl.select();
            document.execCommand('copy');
            
            const message = document.createElement('div');
            message.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-out';
            message.textContent = 'Link copied to clipboard!';
            document.body.appendChild(message);
            
            setTimeout(() => message.remove(), 2000);
        }
        
        document.getElementById('shareModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeShareModal();
            }
        });
        </script>

<script>
function toggleReaction(postId) {
    <?php if(auth()->guard()->check()): ?>
        fetch(`/posts/${postId}/react`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            const button = document.getElementById('reactButton');
            const svg = button.querySelector('svg');
            const count = document.getElementById('reactionCount');
            
            count.textContent = data.reactionCount;
            
            if (data.hasReacted) {
                button.classList.add('bg-red-50', 'border-red-200', 'text-red-500');
                button.classList.remove('bg-gray-50', 'border-gray-200');
                svg.setAttribute('fill', 'currentColor');
                svg.classList.add('scale-110');
            } else {
                button.classList.remove('bg-red-50', 'border-red-200', 'text-red-500');
                button.classList.add('bg-gray-50', 'border-gray-200');
                svg.setAttribute('fill', 'none');
                svg.classList.remove('scale-110');
            }
            
            const message = document.createElement('div');
            message.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-out';
            message.textContent = data.message;
            document.body.appendChild(message);
            
            setTimeout(() => message.remove(), 2000);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while processing your reaction');
        });
    <?php else: ?>
        window.location.href = '<?php echo e(route("login")); ?>';
    <?php endif; ?>
}
</script>


        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6444619677143056"
            crossorigin="anonymous"></script>
        <ins class="adsbygoogle" style="display:block; text-align:center;" data-ad-layout="in-article"
            data-ad-format="fluid" data-ad-client="ca-pub-6444619677143056" data-ad-slot="6030470771"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

    </main>
    <div id="editModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center">
        <div
            class="bg-white rounded-lg shadow-lg w-full max-w-4xl h-full max-h-[90%] sm:w-[90%] sm:h-[90%] md:w-[80%] lg:h-[80%] flex flex-col overflow-auto touch-manipulation">
            <form action="<?php echo e(route('posts.update', $post->id)); ?>" method="POST" id="editPostForm"
                enctype="multipart/form-data" class="flex flex-grow flex-col lg:flex-row">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

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
                            <option value="Not Classified" <?php echo e($post->category == 'Not Classified' ? 'selected' : ''); ?>>
                                Not Classified</option>
                            <option value="Merch" <?php echo e($post->category == 'Merch' ? 'selected' : ''); ?>>Merch</option>
                            <option value="Campus" <?php echo e($post->category == 'Campus' ? 'selected' : ''); ?>>Campus</option>
                            <option value="Organization" <?php echo e($post->category == 'Organization' ? 'selected' : ''); ?>>
                                Organization</option>
                            <option value="Research" <?php echo e($post->category == 'Research' ? 'selected' : ''); ?>>Research
                            </option>
                            <option value="Events" <?php echo e($post->category == 'Events' ? 'selected' : ''); ?>>Events</option>
                            <option value="Sports" <?php echo e($post->category == 'Sports' ? 'selected' : ''); ?>>Sports</option>
                            <option value="Environment" <?php echo e($post->category == 'Environment' ? 'selected' : ''); ?>>
                                Environment</option>
                            <option value="Technology" <?php echo e($post->category == 'Technology' ? 'selected' : ''); ?>>
                                Technology</option>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['type' => 'text','id' => 'title','name' => 'title','value' => ''.e($post->title).'','class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'text','id' => 'title','name' => 'title','value' => ''.e($post->title).'','class' => 'mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm','required' => true]); ?>
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
                            onchange="previewCoverPhoto(event)">
                        <span class="text-xs text-gray-600">Best size 500x300 px</span>
                        <img id="coverPreview" class="mt-4 rounded-md shadow-md max-w-full"
                            src="<?php echo e(asset('storage/' . $post->cover_photo)); ?>" />
                    </div>

                    <div class="flex justify-between mt-auto">
                        <button type="button" onclick="closeEditModal()"
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
                        <?php echo $post->content; ?>

                    </div>
                    <input type="hidden" id="content" name="content">
                </div>
            </form>
        </div>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-75 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6">
            <div class="text-center">
                
                <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>

                <h3 class="text-lg font-medium text-gray-900 mb-2">Delete Post</h3>
                <p class="text-sm text-gray-500 mb-6">Are you sure you want to delete this post? This action cannot be
                    undone.</p>

                <div class="flex justify-center space-x-4">
                    <button onclick="closeDeleteModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium">
                        Cancel
                    </button>
                    <button id="confirmDeleteBtn"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium">
                        Delete
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let postIdToDelete = null;

        function openDeleteModal(postId) {
            postIdToDelete = postId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            postIdToDelete = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (postIdToDelete) {
                const formData = new FormData();
                formData.append('_method', 'DELETE');

                fetch(`/posts/${postIdToDelete}`, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content'),
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        closeDeleteModal();
                        if (data.success) {
                            const successMessage = document.createElement('div');
                            successMessage.className =
                                'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-fade-in-out';
                            successMessage.textContent = data.message;
                            document.body.appendChild(successMessage);

                            setTimeout(() => {
                                successMessage.remove();
                                window.location.href = data.redirect;
                            }, 1000);
                        } else {
                            alert(data.message || 'Error deleting post');
                        }
                    })
                    .catch(error => {
                        closeDeleteModal();
                        console.error('Error:', error);
                        alert('An error occurred while deleting the post');
                    });
            }
        });

        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        const style = document.createElement('style');
        style.textContent = `
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            10% { opacity: 1; transform: translateY(0); }
            90% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
        .animate-fade-in-out {
            animation: fadeInOut 2s ease-in-out;
        }
    `;
        document.head.appendChild(style);
    </script>


    <script>
        function previewCoverPhoto(event) {
            const file = event.target.files[0];
            const coverPreview = document.getElementById('coverPreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    coverPreview.src = e.target.result;
                    coverPreview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            } else {
                coverPreview.src = "<?php echo e(asset('storage/' . $post->cover_photo)); ?>";
            }
        }

        function openEditModal() {
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike', 'link'],
            ['image'],
            [{ 'align': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'header': 1 }, { 'header': 2 }],
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

        document.getElementById('editPostForm').addEventListener('submit', function(e) {
            e.preventDefault();

            var content = quill.root.innerHTML;
            document.getElementById('content').value = content;

            var formData = new FormData(this);

            fetch('<?php echo e(route('posts.update', $post->id)); ?>', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.errors) {
                        console.log('Validation Errors:', data.errors);
                        alert('There were errors in your form.');
                    } else {
                        alert(data.message);
                        closeEditModal();
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Check console for details.');
                });
        });
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
<?php /**PATH C:\xampp\htdocs\LARAVEL\MSOS_BULLETIN\resources\views/article.blade.php ENDPATH**/ ?>