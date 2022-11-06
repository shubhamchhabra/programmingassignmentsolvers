@extends('layouts.app')
@section('content')
<div class="primary p-5 layout align-center column justify-center">
   <div class="">
      <h1 align="center" class="text-white">
         Our <span class="warning--text">Popular</span> Subjects
      </h1>
      <p align="center" class="text-white">
         Experts in multiple domains ready to help
      </p>
      <div class="row" style="justify-content: center;">
         <?php
       foreach($subjects as $subject){ ?>
         <div class="col-sm-4 col mb-4">
            <div class="rounded-lg primary p-4 v-card v-sheet theme--light border border-white">
               <div class="v-image v-responsive theme--light" style="height: 150px;padding:0 2rem;text-align:center">
                  <img width="auto" height="100%" src={{URL::asset('/service/'.$subject->image_path)}} />
                  <div class="v-responsive__content" style="width: 1080px;"></div>
               </div>
               <div class="container  mt-4">
                  <a href="{{route('services.view',['slug' => $subject['slug']])}}"><div class="v-card__title font-weight-bold warning--text text-center pb-3"><?= $subject['title']; ?></div></a>
                  <div class="v-card__text text-white"><?= Str::limit($subject['description'],150)?></div>
               </div>
            </div>
         </div>
         <?php } ?>
      </div>
   </div>

   {{-- <div class="container-lg">
      <div class="row">
         <div class="col-sm-12">
            <div id="myCarousel" data-ride="carousel" class="carousel slide">
               <h2>Customer <b>Testimonials</b></h2>
               <ol class="carousel-indicators">
                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                  <li data-target="#myCarousel" data-slide-to="1"></li>
                  <li data-target="#myCarousel" data-slide-to="2"></li>
               </ol>
               <div class="carousel-inner">
                  <div class="carousel-item active">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="testimonial">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
                           </div>
                           <div class="media">
                              <img src="/examples/images/clients/1.jpg" alt="" class="mr-3">
                              <div class="media-body">
                                 <div class="overview">
                                    <div class="name"><b>Paula Wilson</b></div>
                                    <div class="details">Media Analyst / SkyNet</div>
                                    <div class="star-rating">
                                       <ul class="list-inline">
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="testimonial">
                              <p>Vestibulum quis quam ut magna consequat faucibu. Eget mi suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra. Quis quam ut magna consequat faucibus quam.</p>
                           </div>
                           <div class="media">
                              <img src="/examples/images/clients/2.jpg" alt="" class="mr-3">
                              <div class="media-body">
                                 <div class="overview">
                                    <div class="name"><b>Antonio Moreno</b></div>
                                    <div class="details">Web Developer / SoftBee</div>
                                    <div class="star-rating">
                                       <ul class="list-inline">
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="testimonial">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
                           </div>
                           <div class="media">
                              <img src="/examples/images/clients/3.jpg" alt="" class="mr-3">
                              <div class="media-body">
                                 <div class="overview">
                                    <div class="name"><b>Michael Holz</b></div>
                                    <div class="details">Web Developer / DevCorp</div>
                                    <div class="star-rating">
                                       <ul class="list-inline">
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="testimonial">
                              <p>Vestibulum quis quam ut magna consequat faucibu. Eget mi suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra. Quis quam ut magna consequat faucibus quam.</p>
                           </div>
                           <div class="media">
                              <img src="/examples/images/clients/4.jpg" alt="" class="mr-3">
                              <div class="media-body">
                                 <div class="overview">
                                    <div class="name"><b>Mary Saveley</b></div>
                                    <div class="details">Graphic Designer / MarsMedia</div>
                                    <div class="star-rating">
                                       <ul class="list-inline">
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="carousel-item">
                     <div class="row">
                        <div class="col-sm-6">
                           <div class="testimonial">
                              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu sem tempor, varius quam at, luctus dui. Mauris magna metus, dapibus nec turpis vel, semper malesuada ante.</p>
                           </div>
                           <div class="media">
                              <img src="/examples/images/clients/5.jpg" alt="" class="mr-3">
                              <div class="media-body">
                                 <div class="overview">
                                    <div class="name"><b>Martin Sommer</b></div>
                                    <div class="details">SEO Analyst / RealSearch</div>
                                    <div class="star-rating">
                                       <ul class="list-inline">
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="testimonial">
                              <p>Vestibulum quis quam ut magna consequat faucibu. Eget mi suscipit tincidunt. Utmtc tempus dictum. Pellentesque virra. Quis quam ut magna consequat faucibus quam.</p>
                           </div>
                           <div class="media">
                              <div class="media-left d-flex mr-3"><img src="/examples/images/clients/6.jpg" alt=""></div>
                              <div class="media-body">
                                 <div class="overview">
                                    <div class="name"><b>John Williams</b></div>
                                    <div class="details">Web Designer / UniqueDesign</div>
                                    <div class="star-rating">
                                       <ul class="list-inline">
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star"></i></li>
                                          <li class="list-inline-item"><i class="fa fa-star-o"></i></li>
                                       </ul>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <a href="#myCarousel" data-slide="prev" class="carousel-control-prev"><i class="fa fa-chevron-left"></i></a> <a href="#myCarousel" data-slide="next" class="carousel-control-next"><i class="fa fa-chevron-right"></i></a>
            </div>
         </div>
      </div>
   </div> --}}
