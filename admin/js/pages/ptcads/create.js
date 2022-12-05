(function($) {
    "use strict";   

    /**
     * This function will change the advertisement body. Based on advertisement type.
     * */
    $(document).on('change', '#ads_type', function() {
        var type = $(this).val();

        if (type === 'link_url') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="link_url">Link / URL</label>' +
                '<input type="url" class="form-control" name="ads_body" id="link_url" placeholder="https://example.com/" required>' +
                '</div>');
        } else if (type === 'clickable_image') {
            
            $('#ads_type_body').html('' +
                '<div class="from-group mb-2">' +
                '<label for="clickable_image_url">Clickable Image Url</label>' +
                '<input type="url" class="form-control" name="ads_body" id="clickable_image_url" placeholder="https://www.example.com/hello" required>' +
                '</div>'
            );
        } else if (type === 'script_code') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="script_code">Script / Code</label>' +
                '<textarea class="form-control" name="ads_body" id="script_code" rows="5" placeholder="<script>code</script>" required></textarea>' +
                '</div>');
        } else if (type === 'embedded') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="embedded">Embedded Code</label>' +
                '<textarea class="form-control" name="ads_body" id="embedded" rows="5" placeholder="<iframe...........</iframe>" required></textarea>' +

                '</div>');
        } else if (type === 'youtube_subscriber') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="youtube_subscriber">Youtube Channel Link</label>' +
                '<input type="url" class="form-control" name="ads_body" id="youtube_subscriber" placeholder="https://www.youtube.com/c/channel" required>' +
                '</div>');
        } else if (type === 'facebook_follower') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="facebook_follower">Facebook Link</label>' +
                '<input type="url" class="form-control" name="ads_body" id="facebook_follower" placeholder="https://www.facebook.com/abcd" required>' +
                '</div>');
        } else if (type === 'twitter_follower') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="twitter_follower">Twitter Link</label>' +
                '<input type="url" class="form-control" name="ads_body" id="twitter_follower" placeholder="https://www.twitter.com/abcd" required>' +
                '</div>');
        } else if (type === 'instagram_follower') {
            $('#ads_type_body').html('<div class="from-group mb-2">' +
                '<label for="instagram_follower">Instagram Link</label>' +
                '<input type="url" class="form-control" name="ads_body" id="instagram_follower" placeholder="https://www.instagram.com/abcd" required>' +
                '</div>');
        }
    })

})(jQuery);
