$(function () {
  $(".sub-title").click(function () {
    $(".slide").slideToggle();
  });
  $("#report-ad").click(function () {
    $(".report-ads").fadeIn();
  });
  $(".closeBtn, .cencelBtn").click(function () {
    $(".report-ads").fadeOut();
  });
  $(".slider-main").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: ".slider",
  });
  $(".slider").slick({
    slidesToScroll: 1,
    slidesToShow: 3,
    arrows: true,
    dots: false,
    vertical: true,
    verticalSwiping: true,
    focusOnSelect: true,
    asNavFor: ".slider-main",
    centerPadding: "60px",
    responsive: [
      {
        breakpoint: 500,
        settings: {
          arrows: true,
          vertical: false,
          verticalSwiping: false,
          slidesToShow: 2,
        },
      },
    ],
  });
  $(".acc__title").click(function (j) {
    var dropDown = $(this).closest(".acc__card").find(".acc__panel");
    $(this).closest(".acc").find(".acc__panel").not(dropDown).slideUp();
    if ($(this).hasClass("active")) {
      $(this).removeClass("active");
    } else {
      $(this).closest(".acc").find(".acc__title.active").removeClass("active");
      $(this).addClass("active");
    }
    dropDown.stop(false, true).slideToggle();
    j.preventDefault();
  });

  $("#btn-show").on("click", function () {
    var passInput = $("#passInput");
    if (passInput.attr("type") === "password") {
      passInput.attr("type", "text");
      $(this).text("Hide");
    } else {
      passInput.attr("type", "password");
      $(this).text("Show");
    }
  });
  $("#passInput").on("keyup", function () {
    $("#password-strength").show();
    var capitalReg = /^(?=.*[A-Z])(.{1,})$/;
    var smallReg = /^(?=.*[a-z])(.{1,})$/;
    var numberReg = /^(?=.*[0-9])(.{1,})$/;
    var symbolReg = /^(?=.*[~`!@#$%^&*{}()><])(.{1,})$/;
    var password = $(this).val();
    $("#password-length").removeClass("active");
    $("#password-capital").removeClass("active");
    $("#password-small").removeClass("active");
    $("#password-number").removeClass("active");
    $("#password-symbol").removeClass("active");
    if (password.length >= 8) {
      $("#password-length").addClass("active");
    }
    if (capitalReg.test(password)) {
      $("#password-capital").addClass("active");
    }
    if (smallReg.test(password)) {
      $("#password-small").addClass("active");
    }
    if (symbolReg.test(password)) {
      $("#password-symbol").addClass("active");
    }
    if (numberReg.test(password)) {
      $("#password-number").addClass("active");
    }
  });

  $("body").on("keyup", "#name-input", function () {
    var name = $(this).val();
    var len = name.length;
    if (len > 70) {
      $(this).val(name.substring(0, 70));
    } else {
      $("#name-counter").html(name.length);
    }
  });

  $("body").on("keyup", "#description-input", function () {
    var description = $(this).val();
    var len = description.length;
    if (len > 5000) {
      $(this).val(description.substring(0, 5000));
    } else {
      $("#description-counter").html(description.length);
    }
  });

  $(".fillterBtn").click(function () {
    $(".car-details-bg-color").slideToggle();
  });

  $(".tgmenu").click(function (event) {
    let buttonClass = event.target.className;
    if (buttonClass == "tgmenu active") {
      setTimeout(() => {
        $(".serach_btn").toggle();
        $(".logo_display").toggle();
      }, 800);
    } else {
      $(".serach_btn").toggle();
      $(".logo_display").toggle();
    }

    $(this).toggleClass("active");
    $(".mobile-menu").toggleClass("open");
    $("body").toggleClass("overflowBody");
  });

  $(".header-cross-button").click(function (event) {
    let buttonClass = event.target.className;
    if (buttonClass == "tgmenu active") {
      setTimeout(() => {
        $(".serach_btn").toggle();
        $(".logo_display").toggle();
      }, 800);
    } else {
      $(".serach_btn").toggle();
      $(".logo_display").toggle();
    }

    $(this).toggleClass("active");
    $(".mobile-menu").toggleClass("open");
    $("body").toggleClass("overflowBody");
  });

  $("body").on("keyup", "#search-box-locaction", function (e) {
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
      },
    });
    e.preventDefault();
    if (parseInt($(this).val().length) == 0) {
      $("#suggesstion-box-search-locaction").hide();
      $("#suggesstion-box-search-locaction").html("");
      window.livewire.emit("setSearchLocationPost", "", "", "", "");
    }
    var locationUrl = $("#locationUrl").val();
    if (parseInt($(this).val().length) >= 2) {
      $.ajax({
        type: "POST",
        url: locationUrl,
        data: "type=post&location=" + $(this).val(),
        beforeSend: function () {},
        success: function (data) {
          $("#suggesstion-box-search-locaction").show();
          $("#suggesstion-box-search-locaction").html(data);
        },
      });
    } //end
  });

  $("body").on("click", ".search-list-post", function (event) {
    event.preventDefault();
    const id = $(this).attr("data-id");
    const name = $(this).attr("data-name");
    const type = $(this).attr("data-type");
    const slug = $(this).attr("data-slug");
    window.livewire.emit("setSearchLocationPost", id, name, slug, type);
    $("#search-box-post").val(name);
    $("#suggesstion-box-search-locaction").hide();
  });

  $("body").on("keyup", "#search-box-category", function (e) {
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": jQuery('meta[name="csrf-token"]').attr("content"),
      },
    });
    e.preventDefault();
    if (parseInt($(this).val().length) == 0) {
      $("#suggesstion-box-search-category").hide();
      $("#suggesstion-box-search-category").html("");
      window.livewire.emit("setSearchCategoryPost", "", "", "");
    }
    var catgeroyUrl = $("#catgeroyUrl").val();
    if (parseInt($(this).val().length) >= 2) {
      $.ajax({
        type: "POST",
        url: catgeroyUrl,
        data: "type=post&search=" + $(this).val(),
        beforeSend: function () {},
        success: function (data) {
          $("#suggesstion-box-search-category").show();
          $("#suggesstion-box-search-category").html(data);
        },
      });
    } //end
  });

  $("body").on("click", ".search-list-category", function (event) {
    event.preventDefault();
    const slug = $(this).attr("data-slug");
    const name = $(this).attr("data-name");
    const type = $(this).attr("data-type");
    if (type == "category") {
      $("#category").val(slug).change();
      $("#search-box-category").val("");
      $("#suggesstion-box-search-category").hide();
    } else if (type == "search") {
      $("#search-box-category").val(name);
      $("#suggesstion-box-search-category").hide();
    }
    window.livewire.emit("setSearchCategoryPost", name, slug, type);
  });

  $("body").on("click", ".view-more-cat", function (e) {
    e.preventDefault();
    $(".cat-hide").show();
    $(".view-more-cat").hide();
    $(".view-few-cat").show();
  });

  $("body").on("click", ".view-few-cat", function (e) {
    e.preventDefault();
    $(".cat-hide").hide();
    $(".view-more-cat").show();
    $(".view-few-cat").hide();
  });

  $("body").on("click", ".view-more-loc", function (e) {
    e.preventDefault();
    $(".loc-hide").show();
    $(".view-more-loc").hide();
    $(".view-few-loc").show();
  });

  $("body").on("click", ".view-few-loc", function (e) {
    e.preventDefault();
    $(".loc-hide").hide();
    $(".view-more-loc").show();
    $(".view-few-loc").hide();
  });

  $(".smt-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: false,
    dots: true,
  });

  $("body").on("change", ".fileupload input", function () {
    var file = jQuery(".fileupload input")[0].files[0];
    if (typeof file == "undefined" || file == null) {
      return;
    }
    var fileReader = new FileReader();
    if (file.type.match("image")) {
      fileReader.onload = function () {
        var img = new Image();
        img.src = window.URL.createObjectURL(file);
        img.onload = function () {
          /* var width = img.naturalWidth,
						height = img.naturalHeight; */
          window.URL.revokeObjectURL(img.src);
          // Minimum file size is 240 X 320 pixels and maximum is 960 X 1280 pixels.
          //if ((width >= 240 && width <= 960) && (height >= 320 && height <= 1280)) {
          var size = file.size / 1024 / 1024; //size converted in MB
          if (size <= 5) {
            UploadImageFile(file);
          } else {
            var message = "Image size too large.";
            //window.flnotyf.error(message);
            alert(message);
          }
        };
      };
      fileReader.readAsDataURL(file);
    }
  });

  function UploadImageFile(file) {
    var formdata = new FormData();
    formdata.append("image", file);
    var myurl = "/upload-user-profie-image";
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
    formdata.append("_token", $('meta[name="csrf-token"]').attr("content"));
    $.ajax({
      url: myurl,
      type: "POST",
      //contentType: 'application/json; charset=utf-8',
      contentType: false,
      processData: false,
      data: formdata,
      cache: false,
      timeout: 100000, //15000, // adjust the limit. currently its 15 seconds
      success: function (data) {
        if (data.success == true) {
          window.location.reload();
        } else {
          //location.reload();
        }
      },
      error: function (err, result) {
        var errorRes = err.responseText;
        if (errorRes) {
          var meeageRes = JSON.parse(errorRes);
          //alert(meeageRes.message);
          var message = {
            errorMessage: meeageRes.message,
          };
          window.livewire.emit("openModal", "modals.error-message", message);
        }
      },
    });
    //End of Saving File
  }

  $("body").on("input", ".onlyNumber", function (e) {
    e.preventDefault();
    var x = $(this).val();
    var y = x.replace(/[^0-9.]/g, "").replace(/(\..*?)\..*/g, "$1");
    $(this).val(y);
  });

  $("body").on("click", ".page-link-bootstrap", function (e) {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
  });
  function maxLengthCheck(object) {
    if (object.value.length > object.maxLength)
      object.value = object.value.slice(0, object.maxLength);
  }
});

//////////////////
var closebtns = document.getElementsByClassName("close-tag-btn");
var i;

for (i = 0; i < closebtns.length; i++) {
  closebtns[i].addEventListener("click", function () {
    this.parentElement.style.display = "none";
  });
}
function formatText(icon) {
  return $(
    '<span><i class="fas ' +
      $(icon.element).data("icon") +
      '"></i> ' +
      icon.text +
      "</span>"
  );
}

$(function () {
  $(".select2-icon").select2({
    width: "100%",
    templateSelection: formatText,
    templateResult: formatText,
    selectOnClose: true,
  });  
})



$(document).ready(function () {
  // $(".select2-icon").select2({
  //   width: "100%",
  //   templateSelection: formatText,
  //   templateResult: formatText,
  // });

  $("body").on("click", ".serach_btn", function (e) {
    e.preventDefault();
    $(".search-fields").toggleClass("hide");
  });
});

//document
//  .getElementById("channel-user-profile-img-a")
//  ?.addEventListener("click", function (e) {
//    e.preventDefault();
//    document.getElementById("user-file-upload").click();
//  });

document.querySelectorAll("#channel-user-profile-img-a, #profile_upload_btn").forEach(function(element) {
  element.addEventListener("click", function(e) {
    e.preventDefault();
    document.getElementById("user-file-upload").click();
  });
});




