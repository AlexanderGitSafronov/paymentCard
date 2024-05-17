const card = {
  numbersWrap: document.querySelector(".card__middle_number"),
  numbers: document.querySelectorAll(".card__middle_number input"),
  holder: document.querySelector(".input__wrapper input"),
  dataWrap: document.querySelector(".card__date"),
  data: document.querySelectorAll(".card__date input"),
  cvvWrap: document.querySelector(".card__cv"),
  cvv: document.querySelectorAll(".card__cv input"),
};
const btnSend = document.querySelector(".btn__wrapper button");
const cardTopImg = document.querySelector(".card__top_img img");

function inputsValue(inputValue, count, wrapper) {
  inputValue.forEach((item, idx) => {
    item.addEventListener("focus", () => {
      inputValue[count].focus();
    });
    item.addEventListener("input", () => {
      if (item.value !== "") {
        if (/\d/.test(item.value)) {
          item.value = item.value.substr(0, 1);
          count = count < 16 ? count + 1 : count;
          inputValue[count].focus();
          howCard();
        } else {
          item.value = "";
        }
      }
    });
  });

  wrapper.addEventListener("keyup", (e) => {
    if (e.key === "Backspace") {
      if (count > 0) {
        // card.numbers[numberIdx].value = '';
        count--;
        inputValue[count].value = "";
        inputValue[count].focus();
      }
    }
  });
}

function howCard() {
  if (document.querySelector(".howCard").value === "5") {
    console.log("1212121");
    cardTopImg.src = "./images/mastercard.svg";
  } else if (document.querySelector(".howCard").value === "4") {
    console.log("5555");
    cardTopImg.src = "./images/visa.svg";
  }
}

// Номер банковской карты
let numberIdx = 0;

{
  inputsValue(card.numbers, numberIdx, card.numbersWrap);
}

// Дата
{
  let numberIdxData = 0;
  inputsValue(card.data, numberIdxData, card.dataWrap);
}

// CVV
{
  let numberIdxCvv = 0;
  inputsValue(card.cvv, numberIdxCvv, card.cvvWrap);
}

//Проверка ФИО
// let holderValue = '';
// card.holder.addEventListener('input', ()=>{
//     const value = card.holder.value.substr(0,30);
//     if(/^([a-zA-Z]+)?[ ]?([a-zA-Z]+)?$/.test(value)){
//         card.holder.value = value
//         holderValue = value
//     } else {
//         card.holder.value = holderValue;
//     }
// })

// Button

btnSend.addEventListener("click", () => {
  let numbersCard = "";
  let dataCard = "";
  let cvvCard = "";
  card.numbers.forEach((item) => {
    numbersCard += item.value;
  });
  card.data.forEach((item) => {
    dataCard += item.value;
  });
  card.cvv.forEach((item) => {
    cvvCard += item.value;
  });
  document.querySelector(".numberCard").value = numbersCard;
  document.querySelector(".dataCard").value = dataCard;
  document.querySelector(".cvvCard").value = cvvCard;
});
