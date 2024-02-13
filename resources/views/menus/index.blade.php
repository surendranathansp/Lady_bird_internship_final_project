<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div id="menus_list" class="grid lg:grid-cols-4 gap-y-6"></div>
    </div>

    <script>
       fetch('/web-api/menus/list')
    .then(response => response.json())
    .then(responseData => {
        const data = responseData.data;
        data.forEach(function(menu) {
    

            // Example: Append the price to the HTML markup
            var row = '<div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">'+
                '<img class="w-full h-48" src="' + menu.image + '" alt="Image" />'+
                '<div class="px-6 py-4">'+
                    '<h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">' + menu.name + '</h4>'+
                    '<p class="leading-normal text-gray-700">' + menu.description + '</p>'+
                '</div>'+
               
            '</div>';
            $('#menus_list').append(row);
        });
    });
    </script>
</x-guest-layout>
