$(document).ready(function() {
    // when the document is ready, set up an input event listener
    $('#first-name, #last-name').on('input', function() {
      // get the current value of the first and last name fields
      var firstName = $('#first-name').val();
      var lastName = $('#last-name').val();
      // concatenate the first and last name values to create a full name
      var fullName = firstName + ' ' + lastName;
      // set the concatenated value in full name
      $('#full-name').val(fullName);
    });
  });