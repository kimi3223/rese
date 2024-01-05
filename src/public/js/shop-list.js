// public/js/shop-list.js

$(document).ready(function () {
    $('.favorite-button').on('click', function (e) {
        e.preventDefault();

        var shopId = $(this).data('shop-id');
        var url = '/favorite/' + shopId;

        $.ajax({
            type: 'POST',
            url: url,
            data: {_token: $('meta[name="csrf-token"]').attr('content')},
            success: function (data) {
                if (data.status === 'added') {
                    // お気に入りに追加された場合のUIの更新
                    $(e.target).css('color', 'red');
                    // 必要に応じて追加のUIの更新
                } else if (data.status === 'removed') {
                    // お気に入りから削除された場合のUIの更新
                    $(e.target).css('color', 'black');
                    // 必要に応じて追加のUIの更新
                }
            },
            error: function (data) {
                console.log('エラー:', data);
            }
        });
    });
});
