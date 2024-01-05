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
                    $(e.currentTarget).css('color', 'red');
                } else if (data.status === 'removed') {
                    // お気に入りから削除された場合のUIの更新
                    $(e.currentTarget).css('color', 'white');
                }
            },
            error: function (data) {
                console.log('エラー:', data);
            }
        });
    });
});
