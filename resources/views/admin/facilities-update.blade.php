<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
</head>
<body>
  

    <x-app-layout>

        <div class="flex h-[100vh] bg-white">
            <!-- Sidebar -->
    
            
            
            <!-- Main content -->
            <div class="w-full md:w-5/6">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
               
                <div>   

                <div class="container mx-auto p-6">
                <!-- Images Section -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                        @foreach ($facilities as $facility)
                            @foreach ($facility->images as $image)
                                <img class="w-full h-[200px] object-cover rounded-lg shadow-md" src="{{ asset('images/' . $image) }}" alt="Image">
                            @endforeach
                        @endforeach
                    </div>

                <!-- Form Section -->
                <form action="{{ route('facilities.update', $facility->id ?? '') }}" method="POST" enctype="multipart/form-data" id="facility-form">
                    @csrf
                    @method('POST') <!-- Add this if your route uses POST instead of PUT/PATCH -->
                    <input type="hidden" name="facility_id" value="{{ $facility->id ?? '' }}">

                    <div class="mb-4">
                        <label for="category" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Category</label>
                        <select id="category" name="category" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">
                            @foreach ($categoryIds as $id => $categoryName)
                                <option value="{{ $id }}" {{ $facility->category_id == $id ? 'selected' : '' }}>{{ $categoryName }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="facility-name" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Facility Name</label>
                        <input type="text" id="facility-name" name="facility_name" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $facility->facility_name ?? '' }}">
                    </div>

                    <div class="mb-4">
                        <label for="price" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Price</label>
                        <input type="number" id="price" name="price" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" value="{{ $facility->price ?? '' }}">
                    </div>

                    <div class="mb-4">
                        <label for="amenities" class="block mb-2 text-sm font-medium text-gray-700 dark:text-gray-300">Amenities (comma-separated)</label>
                        <textarea id="amenities" name="amenities" rows="3" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white">{{ $facility->amenities ?? '' }}</textarea>
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



    </x-app-layout>


    <script>
    function previewImages() {
        const previewContainer = document.getElementById('image-preview');
        previewContainer.innerHTML = '';
        const files = document.getElementById('images').files;

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'w-[100px] h-[100px] object-cover rounded-lg shadow-md';
                previewContainer.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    }
</script>



</body>
</html>



