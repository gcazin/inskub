/**
 * Sauvegarde d'un post
 *
 * @param url
 */
export function submitPost(url) {
    $('#submit-post').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
        formData.delete('_method')
        formData.delete('_token')
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#submit-post')[0].reset()
                $('#img-preview').removeAttr('src')
                $('#post-list').prepend(data).fadeIn('slow')
            },
            error: function (data) {
                console.log('Erreur : ' + data.response);
            }
        });
    });
}

/**
 * Permet de rajouter un chargement infini via un bouton
 *
 * @param url
 * @param id
 */
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

/**
 * Permet de rajouter un chargement infini au scroll
 *
 * @param url
 * @param id
 */
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
                    if (data.html.length === 0) {
                        $('.spinner-border').hide()
                        return;
                    } else {
                        $("#"+ id).append(data.html);
                    }
                },
                error: function(data) {
                    console.log(data)
                },
            })
        }
    });
}

export function searchUsersDiscover() {
    let input = $('#search-users')

    $(input).keyup(function() {
        $.ajax({
            type : 'GET',
            url: "{{ config('app.url') }}/discover/search?q=" + input.val(),
            success : function(data) {
                if (data.html.length === 0) {
                    $('#users-list').html(data.html);
                    $('#load-more').text("Aucun résultat").attr('disabled', true)
                } else {
                    if(data.initial) {
                        $('#load-more').html("Voir plus").attr('disabled', false)
                        $('#users-list').html(data.html);
                    } else {
                        console.log(data.html.length)
                        let plural = data.html.length <= 1 ? '' : 's'

                        $('#load-more').text(data.html.length + " résultat" + plural).attr('disabled', true)
                        $('#users-list').html(data.html);
                    }
                }
            },
        })
    })
}

export function searchUsers(url, id) {
    let input = $('#skills')
    let btnSearch = $('#btn-search')
    let form = $('#search-experts')[0]
    let list = $(id)

    $(input).change(function (e) {
        e.preventDefault();

        let formData = new FormData(form);
        formData.delete('_method')
        formData.delete('_token')
        console.log(...formData)
        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            dataType: 'json',
            cache : false,
            processData: false,
            contentType: false,
            success: function(data) {
                console.log(data)
                if (data.html.length === 0) {
                    $(list).html(data.html);
                    $('#load-more').text("Aucun résultat").attr('disabled', true)
                } else {
                    if(data.initial) {
                        $('#load-more').html("Voir plus").attr('disabled', false)
                        $(list).html(data.html);
                    } else {
                        let plural = data.html.length <= 1 ? '' : 's'

                        $('#load-more').text(data.html.length + " résultat" + plural).attr('disabled', true)
                        $(list).html(data.html);
                    }
                }
            },
            error: function (data) {
                console.log('Erreur : ', data.html);
            }
        });
    });
}

/**
 * Permet d'afficher au clic l'item correspondant
 * Utilisé pour les formations et les emplois
 *
 * @param model Url de l'action show du model correspondant (ex: formation)
 */
export function showItem(model) {
    let imgContainer = $('.img-container')

    let showItem = $(`#show-${model}`).show()
    const show = (id) => {
        $(showItem).show()
        $.ajax({
            type : 'GET',
            url: `${model}/${id}`,
            success : function(data) {
                $(showItem).html(data.html)
                console.log('succès')
            },
            /*complete: function() {
                $(button).show()
                $(loading).hide()
            },*/
            error: function(data){
                console.log('Erreur: ' + data.html)
            },
        })
    }

    $(showItem).hide()
    let items = $(`.${model}-item`)
    $(items).each((key, value) => {
        $(value).click(function() {
            show(value.id)
            $(imgContainer).addClass('mr-5')
        });
    })
}
