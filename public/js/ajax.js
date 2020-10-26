export function loadMoreData(url, id) {
    let pageNumber = 2;
    let loading = $('#loading')
    let button = $('#load-more')

    $(loading).hide()
    $(button).click(function() {
        $.ajax({
            type : 'GET',
            url: url + "?page=" + pageNumber,
            beforeSend: function() {
                $(button).hide()
                $(loading).show()
            },
            success : function(data){
                pageNumber += 1;

                if (data.html.length === 0) {
                    $(button).attr('disabled', true).text('Plus aucun résultat à afficher.')
                } else {
                    $("#" + id).append(data.html);
                }
            },
            complete: function() {
                $(button).show()
                $(loading).hide()
            },
            error: function(data){
                console.log('Erreur: ' + data.html)
            },
        })
    })
}

export function loadMoreDataInfinite(url, id) {
    let pageNumber = 2;
    let loading = $('#loading')
    $(loading).hide()

    $(window).scroll(function() {
        if($(window).scrollTop() + $(window).height() >= $(document).height()) {
            $.ajax({
                type : 'GET',
                url: url + "?page=" + pageNumber,
                beforeSend: function() {
                    $(loading).show()
                },
                success: function(data) {
                    pageNumber += 1
                    console.log(data.html.length)

                    if (data.html.length === 0) {
                        console.log('Plus rien')
                        $('.spinner-border').hide()
                        return;
                    } else {
                        $("#"+ id).append(data.html);
                    }
                },
                error: function(data){

                },
            })
        }
    });
}
