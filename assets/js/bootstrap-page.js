let hit = 0;
var rl = window.location.href.split("?");
if (rl.length > 1) {
  window.location.href = rl[0];
}

$(document).ready(function () {
  $(".thank-you").hide();
  $(".form-cntrl").show();
});
function formq() {
  if (hit == 1) return false;
  hit = 1;
  var msg = "";
  $(".getStartedBtn").hide();
  if (document.getElementById("txtname").value == "") {
    msg += "Enter Name.\n";
  }
  if (document.getElementById("txtmobile").value == "") {
    msg += "Enter Contact Number.\n";
  }
  if (isphonenumber($("#txtmobile").val()) == false) {
    msg += "Enter Valid Contact Number.\n";
  }
  if (document.getElementById("txtemail").value == "") {
    msg += "Enter Email Address.\n";
  }
  if (document.getElementById("txtpincode").value == "") {
    msg += "Enter Pincode.\n";
  }

  if (ispincode($("#txtpincode").val()) == false) {
    msg += "Enter Valid Picode.\n";
  }

  if (!document.getElementById("chkiaggree").checked) {
    msg += "Select 'I Agree' to continue..";
  }
  if (msg != "") {
    alert(msg);
    hit = 0;
    $(".getStartedBtn").show();
    return false;
  }

  var formdata = {
    slug: contexturl,
    name: $("#txtname").val(),
    email: $("#txtemail").val(),
    mobile: $("#txtmobile").val(),
    pincode: $("#txtpincode").val(),
  };
  jQuery
    .post(baseurl, formdata)
    .done(function (data) {
      $(".thank-you").show();
      $(".form-cntrl").hide();
      $("#txtname").val("");
      $("#txtemail").val("");
      $("#txtmobile").val("");
      $("#txtpincode").val("");
      //fbq("track", "Lead");
    })
    .always(function () {
      $(".thank-you").show();
      $(".form-cntrl").hide();
      $("#txtname").val("");
      $("#txtemail").val("");
      $("#txtmobile").val("");
      $("#txtpincode").val("");
      fbq("track", "Lead");
      hit = 0;
    });

  return false;
}

function isphonenumber(inputtxt) {
  var phoneno = /^\d{10}$/;
  if (inputtxt.match(phoneno)) {
    return true;
  } else {
    return false;
  }
}
function ispincode(inputtxt) {
  var phoneno = /^\d{6}$/;
  if (inputtxt.match(phoneno)) {
    return true;
  } else {
    return false;
  }
}