</div>
<section class="container p-5">
   <h1 align="center" class="primary--text">
      Why <span class="warning--text">Choose</span> Us
   </h1>
   <p align="center" class="text-black">
      The most reliable source to succeed
   </p>
   <div class="row">
      <div class="col-sm-3 col-12 mb-3">
         <div class="rounded theme--light secondary p-3">
            <div >
               <div class="fw-bold text-white">
                  Qualified experts
               </div>
               <div class="body-1">The words “professional experts” evoke images of people who have experience, knowledge, and talent in a particular sphere of study. The representatives of HomeworkStudios are those people. The reason is that our experts can prove their knowledge and readiness to help students. Get our help online to make sure of this!</div>
            </div>
         </div>
      </div>
      <div class="col-sm-3 col-12 mb-3">
         <div class="rounded theme--light secondary p-3">
            <div >
               <div class="fw-bold text-white">
                  Reliability
               </div>
               <div class="body-1">A visit to our service is no longer considered a unique event because there is nothing wrong with getting our programming homework help. Every day customers place orders here, and we never let them down in terms of reliability. Our service has become a familiar part of many students’ lives because we do everything possible to satisfy them.</div>
            </div>
         </div>
      </div>
      <div class="col-sm-3 col-12 mb-3">
         <div class="rounded theme--light secondary p-3">
            <div >
               <div class="fw-bold text-white">
                  Help with assignment
               </div>
               <div class="body-1">Among other benefits, there is one that deserves special attention – get any kind of assistance. Here, you can get help with the assignment for the first programming course in college or with the last course in university. Our experts can assist you with a project of any academic level. You can get a solution to any of your challenges with homework.</div>
            </div>
         </div>
      </div>
      <div class="col-sm-3 col-12 mb-3">
         <div class="rounded theme--light secondary p-3">
            <div >
               <div class="fw-bold text-white">
                  Quick assistance
               </div>
               <div class="body-1">It won’t take much time to get help on HomeworkStudios. While placing an order online, you need to set the deadline, which will be strictly followed by the expert. This condition should be met by each expert who works on our service. We provide customers with fast help to allow them to submit their finished assignments on time.</div>
            </div>
         </div>
      </div>
   </div>
</section>

