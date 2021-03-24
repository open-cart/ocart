<div x-data="mediaPopup()">
    <x-media::popup
            id="mediaPopup"
            @close="hide()"
            @accept="accept()">
    </x-media::popup>
    <button type="button" id="popup" style="display:none" x-on:click="show()">Choosen image</button>
</div>
<button type="button" id="nguyen">Choosen image</button>
<script>
    $("#nguyen").click(function() {
        $("#popup").click();
    })
    function mediaPopup() {
        return {
            show() {
                $('#mediaPopup').show();
            }
        }
    }
</script>