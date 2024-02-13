<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end m-2 p-2">
                <a href="{{ route('admin.categories.create') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">New Category</a>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden shadow-md sm:rounded-lg">
                            <table id="categories-table" class="min-w-full">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Name
                                        </th>
                                     
                                        <th scope="col"
                                            class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            Description
                                        </th>
                                        <th scope="col"
                                        class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Image
                                    </th>
                                        <th scope="col" class="relative py-3 px-6">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
function deleteCategory(categoryId) {
    fetch('{{ route("admin.categories.destroy", "") }}/' + categoryId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
    })
    .then(response => {
        if (response.ok) {
            // Remove the category row from the table
            $('#category-row-' + categoryId).remove();
            // Parse JSON response
            return response.json();
        } else if (response.status === 404) {
            // Handle 404 Not Found error
            throw new Error('Category not found.');
        } else {
            // Handle other errors (e.g., server error)
            throw new Error('Failed to delete category.');
        }
    })
    .then(data => {
        // Show success message
        alert(data.message);
    })
    .catch(error => {
        if (error.message === 'Category not found.') {
            // Handle 404 Not Found error (optional)
            console.error('Category not found:', error);
            // Optionally, display a different message or take other action
        } else {
            // Handle other errors
            console.error('Error:', error);
            alert('An error occurred while deleting category.');
        }
    });
}


        fetch('/api/categories/list')
            .then(response => response.json())
            .then(data => {
                data.data.forEach(function(category) {
                    var url = "/admin/categories/edit/" + category.id;
                    var row = '<tr id="category-row-' + category.id + '">' +
                
                        '<td>' + category.name + '</td>' +
                        '<td>' + category.description + '</td>' +
                        '<td><img src="' + category.image + '" alt="' + category.name + '" width="100"></td>' +
                        
                        '<td>' +
    '<button onclick="window.location.href=\'' + url + '\'" class="btn btn-primary mr-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white" style="min-width: 100px;">Edit</button>' +
    '<button onclick="deleteCategory(' + category.id + ')" class="btn btn-danger bg-indigo-500 hover:bg-red-700 rounded-lg text-white" style="min-width: 100px;">Delete</button>' +
'</td>' +
'</tr>';
'</tr>';

                    $('#categories-table tbody').append(row);
                });
            });
    </script>
</x-admin-layout>