console.log('file imported'); 
var inputs = document.querySelectorAll('.question_input'); // get the input element
console.log("inputs are: " + inputs); 

for (var i=0; i<inputs.length; i++ ) {
  console.log(inputs[i]); 
  var input = inputs[i]; 
  input.addEventListener('input', resizeInput); // bind the "resizeInput" callback on "input" event
  resizeInput.call(input);                      // immediately call the function
}

function resizeInput() {
  this.style.width = (this.value.length)*7 + "px";
}