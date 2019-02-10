<!doctype html>
<html lang="en">
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
    <meta name="apple-mobile-web-app-capable" content="yes" />
    
    <meta property="og:url" content="http://alliterate.net/">
    <meta property="og:title" content="Alliterate">
    <meta property="og:description" content="A beautiful, addicting word game.">
    <meta property="og:image" content="http://images.clipartpanda.com/homework-clipart-black-and-white-RTdMRae8c.png">
    
    <title>Alliterate &mdash; A beautiful, addicting word game.</title>
    
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="https://use.typekit.net/gud3lnw.css">
    
    <script>try{Typekit.load();}catch(e){}</script>
    
  </head>
  <body class="tk-expo-serif-pro">
    <div data-grid>
      <section>
        <div data-size="1/6"></div>
        <div data-size="2/6" data-logo>
          <a href="/">
            <h1>alliterate</h1>
          </a>
        </div>
        <div data-size="1/6" data-highscore>
          <h1 data-subtitle>HIGHSCORE</h1>
          <b data-highscore></b>
        </div>
        <div data-size="1/6" data-rank>
          <h1 data-subtitle>RANK</h1>
          <b data-rank></b>
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
          You have sixty seconds to type as many words as you can.<br>
          Every twenty seconds you are given a new letter.<br>
          Press <b>return</b> or <b>space</b> to validate a word.<br>
        </div>
        <div data-size="1/6"></div>
      </section>
      <section data-letters>
        <h1 data-size="1/6" data-subtitle data-right>
          TYPE WORDS THAT BEGIN WITH
        </h1>
        <div data-size="2/6" data-letter>
          <div>?</div>
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
    <script src="lib/game.js"></script>
    <div data-grid>
      <section data-footer>
        <div data-size="1/6"></div>
        <div data-size="4/6">
          Scores are calculated based on the <a href="https://en.wikipedia.org/wiki/Scrabble_letter_distributions#English">scrabble letter distribution</a>.
        </div>
        <div data-size="1/6"></div>
      </section>
    </div>
  </body>
</html>