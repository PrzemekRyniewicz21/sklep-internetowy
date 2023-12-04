// bład servera 500 - na ten moement nie wiem jak to naprawic :/
// wiec uzyje metody get
// edit - problem polegał na dd() w funkcji store w controlerze, ktore przerywalo działanie ajax'a

$(function () {
    alert("?");
    $('tr').on('click', function () {
        const parameters = {
            id: $(this).find('[name="id"]').html(),
            name: $(this).find('[name="name_"]').html(),
            description: $(this).find('[name="description"]').html(),
            amount: $(this).find('[name="amount"]').html(),
            price: $(this).find('[name="price"]').html(),
            category: $(this).find('[name="category"]').html()
        };

        $.ajax({
            type: "POST",
            url: "/hurtownia/add_element",
            data: parameters

        }).done(function (response) {
            window.location.href = "/hurtownia/list?msg=Added&name=" + parameters.name;

        }).fail(function (error) {
            console.error("Error:", error);
            alert("Wystąpił błąd");

        });
    });
});

// $(function () {
//     // alert("??2");
//     $('tr').on('click', function () {
//         const parameters = [
//             { key: "id", value: $(this).find('[name="id"]').html() },
//             { key: "name", value: $(this).find('[name="name_"]').html() },
//             { key: "description", value: $(this).find('[name="description"]').html() },
//             { key: "amount", value: $(this).find('[name="amount"]').html() },
//             { key: "price", value: $(this).find('[name="price"]').html() },
//             { key: "category", value: $(this).find('[name="category"]').html() }
//         ];

//         var url = "/hurtownia/add_element/?" + parameters.map(zmienna_pomocnicza => `${zmienna_pomocnicza.key}=${encodeURIComponent(zmienna_pomocnicza.value)}`).join("&");

//         window.location.href = url;
//     });
// });
