<div class="owl-carousel owl-theme relative">
    <div class="item">
        <img src="{{ $banner }}" class="banner-height bg-cover">
    </div>
    <div class="item">
        <img src="{!! Theme::asset('/images/banner2.png') !!}" class="banner-height bg-cover bg-no-repeat">
    </div>
    <div class="item">
        <img src="{!! Theme::asset('/images/p-2.jpg') !!}" class="banner-height bg-cover bg-no-repeat">
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            dots: true  ,
            margin:10,
            nav:true,
            animateOut: 'fadeOut',

            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:1
                },
                1000:{
                    items:1
                }
            }
        })
    });
</script>
<style>
    .owl-nav{
        font-size: 4rem;
    }
    .owl-prev:focus,
    .owl-next:focus{
        outline: none;
    }
    .owl-prev{
        position: absolute;
        top: 50%;
        left: 5px;
        transform: translateY(-50%);

    }
    .owl-next{
        position: absolute;
        top: 50%;
        right: 5px;
        transform: translateY(-50%);
    }
    .owl-prev span,
    .owl-next span{
        color: grey;
    }
    .owl-prev span:hover,
    .owl-next span:hover{
        color: black;
    }

    .owl-dot:focus{
        outline: none;
    }
</style>
