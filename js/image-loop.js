// Выбираем все preview-photo и вешаем события
const images = document.querySelectorAll('.product__preview--photo');
images.forEach(item => {
  item.addEventListener('mouseenter', event => {
    document.querySelectorAll('.product__main--photo').forEach(mainPhoto => {
      mainPhoto.setAttribute('src', item.getAttribute('src'));
    })
  });
});

