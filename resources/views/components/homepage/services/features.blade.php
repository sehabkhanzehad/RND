 <!-- Features Section -->
 <section id="features" class="features section">

     <!-- Section Title -->
     <div class="container section-title" data-aos="fade-up">
         <span>Features</span>
         <h2>Features</h2>
         <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
     </div><!-- End Section Title -->

     <div class="container">
         @forelse ($features as $feature)
             <div class="row gy-4 align-items-center features-item">
                 <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                     <img src="{{ $feature->image1 }}" class="img-fluid" alt="">
                 </div>
                 <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                     <h3>{{ $feature->title1 }}</h3>
                     <p  style="text-align: justify">
                         {{ $feature->description1 }}
                     </p>
                 </div>
             </div><!-- Features Item -->

             <div class="row gy-4 align-items-center features-item">
                 <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out"
                     data-aos-delay="200">
                     <img src="{{ $feature->image2 }}" class="img-fluid" alt="">
                 </div>
                 <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
                     <h3>{{ $feature->title2 }}</h3>
                     <p style="text-align: justify">{{ $feature->description2 }}</p>
                 </div>
             </div><!-- Features Item -->
         @endforeach


         {{-- <div class="row gy-4 align-items-center features-item">
             <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
                 <img src="{{ asset("assets") }}/homepage/img/features-3.jpg" class="img-fluid" alt="">
             </div>
             <div class="col-md-7" data-aos="fade-up">
                 <h3>Sunt consequatur ad ut est nulla consectetur reiciendis animi voluptas</h3>
                 <p>Cupiditate placeat cupiditate placeat est ipsam culpa. Delectus quia minima quod. Sunt saepe
                     odit aut quia voluptatem hic voluptas dolor doloremque.</p>
                 <ul>
                     <li><i class="bi bi-check"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo
                             consequat.</span></li>
                     <li><i class="bi bi-check"></i><span> Duis aute irure dolor in reprehenderit in voluptate
                             velit.</span></li>
                     <li><i class="bi bi-check"></i> <span>Facilis ut et voluptatem aperiam. Autem soluta ad
                             fugiat</span>.</li>
                 </ul>
             </div>
         </div><!-- Features Item -->

         <div class="row gy-4 align-items-center features-item">
             <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out">
                 <img src="{{ asset("assets") }}/homepage/img/features-4.jpg" class="img-fluid" alt="">
             </div>
             <div class="col-md-7 order-2 order-md-1" data-aos="fade-up">
                 <h3>Quas et necessitatibus eaque impedit ipsum animi consequatur incidunt in</h3>
                 <p class="fst-italic">
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                     labore et dolore
                     magna aliqua.
                 </p>
                 <p>
                     Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                     reprehenderit in voluptate
                     velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                     proident, sunt in
                     culpa qui officia deserunt mollit anim id est laborum
                 </p>
             </div>
         </div><!-- Features Item --> --}}

     </div>

 </section><!-- /Features Section -->
