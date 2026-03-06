<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>JamilSoft AMS — Student Registration</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@400;500;600;700&family=Nunito+Sans:wght@300;400;600;700&display=swap" rel="stylesheet"/>
  <style>
    :root {
      --navy: #060C1A;
      --navy-mid: #0D1730;
      --navy-card: #111E35;
      --navy-border: #1C2E4A;
      --teal: #00D4AA;
      --teal-dim: #00A882;
      --teal-glow: rgba(0,212,170,0.15);
      --amber: #F59E0B;
      --text: #E2EAF4;
      --muted: #6B8099;
    }
    * { box-sizing: border-box; margin: 0; padding: 0; }
    body {
      font-family: 'Nunito Sans', sans-serif;
      background-color: var(--navy);
      color: var(--text);
      min-height: 100vh;
      overflow-x: hidden;
    }
    h1,h2,h3,h4,.heading { font-family: 'Rajdhani', sans-serif; }

    /* Grid background */
    .grid-bg {
      position: fixed; inset: 0; z-index: 0;
      background-image:
        linear-gradient(rgba(0,212,170,0.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0,212,170,0.04) 1px, transparent 1px);
      background-size: 48px 48px;
      pointer-events: none;
    }
    .grid-bg::after {
      content: '';
      position: absolute; inset: 0;
      background: radial-gradient(ellipse 80% 60% at 50% 0%, rgba(0,212,170,0.08) 0%, transparent 70%);
    }

    /* Topbar */
    .topbar {
      position: relative; z-index: 10;
      display: flex; align-items: center; justify-content: space-between;
      padding: 16px 40px;
      border-bottom: 1px solid var(--navy-border);
      background: rgba(6,12,26,0.85);
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

    /* Main layout */
    .main-wrap {
      position: relative; z-index: 1;
      display: grid; grid-template-columns: 1fr 1fr;
      min-height: calc(100vh - 65px);
    }
    @media (max-width: 900px) {
      .main-wrap { grid-template-columns: 1fr; }
      .left-panel { display: none; }
    }

    /* Left decorative panel */
    .left-panel {
      display: flex; flex-direction: column;
      justify-content: center; align-items: flex-start;
      padding: 60px 48px;
      border-right: 1px solid var(--navy-border);
      background: linear-gradient(160deg, rgba(0,212,170,0.04) 0%, transparent 60%);
    }
    .panel-badge {
      display: inline-flex; align-items: center; gap: 8px;
      background: var(--teal-glow);
      border: 1px solid rgba(0,212,170,0.3);
      border-radius: 4px;
      padding: 6px 14px;
      font-family: 'Rajdhani', sans-serif;
      font-size: 0.75rem; font-weight: 700; letter-spacing: 2px;
      color: var(--teal); text-transform: uppercase;
      margin-bottom: 28px;
    }
    .panel-badge span { width: 6px; height: 6px; border-radius: 50%; background: var(--teal); display: block; animation: pulse-dot 1.5s ease infinite; }
    .panel-title { font-size: 3rem; font-weight: 700; line-height: 1.1; margin-bottom: 20px; }
    .panel-title em { color: var(--teal); font-style: normal; display: block; }
    .panel-desc { color: var(--muted); font-size: 0.95rem; line-height: 1.7; max-width: 380px; margin-bottom: 40px; }
    .feature-list { display: flex; flex-direction: column; gap: 16px; }
    .feature-item {
      display: flex; align-items: flex-start; gap: 14px;
      padding: 16px;
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 8px;
    }
    .feature-icon {
      width: 36px; height: 36px; flex-shrink: 0;
      background: var(--teal-glow);
      border: 1px solid rgba(0,212,170,0.3);
      border-radius: 6px;
      display: flex; align-items: center; justify-content: center;
      color: var(--teal); font-size: 1rem;
    }
    .feature-text strong { display: block; font-family: 'Rajdhani',sans-serif; font-size: 0.95rem; font-weight: 600; margin-bottom: 2px; }
    .feature-text span { color: var(--muted); font-size: 0.8rem; line-height: 1.5; }

    /* Right form panel */
    .right-panel {
      display: flex; flex-direction: column;
      justify-content: flex-start; align-items: center;
      padding: 48px 40px;
      overflow-y: auto;
    }
    .form-card {
      width: 100%; max-width: 520px;
      background: var(--navy-card);
      border: 1px solid var(--navy-border);
      border-radius: 12px;
      padding: 36px;
      animation: fadeUp 0.5s ease both;
    }
    .form-header { margin-bottom: 28px; }
    .step-label {
      font-family: 'Rajdhani', sans-serif;
      font-size: 0.72rem; font-weight: 700; letter-spacing: 2px;
      color: var(--teal); text-transform: uppercase; margin-bottom: 6px;
    }
    .form-title { font-size: 1.8rem; font-weight: 700; margin-bottom: 8px; }
    .form-subtitle { color: var(--muted); font-size: 0.85rem; }

    /* Steps indicator */
    .steps-bar {
      display: flex; align-items: center; gap: 0;
      margin-bottom: 28px;
    }
    .step-dot {
      width: 28px; height: 28px; border-radius: 50%;
      border: 2px solid var(--navy-border);
      display: flex; align-items: center; justify-content: center;
      font-family: 'Rajdhani', sans-serif; font-size: 0.75rem; font-weight: 700;
      color: var(--muted); background: var(--navy);
      transition: all 0.3s ease; position: relative; z-index: 1;
    }
    .step-dot.active { border-color: var(--teal); color: var(--teal); background: var(--teal-glow); }
    .step-dot.done { border-color: var(--teal); background: var(--teal); color: var(--navy); }
    .step-line { flex: 1; height: 1px; background: var(--navy-border); transition: background 0.3s; }
    .step-line.done { background: var(--teal); }
    .step-label-small {
      font-family: 'Rajdhani', sans-serif; font-size: 0.65rem; letter-spacing: 1px;
      color: var(--muted); text-align: center; margin-top: 4px; text-transform: uppercase;
    }

    /* Form fields */
    .field-group { margin-bottom: 18px; }
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; margin-bottom: 18px; }
    label { display: block; font-family: 'Rajdhani',sans-serif; font-size: 0.78rem; font-weight: 700; letter-spacing: 1px; color: var(--muted); text-transform: uppercase; margin-bottom: 6px; }
    .input-wrap { position: relative; }
    .input-wrap .icon { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--muted); font-size: 0.9rem; pointer-events: none; }
    input[type="text"], input[type="email"], input[type="tel"], input[type="date"], select {
      width: 100%;
      background: var(--navy);
      border: 1px solid var(--navy-border);
      border-radius: 6px;
      color: var(--text);
      font-family: 'Nunito Sans', sans-serif;
      font-size: 0.9rem;
      padding: 11px 14px 11px 38px;
      outline: none;
      transition: border-color 0.2s, box-shadow 0.2s;
      appearance: none;
    }
    input:focus, select:focus {
      border-color: var(--teal);
      box-shadow: 0 0 0 3px rgba(0,212,170,0.1);
    }
    input::placeholder { color: var(--muted); opacity: 0.6; }
    select option { background: var(--navy-mid); }

    /* Fingerprint scanner */
    .fp-section {
      border: 1px dashed rgba(0,212,170,0.3);
      border-radius: 10px;
      padding: 28px;
      text-align: center;
      background: rgba(0,212,170,0.03);
      margin-bottom: 20px;
      transition: border-color 0.3s, background 0.3s;
    }
    .fp-section.scanning { border-color: var(--teal); background: rgba(0,212,170,0.06); }
    .fp-section.success { border-color: var(--teal); background: rgba(0,212,170,0.08); border-style: solid; }
    .fp-title { font-family: 'Rajdhani', sans-serif; font-size: 0.85rem; font-weight: 700; letter-spacing: 1px; color: var(--teal); text-transform: uppercase; margin-bottom: 18px; }

    /* SVG Fingerprint */
    .fp-svg-wrap {
      position: relative; display: inline-flex;
      align-items: center; justify-content: center;
      width: 120px; height: 120px;
      margin: 0 auto 16px;
      cursor: pointer;
    }
    .fp-svg-wrap svg.fp-icon { width: 72px; height: 72px; }
    .fp-ring {
      position: absolute; inset: 0;
      border-radius: 50%;
      border: 2px solid transparent;
      transition: border-color 0.3s;
    }
    .fp-ring-1 { border-color: rgba(0,212,170,0.15); }
    .fp-ring-2 { width: 90px; height: 90px; top: 15px; left: 15px; border-color: rgba(0,212,170,0.1); }
    .scanning .fp-ring-1 { border-color: rgba(0,212,170,0.5); animation: spin 2s linear infinite; }
    .scanning .fp-ring-2 { border-color: rgba(0,212,170,0.3); animation: spin-rev 3s linear infinite; }
    .fp-scan-line {
      position: absolute; left: 20px; right: 20px; height: 2px;
      background: linear-gradient(90deg, transparent, var(--teal), transparent);
      top: 20px; opacity: 0;
      transition: opacity 0.3s;
    }
    .scanning .fp-scan-line { opacity: 1; animation: scanline 1.2s ease infinite; }
    .fp-status { font-size: 0.82rem; color: var(--muted); margin-bottom: 12px; }
    .fp-status.active { color: var(--teal); }
    .fp-status.done { color: #4ade80; }
    .fp-btn {
      font-family: 'Rajdhani', sans-serif;
      font-size: 0.85rem; font-weight: 700; letter-spacing: 1.5px;
      padding: 8px 22px; border-radius: 6px;
      border: 1px solid rgba(0,212,170,0.4);
      background: transparent; color: var(--teal);
      cursor: pointer; text-transform: uppercase;
      transition: all 0.2s;
    }
    .fp-btn:hover { background: var(--teal-glow); }
    .fp-btn.success-btn { border-color: #4ade80; color: #4ade80; background: rgba(74,222,128,0.08); cursor: default; }

    /* Progress bar */
    .fp-progress {
      width: 100%; height: 3px;
      background: var(--navy-border);
      border-radius: 2px; overflow: hidden;
      margin-top: 16px; display: none;
    }
    .fp-progress.show { display: block; }
    .fp-progress-bar {
      height: 100%; width: 0%;
      background: linear-gradient(90deg, var(--teal-dim), var(--teal));
      border-radius: 2px;
      transition: width 0.1s linear;
    }

    /* Submit button */
    .submit-btn {
      width: 100%;
      font-family: 'Rajdhani', sans-serif;
      font-size: 1rem; font-weight: 700; letter-spacing: 2px;
      padding: 14px;
      background: var(--teal);
      color: var(--navy);
      border: none; border-radius: 8px;
      cursor: pointer; text-transform: uppercase;
      transition: all 0.2s;
      position: relative; overflow: hidden;
    }
    .submit-btn:hover { background: var(--teal-dim); transform: translateY(-1px); box-shadow: 0 8px 24px rgba(0,212,170,0.3); }
    .submit-btn:active { transform: translateY(0); }
    .submit-btn:disabled { opacity: 0.4; cursor: not-allowed; transform: none; box-shadow: none; }

    /* Nav step buttons */
    .step-nav { display: flex; gap: 12px; margin-top: 20px; }
    .btn-back {
      flex: 1; font-family: 'Rajdhani', sans-serif; font-size: 0.9rem; font-weight: 700; letter-spacing: 1.5px;
      padding: 12px; border-radius: 8px;
      border: 1px solid var(--navy-border); background: transparent;
      color: var(--muted); cursor: pointer; text-transform: uppercase;
      transition: all 0.2s;
    }
    .btn-back:hover { border-color: var(--muted); color: var(--text); }
    .btn-next {
      flex: 2; font-family: 'Rajdhani', sans-serif; font-size: 0.9rem; font-weight: 700; letter-spacing: 1.5px;
      padding: 12px; border-radius: 8px;
      border: none; background: var(--teal);
      color: var(--navy); cursor: pointer; text-transform: uppercase;
      transition: all 0.2s;
    }
    .btn-next:hover { background: var(--teal-dim); box-shadow: 0 6px 20px rgba(0,212,170,0.25); }

    .divider { width: 100%; height: 1px; background: var(--navy-border); margin: 20px 0; }
    .signin-link { text-align: center; color: var(--muted); font-size: 0.82rem; }
    .signin-link a { color: var(--teal); text-decoration: none; font-weight: 600; }
    .signin-link a:hover { text-decoration: underline; }

    /* Success overlay */
    .success-overlay {
      display: none; flex-direction: column; align-items: center; justify-content: center;
      text-align: center; padding: 40px 20px;
    }
    .success-overlay.show { display: flex; animation: fadeUp 0.4s ease both; }
    .success-circle {
      width: 80px; height: 80px; border-radius: 50%;
      background: rgba(74,222,128,0.1);
      border: 2px solid #4ade80;
      display: flex; align-items: center; justify-content: center;
      font-size: 2rem; margin-bottom: 20px;
      animation: popIn 0.5s cubic-bezier(.17,.67,.42,1.3) both;
    }
    .success-title { font-family: 'Rajdhani', sans-serif; font-size: 2rem; font-weight: 700; color: #4ade80; margin-bottom: 10px; }
    .success-sub { color: var(--muted); font-size: 0.9rem; line-height: 1.6; margin-bottom: 24px; }
    .success-id {
      background: var(--navy); border: 1px solid var(--navy-border);
      border-radius: 8px; padding: 12px 24px; margin-bottom: 24px;
      font-family: 'Rajdhani', sans-serif; font-size: 1rem; letter-spacing: 2px;
    }
    .success-id span { color: var(--teal); }

    /* Step panels */
    .step-panel { display: none; }
    .step-panel.active { display: block; animation: fadeIn 0.3s ease both; }

    /* Tooltip */
    .field-hint { font-size: 0.75rem; color: var(--muted); margin-top: 4px; }
    .error-text { font-size: 0.75rem; color: #f87171; margin-top: 4px; display: none; }
    .field-group.error input, .field-group.error select { border-color: #f87171; }
    .field-group.error .error-text { display: block; }

    /* Animations */
    @keyframes fadeUp { from { opacity:0; transform: translateY(20px); } to { opacity:1; transform: translateY(0); } }
    @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
    @keyframes pulse-dot { 0%,100% { opacity:1; transform: scale(1); } 50% { opacity:0.5; transform: scale(1.3); } }
    @keyframes spin { to { transform: rotate(360deg); } }
    @keyframes spin-rev { to { transform: rotate(-360deg); } }
    @keyframes scanline {
      0% { top: 20px; }
      50% { top: calc(100% - 22px); }
      100% { top: 20px; }
    }
    @keyframes popIn { 0% { transform: scale(0.5); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
  </style>
</head>
<body>

  <div class="grid-bg"></div>

  <!-- Topbar -->
  <header class="topbar">
    <div class="logo-text">JAMIL<span>AMS</span></div>
    <nav class="topbar-nav flex gap-6">
      <a href="login.html">Login</a>
      <a href="signup.html" class="active">Register</a>
      <a href="dashboard.html">Dashboard</a>
    </nav>
  </header>

  <!-- Main -->
  <div class="main-wrap">

    <!-- Left Panel -->
    <div class="left-panel">
      <div class="panel-badge"><span></span> SECURE BIOMETRIC ENROLLMENT</div>
      <h1 class="panel-title">Student<br>Registration<em>Portal</em></h1>
      <p class="panel-desc">Register once with your biometric fingerprint. No passwords needed. Attendance will be tracked automatically with each scan.</p>
      <div class="feature-list">
        <div class="feature-item">
          <div class="feature-icon">🔒</div>
          <div class="feature-text">
            <strong>Biometric Security</strong>
            <span>Your fingerprint is encrypted and stored securely. Only used for identity verification.</span>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon">⚡</div>
          <div class="feature-text">
            <strong>Instant Attendance</strong>
            <span>Mark attendance in under 2 seconds. No cards, no codes, no delays.</span>
          </div>
        </div>
        <div class="feature-item">
          <div class="feature-icon">📊</div>
          <div class="feature-text">
            <strong>Real-time Analytics</strong>
            <span>Teachers see live attendance data per class, semester, and student.</span>
          </div>
        </div>
      </div>
    </div>

    <!-- Right Form Panel -->
    <div class="right-panel">
      <div class="form-card">

        <!-- Steps Bar -->
        <div class="mb-6">
          <div class="steps-bar" id="stepsBar">
            <div style="text-align:center">
              <div class="step-dot active" id="dot1">1</div>
              <div class="step-label-small">Personal</div>
            </div>
            <div class="step-line" id="line1"></div>
            <div style="text-align:center">
              <div class="step-dot" id="dot2">2</div>
              <div class="step-label-small">Academic</div>
            </div>
            <div class="step-line" id="line2"></div>
            <div style="text-align:center">
              <div class="step-dot" id="dot3">3</div>
              <div class="step-label-small">Biometric</div>
            </div>
          </div>
        </div>

        <!-- STEP 1: Personal Info -->
        <div class="step-panel active" id="step1">
          <div class="form-header">
            <div class="step-label">Step 01 — Personal Information</div>
            <h2 class="form-title">Tell us about yourself</h2>
            <p class="form-subtitle">Enter your personal details exactly as they appear on your official documents.</p>
          </div>

          <div class="field-row">
            <div class="field-group" id="fg-firstname">
              <label>First Name</label>
              <div class="input-wrap">
                <span class="icon">👤</span>
                <input type="text" id="firstName" placeholder="e.g. Amina" />
              </div>
              <div class="error-text">First name is required</div>
            </div>
            <div class="field-group" id="fg-lastname">
              <label>Last Name</label>
              <div class="input-wrap">
                <span class="icon">👤</span>
                <input type="text" id="lastName" placeholder="e.g. Bello" />
              </div>
              <div class="error-text">Last name is required</div>
            </div>
          </div>

          <div class="field-group" id="fg-email">
            <label>Email Address</label>
            <div class="input-wrap">
              <span class="icon">✉️</span>
              <input type="email" id="email" placeholder="student@school.edu.ng" />
            </div>
            <div class="error-text">Valid email is required</div>
          </div>

          <div class="field-row">
            <div class="field-group" id="fg-phone">
              <label>Phone Number</label>
              <div class="input-wrap">
                <span class="icon">📱</span>
                <input type="tel" id="phone" placeholder="080XXXXXXXX" />
              </div>
              <div class="error-text">Phone is required</div>
            </div>
            <div class="field-group" id="fg-dob">
              <label>Date of Birth</label>
              <div class="input-wrap">
                <span class="icon">📅</span>
                <input type="date" id="dob" style="padding-left:38px" />
              </div>
              <div class="error-text">Date of birth is required</div>
            </div>
          </div>

          <div class="field-group" id="fg-gender">
            <label>Gender</label>
            <div class="input-wrap">
              <span class="icon">⚧</span>
              <select id="gender">
                <option value="">— Select Gender —</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </div>
            <div class="error-text">Please select gender</div>
          </div>

          <div class="step-nav">
            <button class="btn-next" onclick="goStep(2)">Continue →</button>
          </div>
        </div>

        <!-- STEP 2: Academic Info -->
        <div class="step-panel" id="step2">
          <div class="form-header">
            <div class="step-label">Step 02 — Academic Information</div>
            <h2 class="form-title">Academic Profile</h2>
            <p class="form-subtitle">Provide your academic details to link your record to the correct class.</p>
          </div>

          <div class="field-group" id="fg-matric">
            <label>Matriculation Number</label>
            <div class="input-wrap">
              <span class="icon">🎓</span>
              <input type="text" id="matric" placeholder="e.g. POL/ND1/2024/001" />
            </div>
            <div class="field-hint">Assigned by the school registrar's office</div>
            <div class="error-text">Matric number is required</div>
          </div>

          <div class="field-group" id="fg-dept">
            <label>Department</label>
            <div class="input-wrap">
              <span class="icon">🏫</span>
              <select id="dept">
                <option value="">— Select Department —</option>
                <option>Computer Science</option>
                <option>Electrical Engineering</option>
                <option>Business Administration</option>
                <option>Mass Communication</option>
                <option>Accounting</option>
                <option>Mechanical Engineering</option>
                <option>Civil Engineering</option>
                <option>Science Laboratory Technology</option>
              </select>
            </div>
            <div class="error-text">Please select a department</div>
          </div>

          <div class="field-row">
            <div class="field-group" id="fg-level">
              <label>Class Level</label>
              <div class="input-wrap">
                <span class="icon">📚</span>
                <select id="level">
                  <option value="">— Level —</option>
                  <option value="ND1">ND I</option>
                  <option value="ND2">ND II</option>
                </select>
              </div>
              <div class="error-text">Level is required</div>
            </div>
            <div class="field-group" id="fg-semester">
              <label>Semester</label>
              <div class="input-wrap">
                <span class="icon">📆</span>
                <select id="semester">
                  <option value="">— Semester —</option>
                  <option value="1">1st Semester</option>
                  <option value="2">2nd Semester</option>
                </select>
              </div>
              <div class="error-text">Semester is required</div>
            </div>
          </div>

          <div class="field-group" id="fg-session">
            <label>Academic Session</label>
            <div class="input-wrap">
              <span class="icon">🗓️</span>
              <select id="session">
                <option value="">— Select Session —</option>
                <option>2023/2024</option>
                <option>2024/2025</option>
                <option>2025/2026</option>
              </select>
            </div>
            <div class="error-text">Session is required</div>
          </div>

          <div class="step-nav">
            <button class="btn-back" onclick="goStep(1)">← Back</button>
            <button class="btn-next" onclick="goStep(3)">Continue →</button>
          </div>
        </div>

        <!-- STEP 3: Fingerprint -->
        <div class="step-panel" id="step3">
          <div class="form-header">
            <div class="step-label">Step 03 — Biometric Enrollment</div>
            <h2 class="form-title">Register Fingerprint</h2>
            <p class="form-subtitle">Place your index finger on the scanner. Hold still until the scan is complete.</p>
          </div>

          <div class="fp-section" id="fpSection">
            <div class="fp-title">FINGERPRINT SCANNER</div>
            <div class="fp-svg-wrap" id="fpWrap">
              <div class="fp-ring fp-ring-1"></div>
              <div class="fp-ring fp-ring-2"></div>
              <div class="fp-scan-line" id="fpScanLine"></div>
              <!-- Fingerprint SVG Icon -->
              <svg class="fp-icon" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" id="fpIcon">
                <path d="M50 10C28.5 10 11 27.5 11 49c0 10.5 4 20.1 10.5 27.3" stroke="rgba(0,212,170,0.3)" stroke-width="3" stroke-linecap="round"/>
                <path d="M50 10C71.5 10 89 27.5 89 49c0 10.5-4 20.1-10.5 27.3" stroke="rgba(0,212,170,0.3)" stroke-width="3" stroke-linecap="round"/>
                <path d="M50 22c-14.9 0-27 12.1-27 27 0 7.2 2.8 13.7 7.4 18.5" stroke="rgba(0,212,170,0.4)" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M50 22c14.9 0 27 12.1 27 27 0 7.2-2.8 13.7-7.4 18.5" stroke="rgba(0,212,170,0.4)" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M50 34c-8.3 0-15 6.7-15 15 0 4 1.6 7.6 4.2 10.2" stroke="rgba(0,212,170,0.6)" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M50 34c8.3 0 15 6.7 15 15 0 4-1.6 7.6-4.2 10.2" stroke="rgba(0,212,170,0.6)" stroke-width="2.5" stroke-linecap="round"/>
                <path d="M50 44c-2.8 0-5 2.2-5 5s2.2 5 5 5 5-2.2 5-5-2.2-5-5-5z" fill="rgba(0,212,170,0.7)"/>
                <path d="M36 75c3.7 4.2 9.1 6.8 15 6.8s11.3-2.6 15-6.8" stroke="rgba(0,212,170,0.5)" stroke-width="2" stroke-linecap="round"/>
                <path d="M24 68c1.4 2.4 3 4.6 4.8 6.5" stroke="rgba(0,212,170,0.3)" stroke-width="2" stroke-linecap="round"/>
                <path d="M76 68c-1.4 2.4-3 4.6-4.8 6.5" stroke="rgba(0,212,170,0.3)" stroke-width="2" stroke-linecap="round"/>
              </svg>
            </div>
            <p class="fp-status" id="fpStatus">Tap the scanner to begin fingerprint enrollment</p>
            <button class="fp-btn" id="fpBtn" onclick="startFpScan()">SCAN FINGERPRINT</button>
            <div class="fp-progress" id="fpProgress">
              <div class="fp-progress-bar" id="fpBar"></div>
            </div>
          </div>

          <div id="fpInfo" style="display:none; margin-bottom:18px;">
            <div style="background:rgba(74,222,128,0.06); border:1px solid rgba(74,222,128,0.25); border-radius:8px; padding:14px 16px; display:flex; align-items:center; gap:12px;">
              <span style="font-size:1.2rem;">✅</span>
              <div>
                <div style="font-family:'Rajdhani',sans-serif; font-size:0.85rem; font-weight:700; color:#4ade80; letter-spacing:1px;">FINGERPRINT CAPTURED</div>
                <div style="font-size:0.78rem; color:var(--muted); margin-top:2px;">Template stored • Quality: <span style="color:var(--teal);">Excellent</span> • Ready to register</div>
              </div>
            </div>
          </div>

          <button class="submit-btn" id="submitBtn" onclick="submitForm()" disabled>COMPLETE REGISTRATION</button>

          <div class="step-nav" style="margin-top:12px;">
            <button class="btn-back" onclick="goStep(2)">← Back</button>
          </div>
        </div>

        <!-- SUCCESS -->
        <div class="success-overlay" id="successOverlay">
          <div class="success-circle">✓</div>
          <div class="success-title">REGISTERED!</div>
          <p class="success-sub">Your biometric profile has been successfully created.<br>You can now login using your fingerprint.</p>
          <div class="success-id">Matric No: <span id="successMatric">—</span></div>
          <a href="login.html" style="width:100%">
            <button class="submit-btn">PROCEED TO LOGIN →</button>
          </a>
        </div>

        <div class="divider"></div>
        <p class="signin-link">Already registered? <a href="login.html">Sign in with fingerprint</a></p>

      </div>
    </div>
  </div>

  <script>
    let fpCaptured = false;
    let currentStep = 1;

    function goStep(step) {
      if (step > currentStep && !validateStep(currentStep)) return;

      document.getElementById('step' + currentStep).classList.remove('active');
      document.getElementById('step' + step).classList.add('active');

      // Update dots
      for (let i = 1; i <= 3; i++) {
        const dot = document.getElementById('dot' + i);
        dot.className = 'step-dot';
        if (i < step) dot.classList.add('done'), dot.innerHTML = '✓';
        else if (i === step) dot.classList.add('active'), dot.innerHTML = i;
        else dot.innerHTML = i;
      }
      for (let i = 1; i <= 2; i++) {
        const line = document.getElementById('line' + i);
        line.className = 'step-line' + (i < step ? ' done' : '');
      }
      currentStep = step;
    }

    function validateStep(step) {
      let valid = true;
      if (step === 1) {
        valid = checkField('firstName', 'fg-firstname') & valid;
        valid = checkField('lastName', 'fg-lastname') & valid;
        valid = checkEmailField('email', 'fg-email') & valid;
        valid = checkField('phone', 'fg-phone') & valid;
        valid = checkField('dob', 'fg-dob') & valid;
        valid = checkField('gender', 'fg-gender') & valid;
      }
      if (step === 2) {
        valid = checkField('matric', 'fg-matric') & valid;
        valid = checkField('dept', 'fg-dept') & valid;
        valid = checkField('level', 'fg-level') & valid;
        valid = checkField('semester', 'fg-semester') & valid;
        valid = checkField('session', 'fg-session') & valid;
      }
      return valid;
    }

    function checkField(id, groupId) {
      const el = document.getElementById(id);
      const group = document.getElementById(groupId);
      if (!el.value.trim()) { group.classList.add('error'); return false; }
      group.classList.remove('error'); return true;
    }

    function checkEmailField(id, groupId) {
      const el = document.getElementById(id);
      const group = document.getElementById(groupId);
      const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRe.test(el.value)) { group.classList.add('error'); return false; }
      group.classList.remove('error'); return true;
    }

    function startFpScan() {
      if (fpCaptured) return;
      const section = document.getElementById('fpSection');
      const status = document.getElementById('fpStatus');
      const btn = document.getElementById('fpBtn');
      const progress = document.getElementById('fpProgress');
      const bar = document.getElementById('fpBar');
      const wrap = document.getElementById('fpWrap');

      section.classList.add('scanning');
      wrap.classList.add('scanning');
      btn.disabled = true;
      btn.textContent = 'SCANNING...';
      status.textContent = 'Hold still... scanning in progress';
      status.className = 'fp-status active';
      progress.classList.add('show');

      let pct = 0;
      const interval = setInterval(() => {
        pct += Math.random() * 8 + 2;
        if (pct >= 100) { pct = 100; clearInterval(interval); finishScan(); }
        bar.style.width = pct + '%';
      }, 120);
    }

    function finishScan() {
      fpCaptured = true;
      const section = document.getElementById('fpSection');
      const status = document.getElementById('fpStatus');
      const btn = document.getElementById('fpBtn');
      const submitBtn = document.getElementById('submitBtn');
      const fpInfo = document.getElementById('fpInfo');

      section.classList.remove('scanning');
      section.classList.add('success');
      status.textContent = 'Fingerprint captured successfully!';
      status.className = 'fp-status done';
      btn.textContent = '✓ CAPTURED';
      btn.className = 'fp-btn success-btn';
      fpInfo.style.display = 'block';
      fpInfo.style.animation = 'fadeUp 0.4s ease both';
      submitBtn.disabled = false;
    }

    function submitForm() {
      if (!fpCaptured) return;

      // Collect data
      const data = {
        firstName: document.getElementById('firstName').value,
        lastName: document.getElementById('lastName').value,
        email: document.getElementById('email').value,
        phone: document.getElementById('phone').value,
        dob: document.getElementById('dob').value,
        gender: document.getElementById('gender').value,
        matric: document.getElementById('matric').value,
        dept: document.getElementById('dept').value,
        level: document.getElementById('level').value,
        semester: document.getElementById('semester').value,
        session: document.getElementById('session').value,
        fp_captured: true
      };

      // NOTE: Real implementation — send to PHP API:
      // fetch('api/students/register.php', { method:'POST', headers:{'Content-Type':'application/json'}, body: JSON.stringify(data) })

      console.log('[JamilAMS] Student registration payload:', data);

      // Show success
      document.getElementById('step3').style.display = 'none';
      document.getElementById('successOverlay').classList.add('show');
      document.getElementById('successMatric').textContent = data.matric;
    }

    // Remove error on input
    document.querySelectorAll('input, select').forEach(el => {
      el.addEventListener('input', () => {
        const parent = el.closest('.field-group');
        if (parent) parent.classList.remove('error');
      });
    });
  </script>
</body>
</html>
