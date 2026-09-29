const allInputs = document.querySelectorAll('input[required]');
const email = document.getElementById('email');

// 1. Проверка на заполненность полей <input> формы и установка кастомного текста ошибки
allInputs.forEach(input=>{
input.addEventListener('invalid', function (event) {
  if (event.target.validity.valueMissing)
  {
    event.target.setCustomValidity('Поле обязательно для заполнения.');
  }
});
// 2. Срабатывает при каждом вводе символа, чтобы сбросить ошибку, когда начато заполнение поля
input.addEventListener('input', function (event) {
  // Очищаем кастомную ошибку, иначе форма никогда не отправится
  event.target.setCustomValidity('');
});
});

// 3. Проверка правильности заполнения email-адреса
email.addEventListener('input', function(e) {
  searchChars = ["@", "."];
  if(!searchChars.every(char => e.target.value.includes(char))) 
  
  e.target.setCustomValidity('Не соответствует формату email-адреса');
});
