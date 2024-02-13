<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div id="categories_list" class="grid lg:grid-cols-4 gap-y-6"></div>
    </div>

    <script>
        fetch('/web-api/categories/list')
            .then(response => response.json())
            .then(data => {
                data.data.forEach(function(category) {
                    var url = "/categories/show/" + category.id;
                    var row = '<div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">'+
                    '<img class="w-full h-48" src="' + category.image + '" alt="Image" />'+
                    '<div class="px-6 py-4">'+
                        '<a href="' + url + '">'+
                            '<h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase"> ' + category.name + '</h4>'+
                        '</a>'+
                    '</div>'+
'                </div>';
                    $('#categories_list').append(row);
                });
            });
    </script>
</x-guest-layout>
