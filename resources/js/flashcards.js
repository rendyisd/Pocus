import './bootstrap';
import $ from 'jquery';

$(function() {
    $(document).on('click', '.card-click-animation', function() {
        $(this).addClass("clicked");
        setTimeout(() => {
            $(this).removeClass("clicked");
        }, 300);
    });

    $(document).on('click', '#selectCat', function() {
        var currentBody = $("#addCardSet .modal-body").html();
        var currentNameInput = $("#setName").val();
        var currentDescInput = $("#setDesc").val();

        var currentSetBtn = $("#addCardSet .modal-footer").html();
        var addCategoryCard = `
        <div class="row my-2 mx-1" style="cursor: pointer;">
            <div class="col d-flex flex-column justify-content-center text-center text-white card-select-cat card-click-animation" id="addCat">
                <h6 class="fw-bold m-0">+</h6>
                <h6 class="fw-bold m-0">Add Category</h6>
            </div>
        </div>
        `;
        var backButton = `
            <button type="button" class="btn btn-danger" id="backBtn">Back</button>
        `;

        $("#addCardSet .modal-title").html("Select category");
        $("#addCardSet .modal-body").html(addCategoryCard);

        $("#addCardSet .modal-footer #createSetBtn").remove();
        $("#addCardSet .modal-footer").append(backButton);

        $("#backBtn").on('click', function() {
            $("#addCardSet .modal-title").html("Create new card set");
            $("#addCardSet .modal-body").html(currentBody);
            
            $("#setName").val(currentNameInput);
            $("#setDesc").val(currentDescInput);

            $("#addCardSet .modal-footer #backBtn").remove();
            $("#addCardSet .modal-footer").append(currentSetBtn);
        });
        
    });

    $(document).on('click', '#addCat', function() {
        
    });
});

// COLORIS COLOR PICKER

Coloris({
    parent: '.modal-body',
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
      ],
    defaultColor: '#ffffff'
});

// COLORIS COLOR PICKER