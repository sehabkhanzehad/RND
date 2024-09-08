<!-- About Section -->
<section id="about" class="about section">

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up"
                data-aos-delay="200">
                <img src="{{ $aboutUs->image }}" class="img-fluid" alt="">
                <a href="{{ $aboutUs->video_link }}" class="glightbox pulsating-play-btn"></a>
            </div>

            <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                <h3></h3>
                <p style="text-align: justify">{{ $aboutUs->description }}</p>
                <ul>
                    @foreach ($aboutItems as $aboutItem)
                    <li>
                        <i class="bi bi-{{ $aboutItem->icon_name }}"></i>
                        <div>
                            <h5>{{ $aboutItem->title }}</h5>
                            <p style="text-align: justify">{{ $aboutItem->description }}</p>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

        </div>

    </div>

</section><!-- /About Section -->
