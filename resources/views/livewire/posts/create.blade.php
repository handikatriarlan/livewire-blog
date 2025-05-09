@section('title')
Create Post
@endsection

<div class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl w-full">
        <div class="mb-6 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900 dark:text-white">Create New Post</h1>
                <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">Add a new post to your blog</p>
            </div>
            <a href="/" wire:navigate class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 shadow-sm text-sm font-medium rounded-md text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Back to Posts
            </a>
        </div>

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form wire:submit="store" enctype="multipart/form-data">
                    <!-- Image Upload -->
                    <div class="mb-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Featured Image</label>
                        <div class="mt-1">
                            @if ($image)
                                <div class="mb-4">
                                    <div class="relative">
                                        <img src="{{ $image->temporaryUrl() }}" alt="Image Preview" class="w-full h-64 object-cover rounded-md">
                                        <button type="button" wire:click="$set('image', null)" class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full hover:bg-red-600 transition-colors duration-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @else
                                <label class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-md cursor-pointer hover:border-gray-400 dark:hover:border-gray-500 transition-colors duration-200">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <span class="relative bg-white dark:bg-gray-700 rounded-md font-medium text-primary-600 dark:text-primary-400 hover:text-primary-500 dark:hover:text-primary-300 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-primary-500 px-2">
                                                Upload a file
                                            </span>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            PNG, JPG, GIF up to 10MB
                                        </p>
                                    </div>
                                    <input id="image" type="file" class="sr-only" wire:model="image">
                                </label>
                            @endif
                        </div>
                        @error('image')
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Title Input -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Title</label>
                        <input type="text" id="title" wire:model="title" placeholder="Enter post title" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md px-4 py-2">
                        @error('title')
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Content Textarea -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Content</label>
                        <textarea id="content" wire:model="content" rows="8" placeholder="Enter post content" class="shadow-sm focus:ring-primary-500 focus:border-primary-500 block w-full sm:text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md px-4 py-2"></textarea>
                        @error('content')
                        <div class="mt-2 text-sm text-red-600 dark:text-red-400">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-my-cyan hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500 transition-colors duration-200">
                            <svg wire:loading wire:target="store" class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <svg wire:loading.remove wire:target="store" xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            <span wire:loading.remove wire:target="store">Create Post</span>
                            <span wire:loading wire:target="store">Creating...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>