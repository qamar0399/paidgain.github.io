(function($) {
    "use strict";

    /**
     * This function will change the advertisement body. Based on advertisement type.
     * */
    $('#ads_type').on('change', function() {
        var type = $(this).val();

        if (type === 'link_url') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="link_url" class="form-label text-secondary">Link / URL</label>' +
                '<input type="url" class="form-control" name="ads_body" id="link_url" placeholder="https://example.com/" required>' +
                '</div>');
        } else if (type === 'banner_image') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="banner_image" class="form-label text-secondary">Banner / Image</label>' +
                '<input type="file" class="form-control" name="ads_body" id="banner_image" required>' +
                '</div>');
        } else if (type === 'clickable_image') {
            $('#ads_type_body').html('' +
                '<div class="from-group mb-2">' +
                '<label for="clickable_image" class="form-label text-secondary">Clickable Image</label>' +
                '<input type="file" class="form-control" name="clickable_image" id="clickable_image" required>' +
                '</div>' +
                '<div class="from-group mb-2">' +
                '<label for="clickable_image_url" class="form-label text-secondary">Clickable Image Url</label>' +
                '<input type="url" class="form-control" name="ads_body" id="clickable_image_url" placeholder="https://www.example.com/hello" required>' +
                '</div>'
            );
        } else if (type === 'script_code') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="script_code" class="form-label text-secondary">Script / Code</label>' +
                '<textarea class="form-control" name="ads_body" id="script_code" rows="5" placeholder="<script>code</script>" required></textarea>' +
                '</div>');
        } else if (type === 'embedded') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="embedded" class="form-label text-secondary">Embedded Code</label>' +
                '<textarea class="form-control" name="ads_body" id="embedded" rows="5" placeholder="<iframe...........</iframe>" required></textarea>' +

                '</div>');
        } else if (type === 'youtube_subscriber') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="youtube_subscriber" class="form-label text-secondary">Youtube Channel Link</label>' +
                '<input type="url" class="form-control" name="ads_body" id="youtube_subscriber" placeholder="https://www.youtube.com/c/channel" required>' +
                '</div>');
        } else if (type === 'facebook_follower') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="facebook_follower" class="form-label text-secondary">Facebook Link</label>' +
                '<input type="url" class="form-control" name="ads_body" id="facebook_follower" placeholder="https://www.facebook.com/abcd" required>' +
                '</div>');
        } else if (type === 'twitter_follower') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="twitter_follower" class="form-label text-secondary">Twitter Link</label>' +
                '<input type="url" class="form-control" name="ads_body" id="twitter_follower" placeholder="https://www.twitter.com/abcd" required>' +
                '</div>');
        } else if (type === 'instagram_follower') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="instagram_follower" class="form-label text-secondary">Instagram Link</label>' +
                '<input type="url" class="form-control" name="ads_body" id="instagram_follower" placeholder="https://www.instagram.com/abcd" required>' +
                '</div>');
        }
    })

})(jQuery);
