    <!-- section-quote-end -->
  
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>  

      <script type="text/javascript" src="{{ asset('assets/js/jquery-migrate-1.2.1.js')}}"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
      integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-zoom/1.7.21/jquery.zoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/9.2.4/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/camera.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/easing.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/jquery.prettyPhoto.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/wow.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/custom.js')}}"></script>
    <script src="{{ asset('assets/js/iziToast.js') }}"></script>
    
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<script>
    $('.camera_wrap').camera({
      playPause: false,
      navigation: true,
      navigationHover: false,
      hover: false,
      loader: false,
      loaderColor: 'red',
      loaderBgColor: '#222222',
      loaderOpacity: 1,
      loaderPadding: 0,
      time: 2000,
      transPeriod: 1500,
      pauseOnClick: true,
      pagination: false
    });
  </script>

  <script type="text/javascript">
    (function($){

        @if (Session::has('success'))
          iziToast.success({
              message: '{{ Session::get('success') }}',
              position: "topRight"
          });

        @elseif(Session::has('error'))
          iziToast.error({
              message: '{{ Session::get('error') }}',
              position: "topRight"
          });

        @elseif(Session::has('warning'))
          iziToast.warning({
              message: '{{ Session::get('warning') }}',
              position: "topRight"
          });
        @endif
    })(jQuery);

    @if ($errors->any())
        @php
            $collection = collect($errors->all());
            $errors = $collection->unique();
        @endphp

        @foreach ($errors as $error)
        iziToast.error({
            message: '{{ __($error) }}',
            position: "topRight"
        });
        @endforeach
    @endif
  </script>
  <script>
      const imgs = document.querySelectorAll(".img-select a");
      const imgBtns = [...imgs];
      let imgId = 1;

      imgBtns.forEach((imgItem) => {
        imgItem.addEventListener("click", (event) => {
          event.preventDefault();
          imgId = imgItem.dataset.id;
          slideImage();
        });
      });

      function slideImage() {
        const displayWidth = document.querySelector(
          ".img-showcase img:first-child"
        ).clientWidth;

        document.querySelector(".img-showcase").style.transform = `translateX(${
          -(imgId - 1) * displayWidth
        }px)`;
      }

      window.addEventListener("resize", slideImage);
    </script>
    <script>
    
    var prevButton = null;

function changeColor(button) {
  
  if (prevButton !== null) {
    prevButton.style.backgroundColor = "#fff";
    prevButton.style.color="black";
  }
  
  button.style.backgroundColor = "black";
  button.style.color ="white"
  prevButton = button;
}


   </script>


<script>

  $(document).ready(function(){
    $(".sorting-item a").on("click", function(){  
         $(".sorting-item.active").removeClass("active");  
         $(this).parent().addClass("active");
    }).filter(function(){
        return window.location.href.indexOf($(this).attr('href').trim()) > -1;
    }).click();
});
  
</script>
  
 <script>
//     $(function () {
//         $("#search").autocomplete({
//             source: function (request, response) {
//                 $.ajax({
//                     url: "{{ route('autocomplete.search') }}",
//                     dataType: 'json',
//                     data: {
//                         query: request.term
//                     },
//                     success: function (data) {
//                         response($.map(data, function (item) {
//                             return {
//                                 label: item.name,
//                                 value: item.id 
//                               // id:item.id// You can use a unique identifier here
//                             };
//                         }));
//                     }
//                 });
//             },
//             minLength: 5, // Minimum characters before triggering autocomplete
//             select: function (event, ui) {
//                 // Redirect to the selected product or category page
//                 window.location.href = "/category-product/" + ui.item.value;
//             }
//         });
//     });




 </script>

   <script>
//     $(function () {
//         $("#search").autocomplete({
//             source: function (request, response) {
//                 $.ajax({
//                     url: "{{ route('autocomplete.search') }}",
//                     dataType: 'json',
//                     data: {
//                         query: request.term
//                     },
//                     success: function (data) {
//                         response($.map(data, function (item) {
//                             return {
//                                 label: item.name,
//                                 value: item.id
//                             };
//                         }));
//                     }
//                 });
//             },
//             minLength: 2, // Minimum characters before triggering autocomplete
//             select: function (event, ui) {
//                 // Redirect to the selected product or category page
//                 window.location.href = "/category-product/" + ui.item.value;
//                 $("#search").val('');
                
//                 return false;
//             },
//             open: function () {
//                 // Show the autocomplete dropdown when results are available
//                 $(".ui-autocomplete").css('display', 'block');
//             },
//             close: function () {
//                 // Hide the autocomplete dropdown when no results are available
//                 $(".ui-autocomplete").css('display', 'none');
//             }
//         }).data("ui-autocomplete")._renderItem = function (ul, item) {
//             return $("<li>")
//                 .append("<div>" + item.label + "</div>")
//                 .appendTo(ul);
//         };
//     });
// </script>
<script>
$(function () {
    $("#search").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "{{ route('autocomplete.search') }}",
                dataType: 'json',
                data: {
                    query: request.term
                },
                success: function (data) {
                    response($.map(data, function (item) {
                        return {
                            label: item.label,
                            value: item.value,
                            type: item.type // Include the 'type' attribute
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function (event, ui) {
            // Check the 'type' attribute for category or product
            if (ui.item.type === 'Category') {
                // Handle category selection
                window.location.href = "/category-product/" + ui.item.value;
                
                 $("#search").val('');
                
                 return false;
// Verify the URL path
            } else if (ui.item.type === 'Product') {
                // Handle product selection
                window.location.href = "/product-detail/" + ui.item.value; // Verify the URL path
                 $("#search").val('');
                  return false;
            }
            $("#search").val('');
            // Do not return false, as it prevents the default behavior
        },
        open: function () {
            $(".ui-autocomplete").css('display', 'block');
        },
        close: function () {
            $(".ui-autocomplete").css('display', 'none');
        }
    }).data("ui-autocomplete")._renderItem = function (ul, item) {
        return $("<li>")
            .append("<div>" + item.label + "</div>")
            .appendTo(ul);
    };
});

</script>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/664c785c9a809f19fb3352dc/1hudbcaki';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
                            
{{--<script type="text/javascript">
    (function () {
        var head = document.getElementsByTagName("head").item(0);
        var script = document.createElement("script");
        
        var src = (document.location.protocol == 'https:' 
            ? 'https://www.formilla.com/scripts/feedback.js' 
            : 'http://www.formilla.com/scripts/feedback.js');
        
        script.setAttribute("type", "text/javascript"); 
        script.setAttribute("src", src); script.setAttribute("async", true);        

        var complete = false;
        
        script.onload = script.onreadystatechange = function () {
            if (!complete && (!this.readyState 
                    || this.readyState == 'loaded' 
                    || this.readyState == 'complete')) {
                complete = true;
                Formilla.guid = 'cs07adc6-3e2c-402f-94ac-1e369fe44d6d';
                Formilla.loadWidgets();                
            }
        };

        head.appendChild(script);
    })();
</script>--}}
                                    
  </body>
  </html>