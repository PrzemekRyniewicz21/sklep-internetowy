// zamiennik dla document.ready()
// $(function(){
//
//})

$(function () {



    $('div.dropdown-menu a').on('click', function () {
        $('a.actual-dropdown-toggle').text($(this).text());
        const p = $('a.products-actual-count').first().text();
        const sort = $('a.actual-dropdown-toggle').text();

        getProduct(p, sort);

    });

    $('div.products-count a').on('click', function () {
        $('a.products-actual-count').text($(this).text());
        getProduct($(this).text());
    });

    $('a#button').on('click', function () {
        // alert("??");
        getProduct($('a.products-actual-count').first().text()); // first() dlatego, ze mamy dwa elementy a.products-actual-count na naszej stronie
    });

    $('div#products-wrapper').on('click', 'button.add-cart-button', function () {
        // alert("??");
        $.ajax({
            method: "POST",
            url: 'cart/' + $(this).data('id')

        }).done(function () {
            alert("Added to cart");

        }).fail(function () {
            alert("Err");
        });
    });


    //order/admin - przysik zmiany statusu zamowienia
    $('button#change-status').on('click', function () {
        const id = $(this).val();

        $(this).attr('class', 'btn btn-outline-success');
        $(this).text("Sent");

        $.ajax({
            method: "PUT",
            url: "orders/" + id,
        }).done(function () {
            alert("Update statusu");
        }).fail(function () {
            alert("Update statusu - FAIL");
        });
    });

    function getProduct(paginate = 1, sort = "asc") {
        const form = $('form.sidebar-filter').serialize(); // serialize() wezmie tylko zaznaczone pola!
        // console.log("test123");

        $.ajax({
            method: "GET",
            url: "/",
            // data: form + "&" + $.param({paginate: paginate})
            data: form + "&" + $.param({ paginate: paginate }) + "&" + $.param({ sort: sort })

        }).done(function (response) {
            // console.log(response.data);
            $('div#products-wrapper').empty();

            $.each(response.data, function (index, product) {

                const html =
                    '<div class="col-6 col-md-6 col-lg-4 mb-3">' +
                    '<div class="card h-100 border-0">' +
                    '<div class="card-img-top">' +
                    '<img src="' + getImage(product) + '" class="img-fluid mx-auto d-block" alt="Prodcut img">' +
                    '</div>' +
                    '<div class="card-body text-center">' +
                    '<h4 class="card-title">' +
                    '<a href="' + getProductLink(product) + '">' + product.name + '</a>' +
                    '</h4>' +
                    '<h5 class="card-price small text-warning">' +
                    '<i>PLN ' + product.price + '</i>' +
                    '</h5>' +
                    '<button class="btn btn-success btn-sm add-cart-button" ' + getDisabled() + ' data-id="' + product.id + '">' +
                    '<i class="fa-solid fa-cart-shopping">Add to cart ?? </i>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +

                    '</div>';


                $('div#products-wrapper').append(html);
            });

        }).fail(function (data) {
            // alert("ERR");
        });
    }

    function getProductLink(product) {
        // chcialem zeby nazwa produktu linkowala do podglądu, ale nie da se po porostu zrobic w js tego w ten sposob:
        // <a href="{{ route('products-show', $product->id) }}">{{ $product->name }}</a> - przyklad z welcome.blade.php
        // dlatego stworzylem osobną funkcje, która zwraca cos takiego:

        return "/products/id".replace('id', product.id);
    }

    function getImage(product) {
        if (!!product.img_path) {
            return storage + product.img_path;
        }
        return default_img;
    }

    function getDisabled() {

        if (is_guest) {
            return 'disabled';
        }
        return '';
    }

});