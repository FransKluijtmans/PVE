jQuery.fn.passwordCheck = function() {
  var pass = $(this[0]) // It's your element
  var noofchar=/^.*(?=.{8,}).*$/;
  var checkspace=/\s/;
  var best=/^(?=.*[~!@#$%^&*()_+|}{?:><])(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  var strong=/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
  var weak=/^(?=.*\d)(?=.*[a-z]).{8,}$/;
  var bad=/^(?=.*[a-z]).{8,}$/;
 
  pass.keyup(function() {
    password = pass.val();
    if (true == checkspace.test(password)) {
      $('.strength-message-ext').html("Spaces are not allowed");
      $('.strength-visual').css({'background-color': "#FF3B10", 'width': "25%"});
    } else if (false == noofchar.test(password)) {
	  $('.strength-message').html("Slecht");
      $('.strength-visual').css({'background-color': "#FF3B10", 'width': "25%"});
    } else if(best.test(password)) {
      $('.strength-message').html("Sterk");
      $('.strength-visual').css({'background-color': "#46a546", 'width': "100%"});
    } else if(strong.test(password)) {
      $('.strength-message').html("Redelijk");
      $('.strength-visual').css({'background-color': "#EAFF76", 'width': "75%"});
    } else if(weak.test(password) == true) {
      $('.strength-message').html("Matig");
      $('.strength-visual').css({'background-color': "#f89406", 'width': "50%"});
    } else if(bad.test(password) == true) {
      $('.strength-message').html("Slecht");
      $('.strength-visual').css({'background-color': "#FF3B10", 'width': "25%"});
    }
  });
 
};