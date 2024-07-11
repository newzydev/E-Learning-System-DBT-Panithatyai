// Navbar toggler
$(function() {
    $(".navbar-toggler").on("click", function() {
        if ($(".nav-item").hasClass("active")) {
            $(".nav-item").removeClass("active");
            $(this).html("<i class='fas fa-bars'></i>");
        } else {
            $(".nav-item").addClass("active");
            $(this).html("<i class='fas fa-times'></i>");
        }
    });
});

// Go to top
var btn = $('#button');

$(window).scroll(function() {
  if ($(window).scrollTop() > 300) {
    btn.addClass('show');
  } else {
    btn.removeClass('show');
  }
});

btn.on('click', function(e) {
  e.preventDefault();
  $('html, body').animate({scrollTop:0}, '300');
});

// Confirm
$(function() {
    $("#confirm_accept").click(function() {
        if ($(this).prop("checked") == true) {
            $("#btn_confirm").removeAttr("disabled");
        } else {
            $("#btn_confirm").attr("disabled", "disabled");
        }
    });
});

$(function() {
    var max_length = 500;
    $("#contact_message").keyup(function() {
        var this_length = max_length - $(this).val().length;
        if (this_length < 0) {
            $(this).val($(this).val().mb_substr(0, 500));
        } else {
            $("#now_length").html("จำนวนที่เหลือ " + this_length + " ตัวอักษร");       
        }
    });
});

$(function() {
    var max_length = 100;
    $("#cs_des").keyup(function() {
        var this_length = max_length - $(this).val().length;
        if (this_length < 0) {
            $(this).val($(this).val().mb_substr(0, 100));
        } else {
            $("#now_length").html("จำนวนที่เหลือ " + this_length + " ตัวอักษร");       
        }
    });
});

// Add item
$(function(){

	$("body").on("click", ".btn-add-item", function(e){
		e.preventDefault();
		let ol = $(this).closest("ol")
		let li = $(this).closest("li").clone()
		li.appendTo(ol)
		li.find("input").val("")
		li.find("textarea").val("")
		li.find(".btn-remove-item").show()
		li.find("[name='unit_name_item[]']").focus()
	})

	$("body").on("click", ".btn-remove-item", function(e){
		e.preventDefault()
		$(this).closest("li").remove()
	})

})

// ----------------------------------

// var clickmessage = "อ๊ะ! อย่า save ภาพสิคะ";

function disableclick(e) {
  if (document.all) {
    if (event.button == 2 || event.button == 3) {
      if (event.srcElement.tagName == "IMG") {
        // alert(clickmessage);
        $("#saveimg").modal("show");
        return false;
      }
    }
  } else if (document.layers) {
    if (e.which == 3) {
      $("#saveimg").modal("show");
      return false;
    }
  } else if (document.getElementById) {
    if (e.which == 3 && e.target.tagName == "IMG") {
      $("#saveimg").modal("show");
      return false;
    }
  }
}

function associateimages() {
  for (i = 0; i < document.images.length; i++)
    document.images[i].onmousedown = disableclick;
}

if (document.all) document.onmousedown = disableclick;
else if (document.getElementById) document.onmouseup = disableclick;
else if (document.layers) associateimages();

// ----------------------------------

// var message = "อ๊ะ! อย่าคลิกขวา สิคะ";
function clickIE4() {
  if (event.button == 2) {
    // alert(message);
    $("#message").modal("show");
    return false;
  }
}
function clickNS4(e) {
  if (document.layers || (document.getElementById && !document.all)) {
    if (e.which == 2 || e.which == 3) {
      // alert(message);
      $("#message").modal("show");
      return false;
    }
  }
}
if (document.layers) {
  document.captureEvents(Event.MOUSEDOWN);
  document.onmousedown = clickNS4;
} else if (document.all && !document.getElementById) {
  document.onmousedown = clickIE4;
}
document.oncontextmenu = new Function("$('#message').modal('show');return false");

//ทริกเกอร์คีย์
document.onkeydown = function () {
  // ห้ามกด Ctrl + U
  var message1 = "อ๊ะ! อย่ากด Ctrl + U สิคะ";
  if (event.ctrlKey && window.event.keyCode == 85) {
    // alert(message1);
    $("#message1").modal("show");
    return false;
  }
  // ห้ามกด F12
  var message2 = "อ๊ะ! อย่ากด F12 สิคะ";
  if (window.event && window.event.keyCode == 123) {
    // alert(message2);
    $("#message2").modal("show");
    event.keyCode = 0;
    event.returnValue = false;
  }
  // ห้ามกด Ctrl + S
  var message3 = "อ๊ะ! อย่ากด Ctrl + S สิคะ";
  if (event.ctrlKey && window.event.keyCode == 83) {
    // alert(message3);
    $("#message3").modal("show");
    return false;
  }
  // ห้ามกด F5
  var message4 = "อ๊ะ! อย่ากด F5 สิคะ";
  if (window.event && window.event.keyCode == 116) {
    // alert(message4);
    $("#message4").modal("show");
    event.keyCode = 0;
    event.returnValue = false;
  }
};
