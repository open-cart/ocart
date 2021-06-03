@php
    $banner = get_banner(6);
@endphp
<div class="slide-home owl-carousel owl-theme relative">
    @if(!empty($banner))
        @foreach($banner as $item)
        <div class="item">
            <img src="{{ $item->img }}">
        </div>
        @endforeach
    @endif
</div>
<script>
    $(document).ready(function () {
        $('.owl-carousel').owlCarousel({
            loop: true,
            dots: true,
            nav: false,
            animateOut: 'fadeOut',
            autoPlay: 2000,
            items: 1,
            margin: 0,
        })
    });

</script>
<style lang="scss">
    .owl-carousel:not(.owl-loaded){
        opacity: 0;
        visibility:hidden;
        height:354px;
    }
    .slide-home .owl-dots {
        position: absolute;
        bottom: 0px;
        width: 100%;
    }
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
