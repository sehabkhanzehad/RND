<!-- Project Section -->
<section id="services" class="services section">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Our Projects<br></span>
        <h2>Our Projects</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">

        <div class="row gy-4">

            @foreach ($projects as $project)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-img">
                            <a href="{{ route('home.project-details', $project->id) }}"> <img style="height: 220px; !important"
                                    width="100%" src="{{ $project->image }}" alt="" class="img-fluid"></a>
                        </div>
                        <h3 style=""><a href="{{ route('home.project-details', $project->id) }}">{{ $project->name }}</a><a target="_blank" href="{{ $project->url }}"
                                style="float: right"><i class="bi bi-link"></i></a></h3>

                        <p style="text-align: justify">{{ Str::limit($project->description, 100) }}</p>
                    </div>
                </div><!-- End Card Item -->
            @endforeach

        </div>

    </div>

</section><!-- /Projects Section -->
