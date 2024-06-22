<div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Add Facilities
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 space-y-6">
                

                    <form action="{{ route('facilities.store') }}" method="POST" enctype="multipart/form-data" id="facility-form">
                        @csrf
                        <div class="mb-4">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                            <select id="category" name="category" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                                @foreach ($categoryIds as $id => $categoryName)
                                    <option value="{{ $id }}">{{ $categoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="facility-name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Facility Name</label>
                            <input type="text" id="facility-name" name="facility_name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <div class="mb-4">
                            <label for="price" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                            <input type="number" id="price" name="price" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                        </div>
                        <div class="mb-4">
                            <label for="discount" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Discount</label>
                            <input type="number" id="discount" name="discount" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white transition duration-300 ease-in-out transform hover:scale-105">
                        </div>
                    
                        <div class="mb-4">
                            <label for="amenities" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Amenities (comma-separated)</label>
                            <textarea id="amenities" name="amenities" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="images" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Images</label>
                            <input type="file" id="images" name="images[]" multiple class="mt-1 block w-full px-3 py-2 text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" onchange="previewImages()">
                        </div>
                        <div id="image-preview" class="flex flex-wrap gap-2 mb-4"></div>
                        <div class="flex items-center justify-end mt-4 border-t border-gray-200 pt-4 dark:border-gray-600">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700">SAVE</button>
                        </div>
                    </form>


            </div>
        </div>
    </div>
</div>

<script>
    function previewImages() {
        var preview = document.getElementById('image-preview');
        preview.innerHTML = '';
        var files = document.getElementById('images').files;
        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            var reader = new FileReader();
            reader.onload = function (e) {
                var container = document.createElement('div');
                container.className = 'relative w-24 h-24';

                var img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'h-full w-full object-cover rounded';

                container.appendChild(img);
                preview.appendChild(container);
            }
            reader.readAsDataURL(file);
        }
    }

    function updateFormData() {
        var preview = document.getElementById('image-preview');
        var files = document.getElementById('images').files;
        var formData = new FormData();
        Array.from(preview.children).forEach(function(container, index) {
            var file = files[index];
            if (file) {
                formData.append('images[]', file);
            }
        });
        // Update the form data
        var form = document.getElementById('facility-form');
        form.querySelectorAll('[name^="images"]').forEach(function(input) {
            var index = Array.from(preview.children).indexOf(input.parentElement);
            if (index === -1) {
                input.remove();
            }
        });
        formData.forEach(function(value, key) {
            form.append(key, value);
        });
    }
</script>






