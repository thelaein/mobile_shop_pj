$(document).ready(function () {
    const incrementButton = document.querySelector('#increment');
    const decrementButton = document.querySelector('#decrement');
    const numberSpan = document.querySelector('#number'); //picked-count
    const chooseCount = document.querySelector('#id_count');
    const availableNumber = document.querySelector('#availability'); //available-count
    availableNumber.innerText = (parseInt(availableNumber.innerText) - parseInt(numberSpan.innerText));

    incrementButton.addEventListener('click', function () {
        if (parseInt(availableNumber.innerText) > 0) {
            numberSpan.innerText = parseInt(numberSpan.innerText) + 1;
            decreaseItem(availableNumber);
            chooseCount.value = parseInt(numberSpan.innerText);
        } else {
            alert("All item picked up!");
        }
    });

    decrementButton.addEventListener('click', function () {
        if (parseInt(numberSpan.innerText) > 0) {
            numberSpan.innerText = parseInt(numberSpan.innerText) - 1;
            increaseItem(availableNumber);
            chooseCount.value = parseInt(numberSpan.innerText);
        } else {
            alert("Nothing has picked up!")
        }
    });
});

function increaseItem(item) {
    item.innerText = parseInt(item.innerText) + 1;
}

function decreaseItem(item) {
    item.innerText = parseInt(item.innerText) - 1;
}
