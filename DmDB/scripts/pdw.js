var formErrors = new Array();

function isValidInt(userInput, errorMsg, isReq){
  var mask=/^\d+$/;
  if (isReq == false && userInput.value == "") return true;
  if (mask.test(userInput.value)) return true;
  formErrors[formErrors.length] = errorMsg;
  return false;
}

function isValidChar(userInput, errorMsg, isReq){
  var mask=/^[\w\-]+$/;
  if (isReq == false && userInput.value == "") return true;
  if (mask.test(userInput.value)) return true;
  formErrors[formErrors.length] = errorMsg;
  return false;
}

function isValidEmail(userInput, errorMsg, isReq){
  var mask=/^\w[\w\-\.]+\@\w[\w\-]+(\.[\w\-]+)+$/;
  if (isReq == false && userInput.value == "") return true;
  if (mask.test(userInput.value)) return true;
  formErrors[formErrors.length] = errorMsg;
  return false;
}

function isValidAny(userInput, errorMsg, isReq){
  if (isReq == true && userInput.value == "") {
    formErrors[formErrors.length] = errorMsg;
    return false;
  }
  return true;
}
