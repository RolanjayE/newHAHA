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
            <x-AdminSideBar />
            
            
            <!-- Main content -->
            <div class="w-full md:w-5/6">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
               
                <div>   <!--  --------------------------- Start main content goes here ---------------------------  -->
                
                    <div>
                        <div class="flex justify-between px-8 py-4">
                            <div>
                                <input type="text" placeholder="Search..." class="px-3 py-2 w-full border border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white placeholder-gray-400">
                            </div>
                            <div>
                                <button  data-modal-target="default-modal" class="inline-flex items-center px-2 py-1 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add</button>
                                <button class="inline-flex items-center px-2 py-1 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">Delete</button>
                            </div>
                        </div>
                    </div>

                    <div class="relative shadow-md sm:rounded-lg p-2">
                        <table class="min-w-full divide-y divide-gray-200 md:table">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="p-4">
                                        <!-- <div class="flex items-center">
                                            <label for="checkbox-all-search" class="sr-only">checkbox</label>
                                        </div> -->
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Facility</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Discount</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actual Price</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($facilities as $facility)
                                <tr>
                                    <td class="p-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-table-search-{{ $facility->id }}" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-table-search-{{ $facility->id }}" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">{{ $facility->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $facility->category_id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $facility->facility_name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">₱{{ number_format($facility->price, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">{{ $facility->discount }}%</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">₱{{ number_format($facility->price - ($facility->price * ($facility->discount / 100)), 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-blue-600 dark:text-blue-500">
                                        <a href="{{ route('facilities.edit', ['id' => $facility->id]) }}" class="hover:underline">Edit</a>
                                    </td>
                                </tr>
                                <!-- Repeat the tr for other rows -->
                            @endforeach
                                <!-- Repeat the tr for other rows -->
                            </tbody>
                        </table>
                    </div>

                </div>  <!--  --------------------------- Start main content goes here ---------------------------  -->
            </div>


        </div>



        <!-- Modal toggle --> <!-- Main modal -->
        <x-admin-facilities-modal :categoryIds="$categoryIds" />




    </x-app-layout>

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

</body>
</html>



