<!-- Stats Section -->
<section id="stats" class="stats section">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
            @foreach ($stats as $stat)
                <div class="col-lg-3 col-md-6">
                    <div class="stats-item text-center w-100 h-100">
                        <span data-purecounter-start="0" data-purecounter-end="{{ $stat->stat_value }}"
                            data-purecounter-duration="1" class="purecounter"></span>
                        <p>{{ $stat->stat_name }}</p>
                    </div>
                </div><!-- End Stats Item -->
            @endforeach

        </div>

    </div>

</section><!-- /Stats Section -->
