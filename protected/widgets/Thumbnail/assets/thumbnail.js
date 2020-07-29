$(function () {
    //при нажатии на изображение, класса thumbnail
    // noinspection JSCheckFunctionSignatures
    $('img.thumbnail').click(function (e) {
        //отменить стандартное действие браузера
        e.preventDefault();
        //присвоить атрибуту scr элемента img модального окна
        //значение атрибута scr изображения, которое обернуто
        //вокруг элемента a
        let src = $(this).attr('src');
        const path_split = src.split('/');
        const index = path_split.lastIndexOf('thumbnail');
        if (index === -1) return;
        delete path_split[index];
        src = path_split.join('/');

        // noinspection JSJQueryEfficiency
        $('#image-modal .modal-body img').attr('src', src);
        //открыть модальное окно
        // noinspection JSUnresolvedFunction
        $('#image-modal').modal('show');
    });
    //при нажатию на изображение внутри модального окна
    //закрыть его (модальное окно)
    // noinspection JSJQueryEfficiency
    $('#image-modal .modal-body img').on('click', function () {
        // noinspection JSUnresolvedFunction
        $('#image-modal').modal('hide');
        //удалить изображение
        // noinspection JSJQueryEfficiency
        $('#image-modal .modal-body img').attr('src', '');
    });
});
