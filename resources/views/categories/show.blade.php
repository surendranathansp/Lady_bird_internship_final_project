<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                <img id="image" class="w-full h-48" src="#" alt="Image" />
                <div class="px-6 py-4">
                    <h4 id="name" class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase"></h4>
                    <p id="description" class="leading-normal text-gray-700">
                    </p>
                </div>
                <div class="flex items-center justify-between p-4">
                    <span id="price" class="text-xl text-green-600"></span>
                </div>
            </div>
        </div>
    </div>

    <script>
        fetch('/web-api/categories/details/' + {{$id}})
            .then(response => response.json())
            .then(data => {
                console.log(data.data.id);
                $("#name").html(data?.data?.name);
                $("#description").html(data?.data?.description);
                $("#price").html(data?.data?.price);
                $("img").attr("src", data?.data?.image);
            });
    </script>
</x-guest-layout>
