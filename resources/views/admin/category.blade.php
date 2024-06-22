<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  @vite('resources/css/app.css')
</head>
<body>
  

    <x-app-layout>


        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('deleted'))
            <div class="alert alert-success">
                {{ session('deleted') }}
            </div>
        @endif

        @if (session('updated'))
            <div class="alert alert-success">
                {{ session('updated') }}
            </div>
        @endif

        <div class="flex h-[100vh] bg-white">
            <!-- Sidebar -->
            <x-AdminSideBar />
            
            <!-- Main content -->
            <div class="w-full md:w-5/6">

               
               
                <div>   <!--  --------------------------- Start main content goes here ---------------------------  -->
                
                    <div>
                        <div class="flex justify-between px-8 py-4">
                            <div>
                                <input type="text" placeholder="Search..." class="px-3 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white placeholder-gray-400">
                            </div>
                            <div>
                                <button  data-modal-target="default-modal" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add</button>
                            </div>
                        </div>
                    </div>

                    <div class="relative overflow-hidden shadow-md sm:rounded-lg p-2">
                        <table class="min-w-full divide-y divide-gray-200 hidden md:table">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <div class="flex items-center">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div>                                                                                                                              
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                               
                                @foreach ($categories as $category)
                                    <tr>
                                        <td class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-{{ $category->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 category-checkbox" data-id="{{ $category->id }}">
                                                <label for="checkbox-{{ $category->id }}" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $category->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            <input type="text" class="category-name-input border-none" value="{{ $category->category_name }}" data-id="{{ $category->id }}">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 dark:text-blue-500">
                                            <button class="save-category-btn hover:underline" data-id="{{ $category->id }}">Save</button>
                                        </td>
                                    </tr>
                                @endforeach


                                <form id="update-category-form" action="{{ route('category.update') }}" method="post" style="display: none;">
                                    @csrf
                                    <input type="hidden" name="category_id" id="hidden-category-id">
                                    <input type="hidden" name="category_name" id="hidden-category-name">
                                </form>
                               

                            </tbody>
                        </table>

                        <div>
                            <!-- show all Id that user click here -->
                            <form class="mt-8" action="{{ route('category.destroy') }}" method="POST">
                                @csrf <!-- Include CSRF token -->
                                <input type="hidden" id="selected-ids" name="selected_ids" value="">
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Delete Selected</button>
                            </form>
                        </div>

                       
                    </div>

                </div>  <!--  --------------------------- Start main content goes here ---------------------------  -->
            </div>


        </div>



        <!-- Modal toggle --> <!-- Main modal -->
        <x-adminCategoryModal />




    </x-app-layout>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <script>
        document.querySelectorAll('.save-category-btn').forEach(button => {
        button.addEventListener('click', function(event) {
                event.preventDefault();
                
                const categoryId = this.getAttribute('data-id');
                const categoryName = document.querySelector(`.category-name-input[data-id='${categoryId}']`).value;

                document.getElementById('hidden-category-id').value = categoryId;
                document.getElementById('hidden-category-name').value = categoryName;

                document.getElementById('update-category-form').submit();
            });
        });
    </script>

    <script>
        document.querySelectorAll('[data-modal-target]').forEach(button => {
            const modalId = button.getAttribute('data-modal-target');
            const modal = document.getElementById(modalId);

            button.addEventListener('click', () => {
                modal.classList.toggle('hidden');
                modal.setAttribute('aria-hidden', modal.classList.contains('hidden'));
                document.body.classList.toggle('overflow-hidden'); // Prevent scrolling when modal is open
            });
        });

        document.querySelectorAll('[data-modal-hide]').forEach(button => {
            const modalId = button.getAttribute('data-modal-hide');
            const modal = document.getElementById(modalId);

            button.addEventListener('click', () => {
                modal.classList.add('hidden');
                modal.setAttribute('aria-hidden', modal.classList.contains('hidden'));
                document.body.classList.remove('overflow-hidden'); // Enable scrolling when modal is closed
            });
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('.category-checkbox');
            const inputField = document.getElementById('selected-ids');

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function () {
                    const selectedIds = Array.from(checkboxes)
                        .filter(chk => chk.checked)
                        .map(chk => chk.getAttribute('data-id'));
                    
                    inputField.value = selectedIds.join(', ');
                });
            });
        });
    </script>



</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</html>



