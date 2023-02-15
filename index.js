$(document).ready(function() {
  $('#first-name, #last-name').on('input', function() {
    var firstName = $('#first-name').val();
    var lastName = $('#last-name').val();
    var fullName = firstName + ' ' + lastName;
    $('#full-name').val(fullName);
  });
});