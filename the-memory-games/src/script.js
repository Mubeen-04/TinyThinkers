class PlayFooter extends React.Component {
  constructor(props) {
    super(props);

    this.state = {
      elapsed: 0
    };
  }

  componentWillReceiveProps(nextProps) {
    if (nextProps.gameOver !== this.props.gameOver && nextProps.gameOver) {
      clearInterval(this.timer);

      this.setState({ elapsed: 0 });
    }
  }

  componentDidMount() {
    this.timer = setInterval(() => {
      this.setState({ elapsed: this.state.elapsed + 1 });
    }, 1000);
  }

  render() {
    return (
      <div className="area__footer">
        <p>Turns : {this.props.turns}</p>
        <p>Time : {this.state.elapsed} sec</p>
      </div>
    );
  }
}

class Tile extends React.Component {
  constructor(props) {
    super(props);

    this.handleClick = this.handleClick.bind(this);
  }

  handleClick() {
    if (this.props.status === "unselected") {
      this.props.onClickListener(this.props.index);
    } else {
      console.warn("The tile has already been " + this.props.status);
    }
  }

  render() {
    return (
      <div
        onClick={this.handleClick}
        className={
          "tile " +
          (this.props.status === "selected"
            ? "tile--selected"
            : this.props.status === "matched"
              ? "tile--selected tile--matched"
              : "")
        }
      >
        <div className="tile--front" />
        <div
          className="tile--back"
          style={{ backgroundColor: this.props.accent }}
        >
          {this.props.icon}
        </div>
      </div>
    );
  }
}

class PlayArea extends React.Component {
  tiles = [
    {
      name: "face-with-tears-of-joy",
      accent: "#ffcc33",
      icon: "😂"
    },
    {
      name: "turkey",
      accent: "rgb(171, 153, 142)",
      icon: "🦃"
    },
    {
      name: "monkey-face",
      accent: "rgb(151, 123, 75)",
      icon: "🐵"
    },
    {
      name: "ear-of-maize",
      accent: "rgb(138, 181, 115)",
      icon: "🌽"
    },
    {
      name: "snowman-without-snow",
      accent: "#ffffff",
      icon: "⛄"
    },
    {
      name: "beer-mug",
      accent: "goldenrod",
      icon: "🍺"
    },
    {
      name: "thinking-face",
      accent: "yellow",
      icon: "🤔"
    },
    {
      name: "racing-car",
      accent: "#DC143C",
      icon: "🏎️"
    }
  ];

  constructor(props) {
    super(props);

    this.state = {
      tiles: [],
      turns: 0,
      activeTile: null
    };

    this.handleClick = this.handleClick.bind(this);
    this.resetPlayArea = this.resetPlayArea.bind(this);
  }

  shuffleTiles(tiles) {
    let j, x, i;

    for (i = tiles.length - 1; i > 0; i--) {
      j = Math.floor(Math.random() * (i + 1));
      x = tiles[i];
      tiles[i] = tiles[j];
      tiles[j] = x;
    }

    return tiles;
  }

  multiplyTiles(tiles) {
    return tiles
      .map(item => {
        // Use Object.assign to create a new object rather than passing the same reference twice
        return [item, Object.assign({}, item)];
      })
      .reduce((a, b) => {
        return a.concat(b);
      });
  }

  componentWillReceiveProps(nextProps) {
    if (nextProps.gameOver !== this.props.gameOver && !nextProps.gameOver) {
      const newTiles = this.tiles.map(e => {
        e.status = "unselected";

        return e;
      });

      this.setState({
        tiles: this.shuffleTiles(this.multiplyTiles(newTiles))
      });
    }
  }

  handleClick(index) {
    // Update turns on every click
    this.setState({ turns: this.state.turns + 1 });

    const selectedTile = this.state.tiles[index];
    const updatedTiles = this.state.tiles.slice();

    selectedTile.status = "selected";
    updatedTiles[index] = selectedTile;

    this.setState({
      tiles: updatedTiles
    });

    if (this.state.activeTile === null) {
      this.setState({
        activeTile: selectedTile
      });
    } else if (selectedTile.name === this.state.activeTile.name) {
      let matched = 0;

      const updatedTiles = this.state.tiles.map(e => {
        if (e.name === selectedTile.name) e.status = "matched";
        if (e.status === "matched") matched++;

        return e;
      });

      this.setState({
        tiles: updatedTiles,
        activeTile: null
      });

      if (matched === 16) this.resetPlayArea();
    } else {
      const _this = this;

      setTimeout(function() {
        const updatedTiles = _this.state.tiles.map(e => {
          if (
            e.name === _this.state.activeTile.name ||
            e.name === selectedTile.name
          ) {
            e.status = "unselected";
          }

          return e;
        });

        _this.setState({
          activeTile: null,
          tiles: updatedTiles
        });
      }, 700);
    }
  }

  resetPlayArea() {
    this.props.onGameOver(this.state.turns);

    this.setState({
      tiles: [],
      turns: 0,
      activeTile: null
    });
  }

  render() {
    let cindex = 0;
    return (
      <div className="area__wrapper">
        <h1 className="area__head">The Memory Games</h1>
        <ul className="area">
          {this.state.tiles.map(e => (
            <Tile
              index={cindex++}
              status={e.status}
              icon={e.icon}
              accent={e.accent}
              onClickListener={this.handleClick}
            />
          ))}
        </ul>
        {!this.props.gameOver ? (
          <PlayFooter turns={this.state.turns} gameOver={this.props.gameOver} />
        ) : null}
      </div>
    );
  }
}

class PlayModal extends React.Component {
  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className={this.props.gameOver ? "modal__wrapper" : "hidden"}>
        <div className="modal">
          <div className="modal--top overlay">
            <p>
              <b>High Score</b> : {this.props.highScore} pts
            </p>
          </div>
          <div className="modal--bottom">
            <p>
              Hey there, You think you’ve got a sharp memory? Let’s see how far
              you can go.
            </p>
            <button className="modal__btn" onClick={this.props.onPlayClick}>
              Play
            </button>
          </div>
        </div>
      </div>
    );
  }
}

class App extends React.Component {
  constructor() {
    super();

    this.state = {
      score: 0,
      gameOver: true
    };

    this.initCards = this.initCards.bind(this);
    this.restartGame = this.restartGame.bind(this);
  }

  initCards() {
    this.setState({
      score: 0,
      gameOver: false
    });
  }

  restartGame(turns) {
    const score = Math.round(120 / turns * 100);

    this.setState({
      score: score,
      gameOver: true
    });
  }

  render() {
    return (
      <div>
        <PlayModal
          gameOver={this.state.gameOver}
          highScore={this.state.score}
          onPlayClick={this.initCards}
        />
        <PlayArea
          gameOver={this.state.gameOver}
          onGameOver={this.restartGame}
        />
      </div>
    );
  }
}

ReactDOM.render(<App />, document.getElementById("root"));