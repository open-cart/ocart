<div class="owl-carousel owl-theme">
    <div class="item h-10 bg-gray-100"><h4>1</h4></div>
    <div class="item h-10 bg-gray-200"><h4>2</h4></div>
    <div class="item h-10"><h4>3</h4></div>
    <div class="item h-10"><h4>4</h4></div>
    <div class="item h-10"><h4>5</h4></div>
    <div class="item h-10"><h4>6</h4></div>
    <div class="item h-10"><h4>7</h4></div>
    <div class="item h-10"><h4>8</h4></div>
    <div class="item h-10"><h4>9</h4></div>
    <div class="item h-10"><h4>10</h4></div>
    <div class="item h-10"><h4>11</h4></div>
    <div class="item h-10"><h4>12</h4></div>
</div>
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
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
