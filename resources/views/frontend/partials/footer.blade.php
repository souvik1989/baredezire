<footer>
    <div class="footer-top">
      <div class="container-fluid">
        <div class="footer-top-head">
          <h3>Popular Searches</h3>
          <div class="footer-product-link">
            @foreach($footer_categories as $cat)
            @php
            $new_name=strtolower(str_replace([' ', '/', '&'],  ['-', '-', 'n'], $cat->name));
            $parent=strtolower(str_replace('@', '-', $cat->parent->parent->name));
            @endphp
            <a href="{{route('category-product',[$cat->parent->parent->slug,$cat->slug])}}">{{$cat->name}}</a> 
            @endforeach
         
          </div>

          <div class="quick-links">
            <div class="row">
               
              @foreach($mainCategories->take(3) as $cat)
            
              <div class="col-md-2 col-6">
                <div class="quicklink-box">
                 
                  <h4>{{$cat->name}}</h4>
                  <ul>
                    
                    @foreach($cat->children as $child)
                    @foreach($child->children as $subchild)
                       @php
            $new_name=strtolower(str_replace('@', '-', $cat->name));
            $parent=strtolower(str_replace([' ', '/', '&'],  ['-', '-', 'n'], $subchild->name));
            @endphp
                    <li><a href="{{route('category-product',[$cat->slug,$subchild->slug])}}">{{$subchild->name}}</a></li>
                    @endforeach
                    @endforeach
                  

                    </ul>
                    </div>
                  </div>
                  
