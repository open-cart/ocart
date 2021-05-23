<footer class="text-gray-300 dark-footer skin-dark-footer">
    <div class="bg-gray-800">
        <div class="container-custom py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="footer-widget">
                    <a href="{!! route('home') !!}">
                        @php
                        $logo = get_logo();
                        @endphp
                        <img src="{{ $logo }}" class="img-footer w-2/3 mb-3" alt="">
                    </a>
                    <div class="footer-add">
                        <p>SevenWeb.vn</p>
                        <p>0972 675 428</p>
                        <p>sevenwebvn@gmail.com</p>
                    </div>

                </div>
                <div class="footer-widget">
                    <h4 class="widget-title mb-3 font-bold text-lg text-white">Navigations</h4>
                    <ul class="footer-menu">
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="faq.html">FAQs Page</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="blog.html">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-widget">
                    <h4 class="widget-title mb-3 font-bold text-lg text-white">Navigations</h4>
                    <ul class="footer-menu">
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="faq.html">FAQs Page</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="blog.html">Blog</a></li>
                    </ul>
                </div>
                <div class="footer-widget">
                    <h4 class="widget-title mb-3 font-bold text-lg text-white">Navigations</h4>
                    <ul class="footer-menu">
                        <li><a href="about-us.html">About Us</a></li>
                        <li><a href="faq.html">FAQs Page</a></li>
                        <li><a href="checkout.html">Checkout</a></li>
                        <li><a href="contact.html">Contact</a></li>
                        <li><a href="blog.html">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom bg-gray-900">
        <div class="container-custom align-items-center py-4">
            @php
                $domain = get_domain();
            @endphp
            <p class="mb-0">© 2021 {{ $domain }} Designd By <a href="https://sevenweb.vn">SevenWeb</a> All Rights
                Reserved</p>
        </div>
    </div>
</footer>
