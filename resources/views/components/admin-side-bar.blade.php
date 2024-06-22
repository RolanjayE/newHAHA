
<!-- Sidebar -->
<div class="hidden md:block md:w-1/6 border-r bg-gray-900">
    <ul class="text-white p-8">
        <li class="py-2 {{ request()->routeIs('dashboard') ? 'text-gray-400' : '' }}">
            <a class="hover:text-gray-400" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li class="py-2 {{ request()->routeIs('category.view') ? 'text-gray-400' : '' }}">
            <a class="hover:text-gray-400" href="{{ route('category.view') }}">Category</a>
        </li>
        <li class="py-2">
            <div class="flex items-center">
                <a class="hover:text-gray-400 cursor-pointer" id="facilitiesDropdown">
                    Facilities <span class="ml-2">&#8250;</span>
                </a>
            </div>
            <ul id="facilitiesDropdownContent" class="hidden pl-4 py-3">
                <!-- Add more links for facilities dropdown -->
                <li class="{{ request()->routeIs('facilities.view') ? 'text-gray-400' : '' }} py-1">
                    <a href="{{ route('facilities.view') }}" class="hover:text-gray-400">Add Facilities</a>
                </li>
                <!-- Add more links as needed -->
                <li class="{{ request()->routeIs('facilities.view') ? 'text-gray-400' : '' }} py-1">
                    <a href="{{ route('facilities.view') }}" class="hover:text-gray-400">Deleted</a>
                </li>
                <li class="{{ request()->routeIs('facilities.view') ? 'text-gray-400' : '' }} py-1">
                    <a href="{{ route('facilities.view') }}" class="hover:text-gray-400"></a>
                </li>
            </ul>
        </li>
    </ul>
</div>

<style>
    /* CSS for dropdown icon */
    #facilitiesDropdown > span {
        transition: transform 0.3s ease;
    }

    #facilitiesDropdown.expanded > span {
        transform: rotate(90deg);
    }
</style>

<script>
    // JavaScript to toggle the visibility of the facilities dropdown content
    document.getElementById('facilitiesDropdown').addEventListener('click', function() {
        var dropdownContent = document.getElementById('facilitiesDropdownContent');
        dropdownContent.classList.toggle('hidden');
        this.classList.toggle('expanded');
    });
</script>

