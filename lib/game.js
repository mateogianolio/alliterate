class Game {
  constructor() {
    this.state = {
      playing: false,
      score: 0,
      currentLetter: 0,
      counter: 60,
      guesses: [],
      letters: [],
    };

    this.input = document.querySelector('input');
    this.answers = document.querySelector('[data-answers]');
    this.points = document.querySelector('[data-points] b');
    this.letter = document.querySelector('[data-letter] div');
    this.time = document.querySelector('[data-time] b');
    this.played = document.querySelector('[data-played] h1');
    this.highscore = document.querySelector('[data-highscore] b');
    this.rank = document.querySelector('[data-rank] b');

    this.input.addEventListener('focus', this.onFocus.bind(this));
    window.addEventListener('blur', this.onBlur.bind(this));
    this.input.addEventListener('keydown', this.onKeyDown.bind(this));

    this.getHighscore();
  }

  setState(newState) {
    this.state = {
      ...this.state,
      ...newState,
    };
  }

  onFocus() {
    this.init();
  }

  onBlur() {
    this.input.blur();
    this.reset();
  }

  onKeyDown(event) {
    if (event.key === 'Enter' || event.key == ' ') {
      event.preventDefault();
      this.validate();
    }
  }

  init() {
    this.answers.innerHTML = '';
    this.points.innerHTML = '0';
    this.points.style.background = '#000';
    this.input.value = '';

    this.start = new Date();
    this.setState({
      playing: true,
      letters: this.getLetters(),
    });

    this.letter.innerHTML = this.state.letters[this.state.currentLetter];

    window.requestAnimationFrame(this.update.bind(this));
  }

  update() {
    if (!this.state.playing) {
      return;
    }

    this.time.innerHTML = Math.abs(this.state.counter).toFixed(1);

    this.setState({ currentLetter: Math.floor(3 - (this.state.counter / 20)) });

    if (this.state.letters[this.state.currentLetter] !== this.letter.innerHTML) {
      this.letter.innerHTML = this.state.letters[this.state.currentLetter];
    }
  
    if (this.state.counter <= 0) {
      this.verify();
      return;
    }

    this.setState({ counter: 60 - ((new Date() - this.start) / 1000) });

    window.requestAnimationFrame(this.update.bind(this));
  }

  async verify() {
    if (!this.state.score) {
      return;
    }

    try {
      const body = new FormData();
      body.append('time', (new Date() - this.start) / 1000);
      body.append('words', this.state.guesses);
      body.append('score', this.state.score);
      body.append('letters', this.state.letters);

      const response = await fetch('ajax/verify.php', {
        method: 'POST',
        body,
      });

      const data = await response.text();
  
      if (data != 'success') {
        console.log(data);
      }
  
      this.getHighscore();
  
      this.input.blur();
      this.input.value = 'Well played! Try again?';
      this.points.style.background = '#49a34b';
      this.letter.innerHTML = '?';
  
      this.reset();
    } catch (err) {
      console.error(err);
    }
  }

  async validate() {
    const guess = this.input.value.toLowerCase();
  
    if (!guess
      || this.state.guesses.includes(guess)
      || this.state.counter <= 0
      || guess[0] != this.state.letters[this.state.currentLetter]) {
      return;
    }

    this.input.value = '';
  
    const response = await fetch('ajax/words.php?q=' + guess);
    const data = await response.json();
  
    if (!data) {
      return;
    }
  
    if (this.state.guesses.includes(data.word)) {
      return false;
    }
  
    this.setState({
      guesses: [guess, ...this.state.guesses],
      score: this.state.score + Number(data.score),
    });
  
    const div = document.createElement('div');
    div.style.display = 'inline-block';
    div.title = data.score;
    div.innerHTML = guess + ' ';
    div.classList.add('expandOpen');
  
    this.answers.prepend(div);

    const length = this.answers.children.length;
    for (let i = 0; i < length; i++) {
      const child = this.answers.children[i];
      child.style.opacity = 1 - i / length;
      child.style.zIndex = 999 - i;
    }
  
    this.points.innerHTML = this.state.score;
  }

  reset() {
    this.setState({
      playing: false,
      score: 0,
      currentLetter: 0,
      counter: 60,
      guesses: [],
      letters: [],
    });

    this.letter.innerHTML = '?';
  }
  
  getLetters() {
    const array = [];
    let alphabet = 'abcdefghijkklmnopqrstuvwxyz';
    let pos;
  
    for (let i = 0; i < 3; i++) {
      pos = Math.floor(Math.random() * alphabet.length);
      array.push(alphabet[pos]);
      alphabet = alphabet.replace(alphabet[pos], '');
    }
    
    return array;
  }

  async getHighscore() {
    try {
      const response = await fetch('ajax/highscore.php');
      const data = await response.json();
  
      this.played.innerHTML = '<b>' + data.played + '</b> TOTAL ROUNDS PLAYED<br><br>';
      this.played.innerHTML += '<b>' + data.users + '</b> USERS CURRENTLY PLAYING<br><br>';
      this.played.innerHTML += data.rank > 1 ? '<b>' + data.top + '</b> CURRENT TOP SCORE' : 'YOU ARE THE KING OF THE HILL!';
      this.highscore.innerHTML = data.highscore;
      this.rank.innerHTML = data.rank;
    } catch (err) {
      console.error(err);
    }
  }
}

new Game();
