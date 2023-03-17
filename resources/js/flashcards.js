import './bootstrap';
import $ from 'jquery';

function submitFormWithoutRedirect(form, successCallback, errorCallback) {
    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function(response) {
            if (response.success) {
                form[0].reset();
                successCallback(response);
            } else {
                errorCallback(response);
            }
        },
        error: function(xhr) {
            errorCallback(xhr.responseText);
        }
    });
}

$(function () {
    let modalPageSequence = ['.fc-create-set', '.fc-select-cat', '.fc-create-cat'];
    let modalPagePointer = 0;

    $(document).on('click', '.card-click-animation', function() {
        $(this).addClass("clicked");
        setTimeout(() => {
            $(this).removeClass("clicked");
        }, 300);
    });

    $(document).on('click', '.backBtn', function() {
        $(modalPageSequence[modalPagePointer]).addClass('d-none');
        modalPagePointer = (modalPagePointer - 1) < 0 ? 0 : modalPagePointer - 1;
        $(modalPageSequence[modalPagePointer]).removeClass('d-none');
    });

    $(document).on('click', '#selectCat', function() {
        $('.fc-select-cat').removeClass('d-none');
        $('.fc-create-set').addClass('d-none');

        modalPagePointer = 1;
    });

    $(document).on('click', '#addCat', function() {
        $('.fc-create-cat').removeClass('d-none');
        $('.fc-select-cat').addClass('d-none');

        modalPagePointer = 2;
    });

    $('#addCategoryForm').on('submit', function(event) {
        event.preventDefault();

        var form = $(this);

        submitFormWithoutRedirect(form,
        function(response) {
            var newCategory = `
            <button type="button" class="btn w-100 mb-3 card-select-cat card-click-animation" style="border-left: 13px solid ${response.category['color']};">
                <div class="d-flex align-items-center justify-content-between w-100">
                    <div class="d-inline-block fw-bold flex-grow-1">${response.category['category']}</div>
                    <i class="fa-solid fa-angle-right my-auto"></i>
                </div>
            </button>
            `;

            $('.fc-select-cat.modal-body').append(newCategory);

            $('#addCatSuccess').addClass('show');
            setTimeout(function () {
                $('#addCatSuccess').removeClass('show');
            }, 3000);
        },
        function(error) {
            alert('Error adding category: ' + error);
        });
    });

    new Coloris({
        parent: '.coloris-parent',
        el: '#setCategoryColor',
        theme: 'pill',
        alpha: false,
        swatches: [
            '#00235b',
            '#e21818',
            '#ffdd83',
            '#98dfd6',
            '#ffb84c',
            '#d62828',
            '#a459d1',
            '#07b',
            '#0096c7',
            'blue',
            'limegreen'
        ]
    });
    $("#setCategoryColor").val('#000000');
    document.querySelector('#setCategoryColor').dispatchEvent(new Event('input', { bubbles: true }));
});