@endforeach

 
                  <!-- <div class="col-md-2 col-6">-->
                  <!--  <div class="quicklink-box">-->
                  <!--    <h4>Panties</h4>-->
                  <!--    <ul>-->
                  <!--      <li><a href="#">Bikini Panties</a></li>-->
                  <!--      <li><a href="#">Boy Shorts</a></li>-->
                  <!--      <li><a href="#">Bra Panty Set</a></li>-->
                  <!--      <li><a href="#">Cotton Panties</a></li>-->
                  <!--      <li><a href="#">Hipster</a></li>-->
                  <!--      <li><a href="#">Sexy Panties</a></li>-->
                  <!--      <li><a href="#">Thong</a></li>-->
                  <!--    </ul>-->
                  <!--  </div>-->
                  <!--</div>-->

                  <!--<div class="col-md-2 col-6">-->
                  <!--  <div class="quicklink-box">-->
                  <!--    <h4>Nightwear</h4>-->
                  <!--    <ul>-->
                  <!--      <li><a href="#">Babydoll</a></li>-->
                  <!--      <li><a href="#">Bridal Nightwear</a></li>-->
                  <!--      <li><a href="#">Camisole</a></li>-->
                  <!--      <li><a href="#">Cotton Nightwear</a></li>-->
                  <!--      <li><a href="#">Night Suit</a></li>-->
                  <!--      <li><a href="#">Nighty/Night Dress</a></li>-->
                  <!--      <li><a href="#">Pajamas</a></li>-->
                  <!--      <li><a href="#">Sexy Nightwear</a></li>-->
                  <!--      <li><a href="#">Tank Top</a></li>-->
                  <!--    </ul>-->
                  <!--  </div>-->
                  <!--</div>-->

                  <!--<div class="col-md-2 col-6">-->
                  <!--  <div class="quicklink-box">-->
                  <!--    <h4>ACTIVEWEAR</h4>-->
                  <!--    <ul>-->
                  <!--      <li><a href="#">Active Shorts</a></li>-->
                  <!--      <li><a href="#">Sports Bra</a></li>-->
                  <!--      <li><a href="#">Sports T shirts</a></li>-->
                  <!--      <li><a href="#">Tights</a></li>-->
                  <!--      <li><a href="#">Gym Wear</a></li>-->
                  <!--      <li><a href="#">Yoga Dress</a></li>-->
                  <!--    </ul>-->
                  <!--  </div>-->
                  <!--</div> -->

                  <div class="col-md-3 col-12">
                    <div class="quicklink-box">
                      <h4>QUICK LINKS</h4>
                      <div class="quicklink-box-wrap">
                        <!--<ul>-->
                        <!--  <li><a href="#">Magazine</a></li>-->
                        <!--  <li><a href="#">CloviaCurveTMFit Test</a></li>-->
                        <!--  <li><a href="#">Bra Size Calculator</a></li>-->
                        <!--  <li><a href="#">Bra For Your Dress</a></li>-->
                        <!--  <li><a href="#">Shop By Sizes</a></li>-->
                        <!--  <li><a href="#">Shop By Colors</a></li>-->
                        <!--  <li><a href="#">Period Tracker</a></li>-->
                        <!--  <li><a href="#">Save For Later</a></li>-->
                        <!--  <li><a href="#">Clovia Partnership Program</a></li>-->
                        <!--  <li><a href="#">Clovia Reviews</a></li>-->
                        <!--  <li><a href="#">Sales and Service</a></li>-->
                        <!--  <li><a href="#">Own A Franchisee</a></li>-->
                        <!--  <li><a href="#">Clovia Store Locator</a></li>-->
                        <!--  <li><a href="#">Clovia Responsible</a></li>-->
                        <!--  <li><a href="#">Disclosure Policy</a></li>-->
                        <!--</ul>-->
                        <ul>
                          <li><a href="{{route('aboutUs')}}">About Us</a></li>
                          <li><a href="{{route('contactUs')}}">Contact Us</a></li>
                          <li><a href="{{route('returnPolicy')}}">Return Policy</a></li>
                          <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                          <li><a href="{{route('terms')}}">Terms & Conditions</a></li>
                          <li><a href="{{route('shippingPolicy')}}">Shipping Policy</a></li>
                          <li><a href="{{route('blogs')}}">Blogs</a></li>
                          <!--<li><a href="#">Return & Exchange Policy</a></li>-->
                          <!--<li><a href="#">Track your order</a></li>-->
                          <!--<li><a href="#">Discreet Packaging</a></li>-->
                          <!--<li><a href="#">Gentlemen's Guide</a></li>-->
                          <!--<li><a href="#">Refer & Earn</a></li>-->
                          <!--<li><a href="#">My Bag</a></li>-->
                          <!--<li><a href="#">Sitemap</a></li>-->
                          <!--<li><a href="#">FAQs</a></li>-->
                          <!--<li><a href="#">Clovia Coupons</a></li>-->
                          <!--<li><a href="#">Careers</a></li>-->
                        </ul>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-3 col-12">
                      <div class="quicklink-box">
                          <h4>Stay in Touch</h4>
                        <div class="footer-form">
                            <form action="{{route('emailCheck')}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                              <div class="form-group">
                                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                              </div>
                              <button type="submit" class="btn">Submit</button>
                            </form>
                          </div>
                          <div class="footer-bottom-right">
                            <div class="social-link">
                                  <a href="https://www.facebook.com/profile.php?id=100092465379806" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                  <a href="https://www.instagram.com/baredezireindia/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                </div>
                                <!--<div class="app-link d-flex">
                                  <a href="#"><img src="{{asset('assets/images/gp.png')}}"></a>
                                  <a href="#"><img src="{{asset('assets/images/app.png')}}"></a>
                                </div>-->
                        </div>
                      </div>
                  </div>

                </div>
              </div>
            </div>
            
            <ul class="social-post">
            <li>
              <div class="quicklink-box">
              <h4>Facebook</h4>

             <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fbaredezireindia%2F&tabs=timeline&width=500&height=600&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=270889692477833" width="500" height="600" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
              </div>
