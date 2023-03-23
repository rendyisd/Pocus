import $ from 'jquery';
import './bootstrap';

function submitFormWithoutRedirect(form, successCallback, errorCallback, data = {}) {
    if($.isEmptyObject(data)){
        data = form.serialize();
    }

    $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: data,
        success: function(response) {
            if (response.success) {
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

    $(document).on('click', '#deleteCat', function() {
        $('.delete-category-checkbox-container').toggleClass('d-none');
        $('#deleteCategoryBtn').toggleClass('d-none');

        $('#deleteCategoryForm input[type="checkbox"]').prop('checked', false);
    });

    $('#addSetForm').on('submit', function(event) {
        event.preventDefault();

        var form = $(this);

        submitFormWithoutRedirect(
            form,
            function(response) {
                form[0].reset();
                var newSet = `
                    <a href="${fcUrl+`/${response.set['id']}`}" class="flashcard-open-url">
                        <div class="row mb-3 bg-light card-click-animation card-set" style="cursor: pointer; border-left: 13px solid ${response.category['color']};">
                            <div class="col-9 d-flex flex-column justify-content-center">
                                <h4 class="fw-bold m-0">${response.set['name']}</h4>
                                <p class="m-0 flashcard-set-desc mb-1">${response.set['description']}</p>
                                <div class="d-inline-block rounded-pill px-3 flashcard-set-tag">${response.category['category']}</div>
                            </div>
                            <div class="col-3 d-flex justify-content-end my-auto">
                                <h4 class="fw-bold m-0">0</h4>
                                <img src="${cardSvgUrl}" style="height: 30px;">
                            </div>
                        </div>
                    </a>
                `;

                $('.flashcards-sets-container').append(newSet);
                $('#closeModalBtn').trigger('click');
                $(`.delete-category-checkbox:checkbox[value="${response.category['id']}"]`).prop('disabled', true);

                $('#successMessageText').text("Flashcard has been created successfully");
                $('#addCatSuccess').addClass('show');
                setTimeout(function () {
                    $('#addCatSuccess').removeClass('show');
                }, 3000);
            },
            function(error) {
                $('#errorMessageText').text(error);
                $('#addCatError').addClass('show');
                setTimeout(function () {
                    $('#addCatError').removeClass('show');
                }, 3000);
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
                form[0].reset();
                $("#setCategoryColor").val('#000000');
                document.querySelector('#setCategoryColor').dispatchEvent(new Event('input', { bubbles: true }));

                $('#createCategoryBtn').prop('disabled', false);

                var newCategory = `
                    <div class="row mb-3 delete-category-container" data-categoryId="${response.category['id']}">
                        <div class="col-auto pe-0 d-flex align-items-center justify-content-center d-none delete-category-checkbox-container">
                            <div class="form-check d-flex align-items-center justify-content-center">
                                <input class="form-check-input delete-category-checkbox" type="checkbox" value="${response.category['id']}" name="idForDeletion[]">
                            </div>
                        </div>
                        <div class="col">
                            <button type="button" class="btn w-100 card-select-cat card-click-animation" style="border-left: 13px solid ${response.category['color']};" data-categoryId="${response.category['id']}">
                                <div class="d-flex align-items-center justify-content-between w-100">
                                    <div class="d-inline-block fw-bold flex-grow-1 category-name">${response.category['category']}</div>
                                    <i class="fa-solid fa-angle-right my-auto"></i>
                                </div>
                            </button>
                        </div>
                    </div>
                `;

                $('#deleteCategoryForm').append(newCategory);

                $('#successMessageText').text("Category has been created successfully");
                
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

    $('#deleteCategoryForm').on('submit', function(event) {
        event.preventDefault();
        var form = $(this);
        var formData = $(this).serializeArray();
        var csrfToken = formData[0].value;
        var checkedValues = [];

        $.each(formData, function(index, field) {
            if(field.name == 'idForDeletion[]' && field.value != ''){
                checkedValues.push(field.value);
            }
        });

        submitFormWithoutRedirect(
            $(this),
            function(response) {
                $('.delete-category-container').each(function() {
                    form[0].reset();
                    var catId = $(this).attr('data-categoryId');
                    if(checkedValues.includes(catId)){
                        $(this).fadeOut(300);
                        setTimeout(function(){
                            $(this).remove();
                        }, 350);
                    }
                });
            },
            function(error){

            },
            {
                _token: csrfToken,
                deleteId: checkedValues
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

    $('#addCardForm').on('submit', function(event) {
        event.preventDefault();
        var form = $(this);

        submitFormWithoutRedirect(
            form,
            function(response) {
                form[0].reset();
                var newCard = `
                    <div class="row mb-3 bg-light card-click-animation flashcards-card" style="border-left: 13px solid ${response.catColor};">
                        <div class="col d-grid gap-2 py-2">
                            <p class="fw-bold m-0">
                                ${response.card['term']}
                            </p>
                            <p class="m-0 flashcard-set-desc">
                                ${response.card['definition']}
                            </p>
                        </div>
                    </div>
                `;

                $('.fc-card-container').append(newCard);

                $('#successMessageText').text("Card has been added!");
                
                $('#addCardSuccess').addClass('show');
                setTimeout(function () {
                    $('#addCardSuccess').removeClass('show');
                }, 3000);
            },
            function(error) {
                $('#errorMessageText').text(error);
                $('#addCardError').addClass('show');
                setTimeout(function () {
                    $('#addCardError').removeClass('show');
                }, 3000);
            }
        );
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