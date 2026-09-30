
document.addEventListener('DOMContentLoaded', () => {
  const canvas = document.getElementById('gameCanvas');
  const ctx = canvas.getContext('2d');
  const startBtn = document.getElementById('startGame');
  const scoreEl = document.getElementById('score');

  const CENTER = { x: canvas.width / 2, y: canvas.height / 2 };
  const RADIUS = Math.min(canvas.width, canvas.height) / 2 - 40;

  const COLORS = [
    '#ff595e', '#ffca3a', '#8ac926', '#1982c4',
    '#6a4c93', '#ff924c', '#52b788', '#e63946'
  ];

  const DOT_COUNT = 8;
  const DOT_RADIUS = 10;
  const POINTS_PER_LAP = 100;

  let dots = [];
  let previousAngles = [];
  let score = 0;
  let running = false;
  let animationId = null;

  const playerCar = window.PLAYER_CAR || null;

  function createDots() {
    dots = Array.from({ length: DOT_COUNT }, (_, i) => ({
      angle: (Math.PI * 2 * i) / DOT_COUNT,
      speed: 0.01 + Math.random() * 0.02,
      color: COLORS[i % COLORS.length],
      laps: 0,
      label: null,
    }));

    // The player races as the first dot, using their chosen car.
    if (playerCar) {
      dots[0].color = playerCar.color;
      dots[0].label = playerCar.name;
      // speed_rating (1-5) nudges the player's pace within the normal range.
      dots[0].speed = 0.01 + (playerCar.speed_rating / 5) * 0.02;
    }

    previousAngles = dots.map((d) => d.angle);
  }

  function updateScoreDisplay() {
    scoreEl.textContent = String(score).padStart(6, '0');
  }

  function drawTrack() {
    ctx.beginPath();
    ctx.arc(CENTER.x, CENTER.y, RADIUS, 0, Math.PI * 2);
    ctx.strokeStyle = '#333';
    ctx.lineWidth = 4;
    ctx.stroke();

    const markerX = CENTER.x + RADIUS;
    const markerY = CENTER.y;
    ctx.beginPath();
    ctx.moveTo(markerX - 8, markerY - 8);
    ctx.lineTo(markerX + 8, markerY + 8);
    ctx.moveTo(markerX - 8, markerY + 8);
    ctx.lineTo(markerX + 8, markerY - 8);
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.stroke();
  }

  function drawDot(dot) {
    const x = CENTER.x + RADIUS * Math.cos(dot.angle);
    const y = CENTER.y + RADIUS * Math.sin(dot.angle);

    ctx.beginPath();
    ctx.arc(x, y, DOT_RADIUS, 0, Math.PI * 2);
    ctx.fillStyle = dot.color;
    ctx.shadowColor = dot.color;
    ctx.shadowBlur = 12;
    ctx.fill();
    ctx.shadowBlur = 0;
  }

  function drawLeaderboard() {
    const sorted = [...dots].sort((a, b) => {
      if (b.laps !== a.laps) return b.laps - a.laps;
      return (b.angle % (Math.PI * 2)) - (a.angle % (Math.PI * 2));
    });

    ctx.font = '14px sans-serif';
    ctx.textAlign = 'left';
    sorted.forEach((dot, i) => {
      ctx.fillStyle = dot.color;
      ctx.fillRect(10, 10 + i * 20, 12, 12);
      ctx.fillStyle = dot.label ? dot.color : '#eee';
      const text = dot.label ? `${dot.label} (YOU) — Lap ${dot.laps}` : `Lap ${dot.laps}`;
      ctx.fillText(text, 28, 21 + i * 20);
    });
  }

  function update() {
    dots.forEach((dot, i) => {
      const prev = previousAngles[i] % (Math.PI * 2);
      dot.angle += dot.speed;
      const curr = dot.angle % (Math.PI * 2);
      if (curr < prev) {
        dot.laps += 1;
        score += POINTS_PER_LAP;
        updateScoreDisplay();
      }
      previousAngles[i] = dot.angle;
    });
  }

  function render() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    drawTrack();
    dots.forEach(drawDot);
    drawLeaderboard();
  }

  function loop() {
    update();
    render();
    if (running) animationId = requestAnimationFrame(loop);
  }

  function startGame() {
    if (running) return;
    running = true;
    score = 0;
    updateScoreDisplay();
    createDots();
    startBtn.textContent = 'RESTART';
    loop();
  }

  drawTrack();
  updateScoreDisplay();

  startBtn.addEventListener('click', () => {
    if (animationId) cancelAnimationFrame(animationId);
    running = false;
    startGame();
  });
});