
<div class="swiper-container mySwiper iq-width overflow-hidden mx-auto">
    <div class="swiper-wrapper ">
    <?php
        $request = mysqli_query($database, "SELECT produits.photo_produits1, produits.nom_produits, produits.description_produits FROM produits");
        while ($result = mysqli_fetch_assoc($request)) {
            echo '
                <div class="swiper-slide">
                    <img title="'.$result['description_produits'].'" class="img-fluid w-100 rounded" src="'.$result['photo_produits1'].'" alt="image" />
                </div>
            ';
            # code...
        }
    ?>       
    </div>
</div>