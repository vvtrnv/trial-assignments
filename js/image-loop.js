
// Выбираем все preview-photo и вешаем события
const images = document.querySelectorAll('.product__preview--photo');
images.forEach(item => {
  item.addEventListener('mouseenter', event => {
    document.getElementById('main-photo').src = item.src;
  });
});
