<div id="gallery" class="fullscreen" style="text-align: center">
</div>
<link rel="stylesheet" type="text/css" href="/assets/css/polaroid-gallery.css"/>
<script src="/assets/js/polaroid-gallery.js"></script>
<script>
    window.onload = function () {
        new _polaroidGallery('{{route('goods.tao_girl_detail_ajax',['id'=>$id])}}');
    }
</script>
