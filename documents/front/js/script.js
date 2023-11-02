$(function(){
	$(".sub-title").click(function(){
	    $(".slide").slideToggle();
	});
	$('#report-ad').click(function(){
		$('.report-ads').fadeIn();
	});
	$('.closeBtn, .cencelBtn').click(function(){
		$('.report-ads').fadeOut();
	});
	$('.slider-main').slick({
	  slidesToShow: 1,
	  slidesToScroll: 1,
	  arrows: false,
	  fade: true,
	  asNavFor: '.slider'
	});
	$('.slider').slick({
		slidesToScroll: 1,
		slidesToShow: 3,
		arrows: true,
		dots: false,
		vertical: true,
		verticalSwiping: true,
		focusOnSelect: true,
		asNavFor: '.slider-main',
		centerPadding: '60px',
		responsive: [
			{
	      breakpoint: 500,
	      settings: {
	        arrows: true,
	        vertical: false,
					verticalSwiping: false,
	        slidesToShow: 2
	      }
    	},
		]
	});
	$('.acc__title').click(function(j) {
	    var dropDown = $(this).closest('.acc__card').find('.acc__panel');
	    $(this).closest('.acc').find('.acc__panel').not(dropDown).slideUp();
	    if ($(this).hasClass('active')) {
	      $(this).removeClass('active');
	    } else {
	      $(this).closest('.acc').find('.acc__title.active').removeClass('active');
	      $(this).addClass('active');
	    }
	    dropDown.stop(false, true).slideToggle();
	    j.preventDefault();
	});

	$('#btn-show').on('click', function(){
      var passInput=$("#passInput");
      if(passInput.attr('type')==='password')
        {
          passInput.attr('type','text');
          $(this).text('Hide')
      }else{
         passInput.attr('type','password');
         $(this).text('Show')
      }
  	});

  	// upload image
  	function ImgUpload() {
	  var imgWrap = "";
	  var imgArray = [];

	  $('.upload__inputfile').each(function () {
	    $(this).on('change', function (e) {
	      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
	      var maxLength = $(this).attr('data-max_length');

	      var files = e.target.files;
	      var filesArr = Array.prototype.slice.call(files);
	      var iterator = 0;
	      filesArr.forEach(function (f, index) {

	        if (!f.type.match('image.*')) {
	          return;
	        }

	        if (imgArray.length > maxLength) {
	          return false
	        } else {
	          var len = 0;
	          for (var i = 0; i < imgArray.length; i++) {
	            if (imgArray[i] !== undefined) {
	              len++;
	            }
	          }
	          if (len > maxLength) {
	            return false;
	          } else {
	            imgArray.push(f);

	            var reader = new FileReader();
	            reader.onload = function (e) {
	              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
	              imgWrap.append(html);
	              iterator++;
	            }
	            reader.readAsDataURL(f);
	          }
	        }
	      });
	    });
	  });

	  $('body').on('click', ".upload__img-close", function (e) {
	    var file = $(this).parent().data("file");
	    for (var i = 0; i < imgArray.length; i++) {
	      if (imgArray[i].name === file) {
	        imgArray.splice(i, 1);
	        break;
	      }
	    }
	    $(this).parent().parent().remove();
	  });
	}
	ImgUpload();

	$('.fillterBtn').click(function(){
		$('.car-details-bg-color').slideToggle()
	});
	$('.tgmenu').click(function(){
		$(this).toggleClass('active')
		$('.mobile-menu').toggleClass('open')
		$('body').toggleClass('overflowBody')
	})
})



