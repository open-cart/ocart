<section class="section-custom sec-testimonials">
    <div class="max-w-6xl mx-auto px-8">
        <div class="relative" x-data="{ activeSlide: 1, slides:[1, 2] }">
            <div class="relative lg:flex rounded-lg shadow-2xl overflow-hidden" key="1" x-show="activeSlide === 1">
                <div class="h-56 lg:h-auto lg:w-5/12 relative flex items-center justify-center">
                    <img class="absolute h-full w-full object-cover" src="https://danviet.mediacdn.vn/zoom/480_300/2021/1/26/cover-dv-16115958454521459392617.jpg" alt=""/>
                    <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
                </div>
                <div class="relative lg:w-7/12 bg-white">
                    <svg class="absolute h-full text-white w-24 -ml-12" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <polygon points="50,0 100,0 50,100 0,100"/>
                    </svg>
                    <div class="relative py-4 lg:py-24 px-4 lg:px-16 text-gray-700 leading-relaxed">
                        <p>
                            As <strong class="text-gray-900 font-medium">Slack</strong> grows rapidly, using Stripe helps them scale payments easily &mdash; supporting everything from getting paid by users around the world to enabling ACH payments for corporate customers.
                        </p>
                        <p class="mt-6">
                            <a href="#" class="font-medium text-blue-600 hover:text-red-900">Mai Thu Huyền nói gì về &rarr;</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="relative lg:flex rounded-lg shadow-2xl overflow-hidden" key="2" x-show="activeSlide === 2">
                <div class="h-56 lg:h-auto lg:w-5/12 relative flex items-center justify-center">
                    <img class="absolute h-full w-full object-cover" src="https://list.vn/wp-content/uploads/2020/01/m%E1%BB%B9-t%C3%A2m.jpg" alt=""/>
                    <div class="absolute inset-0 bg-indigo-900 opacity-20"></div>
                </div>
                <div class="relative lg:w-7/12 bg-white">
                    <svg class="absolute h-full text-white w-24 -ml-12" fill="currentColor" viewBox="0 0 100 100" preserveAspectRatio="none">
                        <polygon points="50,0 100,0 50,100 0,100"/>
                    </svg>
                    <div class="relative py-12 lg:py-24 px-8 lg:px-16 text-gray-700 leading-relaxed">
                        <p>
                            <strong class="text-gray-900 font-medium">Với</strong> khối lượng công việc triền miên ngày này qua ngày khác &mdash; thời gian nghỉ ngời thì ít, Diễn viên Danh Tùng đã lựa chọn Tinh nghệ mật ong collagen để sử dụng.
                        </p>
                        <p class="mt-6">
                            <a href="#" class="font-medium text-blue-600 hover:text-red-900">Ca sỹ Mỹ Tâm nói gì &rarr;</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 left-0 lg:flex lg:items-center">
                <button class="mt-24 lg:mt-0 -ml-6 h-12 w-12 rounded-full bg-white p-3 shadow-lg focus:outline-none" x-on:click="activeSlide = activeSlide === 1 ? slides.length : activeSlide - 1">
                    <svg class="h-full w-full text-indigo-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M5.41 11H21a1 1 0 0 1 0 2H5.41l5.3 5.3a1 1 0 0 1-1.42 1.4l-7-7a1 1 0 0 1 0-1.4l7-7a1 1 0 0 1 1.42 1.4L5.4 11z"/>
                    </svg>
                </button>
            </div>
            <div class="absolute inset-y-0 right-0 lg:flex lg:items-center">
                <button class="mt-24 lg:mt-0 -mr-6 h-12 w-12 rounded-full bg-white p-3 shadow-lg focus:outline-none" x-on:click="activeSlide = activeSlide === slides.length ? 1 : activeSlide + 1">
                    <svg class="h-full w-full text-indigo-900" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M18.59 13H3a1 1 0 0 1 0-2h15.59l-5.3-5.3a1 1 0 1 1 1.42-1.4l7 7a1 1 0 0 1 0 1.4l-7 7a1 1 0 0 1-1.42-1.4l5.3-5.3z"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</section>
