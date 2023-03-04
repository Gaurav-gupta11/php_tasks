$(document).ready(function() {
  // when the document is ready, set up an input event listener
  $('#first-name, #last-name').on('input', function() {
    // get the current value of the first and last name fields
    var firstName = $('#first-name').val().trim();
    var lastName = $('#last-name').val().trim();
    // check if the first and last name fields only contain alphabets using a regular expression
    var nameRegex = /^[a-zA-Z]+$/;
    if (firstName !== '' && lastName !== '' && nameRegex.test(firstName) && nameRegex.test(lastName)) {
      // concatenate the first and last name values to create a full name
      var fullName = firstName + ' ' + lastName;
      // set the concatenated value in full name
      $('#full-name').val(fullName);
      // clear any error messages
      $('#error-message').text('');
    } else {
      // if either field contains non-alphabetic characters, clear the full name and show an error message
      $('#full-name').val('');
      if (firstName !== '' && lastName !== '') {
        $('#error-message').text('Please enter valid first name and last name');
      } else {
        $('#error-message').text('');
      }
    }
  });

  // add input event listener for image input
  $('#img').on('input', function() {
    // get the file name and extension of the selected file
    var fileName = $(this).val();
    var fileExtension = fileName.substr(fileName.lastIndexOf('.') + 1).toLowerCase();
    // check if the file extension is valid
    if (fileExtension === 'png' || fileExtension === 'jpeg' || fileExtension === 'jpg') {
      // clear any error messages
      $('#error-message').text('');
    } else {
      // show an error message for invalid file type
      $('#error-message').text('Please select a valid image file (PNG, JPEG, JPG)');
    }
  });

  // add input event listener for marks textarea
$('textarea[name="marks"]').on('input', function() {
  // get the current value of the marks field
  var marks = $(this).val().trim();
  // split the input by new lines
  var marksArray = marks.split('\n');
  // check if each line matches the specified format
  var marksRegex = /^([a-zA-Z]+\|[0-9]+)+$/;
  for (var i = 0; i < marksArray.length; i++) {
    if (marksArray[i] !== '' && !marksRegex.test(marksArray[i])) {
      // show an error message for invalid marks format
      $('#error-message').text('Please enter valid marks in the format "subject|marks" separated by new lines');
      return;
    }
  }
  // clear any error messages
  $('#error-message').text('');
});
  // add input event listener for email input
$('#email').on('input', function() {
  // get the current value of the email field
  var email = $(this).val().trim();
  // check if the email address is valid using a regular expression
  var emailRegex = /^[^\s@]+@[^\s@]+.[^\s@]+$/;
  if (emailRegex.test(email)) {
  // clear any error messages
  $('#error-message').text('');
  } else {
  // show an error message for invalid email address
  $('#error-message').text('Please enter a valid email address');
  }
});  
});
