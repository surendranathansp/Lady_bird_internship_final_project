<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex m-2 p-2">
                <a href="{{ route('admin.table.index') }}"
                    class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded-lg text-white">Menu Index</a>
            </div>
            <div class="m-2 p-2 bg-slate-100 rounded">
                <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                    <form id="updateTableForm" method="POST" action="{{ route('admin.table.update', $id) }}"
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
                            <label for="guest_number" class="block text-sm font-medium text-gray-700"> Guest Number </label>
                            <div class="mt-1">
                                <input type="number" id="guest_number" name="guest_number" value=""
                                    class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                            </div>
                            @error('name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="sm:col-span-6">
                            <label for="location" class="block text-sm font-medium text-gray-700"> Location </label>
                            <div class="mt-1">
                                <select name="location" id="location" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('status') border-red-400 @enderror">
                                    <option value="front">Front</option>
                                    <option value="inside">Inside</option>
                                    <option value="outside">Outside</option>
                                </select>
                            </div>
                            @error('name')
                                <div class="text-sm text-red-400">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="sm:col-span-6">
                            <label for="status" class="block text-sm font-medium text-gray-700"> Status </label>
                            <div class="mt-1">
                                <select name="status" id="status" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('status') border-red-400 @enderror">
                                    <option value="pending">Pending</option>
                                    <option value="available">Available</option>
                                    <option value="unavailable">Unavailable</option>
                                </select>
                            </div>
                            @error('name')
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
        fetch('/api/table/details/' + {{$id}})
            .then(response => response.json())
            .then(data => {
                console.log(data.data.id);
                $("#name").val(data?.data?.name);
                $("#guest_number").val(data?.data?.guest_number);
                $("#location").val(data?.data?.location);
                $("#status").val(data?.data?.status);
            });

        document.addEventListener('submit', async function(event) {
            if (event.target.id === 'updateTableForm') {
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
            window.location.href = '{{ route('admin.table.index') }}';
        }

        function handleFailure(data) {
            if (data.errors) {
                alert('Validation error: ' + data.errors.join(', '));
            } else {
                alert('Failed to update table: ' + data.message);
            }
        }

        function handleError(error) {
            console.error('Error:', error);
            alert('An error occurred while updating table.');
        }
    </script>
</x-admin-layout>
