// ★ボタンがクリックされたら
function toggleBookmark(post_id) {
    // 押されたボタンを特定
    let post = $("#post-" + post_id)

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    let path;
    let data;
    if ($(post).data('is-bookmark') === true) {
        // お気に入り解除
        path = "/unbookmark"
        data = {
            _method: "delete"
        }
    } else {
        // お気に入り登録
        path = "/bookmark"
    }
    $.ajax({
        url: "/post/" + post_id + path,
        type: "POST",
        data: data,
        dataType: 'json',
        complete: function (res) {
            console.log(res)
            if (res.status === 200) {
                // 星の色を入れ替える
                $(post).find('i').attr('class', res.responseText === "added" ? "fas fa-star" : "far fa-star")
                // data-is_bookmarkを入れ替える
                $(post).data('is-bookmark', res.responseText === "added" ? true : false)
            }
        }
    })
}