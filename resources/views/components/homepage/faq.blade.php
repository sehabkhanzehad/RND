<!-- Faq Section -->
<section id="faq" class="faq section">
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
        <span>Frequently Asked Questions</span>
        <h2>Frequently Asked Questions</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
    </div><!-- End Section Title -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="faq-container">
                    @foreach ($faqs as $faq)
                        <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>{{ $faq->question }}</h3>
                            <div class="faq-content">
                                <p>{{ $faq->answer }}</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section><!-- /Faq Section -->
<script>
    
let delayStart = 200;
let faqItems = document.getElementsByClassName("faq-item");
let i;
for (i = 0; i < faqItems.length; i++) {
    faqItems[i].setAttribute("data-aos-delay", delayStart);
    delayStart += 100;
    if (i === 0) {
        faqItems[i].classList.add("faq-active");
    }
}
</script>
