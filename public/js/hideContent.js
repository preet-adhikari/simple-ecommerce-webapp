// const contentHide = document.querySelectorAll('.category-hide');
// const contentToggle = document.querySelector('.content-toggle');
//
// contentToggle.addEventListener('click', (e) => {
//     contentHide.classList.toggle('show-content');
//
// });
$('.content-toggle').click(function(){
    $('.category-hide').addClass('show-content');
    $('.show-less').css('display', 'block');
    $('.content-toggle').css('display', 'none');
})
$('.show-less').click(function (){
    $('.category-hide').removeClass('show-content');
    $('.content-toggle').css('display', 'block');
    $('.show-less').css('display', 'none');
})
