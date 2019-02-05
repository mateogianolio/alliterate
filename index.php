<!doctype html>
<html>
  <head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-41408481-5"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'UA-41408481-5');
    </script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta property="og:url" content="http://alliterate.net/">
    <meta property="og:title" content="Alliterate">
    <meta property="og:description" content="A beautiful, addicting word game.">
    <meta property="og:image" content="http://images.clipartpanda.com/homework-clipart-black-and-white-RTdMRae8c.png">
    
    <title>Alliterate &mdash; A beautiful, addicting word game.</title>
    
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://use.typekit.net/gud3lnw.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>try{Typekit.load();}catch(e){}</script>
    
    <script src="lib/game.js"></script>
  </head>
  <body class="tk-expo-serif-pro">
    <div data-grid>
      <section>
        <div data-size="1/6"></div>
        <div data-size="2/6" data-logo>
          <a href="/"><img width="200" height="50" src="logo.png" title="Alliterate" alt="Logo"></a>
        </div>
        <div data-size="2/6" data-highscore>
          <h1 data-subtitle>HIGHSCORE / RANK</h1>
          <b data-highscore></b>
        </div>
        <div data-size="1/6" data-played>
          <h1 data-subtitle></h1>
        </div>
      </section>
    </div>
    <div data-grid>
      <section>
        <div data-size="1/6">
        </div>
        <div data-size="4/6" data-description>
          <a href="https://twitter.com/share" class="twitter-share-button" data-via="mateogianolio" data-size="large">Tweet</a>
          <br>
          <br>
          You have sixty seconds to type as many words as you can. Every twenty seconds you are given a new letter. Press <b>return</b> or <b>space</b> to validate a word.<br>
        </div>
        <div data-size="1/6"></div>
      </section>
      <section data-letters>
        <h1 data-size="1/6" data-subtitle data-right>
          TYPE WORDS THAT BEGIN WITH
        </h1>
        <div data-size="5/6" data-letter>
          <span>?</span>
        </div>
      </section>
    </div>
    <div data-grid>
      <section>
        <div data-size="1/6" data-points>
          <h1 data-subtitle>SCORE</h1>
          <b>0</b>
        </div>
        <input data-size="4/6"
               name="answer"
               type="text"
               value="Click to play">
        <div data-size="1/6" data-time>
          <h1 data-subtitle>TIME</h1>
          <b>60</b>
        </div>
      </section>
    </div>
    <div data-grid>
      <section>
        <div data-size="1/6"></div>
        <div data-size="4/6" data-answers></div>
        <div data-size="1/6"></div>
      </section>
    </div>
    <script>
      window.twttr = (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0],
          t = window.twttr || {};
        if (d.getElementById(id)) return t;
        js = d.createElement(s);
        js.id = id;
        js.src = "https://platform.twitter.com/widgets.js";
        fjs.parentNode.insertBefore(js, fjs);

        t._e = [];
        t.ready = function(f) {
          t._e.push(f);
        };

        return t;
      }(document, "script", "twitter-wjs"));
    </script>
  </body>
</html>