{{-- How it works section --}}
<section class="primary p-5 w-100" id="howItWorks">
   <h1 align="center" class="text-white">
      How <span class="warning--text">it</span> works?
   </h1>
   <p align="center" class="text-white">
      The most reliable source to succeed
   </p>
   <div class="col-md-12">
      <div class="row order-steps my-5">
         <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="aft-arrow">
               <center>
                  <img
                     data-src="{{URL::asset('/images/assignment.png')}}"
                     class="img-responsive lazyimg"
                     alt="Submit Your Assignment"
                     title="submit"
                     src="{{URL::asset('/images/assignment.png')}}"
                     />
               </center>
               <h4 class="text-center text-white my-4">Submit Your Assignment</h4>
            </div>
         </div>
         <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="aft-arrow">
               <div class="cPanelArrowPulse"></div>
               <center>
                  <img
                     data-src="{{URL::asset('/images/cashless-payment.png')}}"
                     class="img-responsive lazyimg"
                     alt="Make The Payment"
                     title="payment"
                     src="{{URL::asset('/images/cashless-payment.png')}}"
                     />
               </center>
               <h4 class="text-center text-white my-4">Make The Payment</h4>
            </div>
         </div>
         <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="aft-arrow">
               <center>
                  <img
                     data-src="{{URL::asset('/images/query.png')}}"
                     class="img-responsive lazyimg"
                     alt="Ask For Quotation"
                     title="quotation"
                     src="{{URL::asset('/images/query.png')}}"
                     />
               </center>
               <h4 class="text-center my-4 text-white">Ask For Drafts</h4>
            </div>
         </div>
         <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="">
               <center>
                  <img
                     data-src="{{URL::asset('/images/light-bulb.png')}}"
                     class="img-responsive lazyimg"
                     alt="Receive The Solution"
                     title="received"
                     src="{{URL::asset('/images/light-bulb.png')}}"
                     />
               </center>
               <h4 class="text-center my-4 text-white">Receive The Solution</h4>
            </div>
         </div>
      </div>
   </div>
</section>

{{-- Pricing section --}}
<section class="container p-5" id="pricing">
   <h1 align="center" class="primary--text">
      Pricing
   </h1>
   <p align="center" class="text-black">
      The most reliable source to succeed
   </p>
   <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
      <div class="col">
         <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
               <h4 class="my-0 fw-normal">Free</h4>
            </div>
            <div class="card-body">
               <h1 class="card-title pricing-card-title">$0<small class="text-muted fw-light">/mo</small></h1>
               <ul class="list-unstyled mt-3 mb-4">
                  <li>10 users included</li>
                  <li>2 GB of storage</li>
                  <li>Email support</li>
                  <li>Help center access</li>
               </ul>
               <button type="button" class="w-100 btn btn-lg primary text-white">Sign up for free</button>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3">
               <h4 class="my-0 fw-normal">Pro</h4>
            </div>
            <div class="card-body">
               <h1 class="card-title pricing-card-title">$15<small class="text-muted fw-light">/mo</small></h1>
               <ul class="list-unstyled mt-3 mb-4">
                  <li>20 users included</li>
                  <li>10 GB of storage</li>
                  <li>Priority email support</li>
                  <li>Help center access</li>
               </ul>
               <button type="button" class="w-100 btn btn-lg primary text-white">Get started</button>
            </div>
         </div>
      </div>
      <div class="col">
         <div class="card mb-4 rounded-3 shadow-sm">
            <div class="card-header py-3 text-white primary">
               <h4 class="my-0 fw-normal">Enterprise</h4>
            </div>
            <div class="card-body">
               <h1 class="card-title pricing-card-title">$29<small class="text-muted fw-light">/mo</small></h1>
               <ul class="list-unstyled mt-3 mb-4">
                  <li>30 users included</li>
                  <li>15 GB of storage</li>
                  <li>Phone and email support</li>
                  <li>Help center access</li>
               </ul>
               <button type="button" class="w-100 btn btn-lg primary text-white">Contact us</button>
            </div>
         </div>
      </div>
   </div>
</div>
</section>

