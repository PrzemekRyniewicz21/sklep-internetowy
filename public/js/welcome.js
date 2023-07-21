/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/welcome.js ***!
  \*********************************/
// zamiennik dla document.ready()
// $(function(){
//
//})

$(function () {
  $('div.products-count a').on('click', function () {
    $('a.products-actual-count').text($(this).text());
    getProduct($(this).text());
  });
  $('a#button').on('click', function () {
    getProduct($('a.products-actual-count'));
  });
  function getProduct(paginate) {
    var form = $('form.sidebar-filter').serialize(); // serialize() wezmie tylko zaznaczone pola!
    // console.log(form);

    $.ajax({
      method: "GET",
      url: "/",
      data: form + "&" + $.param({
        paginate: paginate
      })
    }).done(function (response) {
      $('div#products-wrapper').empty();
      $.each(response.data, function (index, product) {
        var html = '<div class="col-6 col-md-6 col-lg-4 mb-3">' + '<div class="card h-100 border-0">' + '<div class="card-img-top">' + '<img src="' + getImage(product) + '" class="img-fluid mx-auto d-block" alt="Prodcut img">' + '</div>' + '<div class="card-body text-center">' + '<h4 class="card-title">' + product.name + '</h4>' + '<h5 class="card-price small text-warning">' + '<i>PLN ' + product.price + '</i>' + '</h5>' + '</div>' + '</div>' + '</div>';
        $('div#products-wrapper').append(html);
      });
    }).fail(function (data) {
      alert("ERROR");
    });
  }
  function getImage(product) {
    if (!!product.img_path) {
      return storage + product.img_path;
    }
    return default_img;
  }
});
/******/ })()
;