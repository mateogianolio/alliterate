var points = 0,
    letter = 0,
    time = 60;

var guesses = [],
    letters = [];

var start,
    timer,
    guess;

$(function() {
  getHighscore();
  
  $('body')
    .keydown(function(event) {
      if(event.keyCode == 8 && !timer)
        return false;
    });

  $('input')
    .on('focus', function(event) {
      if(!timer)
        init(this);
    })
    .keydown(function(event) {
      // if space or enter
      if(event.keyCode == 13 || event.keyCode == 32) {
        validate(this);
        return false;
      }
    });
  });

function init(that) {
  $('[data-answers]').html('');
  $('[data-points] b')
    .css('background', '#000')
    .html('0');
  
  $(that).val('');

  start = new Date();
  letters = getLetters();
  
  $('[data-letter] span').html(letters[letter]);

  timer = setInterval(function() {
    update(that);
  }, 1000);
}

function update(that) {
  $('[data-time] b').html(--time);
  
  if(time % 20 == 0) {
    $('[data-letter] span')
      .hide()
      .html(letters[++letter])
      .fadeIn(250);
    
    $(that).val('');
  }

  if(time <= 0) {
    verify(that);
    return;
  }
}

function validate(that) {
  guess = $(that).val().toLowerCase();
  
  if(!guess 
    || $.inArray(guess, guesses) > -1
    || time < 0
    || guess[0] != letters[letter])
    return;

  $.get('ajax/words.php?q=' + guess, function(response) {
    if(!response)
      return;

    response = $.parseJSON(response);
    console.log(response);

    if($.inArray(response.word, guesses) > -1)
      return false;
    
    guesses.push(guess);
    points += Number(response.score);

    var span = document.createElement('span');

    $(span)
      .css('visibility', 'hidden')
      .attr({
        title: response.score,
        class: 'expandOpen'
      })
      .html(guess + ' ');

    $('[data-answers]')
      .prepend(span);

    var length = $('[data-answers] span').length;
    $('[data-answers] span')
      .each(function(i) {
        $(this)
          .css('opacity', 1 - i / length);
      });

    $('[data-points] b')
      .html(points);
  });

  $(that)
    .val('');
}

function verify(that) {
  if(!points)
    return;
  
  var data = {
    time: (new Date() - start) / 1000,
    words: guesses,
    score: points,
    letters: letters
  };

  $.post('ajax/verify.php', data, function(response) {
    if(response != 'success')
      console.log(response);
    
    getHighscore();
  });

  $(that)
    .blur()
    .val('Well played! Try again?');
  
  $('[data-points] b').css('background', '#49a34b');
  $('[data-letter] span').html('?');

  reset();
}

function reset() {
  points = 0;
  letter = 0;
  time = 60;
  
  guesses = [];
  letters = [];
  
  clearInterval(timer);
  timer = null;
}

function getLetters() {
  var array = [];
  var alphabet = 'abcdefghijkklmnopqrstuvwxyz';
  var pos;

  for(i = 0; i < 3; i++) {
    pos = Math.floor(Math.random() * alphabet.length);
    array[i] = alphabet[pos];
    alphabet = alphabet.replace(alphabet[pos], '');
  }
  
  return array;
}

function getHighscore() {
  $.get('ajax/highscore.php', function(response) {
    if(response) {
      var data = $.parseJSON(response);

      $('[data-played] h1')
        .html('<b>' + data.played + '</b> TOTAL ROUNDS PLAYED<br><br>')
        .append(data.rank > 1 ? '<b>' + data.top + '</b> CURRENT TOP SCORE' : 'YOU ARE THE KING OF THE HILL!');
      
      $('[data-highscore] b').html(data.highscore + ' / ' + data.rank);
    }
  });
}