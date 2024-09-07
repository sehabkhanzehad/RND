<!-- Services Section -->
<section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Our Services<br></span>
        <h2>Our ServiceS</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-4">

            @foreach ($services as $service)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-img">
                            <img src="{{ $service->image }}" alt=""
                                class="img-fluid">
                        </div>
                        <h3>{{ $service->name }}</h3>
                        <p>{{ $service->short_des }}</p>
                    </div>
                </div><!-- End Card Item -->
            @endforeach

        </div>

    </div>

</section><!-- /Services Section -->
