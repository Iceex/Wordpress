jQuery(function($) {
  let e; let t; const i = ((e = document.createElement('div')),
  (t = '' + singleTitle) && 'string' == typeof t && ((t = (t = t.replace(/<script[^>]*>([\S\s]*?)<\/script>/gim, '')).replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gim, '')),
  (e.innerHTML = t),
  (t = e.textContent),
  (e.textContent = '')),
  t); const o = 'https://api.themoviedb.org/3/person/'; const a = i; const n = 'https://api.themoviedb.org/3/search/person?api_key=' + apiKey + '&query=' + a;
  jQuery.getJSON(n, function(e) {
    0 == e.results && ($('.detail #content .movie-image').append('<img src="https://via.placeholder.com/1280x1920?text=no-image&000.jpg" >'),
    $('.movie-data').append('<span class="movie-time"><i class="fa fa-user-o"></i>Actor</span>')),
    new LazyLoad();
    for (let t = 0; t < e.results.length; t++) {
      var i = e.results[0].id;
      var a = (e.results[0].name,
      e.results[0].vote_average,
      o + i + '?api_key=' + apiKey + '&append_to_response=images,external_ids');
    }
    jQuery.getJSON(a, function(e) {
      $('.detail #content .movie-image').empty(),
      null == e.external_ids.facebook_id && (s = ''),
      e.name;
      // var t = e.biography.slice(0, 500);
      let t = e.biography;
      // var i = "<span><i class='fa fa-star'></i>&nbsp;" + e.popularity; + "</span>&nbsp;&nbsp;";
      // null == e.popularity && (i = "");
      let a = 'https://image.tmdb.org/t/p/original' + e.profile_path;
      let n = '(' + ('' + e.birthday).split('-', 1)[0] + ')';
      (null != e.birthday && 'undefined' != e.birthday && 'null' != e.birthday) || (n = ''),
      $('#content > div > div.movie-info > h1 > span').append(n);
      let o = '<span id=\'birth\'>' + e.place_of_birth + '</span>&nbsp;&nbsp;';
      null == e.place_of_birth && (o = '<span id=\'birth\'>No information</span>&nbsp;&nbsp;');
      var s = '<a href=\'https://www.facebook.com/' + e.external_ids.facebook_id + '\' target=\'_blank\' class=\'fa fa-facebook-square\'></a>&nbsp;&nbsp;';
      null == e.external_ids.facebook_id && (s = '');
      let l = '<a href=\'https://www.twitter.com/' + e.external_ids.twitter_id + '\' target=\'_blank\' class=\'fa fa-twitter\'></a>&nbsp;&nbsp;';
      (null != e.external_ids.twitter_id && '' != e.external_ids.twitter_id) || (l = '');
      let r = '<a href=\'http://www.instagram.com/' + e.external_ids.instagram_id + '\' target=\'_blank\' class=\'fa fa-instagram\'></a>&nbsp;&nbsp;';
      null == e.external_ids.instagram_id && (r = ''),
      '' == t && (t = nobio + ' ' + singleTitle),
      'https://image.tmdb.org/t/p/originalnull' == a && (a = 'https://via.placeholder.com/1280x1920?text=' + singleTitle + '&000.jpg'),
      $('.detail #content .movie-image').empty(),
      $('.detail #content .movie-image').append('<img src="' + a + '" >');
      let d = 'https://www.imdb.com/name/' + e.imdb_id + '/bio';
      (null != e.imdb_id && '' != e.imdb_id) || (d = '');
      let p = 'https://www.themoviedb.org/person/' + e.id + '/';
      (null != e.id && '' != e.id) || (p = ''),
      $('.tmdb').on("click", function() {
        window.open(p, '_blank');
      }),
      $('#content > div.inner-container > div.movie-info > span > b').append(i),
      $('#content > div.inner-container > div.movie-info > div.movie-data > div').append(o + s + l + r),
      $('.bio').on("click", function() {
        window.open(d, '_blank');
      });
    });
    const n = o + i + '/images?api_key=' + apiKey;
    jQuery.getJSON(n, function(e) {
      const i = [];
      $.each(e.profiles, function(e, t) {
        $('#slideshow').empty(),
        t.file_path,
        i.push('<img src=\'https://image.tmdb.org/t/p/original' + t.file_path + '\' class=\'movie-background\' />');
      }),
      $(i.join('')).appendTo('#slideshow'),
      $('#slideshow > img:gt(0)').hide(),
      setInterval(function() {
        $('#slideshow > img:first').fadeOut(3e3).next().fadeIn(3e3).end().appendTo('#slideshow');
      }, 3e3);
    });
  }),
  $('.plot').filmhdPlot({
    wikiURL: 'https://' + language.slice(0, 2) + '.wikipedia.org/',
    apiPath: 'w',
    section: 1,
    name: a,
    page: page,
    removeLinks: !0,
    type: 'text',
    customSelector: '',
    callback: function() {},
  });
}),
(function(e) {
  e(window).on('load', function() {
    e('.plot').perfectScrollbar({
      suppressScrollX: !0,
    });
  });
}
)(jQuery),
jQuery('#monetize').on("click", function() {
  window.location.href = watch;
}),
(a2a_config = {
  onclick: 1,
}),
(function() {
  const e = document.createElement('script');
  (e.type = 'text/javascript'),
  (e.async = !0),
  (e.src = '//' + disqus_shortname + '.disqus.com/embed.js'),
  (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(e);
}
)();
