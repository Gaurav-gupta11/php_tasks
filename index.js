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
});
