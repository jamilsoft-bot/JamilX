<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JamilSoft AMS — Fingerprint Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Nunito+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --navy: #060C1A;
      --navy-mid: #0D1730;
      --navy-card: #0F1A2E;
      --navy-border: #1C2E4A;
      --teal: #00D4AA;
      --teal-dim: #00A882;
      --teal-glow: rgba(0,212,170,0.12);
      --amber: #F59E0B;
      --red: #F87171;
      --green: #4ADE80;
      --text: #E2EAF4;
      --muted: #6B8099;
    }
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Nunito Sans', sans-serif;
      background: var(--navy);
      color: var(--text);
      min-height: 100vh;
      display: flex; flex-direction: column;
      overflow: hidden;
    }
    h1,h2,h3,h4 { font-family: 'Rajdhani', sans-serif; }

    /* Animated Background */
    .bg-layer {
      position: fixed; inset: 0; z-index: 0;
      background:
        radial-gradient(ellipse 100% 80% at 20% 50%, rgba(0,212,170,0.06) 0%, transparent 55%),
        radial-gradient(ellipse 70% 60% at 80% 30%, rgba(0,100,255,0.04) 0%, transparent 55%);
    }
    .grid-bg {
      position: fixed; inset: 0; z-index: 0;
      background-image:
        linear-gradient(rgba(0,212,170,0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,212,170,0.03) 1px, transparent 1px);
      background-size: 60px 60px;
    }
    /* Floating orbs */
    .orb {
      position: fixed; border-radius: 50%; filter: blur(80px); z-index: 0; pointer-events: none;
    }
    .orb-1 { width: 400px; height: 400px; background: rgba(0,212,170,0.05); top: -100px; left: -100px; animation: orb-drift 12s ease-in-out infinite alternate; }
    .orb-2 { width: 300px; height: 300px; background: rgba(0,100,255,0.04); bottom: -80px; right: -80px; animation: orb-drift 16s ease-in-out infinite alternate-reverse; }

    /* Topbar */
    .topbar {
      position: relative; z-index: 10;
      display: flex; align-items: center; justify-content: space-between;
      padding: 16px 40px;
      border-bottom: 1px solid var(--navy-border);
      background: rgba(6,12,26,0.9);
      backdrop-filter: blur(12px);
    }
    .logo-text { font-family: 'Rajdhani', sans-serif; font-size: 1.35rem; font-weight: 700; letter-spacing: 2px; }
    .logo-text span { color: var(--teal); }
    .topbar-nav a {
      font-family: 'Rajdhani', sans-serif;
      font-size: 0.9rem; font-weight: 600; letter-spacing: 1px;
      color: var(--muted); text-decoration: none;
      transition: color 0.2s;
    }
    .topbar-nav a:hover { color: var(--teal); }
    .topbar-nav a.active { color: var(--teal); }

    /* Center Container */
    .center-wrap {
      position: relative; z-index: 1;
      flex: 1; display: flex; align-items: center; justify-content: center;
      padding: 40px 20px;
    }

    .login-card {
      width: 100%; max-width: 440px;
      animation: enterCard 0.6s cubic-bezier(0.22,1,0.36,1) both;
    }

    /* Top brand area */
    .brand-area { text-align: center; margin-bottom: 36px; }
    .brand-icon {
      width: 60px; height: 60px; border-radius: 12px;
      background: linear-gradient(135deg, rgba(0,212,170,0.2), rgba(0,212,170,0.05));
      border: 1px solid rgba(0,212,170,0.3);
      display: flex; align-items: center; justify-content: center;
      font-size: 1.6rem; margin: 0 auto 16px;
    }
    .brand-title { font-size: 2rem; font-weight: 700; letter-spacing: 1px; }
    .brand-title span { color: var(--teal); }
    .brand-sub { color: var(--muted); font-size: 0.82rem; margin-top: 6px; }

    /* Card */
    .card-inner {
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 16px;
      padding: 36px;
      position: relative; overflow: hidden;
    }
    .card-inner::before {
      content: '';
      position: absolute; top: 0; left: 0; right: 0; height: 1px;
      background: linear-gradient(90deg, transparent, rgba(0,212,170,0.4), transparent);
    }

    .card-heading {
      text-align: center;
      margin-bottom: 28px;
    }
    .card-heading .tag {
      display: inline-block;
      font-family: 'Rajdhani', sans-serif; font-size: 0.7rem; font-weight: 700; letter-spacing: 2px;
      color: var(--teal); text-transform: uppercase;
      background: var(--teal-glow); border: 1px solid rgba(0,212,170,0.25);
      border-radius: 4px; padding: 4px 12px; margin-bottom: 12px;
    }
    .card-heading h2 { font-size: 1.7rem; font-weight: 700; margin-bottom: 8px; }
    .card-heading p { color: var(--muted); font-size: 0.84rem; line-height: 1.6; }

    /* ID Input */
    .id-section { margin-bottom: 24px; }
    .id-label {
      font-family: 'Rajdhani', sans-serif;
      font-size: 0.75rem; font-weight: 700; letter-spacing: 1.5px;
      color: var(--muted); text-transform: uppercase;
      display: block; margin-bottom: 8px;
    }
    .id-input-wrap { position: relative; }
    .id-input-wrap .id-icon {
      position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
      color: var(--muted); font-size: 1rem; pointer-events: none;
    }
    .id-input {
      width: 100%;
      background: var(--navy);
      border: 1px solid var(--navy-border);
      border-radius: 8px;
      color: var(--text);
      font-family: 'Rajdhani', sans-serif; font-size: 1rem; font-weight: 600;
      letter-spacing: 1.5px;
      padding: 12px 14px 12px 42px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .id-input:focus {
      border-color: var(--teal);
      box-shadow: 0 0 0 3px rgba(0,212,170,0.1);
    }
    .id-input::placeholder { font-weight: 400; letter-spacing: 0; opacity: 0.5; }

    /* Divider */
    .divider {
      display: flex; align-items: center; gap: 12px;
      margin-bottom: 24px;
    }
    .divider-line { flex: 1; height: 1px; background: var(--navy-border); }
    .divider-text { font-family: 'Rajdhani', sans-serif; font-size: 0.7rem; letter-spacing: 1.5px; color: var(--muted); text-transform: uppercase; white-space: nowrap; }

    /* ===== FINGERPRINT SCANNER ===== */
    .fp-scanner-wrap {
      display: flex; flex-direction: column; align-items: center;
      margin-bottom: 24px;
    }

    .fp-outer {
      position: relative;
      width: 160px; height: 160px;
      display: flex; align-items: center; justify-content: center;
      margin: 0 auto 20px;
    }

    /* Concentric animated rings */
    .ring {
      position: absolute;
      border-radius: 50%;
      border: 1.5px solid;
      transition: all 0.4s ease;
    }
    .ring-1 { width: 160px; height: 160px; border-color: rgba(0,212,170,0.08); }
    .ring-2 { width: 132px; height: 132px; border-color: rgba(0,212,170,0.12); }
    .ring-3 { width: 106px; height: 106px; border-color: rgba(0,212,170,0.18); }

    /* Pulse rings (hidden by default, shown on scan) */
    .ring-pulse {
      position: absolute; width: 160px; height: 160px;
      border-radius: 50%;
      border: 1.5px solid var(--teal);
      opacity: 0; pointer-events: none;
    }

    /* Central scanner button */
    .fp-center {
      position: relative; z-index: 2;
      width: 86px; height: 86px;
      border-radius: 50%;
      background: var(--navy);
      border: 2px solid rgba(0,212,170,0.3);
      display: flex; align-items: center; justify-content: center;
      cursor: pointer;
      transition: border-color 0.3s, box-shadow 0.3s, transform 0.1s;
      user-select: none;
    }
    .fp-center:hover { border-color: var(--teal); box-shadow: 0 0 20px rgba(0,212,170,0.2); }
    .fp-center:active { transform: scale(0.95); }
    .fp-center svg { width: 46px; height: 46px; transition: all 0.3s; }

    /* States */
    .fp-outer.scanning .ring-1 { border-color: rgba(0,212,170,0.2); animation: rotate-cw 4s linear infinite; }
    .fp-outer.scanning .ring-2 { border-color: rgba(0,212,170,0.3); animation: rotate-ccw 3s linear infinite; }
    .fp-outer.scanning .ring-3 { border-color: rgba(0,212,170,0.4); animation: rotate-cw 2s linear infinite; }
    .fp-outer.scanning .fp-center { border-color: var(--teal); box-shadow: 0 0 30px rgba(0,212,170,0.4), 0 0 60px rgba(0,212,170,0.1); }
    .fp-outer.scanning .ring-pulse { animation: pulse-ring 1.4s ease-out infinite; }

    .fp-outer.success .ring-1, .fp-outer.success .ring-2, .fp-outer.success .ring-3 { border-color: rgba(74,222,128,0.4); }
    .fp-outer.success .fp-center { border-color: var(--green); box-shadow: 0 0 30px rgba(74,222,128,0.4); }
    .fp-outer.failed .ring-1, .fp-outer.failed .ring-2, .fp-outer.failed .ring-3 { border-color: rgba(248,113,113,0.3); }
    .fp-outer.failed .fp-center { border-color: var(--red); box-shadow: 0 0 20px rgba(248,113,113,0.3); animation: shake 0.5s ease; }

    /* Scan progress arc */
    .scan-arc {
      position: absolute; width: 160px; height: 160px;
      border-radius: 50%;
      background: conic-gradient(var(--teal) var(--arc-pct, 0%), transparent 0%);
      -webkit-mask: radial-gradient(farthest-side, transparent calc(100% - 3px), white calc(100% - 2.5px));
      mask: radial-gradient(farthest-side, transparent calc(100% - 3px), white calc(100% - 2.5px));
      opacity: 0; transition: opacity 0.3s;
    }
    .fp-outer.scanning .scan-arc { opacity: 1; }

    /* Status text */
    .fp-status-text {
      font-family: 'Rajdhani', sans-serif;
      font-size: 0.82rem; font-weight: 600; letter-spacing: 1.5px;
      text-transform: uppercase;
      color: var(--muted); text-align: center;
      transition: color 0.3s;
      min-height: 22px;
    }
    .fp-status-text.scanning { color: var(--teal); }
    .fp-status-text.success { color: var(--green); }
    .fp-status-text.failed { color: var(--red); }

    /* Instruction dots */
    .fp-instructions { display: flex; gap: 20px; margin-top: 16px; }
    .fp-inst-item { flex: 1; text-align: center; }
    .fp-inst-icon { font-size: 1.2rem; margin-bottom: 4px; }
    .fp-inst-text { font-size: 0.7rem; color: var(--muted); line-height: 1.4; }

    /* Login btn */
    .login-btn {
      width: 100%;
      font-family: 'Rajdhani', sans-serif;
      font-size: 1rem; font-weight: 700; letter-spacing: 2px;
      padding: 14px;
      background: var(--teal);
      color: var(--navy);
      border: none; border-radius: 8px;
      cursor: pointer; text-transform: uppercase;
      transition: all 0.2s;
    }
    .login-btn:hover { background: var(--teal-dim); transform: translateY(-1px); box-shadow: 0 8px 24px rgba(0,212,170,0.3); }
    .login-btn:disabled { opacity: 0.35; cursor: not-allowed; transform: none; box-shadow: none; }

    /* Status messages */
    .msg-box {
      display: none; align-items: flex-start; gap: 12px;
      padding: 12px 14px;
      border-radius: 8px;
      margin-bottom: 16px;
      font-size: 0.84rem;
      animation: fadeIn 0.3s ease both;
    }
    .msg-box.show { display: flex; }
    .msg-box.success { background: rgba(74,222,128,0.08); border: 1px solid rgba(74,222,128,0.25); color: var(--green); }
    .msg-box.error { background: rgba(248,113,113,0.08); border: 1px solid rgba(248,113,113,0.25); color: var(--red); }
    .msg-box.loading { background: rgba(0,212,170,0.06); border: 1px solid rgba(0,212,170,0.2); color: var(--teal); }

    /* Footer links */
    .card-footer { text-align: center; margin-top: 20px; color: var(--muted); font-size: 0.82rem; }
    .card-footer a { color: var(--teal); text-decoration: none; font-weight: 600; }
    .card-footer a:hover { text-decoration: underline; }
    .separator { display: inline-block; margin: 0 10px; opacity: 0.4; }

    /* Recent logins (bottom bar) */
    .recent-bar {
      position: relative; z-index: 2;
      border-top: 1px solid var(--navy-border);
      background: rgba(6,12,26,0.85);
      padding: 12px 40px;
      display: flex; align-items: center; gap: 16px;
    }
    .recent-label { font-family: 'Rajdhani', sans-serif; font-size: 0.7rem; font-weight: 700; letter-spacing: 1.5px; color: var(--muted); text-transform: uppercase; white-space: nowrap; }
    .recent-chips { display: flex; gap: 8px; overflow-x: auto; scrollbar-width: none; }
    .recent-chip {
      flex-shrink: 0;
      display: flex; align-items: center; gap: 8px;
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 20px; padding: 5px 12px 5px 5px;
      cursor: pointer; transition: border-color 0.2s;
    }
    .recent-chip:hover { border-color: rgba(0,212,170,0.3); }
    .recent-avatar {
      width: 24px; height: 24px; border-radius: 50%;
      background: var(--teal-glow); border: 1px solid rgba(0,212,170,0.3);
      display: flex; align-items: center; justify-content: center;
      font-size: 0.65rem; font-weight: 700; color: var(--teal); font-family: 'Rajdhani', sans-serif;
    }
    .recent-name { font-family: 'Rajdhani', sans-serif; font-size: 0.8rem; font-weight: 600; color: var(--text); }

    /* Animations */
    @keyframes enterCard { from { opacity:0; transform: translateY(30px) scale(0.97); } to { opacity:1; transform: none; } }
    @keyframes rotate-cw { to { transform: rotate(360deg); } }
    @keyframes rotate-ccw { to { transform: rotate(-360deg); } }
    @keyframes pulse-ring {
      from { transform: scale(0.8); opacity: 0.7; }
      to { transform: scale(1.4); opacity: 0; }
    }
    @keyframes shake {
      0%,100% { transform: translateX(0); }
      20%,60% { transform: translateX(-6px); }
      40%,80% { transform: translateX(6px); }
    }
    @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
    @keyframes orb-drift { from { transform: translate(0,0); } to { transform: translate(30px,20px); } }
  </style>
</head>
<body>

  <div class="bg-layer"></div>
  <div class="grid-bg"></div>
  <div class="orb orb-1"></div>
  <div class="orb orb-2"></div>

  <!-- Topbar -->
  <header class="topbar">
    <div class="logo-text">JAMIL<span>AMS</span></div>
    <nav class="topbar-nav flex gap-6">
      <a href="login.html" class="active">Login</a>
      <a href="signup.html">Register</a>
      <a href="dashboard.html">Dashboard</a>
    </nav>
  </header>

  <!-- Center -->
  <div class="center-wrap">
    <div class="login-card">

      <!-- Brand -->
      <div class="brand-area">
        <div class="brand-icon">🎓</div>
        <h1 class="brand-title">JAMIL<span>AMS</span></h1>
        <p class="brand-sub">Attendance Management System</p>
      </div>

      <!-- Card -->
      <div class="card-inner">
        <div class="card-heading">
          <span class="tag">● Biometric Login</span>
          <h2>Place Your Finger</h2>
          <p>Enter your matric number, then scan your registered fingerprint to authenticate.</p>
        </div>

        <!-- Matric ID -->
        <div class="id-section">
          <label class="id-label">Matriculation Number</label>
          <div class="id-input-wrap">
            <span class="id-icon">🎓</span>
            <input type="text" class="id-input" id="matricInput" placeholder="e.g. POL/ND1/2024/001" maxlength="30" />
          </div>
        </div>

        <div class="divider">
          <div class="divider-line"></div>
          <span class="divider-text">Then Scan Below</span>
          <div class="divider-line"></div>
        </div>

        <!-- Fingerprint Scanner -->
        <div class="fp-scanner-wrap">
          <div class="fp-outer" id="fpOuter">
            <!-- Rings -->
            <div class="ring ring-1"></div>
            <div class="ring ring-2"></div>
            <div class="ring ring-3"></div>
            <!-- Arc progress -->
            <div class="scan-arc" id="scanArc"></div>
            <!-- Pulse ring -->
            <div class="ring-pulse"></div>
            <!-- Center button -->
            <div class="fp-center" id="fpCenter" onclick="handleFpTap()">
              <svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" id="fpSvg">
                <!-- Fingerprint paths -->
                <path d="M50 8C26.8 8 8 26.8 8 50c0 12.7 5.3 24.2 13.8 32.3" stroke="rgba(0,212,170,0.25)" stroke-width="3.5" stroke-linecap="round"/>
                <path d="M50 8C73.2 8 92 26.8 92 50c0 12.7-5.3 24.2-13.8 32.3" stroke="rgba(0,212,170,0.25)" stroke-width="3.5" stroke-linecap="round"/>
                <path d="M50 20c-16.6 0-30 13.4-30 30 0 8 3.1 15.3 8.2 20.7" stroke="rgba(0,212,170,0.4)" stroke-width="3" stroke-linecap="round"/>
                <path d="M50 20c16.6 0 30 13.4 30 30 0 8-3.1 15.3-8.2 20.7" stroke="rgba(0,212,170,0.4)" stroke-width="3" stroke-linecap="round"/>
                <path d="M50 32c-9.9 0-18 8.1-18 18 0 4.8 1.9 9.2 4.9 12.4" stroke="rgba(0,212,170,0.6)" stroke-width="3" stroke-linecap="round"/>
                <path d="M50 32c9.9 0 18 8.1 18 18 0 4.8-1.9 9.2-4.9 12.4" stroke="rgba(0,212,170,0.6)" stroke-width="3" stroke-linecap="round"/>
                <path d="M50 44c-3.3 0-6 2.7-6 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6z" fill="rgba(0,212,170,0.8)"/>
                <path d="M38 76c3.4 4 8.1 6.6 13.5 7" stroke="rgba(0,212,170,0.35)" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M63 76c-3.4 4-8.1 6.6-13.5 7" stroke="rgba(0,212,170,0.35)" stroke-width="2.5" stroke-linecap="round"/>
              </svg>
            </div>
          </div>

          <div class="fp-status-text" id="fpStatusText">Tap to scan fingerprint</div>

          <!-- Mini instructions -->
          <div class="fp-instructions">
            <div class="fp-inst-item">
              <div class="fp-inst-icon">☝️</div>
              <div class="fp-inst-text">Use same finger as registered</div>
            </div>
            <div class="fp-inst-item">
              <div class="fp-inst-icon">🤲</div>
              <div class="fp-inst-text">Place firmly and hold still</div>
            </div>
            <div class="fp-inst-item">
              <div class="fp-inst-icon">💡</div>
              <div class="fp-inst-text">Clean dry finger works best</div>
            </div>
          </div>
        </div>

        <!-- Status Messages -->
        <div class="msg-box loading" id="msgLoading">
          <span>⟳</span>
          <div><strong>Authenticating...</strong> Verifying fingerprint against database.</div>
        </div>
        <div class="msg-box success" id="msgSuccess">
          <span>✓</span>
          <div><strong>Verified!</strong> Welcome back. Redirecting to your dashboard...</div>
        </div>
        <div class="msg-box error" id="msgError">
          <span>✕</span>
          <div id="msgErrorText"><strong>Not Recognized.</strong> Fingerprint did not match any record. Try again.</div>
        </div>

        <!-- Login Button -->
        <button class="login-btn" id="loginBtn" onclick="triggerLogin()" disabled>AUTHENTICATE</button>

        <div class="card-footer">
          <a href="signup.html">New Student? Register here</a>
          <span class="separator">|</span>
          <a href="#" onclick="showHelp()">Need Help?</a>
        </div>
      </div>

    </div>
  </div>

  <!-- Recent Logins Bar -->
  <div class="recent-bar">
    <span class="recent-label">Recent:</span>
    <div class="recent-chips">
      <div class="recent-chip" onclick="fillMatric('CS/ND1/2024/007')">
        <div class="recent-avatar">AB</div>
        <span class="recent-name">Amina B.</span>
      </div>
      <div class="recent-chip" onclick="fillMatric('CS/ND2/2024/012')">
        <div class="recent-avatar">KM</div>
        <span class="recent-name">Kamalu M.</span>
      </div>
      <div class="recent-chip" onclick="fillMatric('EE/ND1/2024/034')">
        <div class="recent-avatar">FI</div>
        <span class="recent-name">Fatima I.</span>
      </div>
      <div class="recent-chip" onclick="fillMatric('BA/ND2/2023/055')">
        <div class="recent-avatar">YA</div>
        <span class="recent-name">Yusuf A.</span>
      </div>
    </div>
  </div>

  <script>
    let fpState = 'idle'; // idle | scanning | success | failed
    let arcInterval;
    let arcPct = 0;

    const fpOuter = document.getElementById('fpOuter');
    const fpStatusText = document.getElementById('fpStatusText');
    const loginBtn = document.getElementById('loginBtn');
    const matricInput = document.getElementById('matricInput');

    // Enable login button when matric is entered
    matricInput.addEventListener('input', () => {
      loginBtn.disabled = matricInput.value.trim().length < 5;
      resetFp();
    });

    function handleFpTap() {
      if (!matricInput.value.trim()) {
        matricInput.focus();
        matricInput.style.borderColor = '#f87171';
        setTimeout(() => matricInput.style.borderColor = '', 1500);
        return;
      }
      if (fpState === 'scanning') return;
      if (fpState === 'success') return;
      startScan();
    }

    function triggerLogin() {
      if (!matricInput.value.trim()) return;
      startScan();
    }

    function startScan() {
      fpState = 'scanning';
      fpOuter.className = 'fp-outer scanning';
      fpStatusText.textContent = 'Scanning...';
      fpStatusText.className = 'fp-status-text scanning';
      hideMessages();
      arcPct = 0;

      arcInterval = setInterval(() => {
        arcPct += Math.random() * 5 + 3;
        if (arcPct >= 100) {
          arcPct = 100;
          clearInterval(arcInterval);
          setTimeout(finishScan, 300);
        }
        document.getElementById('scanArc').style.setProperty('--arc-pct', arcPct + '%');
      }, 80);
    }

    function finishScan() {
      // Simulate: 85% success, 15% fail for demo
      const success = Math.random() > 0.15;
      if (success) {
        fpState = 'success';
        fpOuter.className = 'fp-outer success';
        fpStatusText.textContent = 'Identity Verified ✓';
        fpStatusText.className = 'fp-status-text success';
        document.getElementById('fpSvg').innerHTML = `
          <circle cx="50" cy="50" r="28" fill="rgba(74,222,128,0.12)" stroke="rgba(74,222,128,0.5)" stroke-width="2"/>
          <path d="M34 50l10 10 22-22" stroke="#4ade80" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        `;
        showMsg('loading');
        setTimeout(() => {
          hideMessages();
          showMsg('success');
          // NOTE: Real impl — POST to PHP API:
          // fetch('api/auth/fingerprint-login.php', { method:'POST', body: JSON.stringify({ matric_no: matricInput.value, fp_data: '...' }) })
          setTimeout(() => { window.location.href = 'dashboard.html'; }, 1800);
        }, 1200);
      } else {
        fpState = 'failed';
        fpOuter.className = 'fp-outer failed';
        fpStatusText.textContent = 'Not Recognized';
        fpStatusText.className = 'fp-status-text failed';
        document.getElementById('fpSvg').innerHTML = `
          <circle cx="50" cy="50" r="28" fill="rgba(248,113,113,0.1)" stroke="rgba(248,113,113,0.4)" stroke-width="2"/>
          <path d="M36 36l28 28M64 36L36 64" stroke="#f87171" stroke-width="4" stroke-linecap="round" fill="none"/>
        `;
        showMsg('error');
        setTimeout(resetFp, 3000);
      }
    }

    function resetFp() {
      fpState = 'idle';
      fpOuter.className = 'fp-outer';
      fpStatusText.textContent = 'Tap to scan fingerprint';
      fpStatusText.className = 'fp-status-text';
      document.getElementById('scanArc').style.setProperty('--arc-pct', '0%');
      clearInterval(arcInterval);
      document.getElementById('fpSvg').innerHTML = `
        <path d="M50 8C26.8 8 8 26.8 8 50c0 12.7 5.3 24.2 13.8 32.3" stroke="rgba(0,212,170,0.25)" stroke-width="3.5" stroke-linecap="round"/>
        <path d="M50 8C73.2 8 92 26.8 92 50c0 12.7-5.3 24.2-13.8 32.3" stroke="rgba(0,212,170,0.25)" stroke-width="3.5" stroke-linecap="round"/>
        <path d="M50 20c-16.6 0-30 13.4-30 30 0 8 3.1 15.3 8.2 20.7" stroke="rgba(0,212,170,0.4)" stroke-width="3" stroke-linecap="round"/>
        <path d="M50 20c16.6 0 30 13.4 30 30 0 8-3.1 15.3-8.2 20.7" stroke="rgba(0,212,170,0.4)" stroke-width="3" stroke-linecap="round"/>
        <path d="M50 32c-9.9 0-18 8.1-18 18 0 4.8 1.9 9.2 4.9 12.4" stroke="rgba(0,212,170,0.6)" stroke-width="3" stroke-linecap="round"/>
        <path d="M50 32c9.9 0 18 8.1 18 18 0 4.8-1.9 9.2-4.9 12.4" stroke="rgba(0,212,170,0.6)" stroke-width="3" stroke-linecap="round"/>
        <path d="M50 44c-3.3 0-6 2.7-6 6s2.7 6 6 6 6-2.7 6-6-2.7-6-6-6z" fill="rgba(0,212,170,0.8)"/>
        <path d="M38 76c3.4 4 8.1 6.6 13.5 7" stroke="rgba(0,212,170,0.35)" stroke-width="2.5" stroke-linecap="round"/>
        <path d="M63 76c-3.4 4-8.1 6.6-13.5 7" stroke="rgba(0,212,170,0.35)" stroke-width="2.5" stroke-linecap="round"/>
      `;
      hideMessages();
    }

    function showMsg(type) {
      document.getElementById('msgLoading').className = 'msg-box' + (type === 'loading' ? ' show loading' : '');
      document.getElementById('msgSuccess').className = 'msg-box' + (type === 'success' ? ' show success' : '');
      document.getElementById('msgError').className = 'msg-box' + (type === 'error' ? ' show error' : '');
    }
    function hideMessages() {
      ['msgLoading','msgSuccess','msgError'].forEach(id => document.getElementById(id).className = 'msg-box');
    }

    function fillMatric(val) {
      matricInput.value = val;
      loginBtn.disabled = false;
    }

    function showHelp() {
      document.getElementById('msgErrorText').innerHTML = '<strong>Help:</strong> Contact the ICT department or your class coordinator if your fingerprint is not recognized.';
      showMsg('error');
    }
  </script>
</body>
</html>