<!-- Testimonial section -->
<section id="testimonial" class="m-0 primary p-5 carousel slide carousel-dark text-center" data-bs-ride="carousel">
   <!-- Controls -->
   <h1 align="center" class="text-white">
      Testimonial
   </h1>
   <p align="center" class="warning--text">
      The most reliable source to succeed
   </p>
   {{-- <div class="d-flex justify-content-center mb-4">
      <button class="carousel-control-prev position-relative" type="button"
         data-bs-target="#carouselMultiItemExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next position-relative" type="button"
         data-bs-target="#carouselMultiItemExample" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
      </button>
   </div> --}}
   <!-- Inner -->
   <div class="carousel-inner py-4">
      <!-- Single item -->
       <?php $testimonialCount = 1; ?>
       <?php
       foreach($testimonials as $testimonial){
           $item_class = ($testimonialCount == 1) ? 'active': '';
           ?>
      <div class="carousel-item <?php echo $item_class ?>">
         <div class="container">
            <div class="row">
               <div class="col-lg-12">
                  <img class="rounded-circle shadow-1-strong mb-4"
                     src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(1).webp" alt="avatar"
                     style="width: 150px;" />
                  <h5 class="mb-3 secondary-text"><?php echo $testimonial['user']['name'] ?></h5>
                  <p class="text-white">
                     <i class="fas fa-quote-left pe-2"></i>
                      <?php echo $testimonial['message'] ?>
                  </p>
                  <ul class="list-unstyled d-flex justify-content-center text-warning mb-0">
                      <?php
                      for($star = 1; $star <= $testimonial['rating']; $star++ ){

                      ?>
                      <li><i class="fas fa-star fa-sm"></i></li>
                      <?php
                      }
                      ?>
                  </ul>
               </div>
            </div>
         </div>
      </div>
       <?php
       $testimonialCount++;
       }
       ?>
   </div>
   <!-- Inner -->
</section>

{{-- Faq Section --}}
<section class="container my-8 p-5" id="faq">
   <h1 align="center" class="primary--text">
      Frequently <span class="warning--text">Asked</span> Questions
   </h1>
   <p align="center" class="text-black">
      The most reliable source to succeed
   </p>
   <div id="accordionExample" class="accordion">
       <?php $faqCount = 1; ?>
       <?php
       foreach($faqs as $faq){
           $show = ($faqCount == 1) ? 'show': '';

           ?>
      <div class="card mb-1 accordion-item">
         <!----><!---->
         <header role="tab" class="card-header p-1 accordion-header" id="heading-<?php echo $faq['id'] ?>">
             <button type="button" class="btn text-white text-left btn-info btn-block not-collapsed accordion-button" aria-expanded="true"  data-bs-toggle="collapse" data-bs-target="#collapse-<?php echo $faq['id'] ?>" aria-controls="collapse-<?php echo $faq['id'] ?>"><?php echo $faq['question'] ?></button>
         </header>
          <div id="collapse-<?php echo $faq['id'] ?>" class="accordion-collapse collapse <?php echo $show ?>" aria-labelledby="heading-<?php echo $faq['id'] ?>" data-bs-parent="#accordionExample">
              <div class="card-body accordion-body">
                  <!----><!---->
                  <p class="card-text">
                      <?php echo $faq['answer'] ?>
                  </p>
              </div>
          </div>
         <!----><!---->
      </div>
           <?php
           $faqCount++;
           }
           ?>
   </div>
</section>


{{-- Services Section --}}
<section class="p-5 primary" id="services">
   <h1 align="center" class="text-white">
      Our Services
   </h1>
   <p align="center" class="warning--text">
      The most reliable source to succeed
   </p>
   <div class="container">
     <ul class="services-links__list list--clean">
       <?php foreach($services as $service){?>
       <li><a class="text-white" href="/buy.html"><?=$service['title']?></a></li>
         <?php } ?>
     </ul>
   </div>
 </section>

<!----Blog Section---->
<section class="container my-8 p-5" id="blog">
   <h1 align="center" class="primary--text">
       Our <span class="warning--text"> Latest</span> Blogs
   </h1>
   <p align="center" class="text-black">
      The most reliable source to succeed
   </p>

    <div class="row mt-5">
        <?php
          foreach($posts as $post){
        ?>
        <div class="col-md-4">
            <div class="card" style="width: 18rem; max-height: 500px;">
                <img src="{{URL::asset('/post/'.$post->image_path)}}"  class="card-img-top p-2" alt="..." style="max-height: 200px;">
                <div class="card-body pt-0 row ">
                    <h2 class="card-title text-md mt-1">{{ $post->title }}</h2>
                    <div class="pl-2">
                        <a href="{{route('blog.view',['slug' => $post->slug])}}" role="button" class="btn btn-primary text-center w-50 my-2">Read now!</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
         }
        ?>
    </div>

    {!! $posts->links() !!}
</section>
@endsection

<style>
    .accordion-button{
        background: #248097 !important;
    }
    .accordion-button:hover{
        background-color: #4aa0e6 !important;
        border-color: #3f9ae5 !important;
    }
</style>
