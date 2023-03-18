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
            errorCallback(xhr.responseJSON.message);
        }
    });
}

function modalFadeChange(current, next) {
    $(current).addClass('hidden-fade');

    setTimeout(() => {
        $(current).addClass('d-none');
        $(next).removeClass('d-none');
        setTimeout(() =>{
            $(next).removeClass('hidden-fade');
        }, 50);
    }, 300);
}

$(function () {
    let modalPageSequence = ['.fc-create-set', '.fc-select-cat', '.fc-create-cat'];
    let modalPagePointer = 0;

    let isTimeoutRunning = false;

    $(document).on('click', '.card-click-animation', function() {
        $(this).addClass("clicked");
        setTimeout(() => {
            $(this).removeClass("clicked");
        }, 300);
    });

    $(document).on('click', '.backBtn', function() {
        modalFadeChange(modalPageSequence[modalPagePointer], modalPageSequence[modalPagePointer-1]);
        modalPagePointer = (modalPagePointer - 1) < 0 ? 0 : modalPagePointer - 1;
    });

    $(document).on('click', '#selectCat', function() {
        modalFadeChange('.fc-create-set', '.fc-select-cat');
        modalPagePointer = 1;
    });

    $(document).on('click', '#addCat', function() {
        modalFadeChange('.fc-select-cat', '.fc-create-cat');
        modalPagePointer = 2;
    });

    $('#addSetForm').on('submit', function(event) {
        event.preventDefault();

        var form = $(this);

        submitFormWithoutRedirect(
            form,
            function(response) {
                var newSet = `
                    <div class="row mb-3 bg-light card-click-animation card-set" style="cursor: pointer; border-left: 13px solid ${response.category['color']};">
                        <div class="col-9 d-flex flex-column justify-content-center">
                            <h4 class="fw-bold m-0">${response.set['name']}</h4>
                            <p class="m-0 flashcard-set-desc mb-1">${response.set['description']}</p>
                            <div class="d-inline-block rounded-pill px-3 flashcard-set-tag">${response.category['category']}</div>
                        </div>
                        <div class="col-3 d-flex justify-content-end my-auto">
                            <h4 class="fw-bold m-0">45</h4>
                            <img src="${cardSvgUrl}" style="height: 30px;">
                        </div>
                    </div>
                `;

                $('.flashcards-sets-container').append(newSet);

                // $('#addCardSet').modal('hide');
            },
            function(error) {
                console.log(error);
            }
        )
    });

    $('#addCategoryForm').on('submit', function(event) {
        event.preventDefault();
        $('#createCategoryBtn').prop('disabled', true);

        var form = $(this);

        submitFormWithoutRedirect(
            form,
            function(response) {
                $("#setCategoryColor").val('#000000');
                document.querySelector('#setCategoryColor').dispatchEvent(new Event('input', { bubbles: true }));

                $('#createCategoryBtn').prop('disabled', false);

                var newCategory = `
                    <button type="button" class="btn w-100 mb-3 card-select-cat card-click-animation" style="border-left: 13px solid ${response.category['color']};" data-categoryId=${response.category['id']}>
                        <div class="d-flex align-items-center justify-content-between w-100">
                            <div class="d-inline-block fw-bold flex-grow-1 category-name">${response.category['category']}</div>
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
                $('#createCategoryBtn').prop('disabled', false);
                if(!isTimeoutRunning){
                    isTimeoutRunning = true;
                    $('#errorMessageText').text(error);
                    $('#addCatError').addClass('show');
                    setTimeout(function () {
                        isTimeoutRunning = false;
                        $('#addCatError').removeClass('show');
                    }, 3000);
                }
            }
        );
    });

    $('.fc-select-cat.modal-body').on('click', '.card-select-cat', function() {
        var catId = $(this).attr('data-categoryId');
        var catName = $(this).find('.category-name').text();
        var catColor = $(this).css('border-left-color');

        $('#setCat').val(catId);
        $('#selectCat').find('.fw-bold').text(catName);
        $('#selectCat').css('border-left-color', catColor);

        $('#oneOfBackBtn').trigger('click');
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