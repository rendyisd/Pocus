import $ from 'jquery';
import './bootstrap';

$(function () {
    function getRandInt(minNum, maxNum){
        return Math.floor(Math.random() * (maxNum - minNum + 1)) + minNum;
    }

    function openFinishModal(){
        $('#openFinishModal').trigger('click');
    }

    // Shuffle cards
    cards.sort(() => Math.random() - 0.5);
    var numOfCards = cards.length;

    var currentIdx = 0;
    var correctScore = 0;

    function setQuestion(){
        var answerContainerIdx = getRandInt(0, 3);
        var randomIdx = [currentIdx];

        $('.question-container').text(cards[currentIdx].term);

        $('.choice-container').each(function(index, container){
            $(container).css('background-color', 'rgb(230, 130, 20)')
            if(index === answerContainerIdx){
                $(container).text(cards[currentIdx].definition);
                return;
            }

            var randNumb = getRandInt(0, numOfCards-1);

            while(randomIdx.includes(randNumb)) randNumb = getRandInt(0, numOfCards-1);
            randomIdx.push(randNumb);

            $(container).text(cards[randNumb].definition);
        });
    }

    var isChoiceClicked = false;
    $('.choice-container').on('click', function() {
        if(isChoiceClicked) return;

        isChoiceClicked = true;

        if($(this).text() === cards[currentIdx].definition){
            $(this).css('background-color', 'rgb(0, 190, 0)');
            correctScore++;
        }
        else{
            $(this).css('background-color', 'red');
        }
        currentIdx++;

        if(currentIdx === numOfCards){
            $('#numOfCorrect').text(correctScore);
            setTimeout(function() {
                openFinishModal();
            }, 1000);
            return;
        }

        setTimeout(function() {
            setQuestion();
            isChoiceClicked = false;
        }, 1000);
    });

    setQuestion();
    
    // Card click animation script
    $(document).on('click', '.card-click-animation', function() {
        $(this).addClass("clicked");
        setTimeout(() => {
            $(this).removeClass("clicked");
        }, 300);
    });

    $('#finishModal').on('click', function () {
        window.history.back();
    });
});