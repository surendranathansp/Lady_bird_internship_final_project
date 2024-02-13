<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.categories.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Category Index</a>
            </div>
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form id="updateCategoryForm" method="POST" action="{{ route('admin.categories.update', $id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
                            <div class="mt-1">
                                <input type="text" id="name" name="name" value=""
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="image" class="block text-sm font-medium text-gray-700"> Image </label>
                            <div>
                                <input type="hidden" name="old_image" value="">
                                <img id="view_image" class="w-32 h-32" src="">
                            </div>
                            <div class="mt-1">
                                <input type="file" id="image" name="image"
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('image')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6 pt-5">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <div class="mt-1">
                                <textarea id="description" rows="3" name="description"
                                    class="shadow-sm focus:ring-indigo-500 appearance-none bg-white border py-2 px-3 text-base leading-normal transition duration-150 ease-in-out focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    
                                </textarea>
                            </div>
                            @error('description')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-6 p-4">
                            <button type="submit"
                                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Update</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script>
        fetch('/api/categories/details/' + {{$id}})
            .then(response => response.json())
            .then(data => {
                console.log(data.data.id);
                $("#name").val(data.data?.name);
                $("#description").val(data.data?.description);
                $("#old_image").val(data.data?.image);

                $('#view_image').append('<img id="view_image" class="w-32 h-32" src="'+ data.data?.image +'">');
            });

            document.addEventListener('submit', async function(event) {
                if (event.target.id === 'updateCategoryForm') {
                    event.preventDefault();

                    try {
                        const response = await fetch(event.target.action, {
                            method: event.target.method,
                            body: new FormData(event.target),
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        });
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        const data = await response.json();
                        if (data.success) {
                            handleSuccess(data);
                        } else {
                            handleFailure(data);
                        }
                    } catch (error) {
                        handleError(error);
                    }
                }
            });

            function handleSuccess(data) {
                console.log('Success:', data);
                alert(data.message);
                window.location.href = '{{ route('admin.categories.index') }}';
            }

            function handleFailure(data) {
                if (data.errors) {
                    alert('Validation error: ' + data.errors.join(', '));
                } else {
                    alert('Failed to create category: ' + data.message);
                }
            }

            function handleError(error) {
                console.error('Error:', error);
                alert('An error occurred while updating category.');
            }
    </script>
</x-admin-layout>