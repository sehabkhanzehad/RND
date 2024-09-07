<!-- Team Section -->
<section id="team" class="team section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Our Team<br></span>
        <h2>Our Team</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row">
            @foreach ($team as $person)
                <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="member">
                        <img src="{{ $person->image }}" class="img-fluid" alt="">
                        <div class="member-content">
                            <h4>{{ $person->name }}</h4>
                            <span>{{ $person->designation }}</span>
                            <p>{{ $person->description }}</p>
                            <div class="social">
                                <a href="{{ $person->linkedin_link }}"><i class="bi bi-linkedin"></i></a>
                                <a href="{{ $person->github_link }}"><i class="bi bi-github"></i></a>
                                <a href="{{ $person->facebook_link }}"><i class="bi bi-facebook"></i></a>
                                <a href="//wa.me/{{ $person->whatsapp_link }}"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div><!-- End Team Member -->
            @endforeach

            {{-- <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                <div class="member">
                    <img src="{{ asset('assets') }}/homepage/img/team/team-2.jpg" class="img-fluid" alt="">
                    <div class="member-content">
                        <h4>Sarah Jhinson</h4>
                        <span>Marketing</span>
                        <p>
                            Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum rerum
                            temporibus
                        </p>
                        <div class="social">
                            <a href=""><i class="bi bi-linkedin"></i></a>
                            <a href=""><i class="bi bi-github"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div><!-- End Team Member -->

            <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                <div class="member">
                    <img src="{{ asset('assets') }}/homepage/img/team/team-3.jpg" class="img-fluid" alt="">
                    <div class="member-content">
                        <h4>William Anderson</h4>
                        <span>Content</span>
                        <p>
                            Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum toro
                            des clara
                        </p>
                        <div class="social">
                            <a href=""><i class="bi bi-linkedin"></i></a>
                            <a href=""><i class="bi bi-github"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div><!-- End Team Member --> --}}

        </div>

    </div>

</section><!-- /Team Section -->
