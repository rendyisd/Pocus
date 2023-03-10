import './bootstrap';
import $ from 'jquery';

$(document).ready(function() {
    $(".card-click-animation").click(function() {
        $(this).addClass("clicked");
        setTimeout(() => {
            $(this).removeClass("clicked");
        }, 300);
    });
});