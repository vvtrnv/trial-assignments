let quantity = 1;

function test() {
  console.log(quantity);
}

function changeImage(elem, src) {
  elem.setAttribute('src', src);
}


$(document).ready(function() {

  // Событие при потери фокуса полем input
  $('.product__quantity input').on('focusout', function(e) {
    let $this = $(this);
    quantity = parseInt($this.val()) ? parseInt($this.val()) : 1;

    $this.val(quantity);
  })

  // Событие при нажатии на кнопку '-'
  $('.button-minus').on('click', function(e) {
    e.preventDefault();

    let $this = $(this);
    let $input = $this.closest('div').find('input');
    quantity = parseInt($input.val()) ? parseInt($input.val()) : 1; // Обработка на пустое поле input

    if (quantity > 1) {
      quantity -= 1;

      // Смена картинки минуса
      $this.children().each(function (index, elem) {
        changeImage(elem, '../img/icons/minus.svg');
      });
    }

    if(quantity === 1) {
      $this.children().each(function (index, elem) {
        changeImage(elem, '../img/icons/minus_disable.svg')
      });
    }

    $input.val(quantity);
  });

  // Событие при нажатии на кнопку '+'
  $('.button-plus').on('click', function(e) {
    e.preventDefault();

    let $this = $(this);
    let $input = $this.closest('div').find('input');
    quantity = parseInt($input.val()) ? parseInt($input.val()) + 1 : 1;

    if(quantity > 1) {
      // Смена картинки минуса
      $this.closest('div').find('.button-minus').children().each(function (index, elem) {
        changeImage(elem, '../img/icons/minus.svg')
      });
    }

    $input.val(quantity);
  })


  $('.product__actions .button-buy').on('click', function(e) {
    $.notify("В корзину добавлено " + quantity + " товаров", 'success');

    quantity = 1;
    $('.product__quantity input').val(quantity);
  })
})