</li>

 <li>
   <div class="quicklink-box">
   <h4>Instagram</h4>
 <div id="instafeed-container" class="instafeed-img"></div>
   </div>



	<script src="https://cdn.jsdelivr.net/gh/stevenschobert/instafeed.js@2.0.0rc1/src/instafeed.min.js"></script>
	<script type="text/javascript">
	var userFeed = new Instafeed({
		get: 'user',
		target: "instafeed-container",
    	resolution: 'low_resolution',
		accessToken: 'IGQWROck1uQ2dfc3BGUndKSFliV0RSaW4wSWp1Mm85amJRakFfVkF5RVI3M2NNenhiTUdOYmNHd3AwU2FQVTEzM2Eyazc2aE8ySjlWa2RwTnNERDNfdm1FN0V0bF9BM2diSkFTaTBRbkZAQOTBNeG41eUI2cjYxY1kZD'
	});
	userFeed.run();
	</script>
</li>    
            </ul>
            

            <!--<div class="footer-contact-box">-->
            <!--    <div class="row">-->
            <!--        <div class="col-md-6">-->
            <!--            <h4>Stay in Touch</h4>-->
            <!--            <div class="footer-form">-->
            <!--                <form action="{{route('emailCheck')}}" method="POST" enctype="multipart/form-data">-->
            <!--                        @csrf-->
            <!--                  <div class="form-group">-->
            <!--                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">-->
            <!--                  </div>-->
            <!--                  <button type="submit" class="btn">Submit</button>-->
            <!--                </form>-->
            <!--              </div>-->
            <!--        </div>-->
            <!--        <div class="col-md-6">-->
            <!--            <div class="footer-bottom-right">-->
            <!--                <div class="social-link">-->
            <!--                      <a href="https://www.facebook.com/profile.php?id=100092465379806" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>-->
            <!--                      <a href="https://www.instagram.com/baredezireindia/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>-->
            <!--                    </div>-->
            <!--                    <div class="app-link d-flex">-->
            <!--                      <a href="#"><img src="{{asset('assets/images/gp.png')}}"></a>-->
            <!--                      <a href="#"><img src="{{asset('assets/images/app.png')}}"></a>-->
            <!--                    </div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
            
          </div>
        </div>
        <div class="footer-bootom">
          <div class="container">
            <div class="row">
              <div class="col-md-4">
                <div class="footer-bottom-wrap">
                  <h4>{{$setting->contact_title}}</h4>
                  <p><i class="fa fa-map-marker" aria-hidden="true"></i>{{$setting->address}}</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="footer-bottom-wrap">
                  <h4>Support:</h4>
                  <ul class="">
                    <li><a href="tel:123456789"><i class="fa fa-phone" aria-hidden="true"></i>{{$setting->site_phone}}</a></li>
                    <li><a href="https://wa.me/+91987654321"><img src="{{  isset($setting->whatsapp_logo) ? config("app.url").Storage::url($setting->whatsapp_logo) :asset('assets/images/whatsapp.png') }}" alt="image" />{{$setting->site_whatsapp}}</a></li>
                    <li><a href="mailto:baredsire@gmail.com"><i class="fa fa-envelope" aria-hidden="true"></i>{{$setting->site_email}}</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-md-4 text-right">
                <div class="footer-bottom-wrap">
                  <img src="{{asset('assets/images/1-(7).png')}}" alt="">
                  <!-- <img src="{{asset('assets/images/payment.png')}}" alt="" class="mt-2 footer-img-2">-->
                  <p class="copyright mt-2">{{$setting->copyright_text}} <a href="https://3raredynamics.com/" target="_blank">{{$setting->footer_text}}</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </footer>
      <div
      class="modal fade"
      id="exampleModal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content mc-1">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Size Chart</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="modal-body p0">
              <div class="bgPnk">
                <span class="pull-left txtHeading">Find your Size</span>
                
              </div>
              <div class="imgSizeChart">
                <img
                  id="chart_image_inches"
                  src="{{  isset($setting->size_chart_image) ? config("app.url").Storage::url($setting->size_chart_image) :asset('assets/images/avtar.png') }}"
                  src="{{asset('assets/images/size-chharts-IN.jpg')}}"
                  alt="women size chart 2"
                  class="imgResponsive"
                />
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button
              type="button"
              class="btn btn-secondary"
              data-dismiss="modal"
            >
              Close
            </button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>