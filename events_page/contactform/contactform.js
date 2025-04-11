jQuery(document).ready(function($) {
  "use strict";

  $('form.contactForm').submit(function(e) {
    e.preventDefault(); // Stop form from submitting normally

    var f = $(this).find('.form-group'),
      ferror = false,
      emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;

    f.children('input').each(function() {
      var i = $(this);
      var rule = i.attr('data-rule');

      if (rule !== undefined) {
        var ierror = false;
        var pos = rule.indexOf(':', 0);
        var exp = '';
        if (pos >= 0) {
          exp = rule.substr(pos + 1, rule.length);
          rule = rule.substr(0, pos);
        }

        switch (rule) {
          case 'required':
            if (i.val() === '') {
              ferror = ierror = true;
            }
            break;

          case 'minlen':
            if (i.val().length < parseInt(exp)) {
              ferror = ierror = true;
            }
            break;

          case 'email':
            if (!emailExp.test(i.val())) {
              ferror = ierror = true;
            }
            break;

          case 'checked':
            if (!i.is(':checked')) {
              ferror = ierror = true;
            }
            break;

          case 'regexp':
            var reg = new RegExp(exp);
            if (!reg.test(i.val())) {
              ferror = ierror = true;
            }
            break;
        }
        i.next('.validation').html(ierror ? (i.attr('data-msg') || 'Wrong input') : '').show('blind');
      }
    });

    f.children('textarea').each(function() {
      var i = $(this);
      var rule = i.attr('data-rule');

      if (rule !== undefined) {
        var ierror = false;
        var pos = rule.indexOf(':', 0);
        var exp = '';
        if (pos >= 0) {
          exp = rule.substr(pos + 1, rule.length);
          rule = rule.substr(0, pos);
        }

        switch (rule) {
          case 'required':
            if (i.val() === '') {
              ferror = ierror = true;
            }
            break;

          case 'minlen':
            if (i.val().length < parseInt(exp)) {
              ferror = ierror = true;
            }
            break;
        }
        i.next('.validation').html(ierror ? (i.attr('data-msg') || 'Wrong input') : '').show('blind');
      }
    });

    if (ferror) return false;

    var str = $(this).serialize();

    $.ajax({
      type: "POST",
      url: "../forms/contact.php", // ✅ Corrected path
      data: str,
      success: function(msg) {
        if (msg.trim() === 'OK') {
          $("#sendmessage").addClass("show");
          $("#errormessage").removeClass("show");
          $('.contactForm').find("input, textarea").val("");
        } else {
          $("#sendmessage").removeClass("show");
          $("#errormessage").addClass("show").html(msg);
        }
      },
      error: function(xhr) {
        $("#sendmessage").removeClass("show");
        $("#errormessage").addClass("show").html("An error occurred. Please try again.");
      }
    });

    return false;
  });

});
